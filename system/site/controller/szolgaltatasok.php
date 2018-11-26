<?php

class Szolgaltatasok extends Site_controller {

    protected $content_type_id;

    function __construct() {
        parent::__construct();
        $this->content_type_id = Config::get('content_types.szolgaltatas');
        $this->loadModel('taxonomy_model');
        $this->loadModel('blog_model');
        $this->loadModel('gyakori_kerdesek_model');
        $this->loadModel('crew_model');
    }

    public function index() {

        $this->view = new View();
        $this->view->settings = $this->settings;
        $this->view->footer_text = $this->footer_text;
        $this->view->promotions = $this->promotions;
        $this->view->no_of_promotions = $this->no_of_promotions;
        $this->view->szolgaltatasok_menu = $this->szolgaltatasok_menu;
        $this->view->nyitva_tartas = $this->nyitva_tartas;
        $this->view->footer_nagy_atalakulasok = $this->footer_nagy_atalakulasok;
        $this->view->pop_up = $this->pop_up;

        $this->view->blogs = $this->blogs;

        $this->view->data_arr = $this->szolgaltatasok_model->page_data_query('szolgaltatasok');
        $this->view->szolgaltatas_kategoriak = $this->szolgaltatasok_model->getCategories();

        $this->view->title = $this->view->data_arr['page_metatitle'];
        $this->view->description = $this->view->data_arr['page_metadescription'];
        $this->view->keywords = $this->view->data_arr['page_metakeywords'];
        $this->view->content = $this->view->data_arr['page_body'];

        $this->view->set_layout('tpl_layout');
        $this->view->render('szolgaltatasok/tpl_szolgaltatasok');
    }

    public function szolgaltatas() {

        $slug = $this->request->get_params('title');

        $this->view = new View();
        $this->view->settings = $this->settings;
        $this->view->footer_text = $this->footer_text;
        $this->view->promotions = $this->promotions;
        $this->view->no_of_promotions = $this->no_of_promotions;
        $this->view->szolgaltatasok_menu = $this->szolgaltatasok_menu;
        $this->view->nyitva_tartas = $this->nyitva_tartas;
        $this->view->call_to_action = $this->call_to_action;
        $this->view->footer_nagy_atalakulasok = $this->footer_nagy_atalakulasok;
        $this->view->pop_up = $this->pop_up;

        //      $this->view->blogs = $this->blogs;

        $this->view->szolgaltatas = $this->szolgaltatasok_model->getSzolgaltatas($slug);
        if (!$this->view->szolgaltatas) {
            $this->getPageData('error', $this->szolgaltatasok_model, $metadata = '');
            $this->view->set_layout('tpl_layout');
            $this->view->render('error/tpl_404');
            die;
        }

        if ($this->view->szolgaltatas['crew_members'] == '') {
            $this->view->munkatars = array();
        } else {
            // munkatársak
            $this->view->munkatars = $this->crew_model->crew_members_by_id(json_decode($this->view->szolgaltatas['crew_members']));
        }


        $this->view->kapcsolodo_szolgaltatasok = $this->szolgaltatasok_model->getSzolgaltatasokInCategory($this->view->szolgaltatas['szolgaltatas_category_id'], $this->view->szolgaltatas['szolgaltatas_id']);

        $related_content = new Related_content($this->view->szolgaltatas['szolgaltatas_id'], $this->content_type_id);
        $this->view->kapcsolodo_cikkek = $related_content->cikkek();
        $this->view->kapcsolodo_gyik = $related_content->gyik();
        $this->view->kapcsolodo_kepek = $related_content->kepek();


        /*       $term_ids = $this->taxonomy_model->getTermsByContentIdAndContentTypeId($this->view->szolgaltatas['szolgaltatas_id'], $this->content_type_id);
          var_dump( $term_ids);
          if ($term_ids) {
          $kapcsolodo_cikkek_id = array_unique($this->taxonomy_model->getContentIdByTermIdAndContentType($term_ids, 1));
          $this->view->kapcsolodo_cikkek = $this->blog_model->getBlogsById($kapcsolodo_cikkek_id);
          } else {
          $this->view->kapcsolodo_cikkek = array();
          }
          var_dump($this->view->kapcsolodo_cikkek);die; */

        $this->view->title = $this->view->szolgaltatas['szolgaltatas_title'] . ' | ' . $this->view->szolgaltatas['szolgaltatas_list_name'];
        $this->view->description = strip_tags($this->view->szolgaltatas['szolgaltatas_info']);
        $this->view->keywords = '';

        // Megtekintések számának növelése
        $this->szolgaltatasok_model->increase_no_of_clicks($this->view->szolgaltatas['szolgaltatas_id']);

        $this->view->add_links(array('jquery-validation', 'szolgaltatas'));

        $this->view->set_layout('tpl_layout');
        $this->view->render('szolgaltatasok/tpl_szolgaltatas');
    }

    public function szolgaltatas_kategoria() {

        $slug = $this->request->get_params('category');

        $this->view = new View();
        $this->view->settings = $this->settings;
        $this->view->footer_text = $this->footer_text;
        $this->view->promotions = $this->promotions;
        $this->view->no_of_promotions = $this->no_of_promotions;
        $this->view->szolgaltatasok_menu = $this->szolgaltatasok_menu;
        $this->view->nyitva_tartas = $this->nyitva_tartas;
        $this->view->footer_nagy_atalakulasok = $this->footer_nagy_atalakulasok;
        $this->view->pop_up = $this->pop_up;

        $szolgaltatas_kategoria = $this->szolgaltatasok_model->getSzolgaltatasCategoryIdBySlug($slug);
        $this->view->szolgaltatas_kategoria_id = $szolgaltatas_kategoria['szolgaltatas_list_id'];
        $this->view->szolgaltatas_kategoria_name = $szolgaltatas_kategoria['szolgaltatas_list_name'];
        $this->view->szolgaltatas_kategoria_desc = $szolgaltatas_kategoria['szolgaltatas_list_desc'];
        $szolgaltatas_kategoria_id = $this->szolgaltatasok_model->getSzolgaltatasCategoryIdBySlug($slug);
        $this->view->szolgaltatasok = $this->szolgaltatasok_model->getAllSzolgaltatasInCategory($this->view->szolgaltatas_kategoria_id);




        /*       $term_ids = $this->taxonomy_model->getTermsByContentIdAndContentTypeId($this->view->szolgaltatas['szolgaltatas_id'], $this->content_type_id);
          var_dump( $term_ids);
          if ($term_ids) {
          $kapcsolodo_cikkek_id = array_unique($this->taxonomy_model->getContentIdByTermIdAndContentType($term_ids, 1));
          $this->view->kapcsolodo_cikkek = $this->blog_model->getBlogsById($kapcsolodo_cikkek_id);
          } else {
          $this->view->kapcsolodo_cikkek = array();
          }
          var_dump($this->view->kapcsolodo_cikkek);die; */

        $this->view->title = $this->view->szolgaltatas_kategoria_name . ' | Freyaszalon';
        $this->view->description = $this->view->szolgaltatas_kategoria_name . ' | Freyaszalon';
        $this->view->keywords = '';



        $this->view->add_links(array('szolgaltatas_kategoria'));

        $this->view->set_layout('tpl_layout');
        $this->view->render('szolgaltatasok/tpl_szolgaltatas_kategoria');
    }

}

?>