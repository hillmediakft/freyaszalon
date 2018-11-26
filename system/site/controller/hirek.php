<?php

class Hirek extends Site_controller {

    protected $content_type_id;

    function __construct() {
        parent::__construct();
        $this->content_type_id = Config::get('content_types.blog');
        $this->loadModel('blog_model');
        $this->blogs_per_page = 2;
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
        
        $this->view->blog_categories = $this->blog_model->get_blog_categories();

        $pagine = new Paginator('oldal', $this->blogs_per_page);
        // adatok lekérdezése limittel
        $this->view->blog_list = $this->blog_model->blog_pagination_query($pagine->get_limit(), $pagine->get_offset());

        // szűrési feltételeknek megfelelő összes rekord száma
        $blog_count = $this->blog_model->blog_pagination_count_query();

        $pagine->set_total($blog_count);
        $language_code = '';
        // lapozó linkek
        $this->view->pagine_links = $pagine->page_links('hirek/' . $this->registry->uri_path);

        $this->view->data_arr = $this->blog_model->page_data_query('blog');
        $this->view->title = $this->view->data_arr['page_metatitle'];
        $this->view->description = $this->view->data_arr['page_metadescription'];
        $this->view->keywords = $this->view->data_arr['page_metakeywords'];
        $this->view->content = $this->view->data_arr['page_body'];
        $this->view->add_links(array('blog'));


// $this->view->debug(true);
        $this->view->set_layout('tpl_layout');
        $this->view->render('blog/tpl_blog');
    }

    public function kategoria() {

        $category_id = (int) $this->request->get_params('id');

        $this->view = new View();
        $category_data = $this->blog_model->blog_category_query($category_id);
        $this->view->category_name = $category_data['category_name'];
        $this->view->settings = $this->settings;
        $this->view->footer_text = $this->footer_text;
        $this->view->promotions = $this->promotions;
        $this->view->no_of_promotions = $this->no_of_promotions;
        $this->view->szolgaltatasok_menu = $this->szolgaltatasok_menu;
        $this->view->nyitva_tartas = $this->nyitva_tartas;
        
        $this->view->blog_categories = $this->blog_model->get_blog_categories();

        $pagine = new Paginator('oldal', $this->blogs_per_page);
        // adatok lekérdezése limittel
        $this->view->blog_list = $this->blog_model->blog_query_by_category_pagination($category_id, $pagine->get_limit(), $pagine->get_offset());

        // szűrési feltételeknek megfelelő összes rekord száma
        $blog_count = $this->blog_model->blog_pagination_count_query();

        $pagine->set_total($blog_count);
        $language_code = '';
        // lapozó linkek
        $this->view->pagine_links = $pagine->page_links('hirek/kategoria' . $this->registry->uri_path);
        $this->view->title = $this->view->category_name;
        $this->view->description = $this->view->category_name;
        $this->view->keywords = 'blog: ' . $this->view->category_name;
        $this->view->add_links(array('blog'));


// $this->view->debug(true);
        $this->view->set_layout('tpl_layout');
        $this->view->render('blog/tpl_blog_category');
    }

    /**
     * Egy hír megjelenítése
     *
     * @param string $title 
     * @param integer $id 
     */
    public function reszletek() {

        $id = (int) $this->request->get_params('id');
        $this->view = new View();

        $this->view->settings = $this->settings;
        $this->view->footer_text = $this->footer_text;
        $this->view->promotions = $this->promotions;
        $this->view->no_of_promotions = $this->no_of_promotions;
        $this->view->szolgaltatasok_menu = $this->szolgaltatasok_menu;
        $this->view->nyitva_tartas = $this->nyitva_tartas;
        
        $this->view->blog_categories = $this->blog_model->get_blog_categories();

        $content = $this->blog_model->blog_query($id);

        if (empty($content)) {

            $this->getPageData('error', $this->blog_model, $metadata = '');
            $this->view->set_layout('tpl_layout');
            $this->view->render('error/tpl_404');
            die;
        }
        $metadata = array(
            'title' => $content[0]['blog_title'],
            'description' => $content[0]['blog_title'],
            'keywords' => $content[0]['blog_title']
        );
        $this->getPageData('', $this->blog_model, $metadata);

        $this->view->blog = $content[0];
        $related_content = new Related_content($content[0]['blog_id'], $this->content_type_id);
        $this->view->kapcsolodo_szolgaltatasok = $related_content->szolgaltatasok();


        $this->view->set_layout('tpl_layout');
        $this->view->render('blog/tpl_show_blog');
    }

}

?>