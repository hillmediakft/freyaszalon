<?php

class Photo_gallery extends Admin_controller {

    protected $content_type_id;
    
    function __construct() {
        parent::__construct();
        $this->content_type_id = Config::get('content_types.kep');
        $this->loadModel('photo_gallery_model');
        $this->loadModel('terms_model');
        $this->loadModel('taxonomy_model');
    }

    public function index() {
        $this->view = new View();

        $this->view->title = 'Fotó galériák oldal';
        $this->view->description = 'Fotó galériák oldal description';
        // kategóriák
        $this->view->photo_categories = $this->photo_gallery_model->photo_category_list_query();
        // összes rekord a photo_gallery-ból	
        $this->view->all_photos = $this->photo_gallery_model->all_photos();
// $this->view->debug(true);
        $this->view->add_links(array('bootbox', 'mixitup', 'vframework', 'photo_gallery', 'portfolio', 'fancybox'));

        $this->view->set_layout('tpl_layout');
        $this->view->render('photo_gallery/tpl_photo_gallery');
    }

    /**
     * Új fotó hozzáadása
     *
     * @return void
     */
    public function new_photo() {


        if ($this->request->has_post()) {
            $this->photo_gallery_model->save_photo();
            Util::redirect('photo_gallery');
        }

        $this->view = new View();

        // adatok bevitele a view objektumba
        $this->view->title = 'Új fotó oldal';
        $this->view->description = 'Új fotó oldal description';

        // kategóriák nevének és id-jének lekérdezése az option listához
        $this->view->category_list = $this->photo_gallery_model->photo_category_list_query();
        $this->view->terms = $this->terms_model->getTerms();

        $this->view->title = 'Új fotó oldal';
        $this->view->description = 'Új fotó oldal description';

        $this->view->add_links(array('bootstrap-fileupload', 'bootbox', 'vframework', 'select2', 'photo_gallery_insert'));

        $this->view->set_layout('tpl_layout');
        $this->view->render('photo_gallery/tpl_new_photo');
    }

    /**
     * Kép adatainak szerkesztése (új kép feltöltése, szöveg módosítása, kiemelés, kategória módosítása)
     *
     *
     * @return void
     */
    public function edit() {
        $id = (int) $this->request->get_params('id');

        if ($this->request->has_post()) {
            $result = $this->photo_gallery_model->update_photo($id);
            Util::redirect('photo-gallery');
        }

        $this->view = new View();
        // adatok bevitele a view objektumba
        $this->view->title = 'Fotó szerkesztése oldal';
        $this->view->description = 'Fotó szerkesztése description';

        $this->view->add_links(array('bootstrap-fileupload', 'bootbox', 'vframework', 'select2', 'photo_gallery_update'));

        $this->view->photo = $this->photo_gallery_model->photo_data_query($id);
        $this->view->category_list = $this->photo_gallery_model->photo_category_list_query();
        $this->view->terms = $this->terms_model->getTerms();
        $this->view->terms_by_content_id = Util::convertArrayToOneDimensional($this->taxonomy_model->getTermsByContentIdAndContentTypeId($id, $this->content_type_id));

        $this->view->set_layout('tpl_layout');
        $this->view->render('photo_gallery/tpl_edit_photo');
    }

    /**
     * 	Photo törlése AJAX-al
     */
    public function delete_photo_AJAX() {
        if ($this->request->is_ajax()) {
            if (1) {
                // a POST-ban kapott item_id egy tömb
                $id_arr = $this->request->get_post('item_id');
                // a sikeres törlések számát tárolja
                $success_counter = 0;
                // a sikeresen törölt id-ket tartalmazó tömb
                $success_id = array();
                // a sikertelen törlések számát tárolja
                $fail_counter = 0;

                $file_helper = DI::get('file_helper');
                $url_helper = DI::get('url_helper');

                // bejárjuk a $id_arr tömböt és minden elemen végrehajtjuk a törlést
                foreach ($id_arr as $id) {
                    //átalakítjuk a integer-ré a kapott adatot
                    $id = (int) $id;
                    //lekérdezzük a törlendő kép nevét, hogy törölhessük a szerverről
                    $photo_name = $this->photo_gallery_model->selectFilename($id);
                    //rekord törlése	
                    $result = $this->photo_gallery_model->delete($id);

                    if ($result !== false) {
                        // ha a törlési sql parancsban nincs hiba
                        if ($result > 0) {
                            //ha van feltöltött kép (az adatbázisban szerepel a file-név)
                            if (!empty($photo_name)) {
                                $picture_path = Config::get('photogallery.upload_path') . $photo_name;
                                $thumb_picture_path = $url_helper->thumbPath($picture_path);
                                $file_helper->delete(array($picture_path, $thumb_picture_path));
                            }
                            //sikeres törlés
                            $success_counter += $result;
                            $success_id[] = $id;
                        } else {
                            //sikertelen törlés
                            $fail_counter++;
                        }
                    } else {
                        // ha a törlési sql parancsban hiba van
                        $this->response->json(array(
                            'status' => 'error',
                            'message_error' => 'Hibas sql parancs: nem sikerult a DELETE lekerdezes az adatbazisbol!',
                        ));
                    }
                }

                // üzenetek visszaadása
                $respond = array();
                $respond['status'] = 'success';

                if ($success_counter > 0) {
                    $respond['message_success'] = 'Kép törölve.';
                }
                if ($fail_counter > 0) {
                    $respond['message_error'] = 'A képet már töröltek!';
                }

                // válasz
                $this->response->json($respond);
            } else {
                $this->response->json(array(
                    'status' => 'error',
                    'message' => 'Nincs engedélye a művelet végrehajtásához!'
                ));
            }
        }
    }

