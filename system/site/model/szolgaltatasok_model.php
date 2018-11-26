<?php

class Szolgaltatasok_model extends Site_model {

    /**
     * Constructor, létrehozza az adatbáziskapcsolatot
     */
    function __construct() {
        parent::__construct();
    }

    /**
     * 	A services táblázathoz kérdezi le az adatokat
     * 	Itt nem kell minden adat egy szolgáltatásról/játékról
     */
    public function getSzolgaltatasok() {
        $this->query->reset();
        // a query tulajdonság ($this->query) tartalmazza a query objektumot
        $this->query->set_table(array('szolgaltatasok'));
        $this->query->set_columns(array(
            'szolgaltatasok.szolgaltatas_id',
            'szolgaltatasok.szolgaltatas_title',
            'szolgaltatasok.szolgaltatas_description',
            'szolgaltatasok.szolgaltatas_info',
            'szolgaltatasok.szolgaltatas_photo',
            'szolgaltatasok.szolgaltatas_extra_photos',
            'szolgaltatasok.szolgaltatas_status',
            'szolgaltatasok.szolgaltatas_order',
            'szolgaltatasok.szolgaltatas_category_id',
            'szolgaltatasok_list.szolgaltatas_list_name',
            'szolgaltatasok_list.szolgaltatas_list_order'
        ));

        $this->query->set_join('left', 'szolgaltatasok_list', 'szolgaltatasok.szolgaltatas_category_id', '=', 'szolgaltatasok_list.szolgaltatas_list_id');
        $this->query->set_where('szolgaltatasok.szolgaltatas_status', '=', 1);
        $this->query->set_orderby('szolgaltatas_list_order', 'ASC');
        return $this->query->select();
    }

    /**
     * 	Egy szolgáltatás minden adatát lekérdezi a részletek megjelenítéséhez
     */
    public function getSzolgaltatas($slug) {

        $this->query->reset();
        // a query tulajdonság ($this->query) tartalmazza a query objektumot
        $this->query->set_table(array('szolgaltatasok'));
        $this->query->set_columns(array(
            'szolgaltatasok.szolgaltatas_id',
            'szolgaltatasok.szolgaltatas_title',
            'szolgaltatasok.szolgaltatas_description',
            'szolgaltatasok.szolgaltatas_info',
            'szolgaltatasok.szolgaltatas_photo',
            'szolgaltatasok.szolgaltatas_extra_photos',
            'szolgaltatasok.szolgaltatas_status',
            'szolgaltatasok.szolgaltatas_category_id',
            'szolgaltatasok.crew_members',
            'szolgaltatasok_list.szolgaltatas_list_name'
        ));

        $this->query->set_join('left', 'szolgaltatasok_list', 'szolgaltatasok.szolgaltatas_category_id', '=', 'szolgaltatasok_list.szolgaltatas_list_id');
        $this->query->set_where('slug', '=', $slug);
        $result = $this->query->select();
        if (!empty($result)) {
            return $result[0];
        } else {
            return false;
        }
    }

    /**
     * 	Visszaadja a blog tábla tartalmát
     * 	Ha kap egy id paramétert (integer), akkor csak egy sort ad vissza a táblából
     *
     * 	@param $id Integer 
     */
    public function getSzolgaltatasokById($id_array) {
        $this->query->reset();
        $this->query->set_table(array('szolgaltatasok'));
        $this->query->set_columns('*');
        if (!empty($id_array)) {
            $this->query->set_where('szolgaltatas_id', 'in', $id_array);
        }
        $this->query->set_join('left', 'szolgaltatasok_list', 'szolgaltatasok.szolgaltatas_category_id', '=', 'szolgaltatasok_list.szolgaltatas_list_id');
        return $this->query->select();
    }

