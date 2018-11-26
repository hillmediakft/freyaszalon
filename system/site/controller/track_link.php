<?php

class Track_link extends Controller {

    /**
     * Constructor, létrehozza az adatbáziskapcsolatot
     */
    function __construct() {
        parent::__construct();
        $this->loadModel('track_link_model');
    }

    /**
     * 	Megnyitáskor 
     * 	
     *
     * 	@param 
     */
    public function index() {
        if (isset($_GET['n'])) {
            $newsletter_id = (int) $_GET['n'];
        } else {
            exit();
        }
        if (isset($_GET['u'])) {
            $user_id = (int) $_GET['u'];
        } else {
            exit();
        }
        if (isset($_GET['link'])) {
            $link_id = (int) $_GET['link'];
        } else {
            exit();
        }

        $click_time = time();
        $click_ip = $this->get_ip();

        $this->track_link_model->insert_email_click($newsletter_id, $user_id, $click_time, $click_ip, $link_id);

        $email_click_count = $this->track_link_model->get_email_click_count($newsletter_id);
		
		if(empty($email_click_count)) {
			Util::redirect('error');
		}

        $count = $email_click_count[0]['email_clicks'];
        $this->track_link_model->increase_email_click_count($newsletter_id, $count + 1);

        $unique_clicks = $this->track_link_model->get_unique_email_clicks($newsletter_id, $user_id);


        $this->track_link_model->update_unique_email_clicks($newsletter_id, $unique_clicks);

        $link_url = $this->track_link_model->get_link_url($link_id);
        
        $link_url = substr($link_url, strlen(BASE_URL));

        Util::redirect($link_url, '302', true);
        exit();
    }

    /**
     * get client ip
     * @return Visitor ip.
     */
    public function get_ip() {


        if ($_SERVER) {
            if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
                return $_SERVER["HTTP_X_FORWARDED_FOR"];
            } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
                return $_SERVER["HTTP_CLIENT_IP"];
            } else if (isset($_SERVER["REMOTE_ADDR"])) {
                return $_SERVER["REMOTE_ADDR"];
            } else {
                return 'Error';
            }
        } else {
            if (getenv('HTTP_X_FORWARDED_FOR')) {
                return getenv('HTTP_X_FORWARDED_FOR');
            } else if (getenv('HTTP_CLIENT_IP')) {
                return getenv('HTTP_CLIENT_IP');
            } else if (getenv('REMOTE_ADDR')) {
                return getenv('REMOTE_ADDR');
            } else {
                return 'Error';
            }
        }
    }

}

?>