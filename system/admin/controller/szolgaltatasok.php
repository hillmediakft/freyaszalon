<?php

class Szolgaltatasok extends Controller {

    protected $content_type_id;

    function __construct() {
        parent::__construct();
        $this->content_type_id = Config::get('content_types.szolgaltatas');
        Auth::handleLogin();
        /*       require_once "system/libs/logged_in_user.php";
          $this->user = new Logged_in_user();
          $this->check_access("menu_szolgaltatasok");
          $this->view->user = $this->user; */
        $this->loadModel('szolgaltatasok_model');
        $this->loadModel('terms_model');
        $this->loadModel('taxonomy_model');
         $this->loadModel('crew_members_model');
    }

    public function index() {

        $this->view = new View();
        $this->view->title = 'Admin szolgáltatások oldal';
        $this->view->description = 'Admin szolgáltatások oldal description';

        $this->view->add_links(array('datatable', 'bootbox', 'select2', 'vframework', 'szolgaltatasok'));

        $this->view->category_list = $this->szolgaltatasok_model->category_list_query();

//$this->view->debug(true);
        $this->view->set_layout('tpl_layout');
        $this->view->render('szolgaltatasok/tpl_szolgaltatasok');
    }

    /**
     * 	Szolgáltatás minden adatának megjelenítése
     */
    public function view_szolgaltatas() {
        $this->view = new View();
        $this->view->title = 'Admin szolgáltatások részletek oldal';
        $this->view->description = 'Admin szolgáltatások részletek oldal description';

        $this->view->add_links(array('common'));

        $this->view->content = $this->szolgaltatasok_model->one_szolgaltatas_alldata_query($this->request->get_params('id'));

//$this->view->debug(true);
        $this->view->set_layout('tpl_layout');
        $this->view->render('szolgaltatasok/tpl_szolgaltatasok_view');
    }

    /**
     * 	Szolgáltatás minden adatának megjelenítése
     */
    public function view_szolgaltatas_ajax() {
        if (Util::is_ajax()) {
            $this->view->content = $this->szolgaltatasok_model->one_szolgaltatas_alldata_query_ajax();

            $this->view->services = $this->szolgaltatasok_model->get_szolgaltatas_services($this->view->content['szolgaltatas_services']);
            $this->view->location = $this->view->content['city_name'] . ' ' . $this->view->content['district_name'];
            $this->view->render('szolgaltatasok/tpl_szolgaltatas_view_modal', true);
        } else {
            Util::redirect('error');
        }
    }

    /**
     * 	Új szolgaltatas hozzáadása
     */
    public function uj_szolgaltatas() {

        if ($this->request->has_post()) {

            $result = $this->szolgaltatasok_model->insert_szolgaltatas();
            if ($result) {

                Util::redirect('szolgaltatasok');
            } else {
                Util::redirect('szolgaltatasok/uj_szolgaltatas');
            }
        }

        $this->view = new View();

        $this->view->title = 'Új szolgáltatás';
        $this->view->description = 'Új szolgáltatás';

        $this->view->add_links(array('bootstrap-fileupload', 'bootbox', 'ckeditor', 'vframework', 'validation', 'select2', 'uj_szolgaltatas'));


        $this->view->category_list = $this->szolgaltatasok_model->category_list_query();
        $this->view->terms = $this->terms_model->getTerms();


        //$this->view->debug(true);
        $this->view->set_layout('tpl_layout');
        $this->view->render('szolgaltatasok/tpl_uj_szolgaltatas');
    }

