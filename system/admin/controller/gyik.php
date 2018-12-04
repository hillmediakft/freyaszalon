<?php

/**
 * Class gyik
 *
 * @author Várnagy Attila
 * 
 */
class Gyik extends Admin_controller {

    function __construct() {
        parent::__construct();
        $this->loadModel('gyik_model');
        $this->loadModel('terms_model');
        $this->loadModel('taxonomy_model');
    }

    /**
     * index metódus
     *
     * 
     */
    public function index() {

        $this->view = new View();

        $this->view->title = 'GYIK oldal';
        $this->view->description = 'GYIK oldal description';

        $this->view->add_links(array('bootbox', 'datatable', 'gyik'));

        $this->view->all_gyik = $this->gyik_model->all_gyik_query();

        $this->view->set_layout('tpl_layout');
        $this->view->render('gyik/tpl_gyik');
    }

    /**
     * 	GYIK minden adatának megjelenítése
     */
    public function view_gyik() {

        $this->view = new View();

        $this->view->title = 'Admin gyik részletek oldal';
        $this->view->description = 'Admin gyik részletek oldal description';

        $id = (int) $this->request->get_params('id');

        $this->view->content = $this->gyik_model->one_gyik_alldata_query($id);

        $this->view->set_layout('tpl_layout');
        $this->view->render('gyik/tpl_gyik_view');
    }

    /**
     * 	GYIK minden adatának megjelenítése Ajax-szal
     */
    public function view_gyik_ajax() {
        if (Util::is_ajax()) {
            $this->view->content = $this->gyik_model->one_gyik_alldata_query_ajax();


            $this->view->render('gyik/tpl_gyik_view_modal', true);
        } else {
            Util::redirect('error');
        }
    }

    /**
     * 	Új gyik hozzáadása
     */
    public function new_gyik() {
        // új gyik hozzáadása
        if (!empty($_POST)) {
            $result = $this->gyik_model->insert_gyik();
            if ($result) {
                Util::redirect('gyik');
            } else {
                Util::redirect('gyik/new_gyik');
            }
        }

        $this->view = new View();

        $this->view->title = 'Új GYIK oldal';
        $this->view->description = 'Új GYIK description';

        $this->view->add_links(array('bootbox', 'ckeditor', 'new_gyik', 'validation', 'select2'));

// gyik kategóriák lekérdezése az option listához
        $this->view->gyik_category_list = $this->gyik_model->category_list_query();
        $this->view->terms = $this->terms_model->getTerms();
        //       $this->view->gyik_category_list_with_path = $this->category->gyik_categories_with_path($this->view->gyik_category_list);
        // template betöltése
        $this->view->set_layout('tpl_layout');
        $this->view->render('gyik/tpl_new_gyik');
    }

    /**
     * 	GYIK törlése
     *
     */
    public function delete_gyik() {
        // ez a metódus true-val tér vissza (false esetén kivételt dob!)
        $this->gyik_model->delete_gyik();
        Util::redirect('gyik');
    }

    /**
     * 	GYIK módosítása
     *
     */
    public function update_gyik() {

        $id = (int) $this->request->get_params('id');
        if (!empty($_POST)) {
            $result = $this->gyik_model->update_gyik($id);

            if ($result) {
                Util::redirect('gyik');
            } else {
                Util::redirect('gyik/update_gyik/' . $id);
            }
        }

        $this->view = new View();

        // HTML oldal megjelenítése
        // adatok bevitele a view objektumba
        $this->view->title = 'GYIK módosítása oldal';
        $this->view->description = 'GYIK módosítása description';
        // js linkek generálása
        //form validator	
        $this->view->add_links(array('bootbox', 'ckeditor', 'edit_gyik', 'validation', 'select2'));

        // a módosítandó gyik adatai
        $this->view->actual_gyik = $this->gyik_model->one_gyik_query($id);

        $this->view->gyik_category_list = $this->gyik_model->category_list_query();
        $this->view->terms = $this->terms_model->getTerms();
        $this->view->terms_by_content_id = Util::convertArrayToOneDimensional($this->taxonomy_model->getTermsByContentId($this->request->get_params('id')));

        $this->view->set_layout('tpl_layout');
        $this->view->render('gyik/tpl_gyik_update');
    }

