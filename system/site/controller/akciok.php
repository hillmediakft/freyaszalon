<?php

class Akciok extends Site_controller {

    function __construct() {
        parent::__construct();
        $this->loadModel('akciok_ujdonsagok_model');
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

        $this->view->data_arr = $this->akciok_ujdonsagok_model->page_data_query('akciok-ujdonsagok');

        $this->view->title = $this->view->data_arr['page_metatitle'];
        $this->view->description = $this->view->data_arr['page_metadescription'];
        $this->view->keywords = $this->view->data_arr['page_metakeywords'];
        $this->view->content = $this->view->data_arr['page_body'];

        $this->view->set_layout('tpl_layout');
        $this->view->render('akciok_ujdonsagok/tpl_akciok_ujdonsagok');
    }

    public function reszletek() {

        $id = (int) $this->request->get_params('id');

        $this->akciok_ujdonsagok_model->increase_no_of_clicks($id);

        $this->view = new View();
        $this->view->settings = $this->settings;
        $this->view->promotions = $this->promotions;
        $this->view->no_of_promotions = $this->no_of_promotions;
        $this->view->promotion = $this->akciok_ujdonsagok_model->get_promotion($id);
        $this->view->szolgaltatasok_menu = $this->szolgaltatasok_menu;
        $this->view->footer_text = $this->footer_text;
        $this->view->nyitva_tartas = $this->nyitva_tartas;
        $this->view->call_to_action = $this->call_to_action;
        $this->view->footer_nagy_atalakulasok = $this->footer_nagy_atalakulasok;
        $this->view->pop_up = $this->pop_up;

        if (!$this->view->promotion) {
            Util::redirect('error');
        }

        $this->view->title = $this->view->promotion['title'];
        $this->view->description = Util::sentence_trim($this->view->promotion['text'], 2);
        $this->view->keywords = $this->view->promotion['title'];

        $this->view->set_layout('tpl_layout');
        $this->view->render('akciok_ujdonsagok/tpl_akciok_ujdonsagok_reszletek');
    }

}

?>