<?php

class Crew_members_model extends Model {

    /**
     * Constructor, létrehozza az adatbáziskapcsolatot
     */
    function __construct() {
        parent::__construct();
    }

    /**
     * 	Egy kolléga minden adatát lekérdezi a részletek megjelenítéséhez
     */
    public function one_crew_member_alldata_query($id = null) {
        $id = (int) $id;

        $this->query->reset();
//        $this->query->debug(true);
        $result = $this->query->query_sql(
                'SELECT `crew_members`.`crew_member_id` , `crew_members`.`crew_member_name` , `crew_members`.`crew_member_title` ,`crew_members`.`crew_member_phone` , `crew_members`.`crew_member_email` , `crew_members`.`crew_member_status`, `crew_members`.`crew_member_photo`, `crew_members`.`crew_member_category`, `crew_members`.`crew_member_info`,
GROUP_CONCAT( crew_member_categories.crew_member_category_name
SEPARATOR "," ) AS categories
FROM `crew_members`
LEFT JOIN crew_member_categories ON crew_members.crew_member_categories LIKE CONCAT( "%", crew_member_categories.crew_member_category_id, "%" )
WHERE crew_members.crew_member_id = ' . $id . '
GROUP BY crew_members.crew_member_id'
        );
        return $result[0];
    }

    /**
     * 	Egy kolléga minden adatát lekérdezi a részletek megjelenítéséhez
     */
    public function one_crew_member_alldata_query_ajax() {
        //$id = (int)$_POST['id'];
        $id = (int) $this->request->get_params('id');

        
        $this->query->reset();
//        $this->query->debug(true);
        $result = $this->query->query_sql(
                'SELECT `crew_members`.`crew_member_id` , `crew_members`.`crew_member_first_name` , `crew_members`.`crew_member_last_name` , `crew_members`.`crew_member_categories` , `crew_members`.`crew_member_phone` , `crew_members`.`crew_member_email` , `crew_members`.`crew_member_status`, `crew_members`.`crew_member_photo`, `crew_members`.`crew_member_spoken_languages`,
GROUP_CONCAT( crew_member_categories.crew_member_category_name
SEPARATOR "," ) AS categories
FROM `crew_members`
LEFT JOIN crew_member_categories ON crew_members.crew_member_categories LIKE CONCAT( "%", crew_member_categories.crew_member_category_id, "%" )
GROUP BY crew_members.crew_member_id'
        );
       
        return $result[0];
    }

    /**
     * 	Egy kolléga minden "nyers" adatát lekérdezi
     * 	A kolléga módosításához kell (itt az id-kre van szükség, és nem a hozzájuk tartozó névre)	
     */
    public function one_crew_member_query($id) {
        $id = (int) $id;
        $this->query->reset();
        $this->query->set_table(array('crew_members'));
          $this->query->set_columns(array(
          'crew_members.crew_member_id',
          'crew_members.crew_member_name',
          'crew_members.crew_member_title',
          'crew_members.crew_member_phone', 
          'crew_members.crew_member_email',   
          'crew_members.crew_member_category', 
          'crew_members.crew_member_photo',
          'crew_members.crew_member_info',
          'crew_members.crew_member_status', 
          'crew_member_categories.crew_member_category_name'    
          ));
        $this->query->set_join('left', 'crew_member_categories', 'crew_members.crew_member_category', '=', 'crew_member_categories.crew_member_category_id');
        $this->query->set_where('crew_member_id', '=', $id);
        $result = $this->query->select();
        return $result[0];
    }
    
     /**
     * 	Egy kolléga minden "nyers" adatát lekérdezi
     * 	A kolléga módosításához kell (itt az id-kre van szükség, és nem a hozzájuk tartozó névre)	
     */
    public function crew_members_by_id($array) {
        
        
        $this->query->reset();
        $this->query->debug(false);
        $this->query->set_table(array('crew_members'));
          $this->query->set_columns(array(
          'crew_members.crew_member_id',
          'crew_members.crew_member_name',
          'crew_members.crew_member_title',
          'crew_members.crew_member_phone', 
          'crew_members.crew_member_email',   
          'crew_members.crew_member_category', 
          'crew_members.crew_member_photo',
          'crew_members.crew_member_info',
          'crew_members.crew_member_status', 
          'crew_member_categories.crew_member_category_name'    
          ));
        $this->query->set_join('left', 'crew_member_categories', 'crew_members.crew_member_category', '=', 'crew_member_categories.crew_member_category_id');
        $this->query->set_where('crew_member_id', 'in', $array);
        $result = $this->query->select();
        return $result;
    }   

