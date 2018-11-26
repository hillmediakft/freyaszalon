<?php

class Datatables_model extends Admin_model {

    /**
     * A tábla nevek és az ingatlanok táblában az oszlop nevek párosításai
     */
    public $jellemzok = array(
      'ingatlan_allapot' => 'allapot',
      'ingatlan_kategoria' => 'kategoria',
      'ingatlan_futes' => 'futes',
      'ingatlan_energetika' => 'energetika',
      'ingatlan_kert' => 'kert',
      'ingatlan_kilatas' => 'kilatas',
      'ingatlan_parkolas' => 'parkolas',
      'ingatlan_szerkezet' => 'szerkezet'  
    );

    /**
     * Constructor, létrehozza az adatbáziskapcsolatot
     */
    function __construct() {
        parent::__construct();
    }

    /**
     * Jellemző tábla tartalmát adja vissza
     * 
     * @param   string  $table a tábla neve 
     * @return  array   a paraméterként átadott tábla tartalma
     */
    public function get_jellemzo_list($table)
    {
        $this->query->set_table(array($table));
        $this->query->set_columns();
        return $this->query->select();
    }

    /**
     * Jellemző törlése
     * 
     * @param   string  $id - a jellemző id-je
     * @param   string  $table - a jellemző tábla neve (pl.: ingatlan_allapot)
     * @param   string  $id_name - a jellemző táblában az id oszlop neve (pl. all_id)
     * @return  integer || false  integer ha sikeres, false, ha sikertelen a törlés
     */
    public function delete($id, $table, $id_name)
    {
        $id = (int) $id;

        if ($this->is_deletable($id, $table)) {

            $this->query->set_table(array($table));
            return $this->query->delete($id_name, '=', $id);

        } else {
            return false;
        }
    }

    /**
     * Jellemző update
     * 
     * @param   string  $id - a jellemző id-je
     * @param   string  $table - a jellemző tábla neve (pl.: ingatlan_allapot)
     * @param   string  $id_name - a jellemző táblában az id oszlop neve (pl. all_id)
     * @param   string  $leiras_name - a leírás oszlop neve (pl.: all_leiras)
     * @param   string  $data - hozzáadandó jellemző megnevezése
     * @return  boolean true ha sikeres, false, ha sikertelen a törlés
     */
    public function update_insert($id, $table, $id_name, $leiras_name, $data)
    {
        $data = trim($data);
        // ha üres a kategórianév
        if($data == '') {
            echo json_encode(
                array(
                'status' => 'error',
                'message' => 'Nem lehet üres ez a mező!'
                )
            );
            exit;
        }   

        // kategóriák lekérdezése (annak ellenőrzéséhez, hogy már létezik-e ilyen kategória)
        $this->query->set_table(array($table));
        $this->query->set_columns(array($leiras_name));
        $existing_categorys = $this->query->select(); 
        // bejárjuk a kategória neveket és összehasonlítjuk az új névvel (kisbetűssé alakítjuk, hogy ne számítson a nagybetű-kisbetű eltérés)
        foreach($existing_categorys as $value) {
            if(strtolower($data) == strtolower($value[$leiras_name])) {
                echo json_encode(
                    array(
                    'status' => 'error',
                    'message' => 'Már létezik ' . $value[$leiras_name] . ' kategória!'
                    )
                );
                exit;
            }   
        } 

        $data = array($leiras_name => $data);

        if (is_null($id)) {
            // insert
            $this->query->set_table(array($table));
            return $this->query->insert($data);
        } else {
            // update
            $id = (int) $id;
            $this->query->set_table(array($table));
            $this->query->set_where($id_name, '=', $id);
            return $this->query->update($data);
        }
    }

    /**
     * Ellenőrzi, hogy a jellemző törlöhető-e: van ingatlan ilyen jellemzővel
     * 
     * @param   string  $id - a jellező id-je
     * @param   string  $table - a jellemző tábla neve (pl.: ingatlan_allapot)
     * @return   boolean true ha törölhető, false, ha nem
     */
    public function is_deletable($id, $table)
    {
        $this->query->set_table(array('ingatlanok'));
        $this->query->set_columns('id');
        $this->query->set_where($this->jellemzok[$table], '=', $id);
        $result = $this->query->select();
        
        if (empty($result)) {
            return true;
        } else {
            return false;
        }
    }

}
?>