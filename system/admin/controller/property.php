<?php

class Property extends Admin_controller {

    function __construct()
    {
        parent::__construct();
        $this->loadModel('property_model');
    }

    /**
     * Ingatlanok listája
     */
    public function index()
    {
        $this->view = new View();

        $this->view->filter = array();

        $this->view->title = 'Ingatlanok oldal';
        $this->view->description = 'Ingatlanok oldal description';

        $this->view->add_links(array('datatable','select2', 'bootbox', 'vframework', 'property_list'));

        $this->view->users = $this->property_model->users_list_query();
        $this->view->county_list = $this->property_model->county_list_query();
        // kerületek nevének és id-jének lekérdezése az option listához
        $this->view->district_list = $this->property_model->list_query('district_list');
        // ingatlan kategóriák lekérdezése
        $this->view->ingatlan_kat_list = $this->property_model->list_query('ingatlan_kategoria');

/*
        if ($this->request->has_query('action') && $this->request->get_query('action') == 'search') {

            $this->view->all_property = $this->property_model->properties_filter_query();
            Session::init();
            Session::set('filter', $this->request->get_query() );
            $this->view->filter = Session::get('filter');
        } else {
            $this->view->all_property = $this->property_model->all_property_query();
        }
*/

//$this->view->debug(true);

        $this->view->set_layout('tpl_layout');
        $this->view->render('property/tpl_property_list');
    }

    /**
     * Ingatlan részletek
     */
    public function details()
    {
        $this->view = new View();

        $id = (int) $this->request->get_params('id');

        $this->view->title = 'Ingatlan részletek oldal';
        $this->view->description = 'Ingatlan részletek oldal description';

        $this->view->add_links(array('fancybox', 'property_details'));

        $this->view->property_data = $this->property_model->get_property_query($id);
        
        $this->view->photos = json_decode($this->view->property_data['kepek']);
        $this->view->docs = json_decode($this->view->property_data['docs']);

//$this->view->debug(true);

        $this->view->set_layout('tpl_layout');
        $this->view->render('property/tpl_property_details');
    }

    public function search()
    {
        die('work in progress');
    }



            /**
             *  (AJAX) Az ingatlanok listáját adja vissza és kezeli a csoportos művelteket is
             */
            public function ajax_get_property()
            {
                if ($this->request->is_ajax()) {
                    $request_data = $this->request->get_post();  //$_REQUEST;
                    $json_data = $this->property_model->ajax_get_propertys($request_data);
                    // adatok visszaküldése a javascriptnek
                    echo json_encode($json_data);
                
                } else {
                    Util::redirect('error');
                }       
            }





    /**
     * 	Új lakás hozzáadása
     */
    public function insert()
    {
        $this->view = new View();

        // adatok bevitele a view objektumba
        $this->view->title = 'Új lakás oldal';
        $this->view->description = 'Új lakás description';

        $this->view->add_links(array('jquery-ui', 'select2', 'validation', 'ckeditor', 'kartik-bootstrap-fileinput', 'google-maps', 'property_insert', 'autocomplete'));

        // Megyék adatainak lekérdezése az option listához
        $this->view->county_list = $this->property_model->county_list_query();
        // kerületek nevének és id-jének lekérdezése az option listához
        $this->view->district_list = $this->property_model->list_query('district_list');
        // ingatlan kategóriák lekérdezése
        $this->view->ingatlan_kat_list = $this->property_model->list_query('ingatlan_kategoria');
        $this->view->ingatlan_allapot_list = $this->property_model->list_query('ingatlan_allapot');
        $this->view->ingatlan_futes_list = $this->property_model->list_query('ingatlan_futes');
        $this->view->ingatlan_parkolas_list = $this->property_model->list_query('ingatlan_parkolas');
        $this->view->ingatlan_kilatas_list = $this->property_model->list_query('ingatlan_kilatas');
        $this->view->ingatlan_energetika_list = $this->property_model->list_query('ingatlan_energetika');
        $this->view->ingatlan_kert_list = $this->property_model->list_query('ingatlan_kert');

//$this->view->debug(true);
        $this->view->set_layout('tpl_layout');
        $this->view->render('property/tpl_property_insert');
    }