    /**
     * 	Munka kategóriák megjelenítése
     */
    public function category() {

        $this->view = new View();

        // adatok bevitele a view objektumba
        $this->view->title = 'Admin gyik kategóriák oldal';
        $this->view->description = 'Admin gyik kategóriák description';



        $this->view->add_links(array('bootbox', 'datatable', 'gyik_category'));

        $this->view->all_gyik_category = $this->gyik_model->gyik_categories_query();

        $this->view->category_counter = $this->gyik_model->gyik_category_counter_query();

//$this->view->debug(true);			
        $this->view->set_layout('tpl_layout');
        $this->view->render('gyik/tpl_gyik_category');
    }

    /**
     * 	Új gyik kategória hozzáadása
     */
    public function category_insert() {

        if (isset($_POST['gyik_category_name'])) {

            $result = $this->gyik_model->category_insert();

            if ($result) {
                Util::redirect('gyik/category');
            } else {
                Util::redirect('gyik/category_insert');
            }
        }

        $this->view = new View();

        $this->view->title = 'Újgyik kategória hozzáadása oldal';
        $this->view->description = 'Új gyik kategória description';

        $this->view->set_layout('tpl_layout');
        $this->view->render('gyik/tpl_gyik_category_insert');
    }

    /**
     * 	GYIK kategória módosítása
     */
    public function category_update() {
        if (isset($_POST['gyik_category_name'])) {
            $result = $this->gyik_model->category_update($this->request->get_params('id'));
            if ($result) {
                Util::redirect('gyik/category');
            } else {
                Util::redirect('gyik/category_update/' . $this->request->get_params('id'));
            }
        }

        $this->view = new View();


        $this->view->title = 'Admin gyik kategória módosítása oldal';
        $this->view->description = 'Admin gyik kategória módosítása description';

        $this->view->category_content = $this->gyik_model->one_gyik_category($this->request->get_params('id'));

        $this->view->set_layout('tpl_layout');
        $this->view->render('gyik/tpl_gyik_category_update');
    }

    /**
     * Kategória törlése
     *
     * @return void
     */
    public function category_delete() {

        $this->gyik_model->delete_category($this->request->get_params('id'));
        Util::redirect('gyik/category');
    }

    /**
     * (AJAX) A gyik táblában módosítja az gyik_status mező értékét
     *
     * @return void
     */
    public function change_status() {
        if (Util::is_ajax()) {
            if (isset($_POST['action']) && isset($_POST['id'])) {

                $id = (int) $_POST['id'];

                if ($_POST['action'] == 'make_active') {
                    $this->gyik_model->change_status_query($id, 1);
                }
                if ($_POST['action'] == 'make_inactive') {
                    $this->gyik_model->change_status_query($id, 0);
                }
            }
        } else {
            Util::redirect('error');
        }
    }

    /**
     * 	A gyik képét tölti fel a szerverre, és készít egy kisebb méretű képet is.
     *
     * 	Ez a metódus kettő XHR kérést dolgoz fel.
     * 	Meghívásakor kap egy id nevű paramétert melynek értékei upload vagy crop
     * 		upload paraméterrel meghívva: feltölti a kiválasztott képet
     * 		crop paraméterrel meghívva: megvágja az eredeti képet és feltölti	
     * 	(a paraméterek megadása a new_user.js fájlban található: admin/users/user_img_upload/upload vagy admin/user_img_upload/crop)
     *
     * 	Az user_img_upload() model metódus JSON adatot ad vissza (ezt "echo-za" vissza ez a metódus a kérelmező javascriptnek). 
     */
    public function gyik_crop_img_upload() {
        if (Util::is_ajax()) {
            echo $this->gyik_model->gyik_crop_img_upload();
        }
    }

    /**
     * 	A gyik kategória képét tölti fel a szerverre, és készít egy kisebb méretű képet is.
     *
     * 	Ez a metódus kettő XHR kérést dolgoz fel.
     * 	Meghívásakor kap egy id nevű paramétert melynek értékei upload vagy crop
     * 		upload paraméterrel meghívva: feltölti a kiválasztott képet
     * 		crop paraméterrel meghívva: megvágja az eredeti képet és feltölti	
     * 	(a paraméterek megadása a new_user.js fájlban található: admin/users/user_img_upload/upload vagy admin/user_img_upload/crop)
     *
     * 	Az user_img_upload() model metódus JSON adatot ad vissza (ezt "echo-za" vissza ez a metódus a kérelmező javascriptnek). 
     */
    public function gyik_category_crop_img_upload() {
        if (Util::is_ajax()) {
            echo $this->gyik_model->gyik_category_crop_img_upload();
        }
    }

}

?>