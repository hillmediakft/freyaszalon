<?php

class Before_after_photo_gallery extends Admin_controller {

    function __construct() {
        parent::__construct();
        $this->loadModel('before_after_photo_gallery_model');
    }

    public function index() {
        $this->view = new View();

        $this->view->title = 'Előtt-utána fotó galériák oldal';
        $this->view->description = 'Előtt-utána fotó galériák oldal description';
        // kategóriák
        $this->view->photo_categories = $this->before_after_photo_gallery_model->photo_category_list_query();
        // összes rekord a photo_gallery-ból	
        $this->view->all_photos = $this->before_after_photo_gallery_model->all_photos();
// $this->view->debug(true);
        $this->view->add_links(array('bootbox', 'mixitup', 'vframework', 'photo_gallery', 'portfolio', 'fancybox'));

        $this->view->set_layout('tpl_layout');
        $this->view->render('photo_gallery/tpl_before_after_photo_gallery');
    }

    /**
     * Új fotó hozzáadása
     *
     * @return void
     */
    public function new_photo() {


        if ($this->request->has_post()) {
            $result = $this->before_after_photo_gallery_model->insert_photo();
            if ($result) {
                Util::redirect('before_after_photo_gallery');
            } else {
                Util::redirect('before_after_photo_gallery/new_photo');
            }
        }

        $this->view = new View();

        // adatok bevitele a view objektumba
        $this->view->title = 'Új előtte-utána fotó oldal';
        $this->view->description = 'Új előtte-utána fotó oldal description';

        // kategóriák nevének és id-jének lekérdezése az option listához
        $this->view->category_list = $this->before_after_photo_gallery_model->photo_category_list_query();

        $this->view->add_links(array('croppic', 'bootbox', 'ckeditor', 'vframework', 'new_before_after_photo'));

        $this->view->set_layout('tpl_layout');
        $this->view->render('photo_gallery/tpl_before_after_new_photo');
    }

    /**
     * Kép adatainak szerkesztése (új kép feltöltése, szöveg módosítása, kiemelés, kategória módosítása)
     *
     *
     * @return void
     */
    public function edit() {
        $id = $this->request->get_params('id');

        if ($this->request->has_post()) {
            $result = $this->before_after_photo_gallery_model->update_photo($id);
            if ($result) {
                Util::redirect('before_after_photo_gallery');
            } else {
                Util::redirect('before_after_photo_gallery/edit/' . $id);
            }
        }

        $this->view = new View();

        // adatok bevitele a view objektumba
        $this->view->title = 'Előtte-utána fotó szerkesztése';
        $this->view->description = 'Előtte-utána fotó szerkesztése description';


        $this->view->photo = $this->before_after_photo_gallery_model->photo_data_query($id);
        $this->view->category_list = $this->before_after_photo_gallery_model->photo_category_list_query();


        $this->view->add_links(array('croppic', 'bootbox', 'ckeditor', 'vframework', 'edit_before_after_photo'));

        $this->view->set_layout('tpl_layout');
        $this->view->render('photo_gallery/tpl_edit_before_after_photo');
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
                    $photo_name = $this->before_after_photo_gallery_model->selectFilename($id);
                    //rekord törlése	
                    $result = $this->before_after_photo_gallery_model->delete($id);

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

        $result = $this->before_after_photo_gallery_model->delete_photo($id);

        Util::redirect('before_after_photo-gallery');
    }

    /*     * ******---------------------------------------******** */

    /**
     * Kategóriák listája
     */
    public function category() {
        $this->view = new View();

// adatok bevitele a view objektumba
        $this->view->title = 'Admin előtte-utána képgaléria kategória oldal';
        $this->view->description = 'Admin előtte-utána képgaléria kategória description';
        $this->view->all_photo_category = $this->before_after_photo_gallery_model->photo_category_query();
        $this->view->no_of_photos = $this->before_after_photo_gallery_model->get_no_of_photos_in_category();

        $this->view->add_links(array('bootbox', 'vframework', 'photo_category'));

        $this->view->set_layout('tpl_layout');
        $this->view->render('photo_gallery/tpl_before_after_photo_category');
    }

    /**
     * 	Kép törlése a photo_gallery-ből
     *
     */
    public function delete_category() {
        $id = $this->request->get_params('id');

        $result = $this->before_after_photo_gallery_model->delete_category($id);

        Util::redirect('before-after-photo-gallery/category');
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
                $photo_names_temp = $this->before_after_photo_gallery_model->selectFilenameWhereCategory($id);

                $photo_names = array();
                foreach ($photo_names_temp as $key => $value) {
                    $photo_names[] = $value['photo_filename'];
                }
                unset($photo_names_temp);

                // képekhez tartozó rekordok törlése
                $result = $this->before_after_photo_gallery_model->deleteWhereCategory($id);

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
            $result = $this->before_after_photo_gallery_model->category_insert();

            if ($result) {
                Util::redirect('before_after_photo_gallery/category');
            } else {
                Util::redirect('before_after_photo_gallery/category_insert');
            }
        }

        $this->view = new View();

        $this->view->title = 'Új előtte-utána képgaléria kategória hozzáadása oldal';
        $this->view->description = 'Új előtte-utána képgaléria kategória description';

        $this->view->add_links(array('bootbox', 'vframework'));

        $this->view->set_layout('tpl_layout');
        $this->view->render('photo_gallery/tpl_before_after_photo_gallery_category_insert');
    }

    /**
     * 	Képgaléria kategória nevének módosítása
     */
    public function category_update() {

        if ($this->request->has_post()) {
            $result = $this->before_after_photo_gallery_model->category_update($this->request->get_params('id'));
            if ($result) {
                Util::redirect('before_after_photo_gallery/category');
            } else {
                Util::redirect('before_after_photo_gallery/category_update/' . $this->request->get_params('id'));
            }
        }

        $this->view = new View();

        $this->view->title = 'Admin előtte-utána képgaléria kategória módosítása oldal';
        $this->view->description = 'Admin előtte-utána képgaléria kategória módosítása description';


        $this->view->add_links(array('bootbox', 'vframework'));

        $this->view->category_content = $this->before_after_photo_gallery_model->photo_category_query($this->request->get_params('id'));

        $this->view->set_layout('tpl_layout');
        $this->view->render('photo_gallery/tpl_before_after_photo_gallery_category_update');
    }

    /**
     * 	A felhasználó képét tölti fel a szerverre, és készít egy kisebb méretű képet is.
     *
     * 	Ez a metódus kettő XHR kérést dolgoz fel.
     * 	Meghívásakor kap egy id nevű paramétert melynek értékei upload vagy crop
     * 		upload paraméterrel meghívva: feltölti a kiválasztott képet
     * 		crop paraméterrel meghívva: megvágja az eredeti képet és feltölti	
     * 	(a paraméterek megadása a new_user.js fájlban található: admin/users/user_img_upload/upload vagy admin/user_img_upload/crop)
     *
     * 	Az user_img_upload() model metódus JSON adatot ad vissza (ezt "echo-za" vissza ez a metódus a kérelmező javascriptnek). 
     */
    public function before_after_img_upload() {
        if (Util::is_ajax()) {
            echo $this->before_after_photo_gallery_model->before_after_img_upload();
        }
    }

}

?>