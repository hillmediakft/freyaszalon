<?php

class Track_open extends Controller {

    /**
     * Constructor, létrehozza az adatbáziskapcsolatot
     */
    function __construct() {
        parent::__construct();
        $this->loadModel('track_open_model');
    }

    /**
     * 	Megnyitáskor 
     * 	
     *
     * 	@param 
     */
    public function index() {

        $newsletter_id = $this->request->get_params('newsletter_id');
        $user_id = $this->request->get_params('user_id');
        $open_time = time();
        $open_ip = $this->get_ip();

        $this->track_open_model->insert_email_open($newsletter_id, $user_id, $open_time, $open_ip);

        $email_open_count = $this->track_open_model->get_email_open_count($newsletter_id);
        $count = $email_open_count[0]['email_opens'];
        $this->track_open_model->increase_email_open_count($newsletter_id, $count + 1);

        $unique_opens = $this->track_open_model->get_unique_email_opens($newsletter_id, $user_id);


        $this->track_open_model->update_unique_email_opens($newsletter_id, $unique_opens);

        $this->display_image();
    }

    /**
     * get client ip
     * @return Visitor ip.
     */
    public function get_ip() {
        if ($_SERVER) {
            if (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
                return $_SERVER["HTTP_X_FORWARDED_FOR"];
            } else if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
                return $_SERVER["HTTP_CLIENT_IP"];
            } else if ($_SERVER["REMOTE_ADDR"]) {
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

    /*
     * Pixel kép küldése
     * Gmail proxy-n keresztül tölti le a képet, azéer localhoston nem működik a kép letöltés
     */

    public function display_image() {


        //kép küldése az e-mail kliensnek
        $graphic_http = 'public/site_assets/images/blank.gif';

        //Get the filesize of the image for headers
        $filesize = filesize($graphic_http);


        //Now actually output the image requested (intentionally disregarding if the database was affected)
        header('Pragma: public');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Cache-Control: private', false);
        header('Content-Disposition: attachment; filename="blank.gif"');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . $filesize);
        readfile($graphic_http);

        exit();
    }

}

?>