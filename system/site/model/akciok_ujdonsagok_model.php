<?php

class Akciok_ujdonsagok_model extends Site_model {

    /**
     * Constructor, létrehozza az adatbáziskapcsolatot
     */
    function __construct() {
        parent::__construct();
    }

    /**
     * A paraméterként átadott képgalériába tartozó képek lekérdezése
     *
     * @return az összes kép adatai tümbben
     */
    public function get_promotions() {
        // a query tulajdonság ($this->query) tartalmazza a query objektumot
        $this->query->reset();
        $this->query->set_table(array('promotions'));
        $this->query->set_columns('*');
        $this->query->set_where('active', '=', 1);
        $this->query->set_orderby(array('promotion_order'));
        $result = $this->query->select();
        return $result;
    }
    
    /**
     * A paraméterként átadott képgalériába tartozó képek lekérdezése
     *
     * @return az összes kép adatai tümbben
     */
    public function get_promotion($id) {
        // a query tulajdonság ($this->query) tartalmazza a query objektumot
        $this->query->reset();
        $this->query->set_table(array('promotions'));
        $this->query->set_columns('*');
        $this->query->set_where('active', '=', 1);
        $this->query->set_where('id', '=', $id);
        $result = $this->query->select();
        if($result) {
        return $result[0];
        } else {
            return false;
        }
    }    
    
    /**
     * Növeli az adott akció, hír megtekintéseienk számát 1-gyel
     * 	
     * @param $id int    id
     * @return void 
     */
    public function increase_no_of_clicks($id) {
        $increase = array('clicks' => 'clicks+1');

        $this->query->reset();
        $this->query->debug(false);
        $this->query->set_table(array('promotions'));
        $this->query->set_columns(array('id', 'clicks'));
        $this->query->set_where('id', '=', $id);
        $this->query->update(array(), $increase);
    }    

}

?>