    /**
     * 	Lakás adatainak módosítása oldal	
     */
    public function update()
    {
        $this->view = new View();

        $id = (int) $this->request->get_params('id');

        $this->view->title = 'Lakás adatok módosítás oldal';
        $this->view->description = 'Lakás adatok módosítás description';
        
        $this->view->add_links(array('jquery-ui', 'select2', 'validation', 'ckeditor', 'kartik-bootstrap-fileinput', 'property_update'));

        // a lakás összes adatának lekérdezése az ingatlanok táblából
        $this->view->content = $this->property_model->one_property_alldata_query($id);
        // Megyék adatainak lekérdezése az option listához
        $this->view->county_list = $this->property_model->county_list_query();
        // kerületek nevének és id-jének lekérdezése az option listához
        $this->view->district_list = $this->property_model->list_query('district_list');
        // ingatlan kategóriák lekérdezése
        $this->view->ingatlan_kat_list = $this->property_model->list_query('ingatlan_kategoria');
        $this->view->ingatlan_allapot_list = $this->property_model->list_query('ingatlan_allapot');
        $this->view->ingatlan_futes_list = $this->property_model->list_query('ingatlan_futes');
        $this->view->ingatlan_parkolas_list = $this->property_model->list_query('ingatlan_parkolas');
        $this->view->ingatlan_kilatas_list = $this->property_model->list_query('ingatlan_kilatas');
        $this->view->ingatlan_energetika_list = $this->property_model->list_query('ingatlan_energetika');
        $this->view->ingatlan_kert_list = $this->property_model->list_query('ingatlan_kert');
//$this->view->debug(true);
        // template betöltése
        $this->view->set_layout('tpl_layout');
        $this->view->render('property/tpl_property_update');
    }

    /**
     * 	(AJAX) Lakás részletek (modal-ba)
     */
    public function view_property_ajax()
    {
        if ($this->request->is_ajax()) {
            $id = (int)$this->request->get_params('id');
            $this->view->content = $this->property_model->property_details_query($id);

//$this->view->debug(true);			
            //$this->view->location = $this->view->content['county_name'] . $this->view->content['city_name'] . $this->view->content['district_name'];
            $this->view->render('property/tpl_property_view_modal');
        } else {
            Util::redirect('error');
        }
    }

/* ------- AJAX hívások --------------------------------------- */

    /**
     *  (AJAX) Lakás törlése
     */
    public function delete_property_AJAX()
    {
        if($this->request->is_ajax()){
            //if(Acl::check('delete_user')){
            if(1){
                // a POST-ban kapott item_id egy string ami egy szám vagy számok felsorolása pl.: "23" vagy "12,45,76" 
                $id = $this->request->get_post('item_id');
                $result = $this->property_model->delete_property_AJAX($id);

                if($result !== false) {
                    echo json_encode(array(
                        "status" => 'success',
                        "message_success" => 'Ingatlan törölve.'
                    ));

                } else {
                    echo json_encode(array(
                        "status" => 'error',
                        "message" => 'Adatbázis lekérdezési hiba!'
                    ));
                }

            } else {
                echo json_encode(array(
                    'status' => 'error',
                    'message' => 'Nincs engedélye a művelet végrehajtásához!'
                ));
            }
        } else {
            Util::redirect('error');
        }

    }

    /**
     *  (AJAX) Új lakás adatok bevitele adatbázisba,
     *  Lakás adatok módosítása az adatbázisban
     */
    public function insert_update_data_ajax()
    {
        if ( $this->request->is_ajax() ) {
            if ( $this->request->has_post() ) {
                $result = $this->property_model->insert_update_property_data();
                // válasz a javascriptnek
                echo json_encode($result);
            }
        } else {
            Util::redirect('error');
        }
    }

