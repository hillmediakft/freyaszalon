<?php

class Site_users_model extends Model {

    /**
     * 	Legyen-e email visszaigazolós regisztráció
     * 	Értéke: true vagy false
     */
    private $email_verify;

    /**
     * Constructor, létrehozza az adatbáziskapcsolatot
     */
    function __construct() {
        parent::__construct();

        //regisztráció email-es ellenőrzésének be- vagy kikapcsolása
        $this->email_verify = true;
    }

    public function all_site_user() {
        // a query tulajdonság ($this->query) tartalmazza a query objektumot
        $this->query->reset();
        $this->query->set_table(array('site_users'));
        $this->query->set_columns(array('user_id', 'user_name', 'user_email', 'user_active'));

        $result = $this->query->select();
        return $result;
    }

    public function ajax_get_site_users($request_data) {

        // ebbe a tömbbe kerülnek a csoportos műveletek üzenetei
        $messages = array();

        $user_role = Session::get('user_role_id');

        if (isset($request_data['customActionType']) && isset($request_data['customActionName'])) {

            switch ($request_data['customActionName']) {

                case 'group_delete':
                    // az id-ket tartalmazó tömböt kapja paraméterként
                    $result = $this->delete_szolgaltatas($request_data['id']);

                    if ($result['success'] > 0) {
                        $messages['success'] = $result['success'] . ' feliratkozó sikeresen törölve.';
                    }
                    if ($result['error'] > 0) {
                        $messages['error'] = $result['error'] . ' feliratkozó törlése nem sikerült, vagy nem törölhetők!';
                    }
                    break;

                case 'group_make_active':
                    $result = $this->change_status_query($request_data['id'], 1);

                    if ($result['success'] > 0) {
                        $messages['success'] = $result['success'] . ' feliratkozó státusza aktívra változott.';
                    }
                    if ($result['error'] > 0) {
                        $messages['error'] = $result['error'] . ' feliratkozó státusza nem változott meg!';
                    }
                    break;

                case 'group_make_inactive':
                    $result = $this->change_status_query($request_data['id'], 0);

                    if ($result['success'] > 0) {
                        $messages['success'] = $result['success'] . ' feliratkozó státusza inaktívra változott.';
                    }
                    if ($result['error'] > 0) {
                        $messages['error'] = $result['error'] . ' feliratkozó státusza nem változott meg!';
                    }
                    break;
            }
        }

        //összes sor számának lekérdezése
        $total_records = $this->query->count('users');

        $display_length = intval($request_data['length']);
        $display_length = ($display_length < 0) ? $total_records : $display_length;
        $display_start = intval($request_data['start']);
        $display_draw = intval($request_data['draw']);

        $this->query->reset();
        $this->query->debug(false);
        $this->query->set_table(array('site_users'));
        $this->query->set_columns('SQL_CALC_FOUND_ROWS 
			`site_users`.`user_id`,
			`site_users`.`user_name`,
                        `site_users`.`user_email`,
                        `site_users`.`user_active`'
        );
        $this->query->set_offset($display_start);
        $this->query->set_limit($display_length);


        //szűrés beállítások
        if (isset($request_data['action']) && $request_data['action'] == 'filter') {

            if (!empty($request_data['search_user_id'])) {
                $this->query->set_where('user_id', '=', (int) $request_data['search_user_id']);
            }
            if ($request_data['search_user_active'] !== '') {
                $this->query->set_where('user_active', '=', (int) $request_data['search_user_active']);
            }
            if ($request_data['search_user_name'] !== '') {
                $like_string = '%' . $request_data['search_user_name'] . '%';
                $this->query->set_where('user_name', 'LIKE', $like_string);
            }
            if ($request_data['search_user_email'] !== '') {
                $like_string = '%' . $request_data['search_user_email'] . '%';
                $this->query->set_where('user_email', 'LIKE', $like_string);
            }
        }
        //rendezés
        if (isset($request_data['order'][0]['column']) && isset($request_data['order'][0]['dir'])) {
            $num = $request_data['order'][0]['column']; //ez az oszlop száma
            $dir = $request_data['order'][0]['dir']; // asc vagy desc
            $order = $request_data['columns'][$num]['name']; // az oszlopokat az adatbázis mezői szerint kell elnevezni (a javascript datattables columnDefs beállításában)

            $this->query->set_orderby(array($order), $dir);
        }

        // lekérdezés
        $result = $this->query->select();

        // szűrés utáni visszaadott eredmények száma
        $filtered_records = $this->query->found_rows();

        // ebbe a tömbbe kerülnek az elküldendő adatok
        $data = array();
        
        
foreach ($result as $value) {
// id attribútum hozzáadása egy sorhoz 
            //$temp['DT_RowId'] = 'ez_az_id_' . $value['szolgaltatas_id'];
            // class attribútum hozzáadása egy sorhoz 
            //$temp['DT_RowClass'] = 'proba_osztaly';
            // csak a datatables 1.10.5 verzió felett
            //$temp['DT_RowAttr'] = array('data-proba' => 'ertek_proba');


            $temp['checkbox'] = '<input type="checkbox" class="checkboxes" name="user_id_' . $value['user_id'] . '" value="' . $value['user_id'] . '"/>';
            $temp['user_id'] = '#' . $value['user_id'];
            $temp['user_name'] = $value['user_name'];
            $temp['user_email'] = $value['user_email'];
            $temp['user_active'] = ($value['user_active'] == 1) ? '<span class="label label-sm label-success">Aktív</span>' : '<span class="label label-sm label-danger">Inaktív</span>';

            $temp['menu'] = '						
			<div class="actions">
				<div class="btn-group">';

            $temp['menu'] .= '<a class="btn btn-sm grey-steel" title="Műveletek" href="#" data-toggle="dropdown">
						<i class="fa fa-cogs"></i>
					</a>					
					<ul class="dropdown-menu pull-right">';

            // törlés
                $temp['menu'] .= '<li><a href="' . $this->registry->site_url . 'admin/site-users/delete_user/' . $value['user_id'] . '" id="delete_user_' . $value['user_id'] . '"> <i class="fa fa-trash"></i> Töröl</a></li>';;

            // status
            if ($value['user_active'] == 0) {
                $temp['menu'] .= '<li><a rel="' . $value['user_id'] . '" href="admin/site-users/make_active" id="make_active_' . $value['user_id'] . '" data-action="make_active"><i class="fa fa-check"></i> Aktivál</a></li>';
            } else {
                $temp['menu'] .= '<li><a rel="' . $value['user_id'] . '" href="admin/site-users/make_inactive" id="make_inactive_' . $value['user_id'] . '" data-action="make_inactive"><i class="fa fa-ban"></i> Blokkol</a></li>';
            }

            $temp['menu'] .= '</ul></div></div>';

            // adatok berakása a data tömbbe
            $data[] = $temp;
        }

        if (empty($messages)) {
            $messages = '';
        }

        $json_data = array(
            "draw" => $display_draw,
            "recordsTotal" => $total_records,
            "recordsFiltered" => $filtered_records,
            "data" => $data,
            "customActionStatus" => 'OK',
            "customActionMessage" => $messages
        );

        return $json_data;







    }