    /**
     * 	Egy szolgáltatás minden adatát lekérdezi a részletek megjelenítéséhez
     */
    public function getSzolgaltatasokInCategory($category, $id) {

        $this->query->reset();
        // a query tulajdonság ($this->query) tartalmazza a query objektumot
        $this->query->set_table(array('szolgaltatasok'));
        $this->query->set_columns(array(
            'szolgaltatasok.szolgaltatas_id',
            'szolgaltatasok.szolgaltatas_title',
            'szolgaltatasok.szolgaltatas_description',
            'szolgaltatasok.szolgaltatas_info',
            'szolgaltatasok.szolgaltatas_photo',
            'szolgaltatasok.szolgaltatas_status',
            'szolgaltatasok.szolgaltatas_order',
            'szolgaltatasok.szolgaltatas_category_id',
            'szolgaltatasok_list.szolgaltatas_list_name'
        ));
        $this->query->set_join('left', 'szolgaltatasok_list', 'szolgaltatasok.szolgaltatas_category_id', '=', 'szolgaltatasok_list.szolgaltatas_list_id');
        $this->query->set_where('szolgaltatasok.szolgaltatas_category_id', '=', $category);
        $this->query->set_where('szolgaltatasok.szolgaltatas_id', '!=', $id);
        $this->query->set_where('szolgaltatasok.szolgaltatas_status', '=', 1);
        $result = $this->query->select();
        return $result;
    }

    /**
     * 	Egy szolgáltatás minden adatát lekérdezi a részletek megjelenítéséhez
     */
    public function getAllSzolgaltatasInCategory($category_id) {

        $this->query->reset();
        $this->query->debug(false);
        $this->query->set_table(array('szolgaltatasok'));
        $this->query->set_columns(array(
            'szolgaltatasok.szolgaltatas_id',
            'szolgaltatasok.szolgaltatas_title',
            'szolgaltatasok.szolgaltatas_description',
            'szolgaltatasok.szolgaltatas_info',
            'szolgaltatasok.szolgaltatas_photo',
            'szolgaltatasok.szolgaltatas_status',
            'szolgaltatasok.szolgaltatas_order',
            'szolgaltatasok.szolgaltatas_category_id',
            'szolgaltatasok_list.szolgaltatas_list_name'
        ));
        $this->query->set_join('left', 'szolgaltatasok_list', 'szolgaltatasok.szolgaltatas_category_id', '=', 'szolgaltatasok_list.szolgaltatas_list_id');
        $this->query->set_where('szolgaltatasok.szolgaltatas_category_id', '=', $category_id);
        $this->query->set_where('szolgaltatasok.szolgaltatas_status', '=', 1);
        $result = $this->query->select();
        return $result;
    }

    /**
     * 	Egy szolgáltatás minden adatát lekérdezi a részletek megjelenítéséhez
     */
    public function getSzolgaltatasCategoryIdBySlug($slug) {

        $this->query->reset();
        $this->query->set_table(array('szolgaltatasok_list'));
        $this->query->set_columns('*');
        $this->query->set_where('szolgaltatas_list_slug', '=', $slug);
        $result = $this->query->select();
        return $result[0];
    }

    /**
     * Növeli az adott játék megtekintéseienk számát 1-gyel
     * 	
     * @param   $id     int    játék id
     * @return  void 
     */
    public function increase_no_of_clicks($id) {

        $increase = array('megtekintes' => 'megtekintes+1');

        $this->query->reset();
//        $this->query->debug(true);
        $this->query->set_table(array('szolgaltatasok'));
        $this->query->set_columns(array('szolgaltatas_id', 'megtekintes'));
        $this->query->set_where('szolgaltatas_id', '=', $id);
        $this->query->update(array(), $increase);
    }

    /**
     * 	Lekérdezi a kategóriák nevét és id-jét a szolgaltatasok_list táblából (az option listához)
     */
    public function getCategories() {
        $this->query->reset();
        $this->query->set_table(array('szolgaltatasok_list'));
        $this->query->set_columns('*');
        $this->query->set_orderby('szolgaltatas_list_order', 'ASC');
        $result = $this->query->select();
        return $result;
    }

    /**
     * 	A services táblázathoz kérdezi le az adatokat
     * 	Itt nem kell minden adat egy szolgáltatásról/játékról
     */
    public function getSzolgaltatasokByCategory($category_id) {
        $this->query->reset();
        // a query tulajdonság ($this->query) tartalmazza a query objektumot
        $this->query->set_table(array('szolgaltatasok'));
        $this->query->set_columns('*');
        $this->query->set_where('szolgaltatas_category_id', '=', $category_id);
        $this->query->set_where('szolgaltatas_status', '=', 1);
        $this->query->set_orderby('szolgaltatas_order', 'ASC');
        return $this->query->select();
    }

}

?>