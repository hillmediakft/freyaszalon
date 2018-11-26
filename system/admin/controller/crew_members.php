<?php

class Crew_members extends Admin_controller {

    function __construct() {
        parent::__construct();
        $this->loadModel('crew_members_model');
    }

    public function index() {

        $this->view = new View();
        $this->view->title = 'Kollégák oldal';
        $this->view->description = 'Kollégák oldal description';

        $this->view->add_links(array('datatable', 'bootbox', 'select2', 'vframework', 'crew_members'));

        $this->view->all_crew_member = $this->crew_members_model->all_crew_member_query();
//$this->view->debug(true);
        $this->view->set_layout('tpl_layout');
        $this->view->render('crew_members/tpl_crew_members');
    }

    /**
     * 	Munka minden adatának megjelenítése
     */
    public function view_crew_member() {
        $this->view->title = 'Admin kollégák részletek oldal';
        $this->view->description = 'Admin kollégák részletek oldal description';
        // az oldalspecifikus css linkeket berakjuk a view objektum css_link tulajdonságába (ami egy tömb)
        // az oldalspecifikus javascript linkeket berakjuk a view objektum js_link tulajdonságába (ami egy tömb)
        $this->view->js_link[] = $this->make_link('js', ADMIN_JS, 'pages/common.js');

        $this->view->content = $this->crew_members_model->one_crew_member_query($this->request->get_params('id'));

//$this->view->debug(true);

        $this->view->render('crew_members/tpl_crew_member_view');
    }

    /**
     * 	Munka minden adatának megjelenítése
     */
    public function view_crew_member_ajax() {
        if (Util::is_ajax()) {
            $this->view->content = $this->crew_members_model->one_crew_member_alldata_query_ajax();

            $this->view->location = $this->view->content['county_name'] . $this->view->content['city_name'] . $this->view->content['district_name'];
            $this->view->render('crew_members/tpl_crew_member_view_modal', true);
        } else {
            Util::redirect('error');
        }
    }

    /**
     * 	Új munka hozzáadása
     */
    public function new_crew_member() {
        // új munka hozzáadása
        if (!empty($_POST)) {
            $result = $this->crew_members_model->insert_crew_member();
            if ($result) {
                Util::redirect('crew_members');
            } else {
                Util::redirect('crew_members/new_crew_member');
            }
        }

        $this->view = new View();
        $this->view->title = 'Új kolléga oldal';
        $this->view->description = 'Új kolléga description';

        $this->view->add_links(array('ckeditor', 'bootstrap-fileupload', 'croppic', 'validation', 'new_crew_member'));

        // munkaterület kategóriák lekérdezése az option listához
        $this->view->crew_member_category_list = $this->crew_members_model->crew_member_categories_query();

        $this->view->set_layout('tpl_layout');
//$this->view->debug(true);

        $this->view->render('crew_members/tpl_new_crew_member');
    }

    /**
     * 	Munkák törlése
     *
     */
    public function delete_crew_member() {
        // ez a metódus true-val tér vissza (false esetén kivételt dob!)
        $this->crew_members_model->delete_crew_member();
        Util::redirect('crew_members');
    }

    /**
     * 	Crew member módosítása
     *
     */
    public function update_crew_member() {

        $id = (int) $this->request->get_params('id');

        if ($this->request->has_post()) {
            $result = $this->crew_members_model->update_crew_member($id);

            if ($result) {
                Util::redirect('crew_members');
            } else {
                Util::redirect('crew_members/update_crew_member/' . $id);
            }
        }

        $this->view = new View();
        // HTML oldal megjelenítése
        // adatok bevitele a view objektumba
        $this->view->title = 'Crew member módosítása oldal';
        $this->view->description = 'Crew member módosítása description';

        $this->view->add_links(array('ckeditor', 'bootstrap-fileupload', 'croppic', 'validation', 'edit_crew_member'));

        // a módosítandó kolléga adatai
        $this->view->actual_crew_member = $this->crew_members_model->one_crew_member_query($id);

        // munkaterület kategóriák lekérdezése az option listához
        $this->view->crew_member_category_list = $this->crew_members_model->crew_member_categories_query();

        $this->view->set_layout('tpl_layout');
        // template betöltése
        $this->view->render('crew_members/tpl_crew_member_update');
    }

