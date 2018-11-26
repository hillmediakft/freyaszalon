<?php

class Feliratkozas extends Site_controller {

    function __construct() {
        parent::__construct();
        $this->loadModel('feliratkozas_model');
    }

    public function index() {
        
      
        if ($this->request->has_params('user_id') && $this->request->has_params('user_activation_verification_code')) {
            $result = $this->feliratkozas_model->verifyNewUser($this->request->get_params('user_id'), $this->request->has_params('user_activation_verification_code'));
            Util::redirect('feliratkozas');
        }

        if ($this->request->has_post('register_newsletter')) {
            $this->feliratkozas_model->register_user();
            Util::redirect('feliratkozas');
        }


        $this->view = new View();

        $this->view->settings = $this->settings;
        $this->view->footer_text = $this->footer_text;
        $this->view->promotions = $this->promotions;
        $this->view->no_of_promotions = $this->no_of_promotions;
        $this->view->szolgaltatasok_menu = $this->szolgaltatasok_menu;
        $this->view->nyitva_tartas = $this->nyitva_tartas;
        $this->view->footer_nagy_atalakulasok = $this->footer_nagy_atalakulasok;
        $this->view->pop_up = $this->pop_up;
        
        // adatok bevitele a view objektumba
        $this->view->title = 'Hírlevélre feliratkozás Freya szalon';
        $this->view->description = 'Hírlevélre feliratkozás Freya szalon';
        $this->view->keywords = 'Hírlevélre feliratkozás Freya szalon';

        $this->view->set_layout('tpl_layout');
        $this->view->render('feliratkozas/tpl_feliratkozas');

        /*
          if($result) {
          Util::redirect('feliratkozas/sikeres_feliratkozas');
          } else {
          Util::redirect('register_verify/sikertelen_feliratkozas');
          }
         */
    }

    /* 	
      public function sikeres_feliratkozas()
      {
      $this->view->sidebar = $this->feliratkozas_model->get_sidebar();

      // adatok bevitele a view objektumba
      $this->view->title = 'Kapcsolat Freya Szalon';
      $this->view->description = 'Kapcsolat Freya Szalon description';

      $this->view->content = "Sikerült a feliratkozás!";

      $this->view->render('visszaigazolas/tpl_visszaigazolas');
      }

      public function sikertelen_feliratkozas()
      {
      $this->view->sidebar = $this->feliratkozas_model->get_sidebar();

      // adatok bevitele a view objektumba
      $this->view->title = 'Kapcsolat Freya Szalon';
      $this->view->description = 'Kapcsolat Freya Szalon description';

      $this->view->content = "Nem sikerült a feliratkozás!";

      $this->view->render('visszaigazolas/tpl_visszaigazolas');
      }
     */

    public function visszaigazolas() {
        if (empty($_SESSION["feedback_positive"]) && empty($_SESSION["feedback_negative"])) {
            Util::redirect('home');
        }

        $this->view->sidebar = $this->feliratkozas_model->get_sidebar();

        // adatok bevitele a view objektumba
        $this->view->title = 'Visszaigazolás Freya Szalon';
        $this->view->description = 'Visszaigazolás Freya Szalon description';

        $this->view->footer = str_replace('{$mobile}', $this->view->mobile, $this->view->footer);
        $this->view->footer = str_replace('{$address}', $this->view->address, $this->view->footer);
        $this->view->footer = str_replace('{$email}', $this->view->email, $this->view->footer);

        //$this->view->content = "Regisztrációs email elküldve!";

        $this->view->render('visszaigazolas/tpl_visszaigazolas');
    }

}

?>