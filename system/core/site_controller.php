<?php

class Site_controller extends Controller {

    public function __construct() {
        parent::__construct();

        // settings betöltése
        $this->loadModel('settings_model');
        $this->settings = $this->settings_model->get_settings();
        
        if (!$this->request->is_ajax()) {

            // blog bejegyzések betöltése
            $this->loadModel('blogs_model');
            $this->blogs = $this->blogs_model->getBlogs(3);

            // szolgáltatások betöltése menü generálásához
            $this->loadModel('szolgaltatasok_model');
            $this->szolgaltatas_categories = $this->szolgaltatasok_model->getCategories();
            foreach ($this->szolgaltatas_categories as $value) {
                $menu[$value['szolgaltatas_list_name']] = $this->szolgaltatasok_model->getSzolgaltatasokByCategory($value['szolgaltatas_list_id']);
            }

            //      var_dump(Util::sort_array_by_field($this->szolgaltatasok_model->getSzolgaltatasok(), 'szolgaltatas_list_name'));die;
            $this->szolgaltatasok_menu = $menu;


            // blog bejegyzések betöltése
            $this->loadModel('akciok_ujdonsagok_model');
            $this->promotions = $this->akciok_ujdonsagok_model->get_promotions();
            $this->no_of_promotions = count($this->promotions);
            
                        // footerbe sikertörténetek betöltése
            $this->loadModel('galeria_model');
            $this->footer_nagy_atalakulasok = $this->galeria_model->get_all_before_after_photo(2);


            // tartalmi elemek betöltése
            $this->loadModel('content_model');
            $content_names = $this->content_model->getContentNames();
            foreach($content_names as $value) {
            $this->$value['content_name'] = $this->content_model->getContent($value['content_name']);

              /*  
                $this->footer_text = $this->content_model->getContent('footer_text');
            $this->home_block_1 = $this->content_model->getContent('home_block_1');
            $this->home_block_2 = $this->content_model->getContent('home_block_2');
            $this->home_block_3 = $this->content_model->getContent('home_block_3');
            $this->home_csapatunk_szoveg = $this->content_model->getContent('home_crew');
            $this->home_szolgaltatasok_szoveg = $this->content_model->getContent('home_szolgaltatasok');
            $this->nyitva_tartas = $this->content_model->getContent('nyitva_tartas'); */
                
            }
            
	
              if($this->settings['pop_up']) {
              $this->loadModel('pop_up_model');

              $pop_up_window = $this->pop_up_model->get_pop_up_window();
              if(!empty($pop_up_window)) {
              $this->pop_up = $pop_up_window;
              } else {
              $this->pop_up = false;
              }
              }


// var_dump($this->settings);
// var_dump($this->blogs);
// die();
        }

        // kedvencek lekérdezése
        //      $this->get_kedvencek();
        //$this->site_model = new Site_model();
        //$this->blogs = $this->site_model->getBlogs(3);
    }

    /**
     * 	
     */
    public function get_kedvencek() {
        $kedvencek = new Kedvencek_controller();
        $this->kedvencek_list = $kedvencek->get_favourite_properties();
    }

    /**
     * 	
     */
    public function getPageData($page_name, $model, $metadata = array()) {

        if (!empty($page_name) && empty($metadata)) {
            $data_arr = $model->page_data_query($page_name);
            $this->view->title = $data_arr['page_metatitle'];
            $this->view->description = $data_arr['page_metadescription'];
            $this->view->keywords = $data_arr['page_metakeywords'];
            $this->view->content = $data_arr['page_body'];
        } else {
            $this->view->title = $metadata['title'];
            $this->view->description = $metadata['description'];
            $this->view->keywords = $metadata['keywords'];
        }
    }

}

?>