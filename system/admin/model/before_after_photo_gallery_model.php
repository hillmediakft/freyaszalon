<?php

class Before_after_photo_gallery_model extends Model {

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
    public function all_photos() {
        // a query tulajdonság ($this->query) tartalmazza a query objektumot
        $this->query->set_table(array('before_after_photo_gallery'));
        $this->query->set_columns('*');
        $result = $this->query->select();

        return $result;
    }

    /**
     * Fotó hozzáadása, kép feltötése és adatok mentése
     *
     * @return boolean - true ha sikeres a mentés, false ha hoba történt
     */
    public function save_photo() {
        // ******************* kép feltöltése ************************** //

        include(LIBS . "/upload_class.php");
        // feltöltés helye
        $imagePath = UPLOADS . "before_after_photo_gallery/";
        //képkezelő objektum létrehozása (a kép a szerveren a tmp könyvtárba kerül)	
        $handle = new Upload($_FILES['upload_gallery_photo']);

        if ($handle->uploaded) {

            $handle->allowed = array('image/*');

            $random_number = md5(date('Y-m-d H:i:s:u'));

            $handle->image_resize = true;
            $handle->image_ratio_y = true;
            $handle->image_x = 800;
            $handle->file_new_name_body = $random_number;

            //végrehajtás: kép átmozgatása végleges helyére
            $handle->Process($imagePath);

            $filename = $handle->file_dst_name;


            if ($handle->processed) {
                //	$_SESSION["feedback_positive"][] = FEEDBACK_NEW_PHOTO_SUCCESS;


                $handle->image_resize = true;
                $handle->image_ratio_y = true;
                $handle->image_x = 320;
                $handle->file_new_name_body = $random_number . '_thumb';

                //végrehajtás: kép átmozgatása végleges helyére
                $handle->Process($imagePath);


                $handle->clean();
            } else {
                Message::set('error', 'Nem sikerült a feltöltés! Hiba: ' . $handle->error);
                return false;
            }
        } else {
            Message::set('error', 'Nem sikerült a feltöltés! Hiba: ' . $handle->error);
            return false;
        }



        $data['photo_filename'] = UPLOADS . 'photo_gallery/' . $filename;
        $data['photo_caption'] = $_POST['photo_caption'];

        $data['photo_category'] = $_POST['photo_category'];
        if (isset($_POST['photo_slider'])) {
            $data['photo_slider'] = (int) $_POST['photo_slider'];
        } else {
            $data['photo_slider'] = 0;
        }

        $this->query->reset();
        $this->query->set_table(array('photo_gallery'));
        $result = $this->query->insert($data);

        // ha sikeres az insert visszatérési érték true
        if ($result) {
            Message::set('success', 'new_photo_success');
            return true;
        } else {
            Message::set('error', 'unknown_error');
            return false;
        }
    }

    /**
     * Kép adatainak módosítása
     *
     *
     * @param 	int $id	
     * @return 	true vagy false
     */
    public function update_photo($id) {

        $data = $this->request->get_post();

        $id = (int) $id;
        $error_counter = 0;
        if (empty($data['photo_category'])) {
            $error_counter++;
            Message::set('error', 'Válassza ki a kategóriát!');
        }

        if ($error_counter == 0) {

            if (!empty($data['img_url_1'])) {
                $data['photo_filename_1'] = $data['img_url_1'];
                $old_img_name_1 = $data['old_img_1'];
            }
/*         if (!empty($data['img_url_2'])) {
                $data['photo_filename_2'] = $data['img_url_2'];
                $old_img_name_2 = $data['old_img_2'];
            } */
            
            $data['photo_filename_2'] = '';
            unset($data['img_url_1']);
            unset($data['img_url_2']);
            unset($data['submit_edit_photo']);
            unset($data['old_img_1']);
            unset($data['old_img_2']);

           
            // új adatok az adatbázisba
            $this->query->reset();
            $this->query->set_table(array('before_after_photo_gallery'));
            $this->query->set_where('photo_id', '=', $id);
            $result = $this->query->update($data);

            if ($result >= 0) {
                // megvizsgáljuk, hogy létezik-e új feltöltött kép és a régi kép, nem a default
                if (isset($old_img_name_1)) {
                    //régi képek törlése
                    if (!Util::del_file($old_img_name_1)) {
                        Message::set('error', 'unknown_error');
                    }
                }
                if (isset($old_img_name_2)) {
                    //régi képek törlése
                    if (!Util::del_file($old_img_name_2)) {
                        Message::set('error', 'unknown_error');
                    }
                }
                Message::set('success', 'Adatok módosítva!');
                return true;
            }
        } else {
            // ha valamilyen hiba volt a form adataiban
            return false;
        }











        if ($result) {
            if ($flag) {
                unlink($old_img);
                unlink(Util::thumb_path($old_img));
            }
            Message::set('success', 'Fotó módosítása megtörtént!');
            return true;
        } else {
            Message::set('error', 'Hiba történt!');
            return false;
        }
    }

