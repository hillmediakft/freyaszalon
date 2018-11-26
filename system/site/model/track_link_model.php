<?php

class Track_link_model extends Model {

    /**
     * Constructor, létrehozza az adatbáziskapcsolatot
     */
    function __construct() {
        parent::__construct();
    }

    /**
     * Ajánlat update
     * 	
     * @param 	int 	$id	ajánlat id-je
     * @return 	string 	üzenet
     */
    public function get_email_click_count($newsletter_id) {
        $this->query->reset();
        $this->query->set_table(array('stats_newsletters'));
        $this->query->set_columns('email_clicks');
        $this->query->set_where('statid', '=', $newsletter_id);
        return $this->query->select();
    }

    /**
     * Ajánlat update
     * 	
     * @param 	int 	$id	ajánlat id-je
     * @return 	string 	üzenet
     */
    public function increase_email_click_count($newsletter_id, $count) {

        $this->query->reset();
        $this->query->debug(false);
        $this->query->set_table(array('stats_newsletters'));
        $this->query->set_where('statid', '=', $newsletter_id);
        $result = $this->query->update(array('email_clicks' => $count));
        return;
    }

    /**
     * Ajánlat update
     * 	
     * @param 	int 	$id	ajánlat id-je
     * @return 	string 	üzenet
     */
    public function get_unique_email_clicks($newsletter_id) {

        $sth = $this->connect->query("SELECT COUNT(DISTINCT(subscriber_id)) FROM stats_emailclicks WHERE campaign_id =" . $newsletter_id);
        $result = $sth->fetch(PDO::FETCH_NUM);
        return (int) $result[0];
    }

    /**
     * Ajánlat update
     * 	
     * @param 	int 	$id	ajánlat id-je
     * @return 	string 	üzenet
     */
    public function update_unique_email_clicks($newsletter_id, $unique_clicks) {

        $this->query->reset();
        $this->query->set_table(array('stats_newsletters'));
        $this->query->set_where('statid', '=', $newsletter_id);
        $result = $this->query->update(array('unique_email_clicks' => $unique_clicks));
        return;
    }

    /**
     * Email megnyitás adatbázisba írása
     * 	
     * @param 	int 	$newsletter_id	kampány id-je
     * @param 	int 	$user_id		user id-je
     * @param 	string 	$open_time		megnyitás ideje
     * @param 	int 	$open_ip		a megnyitó user IP címe
     * @return 	void
     */
    public function insert_email_click($newsletter_id, $user_id, $click_time, $click_ip, $link_id) {
        $data['campaign_id'] = $newsletter_id;
        $data['subscriber_id'] = $user_id;
        $data['click_time'] = $click_time;
        $data['click_ip'] = $click_ip;
        $data['link_id'] = $link_id;

        $this->query->reset();
        $this->query->debug(false);
        $this->query->set_table(array('stats_emailclicks'));
        $this->query->insert($data);
        return;
    }
    
    /**
     * Ajánlat update
     * 	
     * @param 	int 	$id	ajánlat id-je
     * @return 	string 	üzenet
     */
    public function get_link_url($link_id) {

        $this->query->reset();
         $this->query->debug(false);
        $this->query->set_table(array('email_links'));
        $this->query->set_columns(array('link_url'));
        $this->query->set_where('link_id', '=', $link_id);
        $result = $this->query->select();
        if(!empty($result)) {
            return $result[0]['link_url'];
        } else {
            return '';
        }
    }    
}
?>