    /**
     * 	A crew_members táblázathoz kérdezi le az adatokat
     * 	Itt nem kell minden adat egy munkáról
     */
    public function all_crew_member_query() {
        $this->query->reset();
        $this->query->debug(false);
          $this->query->set_table(array('crew_members'));
          $this->query->set_columns(array(
          'crew_members.crew_member_id',
          'crew_members.crew_member_name',
          'crew_members.crew_member_title',
          'crew_members.crew_member_phone', 
          'crew_members.crew_member_email',   
          'crew_members.crew_member_category', 
          'crew_members.crew_member_photo',
          'crew_members.crew_member_info',
          'crew_members.crew_member_status',    
          'crew_member_categories.crew_member_category_name'    
          ));
          $this->query->set_join('left', 'crew_member_categories', 'crew_members.crew_member_category', '=', 'crew_member_categories.crew_member_category_id');
          return $this->query->select();

    }

    /**
     * 	Lekérdezi a munkaterület típusokat a crew_members_list táblából (és az id-ket)
     * 	@param	integer	$id  (ha csak egy elemet akarunk lekérdezni
     * 	@return	array	
     */
    public function crew_member_categories_query($id = null) {
        $this->query->reset();
        $this->query->set_table(array('crew_member_categories'));
        $this->query->set_columns('*');
        if (!is_null($id)) {
            $id = (int) $id;
            $this->query->set_where('crew_member_category_id', '=', $id);
        }
        return $this->query->select();
    }

    /**
     * 	Crew member hozzáadása
     */
    public function insert_crew_member() {
        $data = $_POST;
        $error_counter = 0;
        //megnevezés ellenőrzése	
        if (empty($data['crew_member_name'])) {
            $error_counter++;
            Message::set('error', 'A kolléga neve nem lehet üres!');
        }

        if (isset($data['img_url']) && $data['img_url'] != '') {
            $data['crew_member_photo'] = $data['img_url'];
        }
        unset($data['img_url']);
       

        if ($error_counter == 0) {

            // új adatok az adatbázisba
            $this->query->reset();
//            $this->query->debug(true);
            $this->query->set_table(array('crew_members'));
            $this->query->insert($data);

            Message::set('success', 'Kolléga sikeresen hozzáadva.');
            return true;
        } else {
            // nem volt minden kötelező mező kitöltve
            return false;
        }
    }

    /**
     * 	Crew member módosítása
     *
     * 	@param integer	$id
     */
    public function update_crew_member($id) {
        $data = $_POST;
        $id = (int) $id;

        $error_counter = 0;
        //megnevezés ellenőrzése	
        if (empty($data['crew_member_name'])) {
            $error_counter++;
            Message::set('error', 'A kolléga keresztneve nem lehet üres!');
        }


        if ($error_counter == 0) {
            if (isset($data['img_url']) && $data['img_url'] != '') {
                $data['crew_member_photo'] = $data['img_url'];
                unset($data['img_url']);
            } else {
                $data['crew_member_photo'] = $data['old_img'];
                unset($data['img_url']);
            }
            unset($data['old_img']);
           

            // új adatok az adatbázisba
            $this->query->reset();
            $this->query->set_table(array('crew_members'));
            $this->query->set_where('crew_member_id', '=', $id);
            $this->query->update($data);

            Message::set('success', 'Kolléga adatai sikeresen módosítva.');
            return true;
        } else {
            // ha valamilyen hiba volt a form adataiban
            return false;
        }
    }

