<?php

class Kereses_model extends Site_model {

    /**
     * Constructor, létrehozza az adatbáziskapcsolatot
     */
    function __construct() {
        parent::__construct();
    }

    /**
     * 	Kersési kulcsszó alapján keresés
     *
     */
    public function search() {
        $request = $this->registry->request;

        $arg = Util::clean_input($request->get_query('search'));

        // keresésé az oldalak között
        $this->query->reset();
        $this->query->debug(false);
        $this->query->set_table(array('pages'));
        $this->query->set_columns('page_friendlyurl, page_metatitle');
        $this->query->set_where('page_tags', 'LIKE', '%' . urldecode($arg) . '%');
        $this->query->set_orderby(array('page_friendlyurl'), 'DESC');

        $result = $this->query->select(); 

        $pages_results_list = $this->generate_pages_results($result, 'page_metatitle');

        
        $result_list = $pages_results_list;
  //      $result_list = array_merge($blog_results_list, $pages_results_list );
        return array($result_list, $arg);
    }
    
   /**
     * 	Kersési kulcsszó alapján keresés
     *
     */
    public function generate_pages_results($result, $title_lang) {
        $list = array();
        foreach($result as $value) {
            $list[] = array(
                'title' => $value[$title_lang],
                'link' => BASE_URL . $value['page_friendlyurl']
                );
         
        }

        return $list;
    }     

}
?>

