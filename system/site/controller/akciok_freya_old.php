<?php

class Akciok extends Controller {

    function __construct() {
        parent::__construct();
        $this->loadModel('akciok_model');
        $this->view->footer = $this->akciok_model->get_footer();
        $this->view->settings = $this->akciok_model->get_settings();
        // a második paraméter azt jelzi, hogy kell-e ikont megjeleníteni
        $this->view->email = Util::safe_mailto($this->view->settings[0]['email'], false);
        $this->view->address = $this->view->settings[0]['cim'];
        $this->view->mobile = $this->view->settings[0]['mobil'];
        $this->view->phone = $this->view->settings[0]['tel'];
        $this->view->pop_up = $this->view->settings[0]['pop_up'];
        $pop_up_window = $this->akciok_model->get_pop_up_window();
        if (!empty($pop_up_window)) {
            $this->view->pop_up_window_title = $pop_up_window['title'];
            $this->view->pop_up_window_content = $pop_up_window['content'];
        } else {
            $this->view->pop_up = false;
        }
    }

    public function index() {

        $this->view->content = $this->akciok_model->all_promotions();

        $this->view->sidebar = $this->akciok_model->get_sidebar();

        // footerbe rólunk mondták doboz
        $this->view->testimonials = $this->akciok_model->get_testimonials();

        $this->view->title = "Freya Szalon akciók";
        $this->view->description = "Freya Szalon akciók";
        $this->view->keywords = "Freya Szalon akciók";

        $this->view->footer = str_replace('{$mobile}', $this->view->mobile, $this->view->footer);
        $this->view->footer = str_replace('{$address}', $this->view->address, $this->view->footer);
        $this->view->footer = str_replace('{$email}', $this->view->email, $this->view->footer);

        $this->view->render('akciok/tpl_akciok');
    }

}

?>