    /**
     * 	Kép törlése a photo_gallery táblából
     *
     * 	@param	$id String or Integer
     * 	@return	boolean
     */
    public function delete_photo($id) {

        $this->query->reset();
        $this->query->set_table(array('before_after_photo_gallery'));
        $this->query->set_columns(array('photo_filename_1', 'photo_filename_2'));
        $this->query->set_where('photo_id', '=', $id);
        $result = $this->query->select();

        if ($result) {
            $image_1 = $result[0]['photo_filename_1'];
            $image_2 = $result[0]['photo_filename_2'];

            $this->query->reset();
            $this->query->set_table(array('before_after_photo_gallery'));
            $this->query->set_where('photo_id', '=', $id);
            $result = $this->query->delete();

            // ha sikeres a törlés 1 a vissaztérési érték
            if ($result == 1) {
                unlink($image_1);
                unlink($image_2);
                Message::set('success', 'A kép sikeresen törölve!');
                return true;
            } else {
                Message::set('error', 'Hiba történt!');
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * 	Egy kép adatait kérdezi le az adatbázisból (photo_gallery tábla)
     *
     * 	@param	$id a kép rekordjának azonosítója
     * 	@return	az adatok tömbben
     */
    public function photo_data_query($id) {
        $this->query->reset();
        $this->query->set_table(array('before_after_photo_gallery'));
        $this->query->set_columns('*');
        $this->query->set_where('photo_id', '=', $id);

        return $this->query->select();
    }

    /**
     * 	Lekérdezi a fotó kategóriákat a photo_category táblából (és az id-ket)
     * 	@param	integer	$id  (ha csak egy elemet akarunk lekérdezni, pl.: munka kategória módosításhoz)
     * 	@return	array	
     */
    public function photo_category_query($id = null) {
        $this->query->reset();
        $this->query->set_table(array('before_after_photo_category'));
        $this->query->set_columns('*');
        if (!is_null($id)) {
            $id = (int) $id;
            $this->query->set_where('id', '=', $id);
        }
        return $this->query->select();
    }

    /**
     * 	Kép kategória hozzáadása
     */
    public function category_insert() {
        $data['category_name'] = trim($_POST['category_name']);

        // kategóriák lekérdezése (annak ellenőrzéséhez, hogy már létezik-e ilyen kategória)
        $existing_categorys = $this->photo_category_query();
        // bejárjuk a kategória neveket és összehasonlítjuk az új névvel (kisbetűssé alakítjuk, hogy ne számítson a nagybetű-kisbetű eltérés)
        foreach ($existing_categorys as $value) {
            $data['category_name'] = trim($data['category_name']);
            if (strtolower($data['category_name']) == strtolower($value['category_name'])) {
                Message::set('error', 'Már létezik ilyen kategória!');
                return false;
            }
        }

        // adatbázis lekérdezés	
        $this->query->reset();
        $this->query->set_table(array('before_after_photo_category'));
        $result = $this->query->insert($data);

        // ha sikeres az insert visszatérési érték egy id
        if ($result) {
            Message::set('success', 'A kategória sikeresen létrehozva!');
            return true;
        } else {
            Message::set('error', 'Hiba történt, próbálja újra!');
            return false;
        }
    }

    /**
     * 	fotó kategóriáka nevének módosítása 
     * 	@param	integer	$id 
     * 	@return	boolean true vagy false	
     */
    public function category_update($id) {
        $data['category_name'] = trim($this->request->get_post('category_name'));
        // régi képek elérési útjának változókhoz rendelése (ezt használjuk a régi kép törléséhez, ha új kép lett feltöltve)
        $old_category = $this->request->get_post('old_category');
        $id = (int) $id;

        //ha módosított a kategória nevén
        if ($old_category != $data['category_name']) {
            // kategóriák lekérdezése (annak ellenőrzéséhez, hogy már létezik-e ilyen kategória)
            $existing_categorys = $this->photo_category_query();
            // bejárjuk a kategória neveket és összehasonlítjuk az új névvel (kisbetűssé alakítjuk, hogy ne számítson a nagybetű-kisbetű eltérés)
            foreach ($existing_categorys as $value) {
                if (strtolower($data['category_name']) == strtolower($value['category_name'])) {
                    Message::set('error', 'Már létezik ilyen kategória!');
                    return false;
                }
            }
        }


        // módosítjuk az adatbázisban a kategória nevét	és kép elérési utat ha kell
        $this->query->reset();
        $this->query->set_table(array('before_after_photo_category'));
        $this->query->set_where('id', '=', $id);
        $result = $this->query->update($data);

        // ha sikeres az insert visszatérési érték egy id
        if ($result) {
            Message::set('success', 'A kategória sikeresen módosítva!');
            return true;
        } else {
            Message::set('error', 'Hiba történt, próbálja újra!');
            return false;
        }
    }

    /**
     * 	Lekérdezi kategóriák nevét és id-jét a photo_category táblából (az option listához)
     */
    public function photo_category_list_query() {
        $this->query->reset();
        $this->query->set_table(array('before_after_photo_category'));
        $this->query->set_columns(array('id', 'category_name'));
        $result = $this->query->select();
        return $result;
    }

    /**
     * 	Lekérdezi a kategóriában lévő fotók számát
     */
    public function get_no_of_photos_in_category($id = null) {
        $this->query->reset();
        $result = $this->query->query_sql('SELECT photo_category, COUNT(*) FROM before_after_photo_gallery GROUP BY photo_category');

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

    /**
     * 	Kép kategória törlése
     *
     * 	@param	$id String or Integer
     * 	@return	boolean
     */
    public function delete_category($id) {

        if ($this->get_no_of_photos_in_category($id) > 0) {
            Message::set('error', 'A kategória nem üres, ezért nem törölhető!');
            return;
        }
        $this->query->reset();
        $this->query->set_table(array('before_after_photo_category'));
        $this->query->set_where('id', '=', $id);
        $result = $this->query->delete();

        // ha sikeres a törlés 1 a vissaztérési érték
        if ($result == 1) {
            Message::set('success', 'Fotó kategória sikeresen törölve!');
            return true;
        } else {
            Message::set('error', 'Hiba történt, próbálja újra!');
            return false;
        }
    }

    /**
     * Crew member képének vágása és feltöltése
     * Az $this->registry->params['id'] paraméter értékétől függően feltölti a kiválasztott képet
     * upload paraméter esetén: feltölti a kiválasztott képet
     * crop paraméter esetén: megvágja a kiválasztott képet és feltölti	
     *
     */
    public function before_after_img_upload() {
        $operation_id = $this->request->get_params('id');
        if (isset($operation_id)) {

            include(LIBS . "/upload_class.php");

            // Kiválasztott kép feltöltése
            if ($operation_id == 'upload') {

                // feltöltés helye
                $imagePath = Config::get('beforeafterphoto.upload_path');

                //képkezelő objektum létrehozása (a kép a szerveren a tmp könyvtárba kerül)	
                $handle = new Upload($_FILES['img']);

                if ($handle->uploaded) {
                    // kép paramétereinek módosítása
                    $handle->file_auto_rename = true;
                    $handle->file_safe_name = true;
                    //$handle->file_new_name_body   	 = 'lorem ipsum';
                    $handle->allowed = array('image/*');
                    $handle->image_resize = true;
                    $handle->image_x = Config::get('beforeafterphoto.width', 600);
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
            if ($operation_id == 'crop') {

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
                $imagePath = Config::get('beforeafterphoto.upload_path');

                //képkezelő objektum létrehozása (a feltöltött kép elérése a paraméter)	
                $handle = new Upload($imgUrl);

                // fájlneve utáni random karakterlánc
                $suffix = md5(uniqid());

                if ($handle->uploaded) {

                    // kép paramétereinek módosítása
                    //$handle->file_auto_rename 		 = true;
                    //$handle->file_safe_name 		 = true;
                    //$handle->file_name_body_add   	 = '_thumb';
                    $handle->file_new_name_body = "beforeafter_" . $suffix;
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
     * 	Kliens hozzáadása
     */
    public function insert_photo() {
        $data = $this->request->get_post();

        $error_counter = 0;
        if (empty($data['img_url_1'])) {
            $error_counter++;
            Message::set('error', 'töltsön fel előtte képet!');
        }
 /*       if (empty($data['img_url_2'])) {
            $error_counter++;
            Message::set('error', 'töltsön fel utána képet!');
        } */

        if (isset($data['img_url_1']) && $data['img_url_1'] != '') {
            $data['photo_filename_1'] = $data['img_url_1'];
        }
        $data['photo_filename_2'] = '';
/*        if (isset($data['img_url_2']) && $data['img_url_2'] != '') {
            $data['photo_filename_2'] = $data['img_url_2'];
        } */
        unset($data['img_url_1']);
        unset($data['img_url_2']); 
        unset($data['submit_new_photo']);

        if ($error_counter == 0) {

            // új adatok az adatbázisba
            $this->query->reset();
//            $this->query->debug(true);
            $this->query->set_table(array('before_after_photo_gallery'));
            $this->query->insert($data);

            Message::set('success', 'Előtte-utána képek sikeresen hozzáadva.');
            return true;
        } else {
            // nem volt minden kötelező mező kitöltve
            return false;
        }
    }

}

?>