    /**
     * 	Szolgáltatás módosítása
     *
     */
    public function update_szolgaltatas() {
        $id = $this->request->get_params('id');

        if (!empty($_POST)) {
            $result = $this->szolgaltatasok_model->update_szolgaltatas($id);

            if ($result) {
                Util::redirect('szolgaltatasok');
            } else {
                Util::redirect('szolgaltatasok/update_szolgaltatas/' . $id);
            }
        }

        $this->view = new View();

        // HTML oldal megjelenítése
        // adatok bevitele a view objektumba
        $this->view->title = 'Szolgáltatás módosítása oldal';
        $this->view->description = 'Szolgáltatás módosítása description';

        $this->view->add_links(array('bootstrap-fileupload', 'bootbox', 'ckeditor', 'vframework', 'validation', 'select2', 'szolgaltatas_update'));

        // a módosítandó szolgáltatás adatai
        $this->view->actual_szolgaltatas = $this->szolgaltatasok_model->one_szolgaltatas_query($id);

        // munkatársak
        $this->view->service_crew_members = $this->crew_members_model->crew_members_by_id(json_decode($this->view->actual_szolgaltatas[0]['crew_members']));
        $this->view->crew_members = $this->crew_members_model->all_crew_member_query();

        $this->view->category_list = $this->szolgaltatasok_model->category_list_query();
        // címkék beolvasása és betöltése 
        $this->view->terms = $this->terms_model->getTerms();
        // a szolgáltatáshoz tartozó címkék betöltése
        $this->view->terms_by_content_id = Util::convertArrayToOneDimensional($this->taxonomy_model->getTermsByContentIdAndContentTypeId($id, $this->content_type_id));



//$this->view->debug(true);
        $this->view->set_layout('tpl_layout');
        $this->view->render('szolgaltatasok/tpl_update_szolgaltatas');
    }

    /* --------------------------------------------------------------------------------- */

    /**
     * 	1 szolgáltatás törlése
     */
    public function ajax_delete_szolgaltatas() {
        if (isset($_POST['delete_id'])) {
            // ez a metódus true-val tér vissza (false esetén kivételt dob!)
            $result = $this->szolgaltatasok_model->delete_szolgaltatas(array($_POST['delete_id']));

            // visszatérés üzenetekkel
            if ($result['success'] == 1) {
                echo json_encode(array(
                    "status" => 'success',
                    "message" => 'A szolgáltatás törlése sikerült!'
                ));
            } else {
                echo json_encode(array(
                    "status" => 'error',
                    "message" => 'A szolgáltatás nem törölhető!'
                ));
            }
        } else {
            throw new Exception('HIBA az ajax_delete_szolgaltatasok metódusban: Nem létezik $_POST["delete_id"]');
        }
    }

    /**
     * 	Munkák listáját adja vissza és kezeli a csoportos művelteket is
     */
    public function ajax_get_szolgaltatasok() {
        if (Util::is_ajax()) {
            $request_data = $_REQUEST;
            $json_data = $this->szolgaltatasok_model->ajax_get_szolgaltatasok($request_data);

// adatok visszaküldése a javascriptnek
            $json_data = Util::convert_array_to_utf8($json_data);

            if (json_encode($json_data)) {
                echo json_encode($json_data);
            } else {
                echo json_last_error_msg();
            }
        } else {
            Util::redirect('error');
        }
    }

    /**
     * 	Szolgáltatás kategóriák megjelenítése
     */
    public function category() {

        $this->view = new View();
        $this->view->title = 'Szolgáltatás kategóriák oldal';
        $this->view->description = 'Admin szolgáltatás kategóriák oldal description';

        $this->view->add_links(array('datatable', 'bootbox', 'select2', 'vframework', 'szolgaltatasok_category'));

        $this->view->all_szolgaltatasok_category = $this->szolgaltatasok_model->szolgaltatas_list_query();
        $this->view->category_counter = $this->szolgaltatasok_model->szolgaltatasok_category_counter_query();

//$this->view->debug(true);
        $this->view->set_layout('tpl_layout');
        $this->view->render('szolgaltatasok/tpl_szolgaltatasok_category');
    }

    /**
     * 	Új szolgáltatás kategória hozzáadása
     */
    public function category_insert() {


        // új szolgáltatás kategória hozzáadása
        if ($this->request->has_post('szolgaltatas_list_name')) {
            $result = $this->szolgaltatasok_model->category_insert();

            if ($result) {
                Util::redirect('szolgaltatasok/category');
            } else {
                Util::redirect('szolgaltatasok/category_insert');
            }
        }
        $this->view = new View();

        $this->view->title = 'Új szolgáltatás kategória hozzáadása oldal';
        $this->view->description = 'Új szolgáltatás kategória description';

        $this->view->add_links(array('bootstrap-fileupload', 'bootbox', 'vframework', 'szolgaltatas_category_insert_update', 'validation'));

        //$this->view->debug(true);
        $this->view->set_layout('tpl_layout');
        $this->view->render('szolgaltatasok/tpl_szolgaltatas_category_insert');
    }

