<?php

class Leiratkozas extends Site_controller {

    function __construct() {
        parent::__construct();
        $this->loadModel('leiratkozas_model');
    }

    public function index() {
        
        if ($this->request->has_params('user_id') && $this->request->has_params('newsletter_unsubscribe_code') && $this->request->has_params('newsletter_id')) {
            $this->leiratkozas_model->leiratkozas($this->request->get_params('user_id'), $this->request->get_params('newsletter_unsubscribe_code'), $this->request->get_params('newsletter_id'));

//die('xxxxxxxxxxxxxxx');


            $this->view = new View();

            $this->view->settings = $this->settings;
            $this->view->footer_text = $this->footer_text;
            $this->view->promotions = $this->promotions;
            $this->view->no_of_promotions = $this->no_of_promotions;
            $this->view->szolgaltatasok_menu = $this->szolgaltatasok_menu;
            $this->view->nyitva_tartas = $this->nyitva_tartas;
            $this->view->footer_nagy_atalakulasok = $this->footer_nagy_atalakulasok;
            $this->view->pop_up = $this->pop_up;

            // adatok bevitele a view objektumba
            $this->view->title = 'Hírlevélről leiratkozás Freya szalon';
            $this->view->description = 'Hírlevélről leiratkozás Freya szalon';
            $this->view->keywords = 'Hírlevélről leiratkozás Freya szalon';

            $this->view->set_layout('tpl_layout');
            $this->view->render('leiratkozas/tpl_leiratkozas');
        } else {
            Util::redirect('error');
        }
    }

}

?>