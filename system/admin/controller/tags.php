<?php

/**
 * Class tags
 *
 * @author Várnagy Attila
 * 
 */
class Tags extends Controller {

    function __construct() {
        parent::__construct();
        $this->loadModel('tags_model');
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

        $this->view->add_links(array('bootbox', 'datatable', 'tags'));

        $this->view->all_tags = $this->tags_model->all_tags_query();

        $this->view->set_layout('tpl_layout');
        $this->view->render('tags/tpl_tags');
    }

    /**
     * 	GYIK minden adatának megjelenítése
     */
    public function view_tags() {

        $this->view = new View();

        $this->view->title = 'Admin tags részletek oldal';
        $this->view->description = 'Admin tags részletek oldal description';

        $id = (int) $this->request->get_params('id');

        $this->view->content = $this->tags_model->one_tags_alldata_query($id);

        $this->view->set_layout('tpl_layout');
        $this->view->render('tags/tpl_tags_view');
    }

    /**
     * 	GYIK minden adatának megjelenítése Ajax-szal
     */
    public function view_tags_ajax() {
        if (Util::is_ajax()) {
            $this->view->content = $this->tags_model->one_tags_alldata_query_ajax();


            $this->view->render('tags/tpl_tags_view_modal', true);
        } else {
            Util::redirect('error');
        }
    }

    /**
     * 	Új tags hozzáadása
     */
    public function new_tags() {
        // új tags hozzáadása
        if (!empty($_POST)) {
            $result = $this->tags_model->insert_tags();
            if ($result) {
                Util::redirect('tags');
            } else {
                Util::redirect('tags/new_tags');
            }
        }

        $this->view = new View();

        $this->view->title = 'Új GYIK oldal';
        $this->view->description = 'Új GYIK description';

        $this->view->add_links(array('bootbox', 'ckeditor', 'new_tags', 'validation', 'select2'));

// tags kategóriák lekérdezése az option listához
        $this->view->tags_category_list = $this->tags_model->category_list_query();
        $this->view->terms = $this->terms_model->getTerms();
        //       $this->view->tags_category_list_with_path = $this->category->tags_categories_with_path($this->view->tags_category_list);
        // template betöltése
        $this->view->set_layout('tpl_layout');
        $this->view->render('tags/tpl_new_tags');
    }

    /**
     * 	GYIK törlése
     *
     */
    public function delete_tags() {
        // ez a metódus true-val tér vissza (false esetén kivételt dob!)
        $this->tags_model->delete_tags();
        Util::redirect('tags');
    }

    /**
     * 	GYIK módosítása
     *
     */
    public function update_tags() {

        $id = (int) $this->request->get_params('id');
        if (!empty($_POST)) {
            $result = $this->tags_model->update_tags($id);

            if ($result) {
                Util::redirect('tags');
            } else {
                Util::redirect('tags/update_tags/' . $id);
            }
        }

        $this->view = new View();

        // HTML oldal megjelenítése
        // adatok bevitele a view objektumba
        $this->view->title = 'GYIK módosítása oldal';
        $this->view->description = 'GYIK módosítása description';
        // js linkek generálása
        //form validator	
        $this->view->add_links(array('bootbox', 'ckeditor', 'edit_tags', 'validation', 'select2'));

        // a módosítandó tags adatai
        $this->view->actual_tags = $this->tags_model->one_tags_query($id);

        $this->view->tags_category_list = $this->tags_model->category_list_query();
        $this->view->terms = $this->terms_model->getTerms();
        $this->view->terms_by_content_id = Util::convertArrayToOneDimensional($this->taxonomy_model->getTermsByContentId($this->request->get_params('id')));

        $this->view->set_layout('tpl_layout');
        $this->view->render('tags/tpl_tags_update');
    }

    /**
     * 	Munka kategóriák megjelenítése
     */
    public function category() {

        $this->view = new View();

        // adatok bevitele a view objektumba
        $this->view->title = 'Admin tags kategóriák oldal';
        $this->view->description = 'Admin tags kategóriák description';



        $this->view->add_links(array('bootbox', 'datatable', 'tags_category'));

        $this->view->all_tags_category = $this->tags_model->tags_categories_query();

        $this->view->category_counter = $this->tags_model->tags_category_counter_query();

//$this->view->debug(true);			
        $this->view->set_layout('tpl_layout');
        $this->view->render('tags/tpl_tags_category');
    }