    /**
     * 	Kolléga (illetve munkák) törlése
     */
    public function delete_crew_member() {
        // a sikeres törlések számát tárolja
        $success_counter = 0;
        // a sikertelen törlések számát tárolja
        $fail_counter = 0;

        // Több user törlése
        if (!empty($_POST)) {
            $data_arr = $_POST;

            //eltávolítjuk a tömbből a felesleges elemeket	
            /* if(isset($data_arr['delete_crew_member'])) {
              unset($data_arr['delete_crew_member']);
              } */
            if (isset($data_arr['crew_members_length'])) {
                unset($data_arr['crew_members_length']);
            }
        } else {
            // egy user törlése (nem POST adatok alapján)
            if (!$this->request->get_params('id')) {
                throw new Exception('Nincs id-t tartalmazo parameter az url-ben (ezert nem tudunk torolni id alapjan)!');
                return false;
            }
            //berakjuk a $data_arr tömbbe a törlendő felhasználó id-jét
            $data_arr = array($this->request->get_params('id'));
        }

        // bejárjuk a $data_arr tömböt és minden elemen végrehajtjuk a törlést
        foreach ($data_arr as $value) {
            //átalakítjuk a integer-ré a kapott adatot
            $value = (int) $value;

            //felhasználó törlése	
            $this->query->reset();
            $this->query->set_table(array('crew_members'));
            //a delete() metódus integert (lehet 0 is) vagy false-ot ad vissza
            $result = $this->query->delete('crew_member_id', '=', $value);

            if ($result !== false) {
                // ha a törlési sql parancsban nincs hiba
                if ($result > 0) {
                    //sikeres törlés
                    $success_counter += $result;
                } else {
                    //sikertelen törlés
                    $fail_counter += 1;
                }
            } else {
                // ha a törlési sql parancsban hiba van
                throw new Exception('Hibas sql parancs: nem sikerult a DELETE lekerdezes az adatbazisbol!');
                return false;
            }
        }

        // üzenetek eltárolása
        if ($success_counter > 0) {
            Message::set('success', $success_counter . ' kolléga törlése sikerült.');
        }
        if ($fail_counter > 0) {
            Message::set('error', $fail_counter . ' kolléga törlése nem sikerült!');
        }

        // default visszatérési érték (akkor tér vissza false-al ha hibás az sql parancs)	
        return true;
    }

    /**
     * 	munkaterület kategória hozzáadása
     */
    public function category_insert() {
        //ha üresen küldték el a formot
        if (empty($_POST['crew_member_category_name'])) {
            Message::set('error', 'Meg kell adni a kategória nevét!');
            return false;
        }

        $data['crew_member_category_name'] = trim($_POST['crew_member_category_name']);

        // kategóriák lekérdezése (annak ellenőrzéséhez, hogy már létezik-e ilyen kategória)
        $existing_categorys = $this->crew_member_categories_query();
        // bejárjuk a kategória neveket és összehasonlítjuk az új névvel (kisbetűssé alakítjuk, hogy ne számítson a nagybetű-kisbetű eltérés)
        foreach ($existing_categorys as $value) {
            $data['crew_member_category_name'] = trim($data['crew_member_category_name']);
            if (strtolower($data['crew_member_category_name']) == strtolower($value['crew_member_category_name'])) {
                Message::set('error', 'category_already_exists');
                return false;
            }
        }


        // adatbázis lekérdezés	
        $this->query->reset();
        $this->query->set_table(array('crew_member_categories'));
        $result = $this->query->insert($data);

        // ha sikeres az insert visszatérési érték egy id
        if ($result) {
            Message::set('success', 'category_created');
            return true;
        } else {
            Message::set('error', 'unknown_error');
            return false;
        }
    }

