<?php

class Photo_gallery_model extends Model {

    /**
     * Constructor, létrehozza az adatbáziskapcsolatot
     */
    function __construct() {
        parent::__construct();
    }

    /**
     * Az összes kép lekérdezése
     *
     * @return az összes kép adatai tümbben
     */
    public function photosByCategory($category_id) {
        $this->query->reset();
        $this->query->debug(false);
        $this->query->set_table(array('photo_gallery'));
        $this->query->set_columns('*');
        $this->query->set_where('photo_category', '=', $category_id);
        $this->query->set_orderby('photo_id', 'DESC');
        $result = $this->query->select();
        return $result;
    }


    /**
     * 	Egy kép adatait kérdezi le az adatbázisból (photo_gallery tábla)
     *
     * 	@param	$id a kép rekordjának azonosítója
     * 	@return	az adatok tömbben
     */
    public function photo_data_query($id) {
        $this->query->reset();
        $this->query->set_table(array('photo_gallery'));
        $this->query->set_columns('*');

        return $this->query->select();
    }

    /**
     * 	Lekérdezi a fotó kategóriákat a photo_category táblából (és az id-ket)
     * 	@param	integer	$id  (ha csak egy elemet akarunk lekérdezni, pl.: munka kategória módosításhoz)
     * 	@return	array	
     */
    public function photo_category_query($id = null) {
        $this->query->reset();
        $this->query->set_table(array('photo_category'));
        $this->query->set_columns('*');
        if (!is_null($id)) {
            $id = (int) $id;
            $this->query->set_where('id', '=', $id);
        }
        return $this->query->select();
    }



    /**
     * 	Lekérdezi kategóriák nevét és id-jét a photo_category táblából (az option listához)
     */
    public function photo_category_list_query() {
        $this->query->reset();
        $this->query->set_table(array('photo_category'));
        $this->query->set_columns(array('id', 'category_name'));
        $result = $this->query->select();
        return $result;
    }

    /**
     * 	Lekérdezi a kategóriában lévő fotók számát
     */
    public function get_no_of_photos_in_category($id = null) {
        $this->query->reset();
        $result = $this->query->query_sql('SELECT photo_category, COUNT(*) FROM photo_gallery GROUP BY photo_category');

        $array = array();
        foreach ($result as $value) {
            foreach ($value as $value2) {
                $array[$value['photo_category']] = $value['COUNT(*)'];
            }
        }
        if (!isset($id)) {
            return $array;
        } else {
            if (array_key_exists($id, $array)) {
                return $array[$id];
            } else {
                return 0;
            }
        }
    }
   

}

?>