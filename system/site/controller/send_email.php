<?php

class Send_email extends Site_controller {

    function __construct() {
        parent::__construct();
        $this->loadModel('settings_model');
        $this->settings = $this->settings_model->get_settings();
    }

    public function init() {
        if ($this->request->is_ajax() && $this->request->get_post('name') != '') {
            if ($this->request->get_post('mezes_bodon') == '') {
                $template = $this->request->get_params('type');
                if ($template == "contact") {
                    $this->to_email = $this->settings['email'];
                    $this->to_name = $this->settings['ceg'];
                    $this->subject = 'Érdeklődés';
                    $this->template = $template;
                }
                if ($template == "csomag_kalkulator") {
                    $this->to_email = $this->settings['email'];
                    $this->to_name = $this->settings['ceg'];
                    $this->subject = 'Érdeklőséds kedvezményes csomag iránt';
                    $this->template = $template;
                }
                $this->send();
            } else {
                exit;
            }
        }
    }

    public function send() {

        // paraméterek: ($from_email, $from_name, $to_email, $to_name, $subject, $form_data, $template)
        $emailer = new Emailer($this->request->get_post('email'), $this->request->get_post('name'), $this->to_email, $this->to_name, $this->subject, $this->request->get_post(), $this->template);
        if ($emailer->send()) {
            echo json_encode(array(
                'status' => 'success',
                'title' => 'Sikeres küldés!',
                'message' => 'Köszönjük az érdeklődést, hamarosan jelentkezünk!')
                    );
        } else {
            echo json_encode(array(
                'status' => 'error',
                'title' => 'Hiba történt!',
                'message' => 'Sajnos hiba történt, próbálja újra!')
                    );
        }
    }

}

?>