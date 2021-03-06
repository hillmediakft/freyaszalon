<?php

class Kereses extends Site_controller {

    function __construct() {
        parent::__construct();
        $this->loadModel('kereses_model');
    }

    public function index() {

        $this->view = new View();
        $this->view->settings = $this->settings;
        $this->view->footer_text = $this->footer_text;
        $this->view->promotions = $this->promotions;
        $this->view->no_of_promotions = $this->no_of_promotions;
        $this->view->szolgaltatasok_menu = $this->szolgaltatasok_menu;
        $this->view->nyitva_tartas = $this->nyitva_tartas;
        $this->view->footer_nagy_atalakulasok = $this->footer_nagy_atalakulasok;
        $this->view->pop_up = $this->pop_up;

        $this->view->search_results = $this->kereses_model->search();

        $this->view->result_list = $this->view->search_results[0];
        $this->view->keyword = $this->view->search_results[1];

        $this->view->data_arr = $this->kereses_model->page_data_query('kereses');

        $this->view->title = $this->view->data_arr['page_metatitle'] . ' ' . $this->view->keyword;
        $this->view->description = $this->view->data_arr['page_metadescription'];
        $this->view->keywords = $this->view->data_arr['page_metakeywords'];
        $this->view->content = $this->view->data_arr['page_body'];

        $this->view->set_layout('tpl_layout');
        $this->view->render('kereses/tpl_kereses_lista');
    }

}

?>