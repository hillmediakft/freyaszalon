<?php

class Offers extends Controller {

    function __construct() {
        parent::__construct();
        $this->loadModel('offers_model');
        Auth::handleLogin();
    }

    public function index() {
        $this->view = new View();
        // adatok bevitele a view objektumba
        $this->view->title = 'Ajánlatok oldal';
        $this->view->description = 'Ajánlatok oldal description';

        $this->view->add_links(array('bootbox', 'offers'));

        $this->view->all_offers = $this->offers_model->all_offers();

        $this->view->set_layout('tpl_layout');
        $this->view->render('offers/tpl_offers');
    }

    /**
     * 	Ajánlatok módosítása
     *
     */
    public function edit() {

        $id = (int) $this->request->get_params('id');

        if (!$id) {
            throw new Exception('Nincs "id" nevű eleme az Active::$params tombnek! (lekerdezes nem hajthato vegre id alapjan)');
            return false;
        }
        $result = $this->request->has_post('submit_update_offer');
        if ($result) {
            $result = $this->offers_model->update_offer($id);
            if ($result) {
                Util::redirect('offers');
            }
        }

        $this->view = new View();
        // adatok bevitele a view objektumba
        $this->view->title = 'Ajánlatok szerkesztése';
        $this->view->description = 'Ajánlatok szerkesztése description';

        $this->view->add_links(array('bootbox', 'ckeditor', 'edit_offer'));

        // visszadja a szerkesztendő oldal adatait egy tömbben (page_id, page_title ... stb.)
        $this->view->data_arr = $this->offers_model->offer_data_query($id);

        $this->view->set_layout('tpl_layout');
        $this->view->render('offers/tpl_edit_offer');
    }

}

?>