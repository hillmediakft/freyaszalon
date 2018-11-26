<?php

class Akciok_model extends Site_model {

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
        $this->query->set_columns(array('promotion_order', 'picture', 'text', 'title'));
        $this->query->set_where('active', '=', 1);
        $this->query->set_orderby(array('promotion_order'));
        $result = $this->query->select();
        return $result;
    }

}

?>