<?php

class Promotions_model extends Model {

    /**
     * Constructor, létrehozza az adatbáziskapcsolatot
     */
    function __construct() {
        parent::__construct();
    }

    /**
     * promotion-ok adatainak lekérdezése, a promotions_order sorrend szerint
     * 	
     * @return Array (az összes promotion minden adata a "promotion_order" szerint rendezve)
     */
    public function all_promotions_query() {
        $this->query->reset();
        $this->query->set_table(array('promotions'));
        $this->query->set_columns();
        $this->query->set_orderby(array('promotion_order'));
        return $this->query->select();
    }

    /**
     * 	Egy akció adatait kérdezi le az adatbázisból id alapján
     *
     * 	@param	$id  Int (egy id szám)
     * 	@return	Array
     */
    public function one_promotion_query($id) {
        $this->query->reset();
        $this->query->set_table(array('promotions'));
        $this->query->set_columns(array('id', 'active', 'picture', 'title', 'text'));
        $this->query->set_where('id', '=', $id);
        return $this->query->select();
    }

    /**
     * Akció adatainak módosítása id alapján
     *
     * @param 	$id	Int	
     * @return 	bool
     */
    public function update_promotion($id) {
        // új kép mutatója (a false a kezdőértéke)	
        $new_picture = false;

        //ha van új kép feltöltve
        if (isset($_FILES['update_promotion_picture'])) {
            // ha a hibakód 4, akkor nem lett kijelölve feltöltendő file (vagyis nem akarunk képet módosítani)
            // ha nem 4-es a hibakód, akkor sikeres, vagy valami gond van a feltöltéssel
            if ($_FILES['update_promotion_picture']['error'] != 4) {
                $new_picture = true;

                // kép feltöltése, upload_promotions_picture() metódussal (visszatér a feltöltött kép elérési útjával, vagy false-al)
                $dest_imagePath = $this->upload_promotion_picture($_FILES['update_promotion_picture']);

                if ($dest_imagePath === false) {
                    return false;
                }
            }
        } else {
            throw new Exception('Hiba promotion kep modositasakor: Nem letezik a \$_FILES[\'update_promotion_picture\'] elem!');
            return false;
        }

        // adatok adatbázisba írása
        $data['active'] = (int) $this->request->get_post('promotion_status');

        if ($new_picture) {
            $data['picture'] = $dest_imagePath;
            // régi képek elérési útjának változókhoz rendelése (ezt használjuk a régi kép törléséhez, ha új kép lett feltöltve)
            $old_img_path = $this->request->get_post('old_img');
            // létrehozzuk a thumb kép elérési útját is (részekre bontjuk az elérési utat)
            $tmp_parts = pathinfo($old_img_path);
            $old_thumb_path = $tmp_parts['dirname'] . "/" . $tmp_parts['filename'] . "_thumb." . $tmp_parts['extension'];
            unset($tmp_parts);
        }

        $data['text'] = $this->request->get_post('promotion_text');
        $data['title'] = $this->request->get_post('promotion_title');

        // új adatok beírása az adatbázisba (update) a $data tömb tartalmazza a frissítendő adatokat 
        $this->query->reset();
        $this->query->set_table(array('promotions'));
        $this->query->set_where('id', '=', $id);
        $result = $this->query->update($data);

        // ha sikeres az adatbázisba írás
        if ($result) {
            // megvizsgáljuk, hogy létezik-e új feltöltött kép
            if ($new_picture) {
                //régi képek törlése
                if (!Util::del_file($old_img_path)) {
                     Message::log('A ' . $old_img_path . ' kép nem törlődött!');
                };
                if (!Util::del_file($old_thumb_path)) {
                   Message::log('A ' . $old_thumb_path . ' kép nem törlődött!');
                };
            }
            // sikeres adatbázisba írás és kép feltöltés esetén!!!!
            Message::set('success', 'Akció sikeresen módosítva!');
            return true;
        } elseif ($result == 0) {
            Message::set('success', 'Nem történt módosítás!');
            return true;
        } else {
            Message::set('error', 'unknown_error');
            return false;
        }
    }

    /**
     * Módosítja az promotions sorrendet a promotions táblában
     * Az Ajax hívás után az order változó $_POST['order']a következő formátumú: 
     * promotions[]=1&promotions[]=3&promotions[]=2 stb Ezt kell tömbbé alakítani a feldolgozáshoz
     * 
     * A sikeres módosításról kiírja az üzenetet, ezt az Ajax hívást indító Javascript kód fogadja
     * és szúrja be a HTML kódba (amennyiben sikeres az Ajax művelet))
     * 	
     * @return 	void
     */
    public function promotions_order() {

        $order = $_POST['order'];
        parse_str($order, $order_array);

        foreach ($order_array as $key => $recordIDValue) {

            foreach ($recordIDValue as $order => $id) {
                $order += 1;
                $this->query->reset();
                $this->query->set_table(array('promotions'));
                $this->query->set_where('id', '=', $id);
                $this->query->update(array('promotion_order' => $order));
            }
        }

        $result = '<div class="alert alert-success">A sorrend módosítva!</div>';
        echo $result;
    }

