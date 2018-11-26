<?php

class Home extends Site_controller {

    function __construct() {
        parent::__construct();
        $this->loadModel('home_model');
        $this->loadModel('crew_model');
        $this->loadModel('szolgaltatasok_model');
        $this->loadModel('galeria_model');
    }

    public function index() {
        $this->view = new View();

        $this->view->content_block_1 = $this->home_model->get_content('home_block_1');

        $this->view->settings = $this->settings;
        $this->view->footer_text = $this->footer_text;
        $this->view->home_block_1 = $this->home_block_1;
        $this->view->home_block_2 = $this->home_block_2;
        $this->view->home_block_3 = $this->home_block_3;
        $this->view->home_csapatunk = $this->home_crew;
        $this->view->home_szolgaltatasok = $this->home_szolgaltatasok;
        $this->view->home_accordion1_cim = $this->home_accordion1_cim;
        $this->view->home_accordion1_szoveg = $this->home_accordion1_szoveg;
        $this->view->home_accordion2_cim = $this->home_accordion2_cim;
        $this->view->home_accordion2_szoveg = $this->home_accordion2_szoveg;
        $this->view->home_accordion3_cim = $this->home_accordion3_cim;
        $this->view->home_accordion3_szoveg = $this->home_accordion3_szoveg;
        $this->view->footer_nagy_atalakulasok = $this->footer_nagy_atalakulasok;
        $this->view->pop_up = $this->pop_up;

        $this->view->promotions = $this->promotions;
        $this->view->no_of_promotions = $this->no_of_promotions;
        $this->view->szolgaltatasok_menu = $this->szolgaltatasok_menu;
        $this->view->nyitva_tartas = $this->nyitva_tartas;

        $this->view->slider = $this->home_model->get_slider();
        $this->view->szolgaltatas_kategoriak = $this->szolgaltatasok_model->getCategories();

        //     $this->view->testimonials = $this->home_model->get_testimonials();
        $this->view->nagy_atalakulasok = $this->galeria_model->get_all_before_after_photo(6);

        $this->view->crew_members = $this->crew_model->get_crew_members();

        $this->view->add_links(array('bx_slider', 'home'));

        // lekérdezések
        // $this->view->settings = $this->home_model->get_settings();

        $this->view->data_arr = $this->home_model->page_data_query('kezdooldal');

        $this->view->title = $this->view->data_arr['page_metatitle'];
        $this->view->description = $this->view->data_arr['page_metadescription'];
        $this->view->keywords = $this->view->data_arr['page_metakeywords'];


//$this->view->debug(true); 
        $this->view->set_layout('tpl_layout');
        $this->view->render('home/tpl_home');
    }

}

?>