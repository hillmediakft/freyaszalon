<?php

class Leiratkozas_model extends Model {

    /**
     * Constructor, létrehozza az adatbáziskapcsolatot
     */
    function __construct() {
        parent::__construct();
    }

    public function leiratkozas($user_id, $unsubscribe_code, $newsletter_id) {
        // lekérdezzük, hogy helyes-e a user_id és a unsubscribe_code (tehát van-e ilyen aktív user)
        $this->query->reset();
        $this->query->set_table(array('site_users'));
        $this->query->set_columns('user_id');
        $this->query->set_where('user_id', '=', $user_id, 'and');
        $this->query->set_where('user_active', '=', 1, 'and');
        $this->query->set_where('user_unsubscribe_code', '=', $unsubscribe_code);
        $result = $this->query->select();

        //ha a találatok száma 1, akkor töröljük az adott user_id-jű rekordot
        if (count($result) == 1) {
            //töröljük az adatbázisból
            $delete_user = $result[0]['user_id'];

            $this->query->reset();
            $this->query->set_table(array('site_users'));
            $this->query->set_where('user_id', '=', $delete_user);
            $result = $this->query->delete();

            if (count($result == 1)) {

                $this->increase_unsubscribe_count($newsletter_id);
                //pozitív üzenet
                Message::set('success', 'Sikeresen leiratkozott a hírlevelünkről.');
            } else {
                //negatív üzenet
                Message::set('error', 'A leiratkozás nem sikerült! Lépjen kapcsolatba a webmesterrel!');
            }
        } else {
            //HIBA: 0 vagy több találat - nem torolheto az adatbazisbol;
            Message::set('error', 'Sikertelen leiratkozás! Lépjen kapcsolatba a webmesterrel!');
        }
    }

    public function increase_unsubscribe_count($newsletter_id) {

        $unsubscribe_count = $this->get_email_unsubscribe_count($newsletter_id);
        $count = $unsubscribe_count[0]['unsubscribe_count'];

        $this->query->reset();
        $this->query->set_table(array('stats_newsletters'));
        $this->query->set_where('statid', '=', $newsletter_id);
        $result = $this->query->update(array('unsubscribe_count' => $count + 1));
        return;
    }

    /**
     * Az adott hírlevél kampányhoz tartozó leirakkozások száma
     * 	
     * @param 	int 	$newsletter_id	a hírlevélküldés id-je
     * @return 	int 	az eddigi leiratkozások száma
     */
    public function get_email_unsubscribe_count($newsletter_id) {
        $this->query->reset();
        $this->query->set_table(array('stats_newsletters'));
        $this->query->set_columns('unsubscribe_count');
        $this->query->set_where('statid', '=', $newsletter_id);
        return $this->query->select();
    }

}

?>