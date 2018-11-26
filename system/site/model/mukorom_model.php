<?php

class Mukorom_model extends Site_model {

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
    public function get_photo_gallery($category) {


        // a query tulajdonság ($this->query) tartalmazza a query objektumot
        $this->query->reset();
        $this->query->set_table(array('photo_gallery'));
        $this->query->set_columns('*');
        $this->query->set_where('photo_category', '=', $category);
        $result = $this->query->select();

        return $result;
    }

    /**
     * A paraméterként átadott képgalériába tartozó képek lekérdezése
     *
     * @return az összes kép adatai tümbben
     */
    public function get_all_photo() {


        // a query tulajdonság ($this->query) tartalmazza a query objektumot
        $this->query->reset();
        $this->query->set_table(array('photo_gallery'));
        $this->query->set_columns('*');
        $this->query->set_where('photo_category', '=', 5);
        $this->query->set_where('photo_category', '=', 6, 'OR');
        $result = $this->query->select();

        return $result;
    }

    /**
     * 	Lekérdezi kategóriák nevét és id-jét a photo_category táblából (az option listához)
     */
    public function photo_category_list_query() {
        $this->query->reset();
        $this->query->set_table(array('photo_category'));
        $this->query->set_columns('*');
        $this->query->set_where('id', '=', 5);
        $this->query->set_where('id', '=', 6, 'OR');
        $result = $this->query->select();
        return $result;
    }    


}
?>