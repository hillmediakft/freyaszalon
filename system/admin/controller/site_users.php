<?php

class Site_users extends Admin_controller {

    function __construct() {
        parent::__construct();
        //Auth::handleLogin();
        $this->loadModel('site_users_model');
    }

    public function index() {
        
        $this->view = new View();

        $this->view->title = 'Regisztrált látogatók oldal';
        $this->view->description = 'Regisztrált látogatók';

        $this->view->add_links(array('select2', 'datatable', 'bootbox', 'site_users'));
        
   //     $this->view->all_site_user = $this->site_users_model->ajax_get_site_users();
                
        $this->view->set_layout('tpl_layout');
        $this->view->render('site_users/tpl_site_users');
    }

    /**
     * 	Site User törlése
     *
     */
    public function delete_user() {
        $result = $this->site_users_model->delete_user();
        Util::redirect('site-users');
    }

    /**
     * A users táblában inaktívvá tesz a felhasználót
     *
     * Megvizsgálja, hogy Ajax-e a kérés, ha igen meghívja a make_user_inactive()) metódust 
     *
     * @return void
     */
    public function make_inactive() {
        if (Util::is_ajax()) {
            if (isset($_POST["action"]) && $_POST["action"] == "make_inactive") {
                $this->site_users_model->make_user_inactive();
 
            }
        }
    }

    /**
     * A users táblában aktívvá tesz a felhasználót
     *
     * Megvizsgálja, hogy Ajax-e a kérés, ha igen meghívja a make_user_inactive()) metódust 
     *
     * @return void
     */
    public function make_active() {
        
        if (Util::is_ajax()) {
            if (isset($_POST["action"]) && $_POST["action"] == "make_active") {
                $this->site_users_model->make_user_active();

            }
        }
    }
    
    /**
     *  
     *
     * @return void
     */
    public function ajax_get_site_users() {
        
            if (Util::is_ajax()) {
            $request_data = $_REQUEST;
            $json_data = $this->site_users_model->ajax_get_site_users($request_data);

// adatok visszaküldése a javascriptnek
            $json_data = Util::convert_array_to_utf8($json_data);

            if (json_encode($json_data)) {
                echo json_encode($json_data);
            } else {
                echo json_last_error_msg();
            }
        } else {
            Util::redirect('error');
        }    

    }
   

}

?>