    /**
     * 	(AJAX) File listát jeleníti (frissíti) meg feltöltéskor (képek)
     */
    public function show_file_list()
    {
        if ($this->request->is_ajax()) {
            // db rekord id-je
            $id =  $this->request->get_post('id', 'integer');
            // típus: kepek vagy docs
            $type = $this->request->get_post('type');

            //adatok lekérdezése (a json stringet adja vissza)
            $result = $this->property_model->file_data_query($id, $type);
            // json string átalakítása tömb-bé
            $temp_arr = json_decode($result);

            // lista HTML generálása
            $html = '';
            $counter = 0;

            if ($type == 'kepek') {
                $file_location = Config::get('ingatlan_photo.upload_path');

                foreach ($temp_arr as $key => $value) {
                    $counter = $key + 1;
                    $file_path = Util::thumb_path($file_location . $value);
                    $html .= '<li id="elem_' . $counter . '" class="ui-state-default"><img class="img-thumbnail" src="' . $file_path . '" alt="" /><button style="position:absolute; top:20px; right:20px; z-index:2;" class="btn btn-xs btn-default" type="button" title="Kép törlése"><i class="glyphicon glyphicon-trash"></i></button></li>' . "\n\r";
                }
            }
            if ($type == 'docs') {
                $file_location = Config::get('ingatlan_doc.upload_path');

                foreach ($temp_arr as $key => $value) {
                    $counter = $key + 1;
                    $file_path = Util::thumb_path($file_location . $value);
                    $html .= '<li id="doc_' . $counter . '" class="list-group-item"><i class="glyphicon glyphicon-file"> </i>&nbsp;' . $value . '<button type="button" class="btn btn-xs btn-default" style="position: absolute; top:8px; right:8px;"><i class="glyphicon glyphicon-trash"></i></button></li>' . "\n\r";
                }
            }

            // lista visszaküldése a javascriptnek
            echo $html;
        } else {
            Util::redirect('error');
        }
    }

    /**
     * 	Képek sorbarendezése (AJAX)
     */
    public function photo_sort()
    {
        if ($this->request->is_ajax()) {
            $id = $this->request->get_post('id', 'integer');
            $sort_json = $this->request->get_post('sort');

            $result = $this->property_model->photo_sort($id, $sort_json);

            if ($result === 1) {
                echo json_encode(array('status' => 'success'));
            } else {
                echo json_encode(array('status' => 'error'));
            }
        } else {
            Util::redirect('error');
        }
    }

    /**
     * 	(AJAX) Kép vagy dokumentum törlése a feltöltöttek listából
     */
    public function file_delete()
    {
        if ($this->request->is_ajax()) {
            $id = $this->request->get_post('id', 'integer');
            // a kapott szorszámból kivonunk egyet, mert a képeket tartalamzó tömbben 0-tól indul a számozás
            $sort_id = ($this->request->get_post('sort_id', 'integer')) - 1;
            $type = $this->request->get_post('type');

            $result = $this->property_model->file_delete($id, $sort_id, $type);

            if ($result) {
                $message = Message::show('A file törölve!');
                echo json_encode(array(
                    'status' => 'success',
                    'message' => $message
                ));
            } else {
                echo json_encode(array('status' => 'error'));
            }
        } else {
            Util::redirect('error');
        }
    }

    /**
     * 	(AJAX) File feltöltés (képek)
     */
    public function file_upload_ajax()
    {
        if ($this->request->is_ajax()) {
            //uploadExtraData beállítás küldi
            $id = $this->request->get_post('id', 'integer');
            $photo_names = $this->property_model->upload_property_photo($_FILES['new_file']);
            $result = $this->property_model->property_file_query($photo_names, 'kepek', $id);

            if ($result !== false) {
                echo json_encode(array('status' => 'success', 'message' => 'Kép feltöltése sikeres.'));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Ismeretlen hiba!'));
            }

        } else {
            Util::redirect('error');
        }
    }

    /**
     * 	(AJAX) Dokumentum feltöltés
     */
    public function doc_upload_ajax()
    {
        if ($this->request->is_ajax()) {
            //uploadExtraData beállítás küldi
            $id = $this->request->get_post('id', 'integer');
            $doc_names = $this->property_model->upload_property_doc($_FILES['new_doc'], $id);
            $result = $this->property_model->property_file_query($doc_names, 'docs', $id);

            if ($result !== false) {
                echo json_encode(array('status' => 'success', 'message' => 'File feltöltése sikeres.'));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Ismeretlen hiba!'));
            }
        } else {
            Util::redirect('error');
        }
    }