    /**
     * 	Munka kategóriák megjelenítése
     */
    public function category() {
        $this->view = new View();

        $this->view->title = 'Admin crew member kategória oldal';
        $this->view->description = 'Admin crew member kategória description';

        $this->view->add_links(array('vframework', 'bootbox', 'crew_members_category'));

        $this->view->all_crew_member_category = $this->crew_members_model->crew_member_categories_query();
        $this->view->crew_members_counter = $this->crew_members_model->crew_members_counter_query();


//$this->view->debug(true);			
        $this->view->set_layout('tpl_layout');
        $this->view->render('crew_members/tpl_crew_member_category');
    }

    /**
     * 	Új munka kategória hozzáadása
     */
    public function category_insert() {
        // új munka kategória hozzáadása
        if (isset($_POST['crew_member_category_name'])) {
            $result = $this->crew_members_model->category_insert();

            if ($result) {
                Util::redirect('crew_members/category');
            } else {
                Util::redirect('crew_members/category_insert');
            }
        }

        $this->view = new View();

        $this->view->title = 'Új munka kategória hozzáadása oldal';
        $this->view->description = 'Új munka kategória description';

        $this->view->add_links(array('datatable', 'bootbox', 'vframework', 'crew_member_category'));

        // template betöltése
        $this->view->set_layout('tpl_layout');
        $this->view->render('crew_members/tpl_crew_member_category_insert');
    }

    /**
     * 	Munka kategória nevének módosítása
     */
    public function category_update() {
        if (isset($_POST['crew_member_category_name'])) {
            $result = $this->crew_members_model->category_update($this->request->get_params('id'));
            if ($result) {
                Util::redirect('crew_members/category');
            } else {
                Util::redirect('crew_members/category_update/' . $this->request->get_params('id'));
            }
        }
        $this->view = new View();
        $this->view->title = 'Admin munkakör kategória módosítása oldal';
        $this->view->description = 'Admin munkakör kategória módosítása description';

        $this->view->add_links(array('datatable', 'bootbox', 'vframework', 'crew_member_category'));

        //$this->view->js_link[] = $this->make_link('js', ADMIN_JS, 'pages/common.js');	   

        $this->view->category_content = $this->crew_members_model->crew_member_categories_query($this->request->get_params('id'));
        $this->view->set_layout('tpl_layout');
        $this->view->render('crew_members/tpl_crew_member_category_update');
    }

    /**
     * 	Kollégák kategória törlése
     */
    public function delete_category() {

        $id = (int) $this->request->get_params('id');
        $is_deletable = $this->crew_members_model->is_deletable($id);
        if ($is_deletable) {
            $result = $this->crew_members_model->delete_category($id);
            if ($result) {
                Message::set('success', 'Kategória sikeresen törölve!');
            } else {
                Message::set('error', 'Hiba történt!');
            }
        } else {
            Message::set('error', 'A katória használatban van, ezért nem törölhető!');
        }
        Util::redirect('crew_members/category');
    }

    /* --------------------------------------------------------------------------------- */

    /**
     * (AJAX) A crew_members táblában módosítja az crew_member_status mező értékét
     *
     * @return void
     */
    public function change_status() {
        if (Util::is_ajax()) {
            if (isset($_POST['action']) && isset($_POST['id'])) {

                $id = (int) $_POST['id'];

                if ($_POST['action'] == 'make_active') {
                    $this->crew_members_model->change_status_query($id, 1);
                }
                if ($_POST['action'] == 'make_inactive') {
                    $this->crew_members_model->change_status_query($id, 0);
                }
            }
        } else {
            Util::redirect('error');
        }
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
    public function crew_member_img_upload() {
        if (Util::is_ajax()) {
            echo $this->crew_members_model->crew_member_img_upload();
        }
    }

}

?>