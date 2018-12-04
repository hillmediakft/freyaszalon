<?php

/**
 * Class terms
 *
 * @author Várnagy Attila
 * 
 */
class Terms extends Admin_controller {

    function __construct() {
        parent::__construct();
        $this->loadModel('terms_model');
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

        $this->view->title = 'címke oldal';
        $this->view->description = 'címke oldal description';

        $this->view->add_links(array('bootbox', 'datatable', 'terms'));

        $this->view->terms = $this->terms_model->getTerms();

        $this->view->set_layout('tpl_layout');
        $this->view->render('terms/tpl_terms');
    }

    /**
     * 	címke minden adatának megjelenítése
     */
    public function view_terms() {

        $this->view = new View();

        $this->view->title = 'Admin terms részletek oldal';
        $this->view->description = 'Admin terms részletek oldal description';

        $id = (int) $this->request->get_params('id');

        $this->view->content = $this->terms_model->one_terms_alldata_query($id);

        $this->view->set_layout('tpl_layout');
        $this->view->render('terms/tpl_terms_view');
    }

    /**
     * 	címke minden adatának megjelenítése Ajax-szal
     */
    public function view_terms_ajax() {
        if (Util::is_ajax()) {
            $this->view->content = $this->terms_model->one_terms_alldata_query_ajax();


            $this->view->render('terms/tpl_terms_view_modal', true);
        } else {
            Util::redirect('error');
        }
    }

    /**
     * 	Új terms hozzáadása
     */
    public function insert_term() {
        
        $this->terms_model->insert_term($this->request->get_post('term'));
        Util::redirect('terms');
    }

    /**
     * 	címke törlése
     *
     */
    public function delete_term() {
        $id = (int) (int) $this->request->get_params('id');
         // ez a metódus true-val tér vissza (false esetén kivételt dob!)
        $this->terms_model->delete_term($id);
        Util::redirect('terms');
    }
    
     /**
     * 	címkék csoportos törlése
     *
     */
    public function delete_terms() {
        $ids = $this->request->get_post();
        unset($ids['terms_length']);
        $ids = array_values($ids);
         // ez a metódus true-val tér vissza (false esetén kivételt dob!)
        $this->terms_model->delete_terms($ids);
        Message::set('success', 'Címke törlése sikerült.');
        Util::redirect('terms');
    }   

    /**
     * 	címke módosítása
     *
     */
    public function update_term() {


        $id = (int) $this->request->get_post('id');
        $term = $this->request->get_post('term');

        if (!empty($_POST)) {
            $this->terms_model->update_term($id, $term);

            Util::redirect('terms');
        }
    }

    /**
     * 	Munka kategóriák megjelenítése
     */
    public function category() {

        $this->view = new View();

        // adatok bevitele a view objektumba
        $this->view->title = 'Admin terms kategóriák oldal';
        $this->view->description = 'Admin terms kategóriák description';



        $this->view->add_links(array('bootbox', 'datatable', 'terms_category'));

        $this->view->all_terms_category = $this->terms_model->terms_categories_query();

        $this->view->category_counter = $this->terms_model->terms_category_counter_query();

//$this->view->debug(true);			
        $this->view->set_layout('tpl_layout');
        $this->view->render('terms/tpl_terms_category');
    }

    /**
     * 	Új terms kategória hozzáadása
     */
    public function category_insert() {

        if (isset($_POST['terms_category_name'])) {

            $result = $this->terms_model->category_insert();

            if ($result) {
                Util::redirect('terms/category');
            } else {
                Util::redirect('terms/category_insert');
            }
        }

        $this->view = new View();

        $this->view->title = 'Újterms kategória hozzáadása oldal';
        $this->view->description = 'Új terms kategória description';

        $this->view->set_layout('tpl_layout');
        $this->view->render('terms/tpl_terms_category_insert');
    }

    /**
     * 	címke kategória módosítása
     */
    public function category_update() {
        if (isset($_POST['terms_category_name'])) {
            $result = $this->terms_model->category_update($this->request->get_params('id'));
            if ($result) {
                Util::redirect('terms/category');
            } else {
                Util::redirect('terms/category_update/' . $this->request->get_params('id'));
            }
        }

        $this->view = new View();


        $this->view->title = 'Admin terms kategória módosítása oldal';
        $this->view->description = 'Admin terms kategória módosítása description';

        $this->view->category_content = $this->terms_model->one_terms_category($this->request->get_params('id'));

        $this->view->set_layout('tpl_layout');
        $this->view->render('terms/tpl_terms_category_update');
    }

    /**
     * Kategória törlése
     *
     * @return void
     */
    public function category_delete() {

        $this->terms_model->delete_category($this->request->get_params('id'));
        Util::redirect('terms/category');
    }

    /**
     * (AJAX) A terms táblában módosítja az terms_status mező értékét
     *
     * @return void
     */
    public function change_status() {
        if (Util::is_ajax()) {
            if (isset($_POST['action']) && isset($_POST['id'])) {

                $id = (int) $_POST['id'];

                if ($_POST['action'] == 'make_active') {
                    $this->terms_model->change_status_query($id, 1);
                }
                if ($_POST['action'] == 'make_inactive') {
                    $this->terms_model->change_status_query($id, 0);
                }
            }
        } else {
            Util::redirect('error');
        }
    }

    /**
     * 	A terms képét tölti fel a szerverre, és készít egy kisebb méretű képet is.
     *
     * 	Ez a metódus kettő XHR kérést dolgoz fel.
     * 	Meghívásakor kap egy id nevű paramétert melynek értékei upload vagy crop
     * 		upload paraméterrel meghívva: feltölti a kiválasztott képet
     * 		crop paraméterrel meghívva: megvágja az eredeti képet és feltölti	
     * 	(a paraméterek megadása a new_user.js fájlban található: admin/users/user_img_upload/upload vagy admin/user_img_upload/crop)
     *
     * 	Az user_img_upload() model metódus JSON adatot ad vissza (ezt "echo-za" vissza ez a metódus a kérelmező javascriptnek). 
     */
    public function terms_crop_img_upload() {
        if (Util::is_ajax()) {
            echo $this->terms_model->terms_crop_img_upload();
        }
    }

    /**
     * 	A terms kategória képét tölti fel a szerverre, és készít egy kisebb méretű képet is.
     *
     * 	Ez a metódus kettő XHR kérést dolgoz fel.
     * 	Meghívásakor kap egy id nevű paramétert melynek értékei upload vagy crop
     * 		upload paraméterrel meghívva: feltölti a kiválasztott képet
     * 		crop paraméterrel meghívva: megvágja az eredeti képet és feltölti	
     * 	(a paraméterek megadása a new_user.js fájlban található: admin/users/user_img_upload/upload vagy admin/user_img_upload/crop)
     *
     * 	Az user_img_upload() model metódus JSON adatot ad vissza (ezt "echo-za" vissza ez a metódus a kérelmező javascriptnek). 
     */
    public function terms_category_crop_img_upload() {
        if (Util::is_ajax()) {
            echo $this->terms_model->terms_category_crop_img_upload();
        }
    }

}

?>