    /**
     * 	Új akció hozzáadása	
     *
     * 	@return bool
     */
    public function add_promotion() {
        if (isset($_FILES['upload_promotion_picture'])) {
            // kép feltöltése, upload_promotion_picture() metódussal (visszatér a feltöltött kép elérési útjával, vagy false-al)
            $dest_imagePath = $this->upload_promotion_picture($_FILES['upload_promotion_picture']);

            if ($dest_imagePath === false) {
                return false;
            }
        } else {
            throw new Exception('Hiba akcio kep feltoltesekor: Nem letezik a \$_FILES[\'upload_promotion_picture\'] elem!');
            return false;
        }

        //adatok bevitele az adatbázisba
        $data['active'] = (int) $_POST['promotion_status'];
        $data['promotion_order'] = ($this->promotion_highest_order_number()) + 1;
        $data['picture'] = $dest_imagePath;
        //$data['target_url'] = "";
        $data['text'] = $_POST['promotion_text'];
        $data['title'] = $_POST['promotion_title'];
        $data['created'] = date('Y-m-d');
        $data['clicks'] = 0;

        // adatbázis lekérdezés	
        $this->query->reset();
        $this->query->set_table(array('promotions'));
        $result = $this->query->insert($data);

        // ha sikeres az insert visszatérési érték true
        if ($result) {
            Message::set('success', 'Akció sikeresen létrehozva!');
            return true;
        } else {
             Message::set('error', 'Hiba történt!');
            return false;
        }
    }

    /**
     * 	promotion törlése a promotions táblából
     *
     * 	@param	$id String or Integer
     * 	@return	tru vagy false
     */
    public function delete_promotion($id) {
        // kép elérési útjának lekérdezése
        $this->query->reset();
        $this->query->set_table(array('promotions'));
        $this->query->set_columns(array('picture'));
        $this->query->set_where('id', '=', $id);
        $result = $this->query->select();

        $image_path = $result[0]['picture'];
        $tmp_parts = pathinfo($image_path);
        $image_thumb_path = $tmp_parts['dirname'] . "/" . $tmp_parts['filename'] . "_thumb." . $tmp_parts['extension'];
        unset($tmp_parts);

        // promotions törlése
        $this->query->reset();
        $this->query->set_table(array('promotions'));
        $this->query->set_where('id', '=', $id);
        $result = $this->query->delete();

        // ha sikeres a törlés 1 a vissaztérési érték
        if ($result == 1) {
            //régi képek törlése
            if (!Util::del_file($image_path)) {
                 Message::set('error', 'Hiba történt');
            };
            if (!Util::del_file($image_thumb_path)) {
                Message::set('error', 'Hiba történt');
            };

            Message::set('success', 'Akció törölve!');
            return true;
        } else {
            throw new Exception('Hiba akció torlesekor: a DELETE lekerdezes nem sikerult!');
            return false;
        }
    }

    /**
     * Meghatározott user_ide-hez feltöltött képek közül iválasztja azt a sort, amelyben a 
     * legmagasabb a sorrend értéke. 
     *
     * @param string 	$tablename	képek tábla neve
     * @param string 	$user_id	felhasználó id
     * @return int az eddigi legnagyobb sorrend szám
     */
    public function promotion_highest_order_number() {

        $this->query->reset();
        $this->query->set_table(array('promotions'));
        $this->query->set_columns('MAX(promotion_order)');
        $result = $this->query->select();

        return $result[0]['MAX(promotion_order)'];
    }

    /**
     * 	promotion képet méretezi és tölti fel a szerverre (thumb képet is)
     * 	(ez a metódus az update_promotion() és add_promotion() metódusokban hívódik meg!)
     *
     * 	@param	$files_array	Array ($_FILES['valami'])
     * 	@return	String (kép elérési útja) or false
     */
    private function upload_promotion_picture($files_array) {
        include(LIBS . "/upload_class.php");
        // feltöltés helye
        $imagePath = UPLOADS . "promotion_photo/";
        //képkezelő objektum létrehozása (a kép a szerveren a tmp könyvtárba kerül)	
        $handle = new Upload($files_array);

        //file átméretezése, vágása, végleges helyre mozgatása
        if ($handle->uploaded) {
            // kép paramétereinek módosítása
            $handle->file_auto_rename = true;
            $handle->file_safe_name = true;
            $handle->allowed = array('image/*');
            $handle->file_new_name_body = "promotion_" . rand();
            $handle->image_resize = true;
            $handle->image_x = 400;
//			$handle->image_y                 = 370;
            $handle->image_ratio_y = true;

            //képarány meghatározása a nézőképhez
            $ratio = ($handle->image_x / $handle->image_y);

            // promotion kép készítése
            $handle->Process($imagePath);
            if ($handle->processed) {
                //kép elérési útja és új neve (ezzel tér vissza a metódus, ha nincs hiba!)
                $dest_imagePath = $imagePath . $handle->file_dst_name;
            } else {
                $_SESSION["feedback_negative"][] = $handle->error;
                return false;
            }

            // Nézőkép készítése
            //nézőkép nevének megadása (kép új neve utána _thumb)	
            $handle->file_new_name_body = $handle->file_dst_name_body;
            $handle->file_name_body_add = '_thumb';

            $handle->image_resize = true;
            $handle->image_x = 200;
            $handle->image_ratio_y = true;
            //$handle->image_ratio_y           = true;

            $handle->Process($imagePath);
            if ($handle->processed) {
                //temp file törlése a szerverről
                $handle->clean();
            } else {
                $_SESSION["feedback_negative"][] = $handle->error;
                return false;
            }
        } else {
            $_SESSION["feedback_negative"][] = $handle->error;
            return false;
        }

        // ha nincs hiba visszadja a feltöltött kép elérési útját
        return $dest_imagePath;
    }

}

?>