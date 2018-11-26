<?php

class Logs extends Admin_controller {

    function __construct() {
        parent::__construct();
        $this->loadModel('logs_model');
    }

    public function index() {
        $this->view = new View();

        $this->view->title = 'Naplózás oldal';
        $this->view->description = 'Naplózás oldal description';

        $this->view->add_links(array('datatable', 'vframework', 'logs'));

        // userek adatainak lekérdezése
        $this->view->logs = $this->logs_model->get_logs();
//$this->view->debug(true);	
        $this->view->set_layout('tpl_layout');
        $this->view->render('logs/tpl_logs');
    }

}

?>