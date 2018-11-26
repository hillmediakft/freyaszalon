<?php

class Csomag_kalkulator extends Site_controller {

    function __construct() {
        parent::__construct();
        $this->loadModel('csomag_kalkulator_model');
    }

    public function index() {
        if (isset($_POST["gender"])) {

            if (isset($_POST["mezes_bodon"]) && $_POST["mezes_bodon"] == '') {
                $this->csomag_kalkulator_model->get_package();
                exit();
            }
        }

        $this->view = new View();

        $this->view->settings = $this->settings;
        $this->view->footer_text = $this->footer_text;
        $this->view->promotions = $this->promotions;
        $this->view->no_of_promotions = $this->no_of_promotions;
        $this->view->szolgaltatasok_menu = $this->szolgaltatasok_menu;
        $this->view->nyitva_tartas = $this->nyitva_tartas;
        $this->view->footer_nagy_atalakulasok = $this->footer_nagy_atalakulasok;
        $this->view->pop_up = $this->pop_up;

        $this->view->data_arr = $this->csomag_kalkulator_model->page_data_query('csomag-kalkulator');

        $this->view->title = $this->view->data_arr['page_metatitle'];
        $this->view->description = $this->view->data_arr['page_metadescription'];
        $this->view->keywords = $this->view->data_arr['page_metakeywords'];
        $this->view->content = $this->view->data_arr['page_body'];

        $this->view->add_links(array('bootstrap-validator', 'csomag-kalkulator'));
//$this->view->debug(true); 
        $this->view->set_layout('tpl_layout');
        $this->view->render('csomag_kalkulator/tpl_csomag_kalkulator');
    }

}

?>