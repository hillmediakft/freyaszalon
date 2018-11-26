<?php

class Log_into_db_model extends Admin_model {

    /**
     * Constructor, létrehozza az adatbáziskapcsolatot
     */
    function __construct() {
        parent::__construct();
    }

    /**
     * Slide-ok adatainak lekérdezése, a slider_order sorrend szerint
     * 	
     * @return Array (az összes slide minden adata a "slider_order" szerint rendezve)
     */
    public function save_log_data($message) {

        $data = array (
        'user_id' => Session::get('user_id'),
        'message' => $message,
        'date' => date("Y-m-d h:i:s")

        );

        $this->query->reset();
        $this->query->set_table(array('logs'));
        $result = $this->query->insert($data);
    }

}

?>