    /**
     * 	Új tags kategória hozzáadása
     */
    public function category_insert() {

        if (isset($_POST['tags_category_name'])) {

            $result = $this->tags_model->category_insert();

            if ($result) {
                Util::redirect('tags/category');
            } else {
                Util::redirect('tags/category_insert');
            }
        }

        $this->view = new View();

        $this->view->title = 'Újtags kategória hozzáadása oldal';
        $this->view->description = 'Új tags kategória description';

        $this->view->set_layout('tpl_layout');
        $this->view->render('tags/tpl_tags_category_insert');
    }

    /**
     * 	GYIK kategória módosítása
     */
    public function category_update() {
        if (isset($_POST['tags_category_name'])) {
            $result = $this->tags_model->category_update($this->request->get_params('id'));
            if ($result) {
                Util::redirect('tags/category');
            } else {
                Util::redirect('tags/category_update/' . $this->request->get_params('id'));
            }
        }

        $this->view = new View();


        $this->view->title = 'Admin tags kategória módosítása oldal';
        $this->view->description = 'Admin tags kategória módosítása description';

        $this->view->category_content = $this->tags_model->one_tags_category($this->request->get_params('id'));

        $this->view->set_layout('tpl_layout');
        $this->view->render('tags/tpl_tags_category_update');
    }

    /**
     * Kategória törlése
     *
     * @return void
     */
    public function category_delete() {

        $this->tags_model->delete_category($this->request->get_params('id'));
        Util::redirect('tags/category');
    }

    /**
     * (AJAX) A tags táblában módosítja az tags_status mező értékét
     *
     * @return void
     */
    public function change_status() {
        if (Util::is_ajax()) {
            if (isset($_POST['action']) && isset($_POST['id'])) {

                $id = (int) $_POST['id'];

                if ($_POST['action'] == 'make_active') {
                    $this->tags_model->change_status_query($id, 1);
                }
                if ($_POST['action'] == 'make_inactive') {
                    $this->tags_model->change_status_query($id, 0);
                }
            }
        } else {
            Util::redirect('error');
        }
    }

    /**
     * 	A tags képét tölti fel a szerverre, és készít egy kisebb méretű képet is.
     *
     * 	Ez a metódus kettő XHR kérést dolgoz fel.
     * 	Meghívásakor kap egy id nevű paramétert melynek értékei upload vagy crop
     * 		upload paraméterrel meghívva: feltölti a kiválasztott képet
     * 		crop paraméterrel meghívva: megvágja az eredeti képet és feltölti	
     * 	(a paraméterek megadása a new_user.js fájlban található: admin/users/user_img_upload/upload vagy admin/user_img_upload/crop)
     *
     * 	Az user_img_upload() model metódus JSON adatot ad vissza (ezt "echo-za" vissza ez a metódus a kérelmező javascriptnek). 
     */
    public function tags_crop_img_upload() {
        if (Util::is_ajax()) {
            echo $this->tags_model->tags_crop_img_upload();
        }
    }

    /**
     * 	A tags kategória képét tölti fel a szerverre, és készít egy kisebb méretű képet is.
     *
     * 	Ez a metódus kettő XHR kérést dolgoz fel.
     * 	Meghívásakor kap egy id nevű paramétert melynek értékei upload vagy crop
     * 		upload paraméterrel meghívva: feltölti a kiválasztott képet
     * 		crop paraméterrel meghívva: megvágja az eredeti képet és feltölti	
     * 	(a paraméterek megadása a new_user.js fájlban található: admin/users/user_img_upload/upload vagy admin/user_img_upload/crop)
     *
     * 	Az user_img_upload() model metódus JSON adatot ad vissza (ezt "echo-za" vissza ez a metódus a kérelmező javascriptnek). 
     */
    public function tags_category_crop_img_upload() {
        if (Util::is_ajax()) {
            echo $this->tags_model->tags_category_crop_img_upload();
        }
    }

}

?>