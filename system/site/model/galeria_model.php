<?php

class Galeria_model extends Site_model {

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
        $result = $this->query->select();

        return $result;
    }

    /**
     * A paraméterként átadott képgalériába tartozó képek lekérdezése
     *
     * @return az összes kép adatai tümbben
     */
    public function get_all_photo_by_category($category_id) {


        // a query tulajdonság ($this->query) tartalmazza a query objektumot
        $this->query->reset();
        $this->query->set_table(array('photo_gallery'));
        $this->query->set_columns('*');
        $this->query->set_where('photo_category', '=', $category_id);
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
        $result = $this->query->select();
        return $result;
    }

    /**
     * 	Visszaadja a blog tábla tartalmát
     * 	Ha kap egy id paramétert (integer), akkor csak egy sort ad vissza a táblából
     *
     * 	@param $id Integer 
     */
    public function getImagesById($id_array) {
        if (!empty($id_array)) {
            $this->query->reset();
            $this->query->set_table(array('photo_gallery'));
            $this->query->set_columns('*');
            $this->query->set_where('photo_id', 'in', $id_array);
            return $this->query->select();
        } else {
            return array();
        }
    }

    /*     * ****************** Before after photos ******************** */

    /**
     * A paraméterként átadott képgalériába tartozó képek lekérdezése
     *
     * @return az összes kép adatai tümbben
     */
    public function get_all_before_after_photo($number = 0) {


        // a query tulajdonság ($this->query) tartalmazza a query objektumot
        $this->query->reset();
        $this->query->set_table(array('before_after_photo_gallery'));
        $this->query->set_columns('*');
        if($number > 0) {
            $this->query->set_limit($number);
        }
        $this->query->set_orderby('photo_id', 'DESC');
        $result = $this->query->select();

        return $result;
    }

}
?>