    /**
     * (AJAX) Az ingatlanok táblában módosítja az status mező értékét
     *  NEM CSOPORTOS MŰVELET ESETÉN!!
     *
     * @return void
     */
    public function change_status()
    {
        if ( $this->request->is_ajax() ) {

            if ( $this->request->has_post('action') && $this->request->has_post('id') ) {
            
                $id = $this->request->get_post('id', 'integer');
                $action = $this->request->get_post('action');

                if($action == 'make_active') {
                    $result = $this->property_model->change_status_query($id, 1);
                    if($result !== false){
                        echo json_encode(array(
                            "status" => 'success',
                            "message" => 'Az elem aktiválása megtörtént!'
                        ));     
                    } else {
                        echo json_encode(array(
                            "status" => 'error',
                            "message" => 'Adatbázis lekérdezési hiba!'
                        ));
                    }
                }
                if($action == 'make_inactive') {
                    $result = $this->property_model->change_status_query($id, 0);
                    if($result !== false){
                        echo json_encode(array(
                            "status" => 'success',
                            "message" => 'Az elem blokkolása megtörtént!'
                        ));     
                    } else {
                        echo json_encode(array(
                            "status" => 'error',
                            "message" => 'Adatbázis lekérdezési hiba!'
                        ));
                    }
                    
                }
            } else {
                echo json_encode(array(
                    "status" => 'error',
                    "message" => 'Ismeretlen hiba!'
                ));
            }
        } else {
            Util::redirect('error');
        }
    }   

    /**
     * (AJAX) Az ingatlanok táblában módosítja az kiemeles mező értékét
     *
     * @return void
     */
    public function change_kiemeles()
    {
        if ( $this->request->is_ajax() ) {
            if ( $this->request->has_post('action') && $this->request->has_post('id') ) {

                $id = $this->request->get_post('id', 'integer');

                if ($this->request->get_post('action') == 'delete_kiemeles') {
                    $result = $this->property_model->change_kiemeles_query($id, 0);
                    if ($result !== false) {
                        echo json_encode(array("status" => 'success'));
                    } else {
                        echo json_encode(array("status" => 'error'));
                    }
                }
                if ($this->request->get_post('action') == 'add_kiemeles') {
                    $result = $this->property_model->change_kiemeles_query($id, 1);
                    if ($result !== false) {
                        echo json_encode(array("status" => 'success'));
                    } else {
                        echo json_encode(array("status" => 'error'));
                    }
                }
            }
        } else {
            Util::redirect('error');
        }
    }

    /**
     * 	(AJAX) - Visszadja a kiválasztott kerület városrészeinek option listáját  
     */
    public function kerulet_utca_list()
    {
        if ($this->request->is_ajax()) {
            if ($this->request->has_post('district_id')) {
                $id = $this->request->get_post('district_id', 'integer');
                $result = $this->property_model->utca_list_query($id);

                $string = '<option value="">Válasszon</option>' . "\r\n";
                foreach ($result as $value) {
                    //$string .= '<option data-zipcode="' . $value['zip_code'] . '" value="' . $value['street_id'] . '">' . $value['street_name'] . ' &nbsp;(' . $value['zip_code'] . ')</option>' . "\r\n";
                    $string .= '<option value="' . $value['street_id'] . '-' . $value['zip_code'] . '">' . $value['street_name'] . ' (' . $value['zip_code'] . ')</option>' . "\r\n";
                }
                //válasz a javascriptnek (option lista)
                echo $string;
            }
        } else {
            Util::redirect('error');
        }
    }

    /**
     * 	(AJAX) - Visszadja a kiválasztott megye városainak option listáját  
     */
    public function county_city_list()
    {
        if ($this->request->is_ajax()) {
            if ($this->request->has_post('county_id')) {
                $id = $this->request->get_post('county_id', 'integer');
                if ($id == 5) {
                    $string = '<option value="88">Budapest</option>' . "\r\n";
                } else {
                    $result = $this->property_model->city_list_query($id);

                    $string = '';
                    foreach ($result as $value) {
                        $string .= '<option value="' . $value['city_id'] . '">' . $value['city_name'] . '</option>' . "\r\n";
                    }
                }
                //válasz a javascriptnek (option lista)
                echo $string;
            }
        } else {
            Util::redirect('error');
        }
    }
    
   /**
     * 	utca keresés autocomplete 
     */
    public function street_list()
    {
        if ($this->request->is_ajax()) {
            $text = $this->request->get_query('query');
            if($text) {
                $result = $this->property_model->get_street_suggestions($text);
                echo json_encode(array('suggestions' => $result));
                
            }
        }    

    }    

}
?>