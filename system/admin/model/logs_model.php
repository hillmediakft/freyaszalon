<?php

class Logs_model extends Admin_model {


    /**
     * Constructor, létrehozza az adatbáziskapcsolatot
     */
    function __construct()
    {
        parent::__construct();

    }


    /**
     *  Felhasználók adatainak lekérdezése
     *
     *  @param  string|integer    $user_id (csak ennek a felhasználónak az adatait adja vissza
     *  @return array|false
     */
    public function get_logs($user_id = null)
    {
        $this->query->reset();
        $this->query->set_table(array('logs'));
        $this->query->set_columns('*');
        $this->query->set_join('left', 'users', 'users.user_id', '=', 'logs.user_id');
      
        if(!is_null($user_id)){
            $this->query->set_where('user_id', '=', $user_id);
        }
        return $this->query->select();
    }


 
}

// end class
?>