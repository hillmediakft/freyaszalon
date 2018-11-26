<?php

class Nagy_atalakulasok extends Site_controller {

    function __construct() {
        parent::__construct();
        $this->loadModel('nagy_atalakulasok_model');
        $this->loadModel('galeria_model');
    }

    public function index() {

        $this->view = new View();
        $this->view->settings = $this->settings;
        $this->view->footer_text = $this->footer_text;
        $this->view->promotions = $this->promotions;
        $this->view->no_of_promotions = $this->no_of_promotions;
        $this->view->szolgaltatasok_menu = $this->szolgaltatasok_menu;
        $this->view->nyitva_tartas = $this->nyitva_tartas;
        $this->view->call_to_action = $this->call_to_action;
        $this->view->footer_nagy_atalakulasok = $this->footer_nagy_atalakulasok;
        $this->view->pop_up = $this->pop_up;

        $this->view->data_arr = $this->nagy_atalakulasok_model->page_data_query('nagy-atalakulasok');

        $this->view->title = $this->view->data_arr['page_metatitle'];
        $this->view->description = $this->view->data_arr['page_metadescription'];
        $this->view->keywords = $this->view->data_arr['page_metakeywords'];
        $this->view->content = $this->view->data_arr['page_body'];

        $this->view->nagy_atalakulasok = $this->galeria_model->get_all_before_after_photo();

        $this->view->set_layout('tpl_layout');
        $this->view->render('nagy_atalakulasok/tpl_nagy_atalakulasok');
    }

}

?>