    /**
     * 	Szolgáltatás kategória nevének módosítása
     */
    public function category_update() {


        $id = (int) $this->request->get_params('id');

        if ($this->request->has_post()) {
            $result = $this->szolgaltatasok_model->category_update($id);
            if ($result >= 0) {
                Util::redirect('szolgaltatasok/category');
            } else {
                Util::redirect('szolgaltatasok/category_update/' . $id);
            }
        }

        $this->view = new View();

        $this->view->title = 'Szolgáltatás kategória módosítása oldal';
        $this->view->description = 'Szolgáltatás kategória módosítása description';

        $this->view->add_links(array('bootstrap-fileupload', 'ckeditor', 'bootbox', 'vframework', 'szolgaltatas_category_insert_update', 'validation'));

        $this->view->category_content = $this->szolgaltatasok_model->szolgaltatas_list_query($id);

//$this->view->debug(true);
        $this->view->set_layout('tpl_layout');
        $this->view->render('szolgaltatasok/tpl_szolgaltatas_category_update');
    }

    /**
     * (AJAX) A szolgaltatasok táblában módosítja az szolgaltatasok_status mező értékét
     * 1 szolgáltatás státuszát módosítja
     *
     * @return void
     */
    public function ajax_change_status() {
        if (Util::is_ajax()) {
            if (isset($_POST['action']) && isset($_POST['id'])) {

                $id = (int) $_POST['id'];
                $action = $_POST['action'];

                if ($action == 'make_active') {
                    $result = $this->szolgaltatasok_model->change_status_query(array($id), 1);
                    if ($result['success'] == 1) {
                        echo json_encode(array(
                            "status" => 'success',
                            "message" => 'A szolgáltatás aktív státuszba került!'
                        ));
                    } else {
                        echo json_encode(array(
                            "status" => 'error',
                            "message" => 'Hiba történt'
                        ));
                    }
                }
                if ($action == 'make_inactive') {
                    $result = $this->szolgaltatasok_model->change_status_query(array($id), 0);
                    if ($result['success'] == 1) {
                        echo json_encode(array(
                            "status" => 'success',
                            "message" => 'A szolgáltatás inaktív státuszba került!'
                        ));
                    } else {
                        echo json_encode(array(
                            "status" => 'error',
                            "message" => 'A szolgáltatás státusza nem változott meg!'
                        ));
                    }
                }
            } else {
                throw new Exception('Nincs $_POST["action"] es $_POST["id"]!!!');
            }
        } else {
            Util::redirect('error');
        }
    }

    /**
     * 	(AJAX) - Visszadja a kiválasztott megye városainak option listáját  
     */
    public function county_city_list() {
        if (Util::is_ajax()) {
            if (isset($_POST["county_id"])) {
                $id = (int) $_POST["county_id"];
                $result = $this->szolgaltatasok_model->city_list_query($id);

                $string = '<option value="">Válasszon</option>' . "\r\n";
                foreach ($result as $value) {
                    $string .= '<option value="' . $value['city_id'] . '">' . $value['city_name'] . '</option>' . "\r\n";
                }
                //válasz a javascriptnek (option lista)
                echo $string;
            }
        } else {
            Util::redirect('error');
        }
    }

    /**
     * Kategória törlése
     *
     * @return void
     */
    public function category_delete() {

        $id = (int) $this->request->get_params('id');

        $this->szolgaltatasok_model->delete_category($id);
        Util::redirect('szolgaltatasok/category');
    }

    /**
     * 	(AJAX) File listát jeleníti (frissíti) meg feltöltéskor (képek)
     */
    public function show_file_list() {
        if (Util::is_ajax()) {
            // db rekord id-je
            $id = (int) $_POST['id'];
            // típus: kepek vagy docs
            $type = $_POST['type'];

            //adatok lekérdezése (a json stringet adja vissza)
            $result = $this->szolgaltatasok_model->file_data_query($id);
            // json string átalakítása tömb-bé
            $temp_arr = json_decode($result);

            // lista HTML generálása
            $html = '';
            $counter = 0;


            $file_location = Config::get('szolgaltatasphoto.upload_path');

            foreach ($temp_arr as $key => $value) {
                $counter = $key + 1;
                $file_path = Util::thumb_path($file_location . $value);
                $html .= '<li id="elem_' . $counter . '" class="ui-state-default"><img style="width:100px" class="img-thumbnail" src="' . $file_path . '" alt="" /><button style="position:absolute; top:20px; right:20px; z-index:2;" class="btn btn-xs btn-default" type="button" title="Kép törlése"><i class="fa fa-trash"></i></button></li>' . "\n\r";
            }



            // lista visszaküldése a javascriptnek
            echo $html;
        } else {
            Util::redirect('error');
        }
    }

