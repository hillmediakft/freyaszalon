<?php

class Rolunk extends Site_controller {

    function __construct() {
        parent::__construct();
        $this->loadModel('rolunk_model');
    }

    public function munkatarsaink() {

        $this->loadModel('munkatarsaink_model');

        $this->view = new View();

        $this->view->settings = $this->settings;
        $this->view->footer_text = $this->footer_text;
        $this->view->promotions = $this->promotions;
        $this->view->no_of_promotions = $this->no_of_promotions;
        $this->view->szolgaltatasok_menu = $this->szolgaltatasok_menu;
        $this->view->nyitva_tartas = $this->nyitva_tartas;
        $this->view->footer_nagy_atalakulasok = $this->footer_nagy_atalakulasok;

        $this->view->blogs = $this->blogs;
        $this->view->crew_members = $this->munkatarsaink_model->get_crew_members();

        $this->view->data_arr = $this->rolunk_model->page_data_query('munkatarsaink');

        $this->view->title = $this->view->data_arr['page_metatitle'];
        $this->view->description = $this->view->data_arr['page_metadescription'];
        $this->view->keywords = $this->view->data_arr['page_metakeywords'];
        $this->view->content = $this->view->data_arr['page_body'];

        $this->view->add_links(array('munkatarsaink'));
//$this->view->debug(true); 
        $this->view->set_layout('tpl_layout');
        $this->view->render('munkatarsaink/tpl_munkatarsaink');
    }
    
     public function munkatars() {
         
        $id = (int) $this->request->get_params('id'); 

        $this->loadModel('munkatarsaink_model');

        $this->view = new View();

        $this->view->settings = $this->settings;
        $this->view->footer_text = $this->footer_text;
        $this->view->promotions = $this->promotions;
        $this->view->no_of_promotions = $this->no_of_promotions;
        $this->view->szolgaltatasok_menu = $this->szolgaltatasok_menu;
        $this->view->nyitva_tartas = $this->nyitva_tartas;
        $this->view->footer_nagy_atalakulasok = $this->footer_nagy_atalakulasok;

        $this->view->blogs = $this->blogs;
        $this->view->colleague = $this->munkatarsaink_model->get_crew_member($id);
        
        $this->view->title = $this->view->colleague['crew_member_name'] . ' - ' . $this->view->colleague['crew_member_category_name'];
        $this->view->description = $this->view->colleague['crew_member_name'] . ' - ' . $this->view->colleague['crew_member_category_name'];
        $this->view->keywords = $this->view->colleague['crew_member_name'];


        $this->view->add_links(array('munkatarsaink'));
//$this->view->debug(true); 
        $this->view->set_layout('tpl_layout');
        $this->view->render('munkatarsaink/tpl_munkatars');
    }   

    public function rendelonk() {

        $this->loadModel('rendelonk_model');

        $this->view = new View();

        $this->view->settings = $this->settings;
        $this->view->footer_text = $this->footer_text;
        $this->view->promotions = $this->promotions;
        $this->view->no_of_promotions = $this->no_of_promotions;
        $this->view->szolgaltatasok_menu = $this->szolgaltatasok_menu;
        $this->view->nyitva_tartas = $this->nyitva_tartas;
        $this->view->footer_nagy_atalakulasok = $this->footer_nagy_atalakulasok;

        $this->view->blogs = $this->blogs;


        $this->view->data_arr = $this->rolunk_model->page_data_query('rendelonk');

        $this->view->title = $this->view->data_arr['page_metatitle'];
        $this->view->description = $this->view->data_arr['page_metadescription'];
        $this->view->keywords = $this->view->data_arr['page_metakeywords'];
        $this->view->content = $this->view->data_arr['page_body'];


//$this->view->debug(true); 
        $this->view->set_layout('tpl_layout');
        $this->view->render('rendelonk/tpl_rendelonk');
    }

    public function hivatasunk() {

        $this->view = new View();

        $this->view->settings = $this->settings;
        $this->view->footer_text = $this->footer_text;
        $this->view->promotions = $this->promotions;
        $this->view->no_of_promotions = $this->no_of_promotions;
        $this->view->szolgaltatasok_menu = $this->szolgaltatasok_menu;
        $this->view->nyitva_tartas = $this->nyitva_tartas;
        $this->view->footer_nagy_atalakulasok = $this->footer_nagy_atalakulasok;

        $this->view->blogs = $this->blogs;


        $this->view->data_arr = $this->rolunk_model->page_data_query('hivatasunk');

        $this->view->title = $this->view->data_arr['page_metatitle'];
        $this->view->description = $this->view->data_arr['page_metadescription'];
        $this->view->keywords = $this->view->data_arr['page_metakeywords'];
        $this->view->content = $this->view->data_arr['page_body'];


//$this->view->debug(true); 
        $this->view->set_layout('tpl_layout');
        $this->view->render('hivatasunk/tpl_hivatasunk');
    }

    public function miert_a_mentadent() {

        $this->view = new View();

        $this->view->settings = $this->settings;
        $this->view->footer_text = $this->footer_text;
        $this->view->promotions = $this->promotions;
        $this->view->no_of_promotions = $this->no_of_promotions;
        $this->view->szolgaltatasok_menu = $this->szolgaltatasok_menu;
        $this->view->nyitva_tartas = $this->nyitva_tartas;
        $this->view->footer_nagy_atalakulasok = $this->footer_nagy_atalakulasok;

        $this->view->blogs = $this->blogs;


        $this->view->data_arr = $this->rolunk_model->page_data_query('miert-a-mentadent');

        $this->view->title = $this->view->data_arr['page_metatitle'];
        $this->view->description = $this->view->data_arr['page_metadescription'];
        $this->view->keywords = $this->view->data_arr['page_metakeywords'];
        $this->view->content = $this->view->data_arr['page_body'];


//$this->view->debug(true); 
        $this->view->set_layout('tpl_layout');
        $this->view->render('miert_a_mentadent/tpl_miert_a_mentadent');
    }

}

?>