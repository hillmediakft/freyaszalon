<?php

class Offers_model extends Model {

    /**
     * Constructor, létrehozza az adatbáziskapcsolatot
     */
    function __construct() {
        parent::__construct();
    }

    public function all_offers() {
        // a query tulajdonság ($this->query) tartalmazza a query objektumot
        $this->query->set_table(array('offers'));
        $this->query->set_columns(array('id', 'code', 'title', 'package'));
        $result = $this->query->select();

        return $result;
    }

    /**
     * Ajánlat update
     * 	
     * @param 	int 	$id	ajánlat id-je
     * @return 	string 	üzenet
     */
    public function update_offer($id) {

        $data['title'] = $this->request->get_post('offer_title');
        $data['package'] = $this->request->get_post('offer_package');

        // új adatok beírása az adatbázisba (update) a $data tömb tartalmazza a frissítendő adatokat 
        $this->query->reset();
        $this->query->set_table(array('offers'));
        $this->query->set_where('id', '=', $id);
        $result = $this->query->update($data);

        if ($result) {
            Message::set('success', 'Tartalom sikeresen módosítva!');
            return true;
        } else {
            Message::set('error', 'Hiba történt!');
            return false;
        }
    }

    /**
     * 	Az ajánlatokat kérdezi le az adatbázisból (offers tábla)
     *
     * 	@param	$id String or Integer
     * 	@return	az adatok tömbben
     */
    public function offer_data_query($id) {
        $this->query->reset();
        $this->query->set_table(array('offers'));
        $this->query->set_columns(array('id', 'code', 'title', 'package'));
        $this->query->set_where('id', '=', $id);
        return $this->query->select();
    }

}

?>