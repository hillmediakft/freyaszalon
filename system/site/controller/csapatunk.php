<?php

class Csapatunk extends Site_controller {

    function __construct() {
        parent::__construct();
        $this->loadModel('crew_model');
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

        //       $this->view->blogs = $this->blogs;
        $this->view->crew_members = $this->crew_model->get_crew_members();

        $this->view->data_arr = $this->crew_model->page_data_query('csapatunk');

        $this->view->title = $this->view->data_arr['page_metatitle'];
        $this->view->description = $this->view->data_arr['page_metadescription'];
        $this->view->keywords = $this->view->data_arr['page_metakeywords'];
        $this->view->content = $this->view->data_arr['page_body'];

        $this->view->add_links(array('csapatunk'));
//$this->view->debug(true); 
        $this->view->set_layout('tpl_layout');
        $this->view->render('csapatunk/tpl_csapatunk');
    }

    public function munkatars() {

        $id = (int) $this->request->get_params('id');

        $this->view = new View();

        $this->view->settings = $this->settings;
        $this->view->footer_text = $this->footer_text;
        $this->view->promotions = $this->promotions;
        $this->view->no_of_promotions = $this->no_of_promotions;
        $this->view->szolgaltatasok_menu = $this->szolgaltatasok_menu;
        $this->view->nyitva_tartas = $this->nyitva_tartas;
        $this->view->footer_nagy_atalakulasok = $this->footer_nagy_atalakulasok;
        $this->view->pop_up = $this->pop_up;

        //      $this->view->blogs = $this->blogs;
        $this->view->colleague = $this->crew_model->get_crew_member($id);

        $this->view->title = $this->view->colleague['crew_member_name'] . ' - ' . $this->view->colleague['crew_member_category_name'];
        $this->view->description = $this->view->colleague['crew_member_name'] . ' - ' . $this->view->colleague['crew_member_category_name'];
        $this->view->keywords = $this->view->colleague['crew_member_name'];


        $this->view->add_links(array('csapatunk'));
//$this->view->debug(true); 
        $this->view->set_layout('tpl_layout');
        $this->view->render('csapatunk/tpl_munkatars');
    }

}

?>