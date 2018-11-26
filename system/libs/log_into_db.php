<?php

class Log_into_db extends Admin_controller {

    function __construct() {
        parent::__construct();
    }

    public function index($data) {
        
        $this->log_into_db_model = new Log_into_db_model();
        $this->log_into_db_model->save_log_data($data);
    }

}

?>