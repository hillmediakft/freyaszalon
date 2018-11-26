<?php

class Kedvencek_controller extends Controller {

    public function __construct() {
        parent::__construct();
        // kedvencek lekérdezése
        $this->kedvencek_model = new Kedvencek_model;

    }
    
    /**
     * 	lekérdezi a kedvencek cookie-ban szereplő kedvencekat 
     */
    public function get_favourite_properties() {

        $id_array = json_decode(Cookie::get('kedvencek'));

        if ($id_array) {
            $result = $this->kedvencek_model->get_favourite_properties_data($id_array);
            return $result;
        } else {
            return array();
        }
    }  
    
        /**
     * 	törli az ingatlan id-t a kedvencek cookie-ból  
     */
    public function delete_property_from_cookie() {
        if (Util::is_ajax() && isset($_POST["ingatlan_id"])) {
            $id = (int) $_POST["ingatlan_id"];


            $this->kedvencek_model->delete_property_from_cookie($id);
        } else {
            exit();
        }
    }
    
    /**
     * 	hozzáadja az ingatlan id-t a kedvencek cookie-hoz  
     */
    public function add_property_to_cookie() {
        if (Util::is_ajax() && isset($_POST["ingatlan_id"])) {
            $id = (int) $_POST["ingatlan_id"];
            $this->kedvencek_model->refresh_kedvencek_cookie($id);
        } else {
            exit();
        }
    }    

}

?>