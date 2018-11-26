<?php

class References_model extends Model {

    /**
     * Constructor, létrehozza az adatbáziskapcsolatot
     */
    function __construct() {
        parent::__construct();
    }

    public function all_references() {
        // a query tulajdonság ($this->query) tartalmazza a query objektumot
        $this->query->reset();
//		$this->query->debug(true);
        $this->query->set_table(array('references'));
        $this->query->set_columns('*');
		$this->query->set_orderby('reference_id DESC');
        $result = $this->query->select();

        return $result;
    }

    public function update_reference($id) {
        $data['reference_imdb_id'] = $_POST['reference_imdb_id'];
        $data['reference_title'] = $_POST['reference_title'];


        // új adatok beírása az adatbázisba (update) a $data tömb tartalmazza a frissítendő adatokat 
        $this->query->reset();
        $this->query->set_table(array('references'));
        $this->query->set_where('reference_id', '=', $id);
        $result = $this->query->update($data);

        if ($result) {
            Message::set('success', 'referencia sikeresen módosítva!');
            return true;
        } else {
            Message::set('error', 'unknown_error');
            return false;
        }
    }

    /**
     * 	Egy oldal adatait kérdezi le az adatbázisból (pages tábla)
     *
     * 	@param	$id String or Integer
     * 	@return	az adatok tömbben
     */
    public function reference_data_query($id) {
        $this->query->reset();
        $this->query->set_table(array('references'));
        $this->query->set_columns('*');
        $this->query->set_where('reference_id', '=', $id);

        return $this->query->select();
    }

    /**
     * 	Egy oldal adatait kérdezi le az adatbázisból (pages tábla)
     *
     * 	@param	$id String or Integer
     * 	@return	az adatok tömbben
     */
    public function new_reference() {

        $data['reference_imdb_id'] = $_POST['reference_imdb_id'];

		if(!preg_match("#^tt\\d{1,8}$#", $data['reference_imdb_id'], $matches)){
			Message::set('error', 'Az IMDb azonosító nem megfelelő formátumú!');
            return false;
		}

        
        include(LIBS . "/class_IMDb.php");
        $imdb = new IMDb(true, true, 0);    // anonymise requests to prevent IP address getting banned, summarise returned data, unlimited films returned
        $movie = $imdb->find_by_id($data['reference_imdb_id']);
        $data['reference_title'] = $movie->title;
        $data['reference_year'] = $movie->year;
        $data['reference_genre'] = $movie->genre;
        $data['reference_director'] = $movie->director;
        $data['reference_actors'] = $movie->actors;
		
		if($movie->poster){
		       
			$imageString = file_get_contents($movie->poster);
			$save = file_put_contents('uploads/reference_photo/' . $data['reference_imdb_id'] . '_poster.jpg',$imageString);

			$img_on_server = 'uploads/reference_photo/' . $data['reference_imdb_id'] . '_poster.jpg';
			$imagePath = 'uploads/reference_photo/';
                        // Nézőkép készítése
						 include(LIBS . "/upload_class.php");
						 //képkezelő objektum létrehozása (a feltöltött kép elérése a paraméter)
                        $handle = new upload($img_on_server);
//                        $handle->file_name_body_add = '_thumb';
$handle->file_overwrite = true;
$handle->file_auto_rename = false;
                        $handle->image_resize = true;
                        $handle->image_x = 450; //poster szélessége
                        $handle->image_ratio_y = true;

                        $handle->Process($imagePath);
			
			
			
			$data['reference_poster'] = 'uploads/reference_photo/' . $data['reference_imdb_id'] . '_poster.jpg';
		}
		else{
			$data['reference_poster'] = 'uploads/reference_photo/' . 'placeholder_poster.jpg';
		}
        $this->query->reset();
//        $this->query->debug(true);
        $this->query->set_table(array('references'));
        $result = $this->query->insert($data);

        // ha sikeres az insert visszatérési érték true
        if ($result) {
            Message::set('success', 'Új referencia sikeresen hozzáadva!');
            return true;
        } else {
            Message::set('error', 'unknown_error');
            return false;
        }
    }

    /**
     * 	Vélemény törlése a references táblából
     *
     * 	@param	$id String or Integer
     * 	@return	az adatok tömbben
     */
    public function delete_reference($id) {

        $this->query->reset();
        $this->query->set_table(array('references'));
        $this->query->set_where('reference_id', '=', $id);
        $result = $this->query->delete();

        // ha sikeres a törlés 1 a vissaztérési érték
        if ($result == 1) {
            Message::set('success', 'referencia sikeresen törölve!');
            return true;
        } else {
            Message::set('error', 'unknown_error');
            return false;
        }
    }

}

?>