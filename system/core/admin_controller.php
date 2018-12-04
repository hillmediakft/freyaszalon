<?php
class Admin_controller extends Controller {

    public function __construct()
    {
        parent::__construct();


        // Authentikáció minden admin oldalra, kivéve a login és a newsletter/send_newsletter_timelimit oldalt
        if( (($this->request->get_controller() == 'newsletter') && ($this->request->get_action() == 'send_newsletter_timelimit')) || ($this->request->get_controller() == 'login')
        )	
        {
			

        } else {
            Auth::handleLogin();
        }


/*
        if (($this->request->get_controller() != 'login')) {
            Auth::handleLogin();
        }
*/

    }
}
?>