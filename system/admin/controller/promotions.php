<?php

class Promotions extends Controller {

    function __construct() {
        parent::__construct();
        Auth::handleLogin();
        $this->loadModel('promotions_model');
    }

    public function index() {

        $this->view = new View();
        // adatok bevitele a view objektumba
        $this->view->title = 'Akciók oldal';
        $this->view->description = 'Akciók oldal description';

        $this->view->add_links(array('bootbox', 'jquery-ui', 'promotions'));

        $this->view->promotions = $this->promotions_model->all_promotions_query();

        $this->view->set_layout('tpl_layout');
        $this->view->render('promotions/tpl_promotions');
    }

    /**
     * Új promotion hozzáadása
     *
     * @return void
     */
    public function new_promotion() {
        if ($this->request->has_post()) {

            $result = $this->promotions_model->add_promotion();
            if ($result) {
                Util::redirect('promotions');
            } else {
                Util::redirect('promotions/new_promotion');
            }
        }
        $this->view = new View();
        // adatok bevitele a view objektumba
        $this->view->title = 'Új akció oldal';
        $this->view->description = 'Új akció oldal description';

        $this->view->add_links(array('ckeditor', 'bootstrap-fileupload', 'bootbox', 'new_promotion'));

        $this->view->set_layout('tpl_layout');
        $this->view->render('promotions/tpl_new_promotion');
    }

    /**
     * 	A promotions módosítása (kép és szövegek cseréje)
     *
     * 	@param Int Active::$params['id']
     * 	@return void
     */
    public function edit() {
        if (!$this->request->get_params('id')) {
            throw new Exception('Nincs "id" nevű eleme az Active::$params tombnek! (lekerdezes nem hajthato vegre id alapjan)');
            return false;
        }
        $id = (int) $this->request->get_params('id');

        if (isset($_POST['submit_update_promotion'])) {
            $result = $this->promotions_model->update_promotion($id);
            if ($result) {
                Util::redirect('promotions');
            }
        }
        $this->view = new View();
        // adatok bevitele a view objektumba
        $this->view->title = 'promotions szerkesztése oldal';
        $this->view->description = 'promotions szerkesztése description';

        $this->view->add_links(array('ckeditor', 'bootstrap-fileupload', 'bootbox', 'edit_promotion'));

        $this->view->promotion = $this->promotions_model->one_promotion_query($id);

        $this->view->set_layout('tpl_layout');
        $this->view->render('promotions/tpl_edit_promotion');
    }

    /**
     * 	promotion törlése
     *
     */
    public function delete() {
        if (!$this->request->get_params('id')) {
            throw new Exception('Nincs "id" nevű eleme az Active::$params tombnek! (a lekerdezes nem hajthato vegre)');
            return false;
        }

        $id = (int) $this->request->get_params('id');
        $this->promotions_model->delete_promotion($id);
        Util::redirect('promotions');
    }

    /**
     * A promotionsek sorrendjének módosításakor meghívott action (promotions/order)
     *
     * Megvizsgálja, hogy a kérés xmlhttprequest volt-e (Ajax), ha igen meghívja a promotions_order() metódust 
     *
     * @return void
     */
    public function order() {
        if (Util::is_ajax()) {
            if (isset($_POST["action"]) && $_POST["action"] == "update_promotions_order") {
                $this->promotions_model->promotions_order();
            }
        }
    }

}

?>