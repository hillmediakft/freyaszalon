<?php 
class Newsletter_progress extends Controller {

	function __construct()
	{
		parent::__construct();
		$this->loadModel('newsletter_model');
	}

	public function index()
	{
	// adatok bevitele a view objektumba
		$this->view->title = 'Hírlevél küldése';
		$this->view->description = 'Hírlevél oldal description';
		
//$this->view->debug(true);	

		// template betöltése
		$this->view->render('newsletter/tpl_newsletter_progress', true);	
	}	

	
	public function progress()
	{
		header('Content-Type: text/event-stream');
		// recommended to prevent caching of event data.
		header('Cache-Control: no-cache');
			
		set_time_limit(0); 
		ob_implicit_flush(true);
phpinfo();die;
		$this->newsletter_model->send_newsletter();		
	}
}	
?>