    public function category_update($id) {
        $data['crew_member_category_name'] = trim($_POST['crew_member_category_name']);
        // régi képek elérési útjának változókhoz rendelése (ezt használjuk a régi kép törléséhez, ha új kép lett feltöltve)
        $old_category = $_POST['old_category'];
        $id = (int) $id;

        //ha módosított a kategória nevén
        if ($old_category != $data['crew_member_category_name']) {
            // kategóriák lekérdezése (annak ellenőrzéséhez, hogy már létezik-e ilyen kategória)
            $existing_categorys = $this->crew_member_categories_query();
            // bejárjuk a kategória neveket és összehasonlítjuk az új névvel (kisbetűssé alakítjuk, hogy ne számítson a nagybetű-kisbetű eltérés)
            foreach ($existing_categorys as $value) {
                if (strtolower($data['crew_member_category_name']) == strtolower($value['crew_member_category_name'])) {
                    Message::set('error', 'Ezen a néven már létezik kategória!');
                    return false;
                }
            }
        }

        // módosítjuk az adatbázisban a kategória nevét	és kép elérési utat ha kell
        $this->query->reset();
        $this->query->set_table(array('crew_member_categories'));
        $this->query->set_where('crew_member_category_id', '=', $id);
        $result = $this->query->update($data);

        // ha sikeres az insert visszatérési érték true
        if ($result) {
            // megvizsgáljuk, hogy létezik-e új feltöltött kép és a régi kép, nem a default


            Message::set('success', 'category_updated');
            return true;
        } else {
            Message::set('error', 'unknown_error');
            return false;
        }
    }

    /**
     * 	(AJAX) A crew_members tábla crew_member_status mezőjének ad értéket
     * 	siker vagy hiba esetén megy vissza az üzenet a javascriptnek 	
     *
     * 	@param	integer	$id	
     * 	@param	integer	$data (0 vagy 1)	
     * 	@return void
     */
    public function change_status_query($id, $data) {
        $this->query->reset();
        $this->query->set_table(array('crew_members'));
        $this->query->set_where('crew_member_id', '=', $id);
        $result = $this->query->update(array('crew_member_status' => $data));

        if ($result) {
            echo json_encode(array("status" => 'success'));
        } else {
            echo json_encode(array("status" => 'error'));
        }
    }