    /**
     * 	Regisztrált látogató (site user) törlése
     *
     * 	@return integer or false
     */
    public function delete_user() {
        // a sikeres törlések számát tárolja
        $success_counter = 0;
        // a sikertelen törlések számát tárolja
        $fail_counter = 0;

        // Több user törlése
        if (isset($_POST['delete_user'])) {

            $data_arr = $_POST;

            //eltávolítjuk a tömbből a felesleges elemeket	
            if (isset($data_arr['delete_user'])) {
                unset($data_arr['delete_user']);
            }
            if (isset($data_arr['users_length'])) {
                unset($data_arr['users_length']);
            }
        } else {
            // egy user törlése (nem POST adatok alapján)
            if (!$this->request->has_params('id')) {
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

            $this->query->reset();
            $this->query->set_table(array('site_users'));
            //a delete() metódus integert (lehet 0 is) vagy false-ot ad vissza
            $result = $this->query->delete('user_id', '=', $value);

            if ($result !== false) {
                // ha a törlési sql parancsban nincs hiba
                if ($result > 0) {


                    $success_counter += $result;
                } else {
                    $fail_counter += 1;
                }
                //continue;
            } else {
                // ha a törlési sql parancsban hiba van
                throw new Exception('Hibas sql parancs: nem sikerult a DELETE lekerdezes az adatbazisbol!');
                return false;
            }
        }

        // üzenetek eltárolása
        if ($success_counter > 0) {
             Message::set('success', $success_counter . ' feliratkozott törölve!');
        }
        if ($fail_counter > 0) {
             Message::set('error', $fail_counter . ' feliratkozott törlése nem sikerült');
        }

        // default visszatérési érték (akkor tér vissza false-al ha hibás az sql parancs)	
        return true;
    }

    /**
     * A $_POST-ban kapott id-jű user user_active mezőjét 0-ra állítja 
     *
     * @return false ha az update nem sikerült
     */
    public function make_user_inactive($id = null) {

        if (is_array($id)) {


            foreach ($id as $value) {
                $this->query->reset();
                $this->query->set_table(array('site_users'));
                $this->query->set_where('user_id', '=', (int) $value);
                $result = $this->query->update(array('user_active' => 0));
            }
        } else {
            $id = $_POST['id'];

            $this->query->reset();
            $this->query->set_table(array('site_users'));
            $this->query->set_where('user_id', '=', $id);
            $result = $this->query->update(array('user_active' => 0));

            if ($result) {
                $response = array(
                    "status" => 'make_inactive_success',
                    "message" => '<div class="alert alert-success">A regisztrált látogató inaktívvá tétele megtörtént!</div>'
                );
                echo json_encode($response);
            }
        }
    }

    /**
     * A $_POST-ban kapott id-jű user user_active mezőjét 1-re állítja 
     *
     * @return false ha az update nem sikerült
     */
    public function make_user_active($id = null) {

        if (is_array($id)) {
            foreach ($id as $value) {
                $this->query->reset();
                $this->query->set_table(array('site_users'));
                $this->query->set_where('user_id', '=', (int) $value);
                $result = $this->query->update(array('user_active' => 1));
            }
        } else {
            $id = $_POST['id'];

            $this->query->reset();
            $this->query->set_table(array('site_users'));
            $this->query->set_where('user_id', '=', $id);
            $result = $this->query->update(array('user_active' => 1));

            if ($result) {
                $response = array(
                    "status" => 'make_active_success',
                    "message" => '<div class="alert alert-success">A regisztrált látogató aktiválása megtörtént!</div>'
                );
                echo json_encode($response);
            } else {
                $response = array(
                    "status" => 'error',
                    "message" => 'Hiba történt, próbálja újra!'
                );
                echo json_encode($response);
            }
        }
    }

}

// end class
?>