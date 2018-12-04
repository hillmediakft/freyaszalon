<?php
class References extends Admin_controller {

	function __construct()
	{
		parent::__construct();
		$this->loadModel('references_model');
	}

	public function index()
	{
/*		Auth::handleLogin();

		if (!Acl::create()->userHasAccess('home_menu')) {
		exit('nincs hozzáférése');
		}

*/
		// adatok bevitele a view objektumba
		$this->view->title = 'referenciák oldal';
		$this->view->description = 'Referenciák oldal description';
		
		$this->view->js_link[] = $this->make_link('js', ADMIN_ASSETS, 'plugins/bootbox/bootbox.min.js');
		$this->view->js_link[] = $this->make_link('js', ADMIN_JS, 'pages/references.js');
		
		$this->view->all_reference = $this->references_model->all_references();	
		
		$this->view->render('references/tpl_references');
	}
	
	
	/**
	 * A referencesek sorrendjének módosításakor meghívott action (references/order)
	 *
	 * Megvizsgálja, hogy a kérés xmlhttprequest volt-e (Ajax), ha igen meghívja a references_order() metódust 
	 *
	 * @return void
	 */
	public function new_reference()
	{
	
		if(isset($_POST['submit_new_reference'])) {
			$result = $this->references_model->new_reference();
			if($result){
				Util::redirect('references');
			}
			else{
				Util::redirect('references/new_refrence');
			}
		}
			
		// adatok bevitele a view objektumba
		$this->view->title = 'Új references oldal';
		$this->view->description = 'Új references oldal description';
		
		$this->view->js_link[] = $this->make_link('js', ADMIN_ASSETS, 'plugins/bootbox/bootbox.min.js');
		$this->view->js_link[] = $this->make_link('js', ADMIN_JS, 'pages/new_reference.js');
		
		
	
//		$this->view->references = $this->references_model->get_references_data();	
		
		$this->view->render('references/tpl_new_reference');	
		
	}
	
	/**
	 *	Rólunk mondták elemek módosítása
	 *
	 */
	public function edit()
	{
		$id = $this->registry->params;


		if(isset($_POST['submit_update_reference'])) {
			
			$result = $this->references_model->update_reference($id);
			if($result){
				Util::redirect('references');
			}
			else{
				Util::redirect('references/new_refrence');
			}
		}
		
		// adatok bevitele a view objektumba
		$this->view->title = 'Rólunk mondták szerkesztése';
		$this->view->description = 'Rólunk mondták szerkesztése description';
		
		$this->view->js_link[] = $this->make_link('js', ADMIN_ASSETS, 'plugins/bootbox/bootbox.min.js');
		$this->view->js_link[] = $this->make_link('js', ADMIN_JS, 'pages/edit_reference.js');
		
		// visszadja a szerkesztendő oldal adatait egy tömbben (page_id, page_title ... stb.)
		$this->view->data_arr = $this->references_model->reference_data_query($id);
		
		$this->view->render('references/tpl_edit_reference');
	
	}
	
	
	/**
	 *	Rólunk mondták elem törlése
	 *
	 */
	public function delete()
	{
		$id = $this->registry->params;
		
		$result = $this->references_model->delete_reference($id);
			
		Util::redirect('references');

	
	}

			
	
}
?>