    /**
     * 	Kép törlése a photo_gallery-ből
     *
     */
    public function delete() {
        $id = $this->request->get_params('id');

        $result = $this->photo_gallery_model->delete_photo($id);

        Util::redirect('photo-gallery');
    }

    /*     * ******---------------------------------------******** */

    /**
     * Kategóriák listája
     */
    public function category() {
        $this->view = new View();

// adatok bevitele a view objektumba
        $this->view->title = 'Admin képgaléria kategória oldal';
        $this->view->description = 'Admin képgaléria kategória description';
        $this->view->all_photo_category = $this->photo_gallery_model->photo_category_query();
        $this->view->no_of_photos = $this->photo_gallery_model->get_no_of_photos_in_category();

        $this->view->add_links(array('bootbox', 'vframework', 'photo_category'));

        $this->view->set_layout('tpl_layout');
        $this->view->render('photo_gallery/tpl_photo_category');
    }

    /**
     * 	Kép törlése a photo_gallery-ből
     *
     */
    public function delete_category() {
        $id = $this->request->get_params('id');

        $result = $this->photo_gallery_model->delete_category($id);

        Util::redirect('photo-gallery/category');
    }

    /**
     * 	Kategória törlése AJAX-al
     */
    public function delete_category_AJAX() {
        if ($this->request->is_ajax()) {
            if (1) {
                // a POST-ban kapott user_id egy tömb
                $id = $this->request->get_post('item_id', 'integer');
                // a sikeres törlések számát tárolja
                $success_counter = 0;
                // a sikertelen törlések számát tárolja
                $fail_counter = 0;

                // lekérdezzük a törlendő képek nevét
                $photo_names_temp = $this->photo_gallery_model->selectFilenameWhereCategory($id);

                $photo_names = array();
                foreach ($photo_names_temp as $key => $value) {
                    $photo_names[] = $value['photo_filename'];
                }
                unset($photo_names_temp);

                // képekhez tartozó rekordok törlése
                $result = $this->photo_gallery_model->deleteWhereCategory($id);

                // képek törlése
                if ($result !== false) {
                    if ($result > 0) {

                        $file_helper = DI::get('file_helper');
                        $url_helper = DI::get('url_helper');
                        $upload_path = Config::get('photogallery.upload_path');

                        foreach ($photo_names as $value) {
                            $picture_path = $upload_path . $value;
                            $thumb_picture_path = $url_helper->thumbPath($picture_path);
                            $file_helper->delete(array($picture_path, $thumb_picture_path));
                        }
                    }
                }

                // kategória törlése
                $result = $this->photocategory_model->deleteCategory($id);

                if ($result !== false) {
                    // ha a törlési sql parancsban nincs hiba
                    if ($result > 0) {
                        $success_counter += $result;
                    } else {
                        //sikertelen törlés
                        $fail_counter++;
                    }
                } else {
                    // ha a törlési sql parancsban hiba van
                    $this->response->json(array(
                        'status' => 'error',
                        'message_error' => 'Hibas sql parancs: nem sikerult a DELETE lekerdezes az adatbazisbol!',
                    ));
                }

                // üzenetek visszaadása
                $respond = array();
                $respond['status'] = 'success';

                if ($success_counter > 0) {
                    $respond['message_success'] = 'Kategória törölve.';
                }
                if ($fail_counter > 0) {
                    $respond['message_error'] = 'A kategóriát már törölték!';
                }

                // respond tömb visszaadása
                $this->response->json($respond);
            } else {
                $this->response->json(array(
                    'status' => 'error',
                    'message' => 'Nincs engedélye a művelet végrehajtásához!'
                ));
            }
        }
    }

    /**
     * 	Új képgaléria kategória hozzáadása
     */
    public function category_insert() {
        // új kategória hozzáadása
        if ($this->request->has_post()) {
            $result = $this->photo_gallery_model->category_insert();

            if ($result) {
                Util::redirect('photo_gallery/category');
            } else {
                Util::redirect('photo_gallery/category_insert');
            }
        }

        $this->view = new View();

        $this->view->title = 'Új képgaléria kategória hozzáadása oldal';
        $this->view->description = 'Új képgaléria kategória description';

        $this->view->add_links(array('bootbox', 'vframework'));

        $this->view->set_layout('tpl_layout');
        $this->view->render('photo_gallery/tpl_photo_gallery_category_insert');
    }

    /**
     * 	Képgaléria kategória nevének módosítása
     */
    public function category_update() {
        if ($this->request->has_post()) {
            $result = $this->photo_gallery_model->category_update($this->request->get_params('id'));
            if ($result) {
                Util::redirect('photo_gallery/category');
            } else {
                Util::redirect('photo_gallery/category_update/' . $this->request->get_params('id'));
            }
        }

        $this->view = new View();

        $this->view->title = 'Admin képgaléria kategória módosítása oldal';
        $this->view->description = 'Admin képgaléria kategória módosítása description';


        $this->view->add_links(array('bootbox', 'vframework'));

        $this->view->category_content = $this->photo_gallery_model->photo_category_query($this->request->get_params('id'));

        $this->view->set_layout('tpl_layout');
        $this->view->render('photo_gallery/tpl_photo_gallery_category_update');
    }

}

?>