    /**
     * Crew member képének vágása és feltöltése
     * Az $this->request->get_params('id') paraméter értékétől függően feltölti a kiválasztott képet
     * upload paraméter esetén: feltölti a kiválasztott képet
     * crop paraméter esetén: megvágja a kiválasztott képet és feltölti	
     *
     */
    public function crew_member_img_upload() {
        if ($this->request->get_params('id')) {
            
            include(LIBS . "/upload_class.php");

            // Kiválasztott kép feltöltése
            if ($this->request->get_params('id') == 'upload') {

                // feltöltés helye
                $imagePath = Config::get('crew_member.upload_path');

                //képkezelő objektum létrehozása (a kép a szerveren a tmp könyvtárba kerül)	
                $handle = new Upload($_FILES['img']);

                if ($handle->uploaded) {
                    // kép paramétereinek módosítása
                    $handle->file_auto_rename = true;
                    $handle->file_safe_name = true;
                    //$handle->file_new_name_body   	 = 'lorem ipsum';
                    $handle->allowed = array('image/*');
                    $handle->image_resize = true;
                    $handle->image_x = Config::get('crew_member.width', 600);
                    $handle->image_ratio_y = true;

                    //végrehajtás: kép átmozgatása végleges helyére
                    $handle->Process($imagePath);

                    if ($handle->processed) {
                        //temp file törlése a szerverről
                        $handle->clean();

                        $response = array(
                          "status" => 'success',
                          //"url" => $handle->file_dst_name,
                          "url" => $imagePath . $handle->file_dst_name,
                          "width" => $handle->image_dst_x,
                          "height" => $handle->image_dst_y
                        );
                        return json_encode($response);
                    } else {
                        $response = array(
                          "status" => 'error',
                          "message" => $handle->error . ': Can`t upload File; no write Access'
                        );
                        return json_encode($response);
                    }
                } else {
                    $response = array(
                      "status" => 'error',
                      "message" => $handle->error . ': Can`t upload File; no write Access'
                    );
                    return json_encode($response);
                }
            }


            // Kiválasztott kép vágása és vágott kép feltöltése
            if ($this->request->get_params('id') == 'crop') {

                // a croppic js küldi ezeket a POST adatokat 	
                $imgUrl = $_POST['imgUrl'];
                // original sizes
                $imgInitW = $_POST['imgInitW'];
                $imgInitH = $_POST['imgInitH'];
                // resized sizes
                //kerekítjük az értéket, mert lebegőpotos számot is kaphatunk és ez hibát okozna a kép generálásakor
                $imgW = round($_POST['imgW']);
                $imgH = round($_POST['imgH']);
                // offsets
                // megadja, hogy mennyit kell vágni a kép felső oldalából
                $imgY1 = $_POST['imgY1'];
                // megadja, hogy mennyit kell vágni a kép bal oldalából
                $imgX1 = $_POST['imgX1'];
                // crop box
                $cropW = $_POST['cropW'];
                $cropH = $_POST['cropH'];
                // rotation angle
                //$angle = $_POST['rotation'];
                //a $right_crop megadja, hogy mennyit kell vágni a kép jobb oldalából
                $right_crop = ($imgW - $imgX1) - $cropW;
                //a $bottom_crop megadja, hogy mennyit kell vágni a kép aljából
                $bottom_crop = ($imgH - $imgY1) - $cropH;

                // feltöltés helye
                $imagePath = Config::get('crew_member.upload_path');

                //képkezelő objektum létrehozása (a feltöltött kép elérése a paraméter)	
                $handle = new Upload($imgUrl);

                // fájlneve utáni random karakterlánc
                $suffix = md5(uniqid());

                if ($handle->uploaded) {

                    // kép paramétereinek módosítása
                    //$handle->file_auto_rename 		 = true;
                    //$handle->file_safe_name 		 = true;
                    //$handle->file_name_body_add   	 = '_thumb';
                    $handle->file_new_name_body = "crew_" . $suffix;
                    //kép átméretezése
                    $handle->image_resize = true;
                    $handle->image_x = $imgW;
                    $handle->image_ratio_y = true;
                    //utána kép vágása
                    $handle->image_crop = array($imgY1, $right_crop, $bottom_crop, $imgX1);

                    //végrehajtás: kép átmozgatása végleges helyére
                    $handle->Process($imagePath);

                    if ($handle->processed) {
                        // vágatlan forrás kép törlése az upload/user_photo mappából
                        $handle->clean();

                        $response = array(
                          "status" => 'success',
                          //"url" => $handle->file_dst_name
                          "url" => $imagePath . $handle->file_dst_name
                        );
                        return json_encode($response);
                    } else {
                        $response = array(
                          "status" => 'error',
                          "message" => $handle->error . ': Can`t upload File; no write Access'
                        );
                        return json_encode($response);
                    }
                } else {
                    $response = array(
                      "status" => 'error',
                      "message" => $handle->error . ': Can`t upload File; no write Access'
                    );
                    return json_encode($response);
                }
            }
        }
    }
    
    /**
     * 	
     * 	A munkatársak számát adja vissza kategóriánkéntszámának meghatározásához kell
     */
    public function crew_members_counter_query() {
        $this->query->reset();
        $this->query->set_table(array('crew_members'));
        $this->query->set_columns('crew_member_category');
        return $this->query->select();
    } 
    
    /**
     * 	
     * 	A munkatársak számát adja vissza kategóriánkéntszámának meghatározásához kell
     */
    public function delete_category($id) {
        $this->query->reset();
        $this->query->set_table('crew_member_categories');
        return $this->query->delete('crew_member_category_id', '=', $id);
    } 

    /**
     * Ellenőrzi, hogy a jellemző törlöhető-e: van ingatlan ilyen jellemzővel
     * 
     * @param   string  $id - a jellező id-je
     * @param   string  $table - a jellemző tábla neve (pl.: ingatlan_allapot)
     * @return   boolean true ha törölhető, false, ha nem
     */
    public function is_deletable($id)
    {
        $this->query->set_table(array('crew_members'));
        $this->query->set_columns('crew_member_category');
        $this->query->set_where('crew_member_category', '=', $id);
        $result = $this->query->select();
        
        if (empty($result)) {
            return true;
        } else {
            return false;
        }
    }
    

}

?>