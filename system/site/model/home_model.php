<?php

class Home_model extends Site_model {

    function __construct() {
        parent::__construct();
    }

    /**
     * 	Lekérdezi a városok nevét és id-jét a city_list táblából (az option listához)
     * 	A paraméter megadja, hogy melyik megyében lévő városokat adja vissza 		
     * 	@param integer	$id 	egy megye id-je (county_id)
     */
    public function city_list_grouped_by_county() {
        $this->query->set_table(array('city_list'));
        $this->query->set_columns('*');

        $this->query->set_join('left', 'county_list', 'city_list.county_id', '=', 'county_list.county_id');
        //       $this->query->set_orderby(array('city_name'), 'ASC');
        $result = $this->query->select();

        $arr = array();
        foreach ($result as $key => $item) {
            $arr[$item['county_name']][$key] = $item;
        }

        ksort($arr, SORT_REGULAR);
        return $arr;
    }

    /**
     * 	Lekérdez minden adatot a megadott táblából (pl.: az option listához)
     * 	
     * 	@param	string	$table 		(tábla neve)
     * 	@return	array
     */
    public function list_query($table) {
        $this->query->set_table(array($table));
        $this->query->set_columns('*');
        return $this->query->select();
    }

    /**
     * 	A home oldal slider adatait kérdezi le az adatbázisból
     *
     * 	@return	string a slider html kódja
     */
    public function get_slider() {

        $this->query->reset();
        $this->query->set_table(array('slider'));
        $this->query->set_columns(array('id', 'slider_order', 'picture', 'text', 'title', 'target_url'));
        $this->query->set_where('active', '=', 1);
        $this->query->set_orderby(array('slider_order'), 'ASC');
        $result = $this->query->select();

        return $result;
    }

    /**
     * 	A home oldal slider adatait kérdezi le az adatbázisból
     *
     * 	@return	string a slider html kódja
     */
    public function get_content($content_id) {

        $this->query->reset();
        $this->query->set_table(array('content'));
        $this->query->set_columns('*');
        $this->query->set_where('content_name', '=', $content_id);
        $result = $this->query->select();
        if (count($result) > 1) {
            return $result[0];
        } else {
            return $result;
        }
    }

    /**
     * 	A home oldal rólunk mondták (testimonials) slider-höz a szövegeket olvassa be
     *
     * 	@return	string a rólunk mondták slider html kódja
     */
    public function get_testimonials() {

        $this->query->reset();
        $this->query->set_table(array('testimonials'));
        $this->query->set_columns(array('text', 'name', 'title'));
        $result = $this->query->select();
        return $result;
    }

}

?>