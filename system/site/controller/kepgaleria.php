<?php

class Kepgaleria extends Site_controller {

    function __construct() {
        parent::__construct();
        $this->loadModel('galeria_model');
    }

    public function index() {
        
        $this->loadModel('galeria_model');

        $this->view = new View();

        $this->view->settings = $this->settings;
        $this->view->footer_text = $this->footer_text;
        $this->view->promotions = $this->promotions;
        $this->view->no_of_promotions = $this->no_of_promotions;
        $this->view->szolgaltatasok_menu = $this->szolgaltatasok_menu;
        $this->view->nyitva_tartas = $this->nyitva_tartas;
        $this->view->footer_nagy_atalakulasok = $this->footer_nagy_atalakulasok;
        $this->view->pop_up = $this->pop_up;

        $this->view->data_arr = $this->galeria_model->page_data_query('galeria');

        $this->view->title = $this->view->data_arr['page_metatitle'];
        $this->view->description = $this->view->data_arr['page_metadescription'];
        $this->view->keywords = $this->view->data_arr['page_metakeywords'];
        $this->view->content = $this->view->data_arr['page_body'];

        $this->view->category_list = $this->galeria_model->photo_category_list_query();
        $this->view->photo_gallery = $this->galeria_model->get_all_photo();

        $this->view->add_links(array('galeria', 'portfolio', 'mixitup'));

//$this->view->debug(true); 
        $this->view->set_layout('tpl_layout');
        $this->view->render('galeria/tpl_galeria');
    }
}
?>