    /**
     * 	Képek sorbarendezése (AJAX)
     * 	
     */
    public function photo_sort() {
        if (Util::is_ajax()) {
            $id = (int) $_POST['id'];
            $sort_json = $_POST['sort'];

            $result = $this->szolgaltatasok_model->photo_sort($id, $sort_json);

            if ($result) {
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
    public function file_delete() {
        if (Util::is_ajax()) {
            $id = (int) $_POST['id'];
            // a kapott szorszámból kivonunk egyet, mert a képeket tartalamzó tömbben 0-tól indul a számozás
            $sort_id = ((int) $_POST['sort_id']) - 1;

            $result = $this->szolgaltatasok_model->file_delete($id, $sort_id);

            if ($result) {
                echo json_encode(array(
                    'status' => 'success',
                    'message' => 'A file törölve!'
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
    public function file_upload_ajax() {
        if (Util::is_ajax()) {
            //uploadExtraData beállítás küldi
            $id = (int) $_POST['id'];
            $photo_names = $this->szolgaltatasok_model->upload_szolgaltatas_extra_photos($_FILES['new_file']);
            $result = $this->szolgaltatasok_model->szolgaltatas_file_query($photo_names, $id);

            if ($result) {
                echo json_encode(array('status' => 'success'));
            } else {
                echo json_encode(array('status' => 'error'));
            }
        } else {
            Util::redirect('error');
        }
    }

    /**
     * 	Képek sorbarendezése (AJAX)
     * 	
     */
    public function szolgaltatas_kategoria_sorrend() {
        $this->view = new View();

        $this->view->title = 'Új szolgáltatás';
        $this->view->description = 'Új szolgáltatás';

        $this->view->add_links(array('nestable', 'szolgaltatas_category_order'));


        $this->view->category_list = $this->szolgaltatasok_model->category_list_query();

        //$this->view->debug(true);
        $this->view->set_layout('tpl_layout');
        $this->view->render('szolgaltatasok/tpl_szolgaltatas_category_order');
    }

    /**
     * 	Képek sorbarendezése (AJAX)
     * 	
     */
    public function szolgaltatas_sorrend() {
        $this->view = new View();

        $this->view->title = 'Új szolgáltatás';
        $this->view->description = 'Új szolgáltatás';

        $this->view->add_links(array('nestable', 'szolgaltatas_order'));

        $szolgaltatas_categories = $this->szolgaltatasok_model->getCategories();
        foreach ($szolgaltatas_categories as $value) {
            $menu[$value['szolgaltatas_list_name']] = $this->szolgaltatasok_model->getSzolgaltatasokByCategory($value['szolgaltatas_list_id']);
        }
        $this->view->szolgaltatasok = $menu;

        $this->view->category_list = $this->szolgaltatasok_model->category_list_query();

        //$this->view->debug(true);
        $this->view->set_layout('tpl_layout');
        $this->view->render('szolgaltatasok/tpl_szolgaltatas_order');
    }

    /**
     * 	szolgáltatás kategóriák sorbarendezése (AJAX)
     * 	
     */
    public function szolgaltatas_category_sort() {
        if (Util::is_ajax()) {

            $sort_json = $_POST['sort'];

            $result = $this->szolgaltatasok_model->szolgaltatas_category_sort(json_decode($sort_json));

            if ($result) {
                echo json_encode(array('status' => 'success'));
            } else {
                echo json_encode(array('status' => 'error'));
            }
        } else {
            Util::redirect('error');
        }
    }

    /**
     * 	szolgáltatás kategóriák sorbarendezése (AJAX)
     * 	
     */
    public function szolgaltatas_sort() {

        if (Util::is_ajax()) {

            $sort_json = $_POST['sort'];

            $result = $this->szolgaltatasok_model->szolgaltatas_sort(json_decode($sort_json));

            if ($result) {
                echo json_encode(array('status' => 'success'));
            } else {
                echo json_encode(array('status' => 'error'));
            }
        } else {
            Util::redirect('error');
        }
    }

}

?>