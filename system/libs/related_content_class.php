<?php

class Related_content extends Site_controller {

    protected $content_types;

    function __construct($content_id, $content_type_id) {
        parent::__construct();
        $this->content_id = $content_id;
        $this->content_type_id = $content_type_id;
        $this->content_types = Config::get('content_types');
        $this->loadModel('taxonomy_model');
        $this->term_ids = $this->taxonomy_model->getTermsByContentIdAndContentTypeId($this->content_id, $this->content_type_id);

    }

    public function cikkek() {
        
        $this->loadModel('blog_model');
        
        if ($this->term_ids) {
            $kapcsolodo_cikkek_id = array_unique($this->taxonomy_model->getContentIdByTermIdAndContentType($this->term_ids, $this->content_types['blog']));
            return $kapcsolodo_cikkek = $this->blog_model->getBlogsById($kapcsolodo_cikkek_id);
        } else {
            return $kapcsolodo_cikkek = array();
        }
    }

    public function szolgaltatasok() {

        $this->loadModel('szolgaltatasok_model');

        if ($this->term_ids) {
            $kapcsolodo_szolgaltatasok_id = array_unique($this->taxonomy_model->getContentIdByTermIdAndContentType($this->term_ids, $this->content_types['szolgaltatas']));
            return $kapcsolodo_szolgaltatasok = $this->szolgaltatasok_model->getSzolgaltatasokById($kapcsolodo_szolgaltatasok_id);
        } else {
            return $kapcsolodo_szolgaltatasok = array();
        }
    }
    
    public function gyik() {

        $this->loadModel('gyakori_kerdesek_model');

        if ($this->term_ids) {
            $kapcsolodo_gyik_id = array_unique($this->taxonomy_model->getContentIdByTermIdAndContentType($this->term_ids, $this->content_types['gyik']));
            return $kapcsolodo_gyik = $this->gyakori_kerdesek_model->getGyikById($kapcsolodo_gyik_id);
        } else {
            return $kapcsolodo_gyik = array();
        }
    }   
    
    public function kepek() {
        
        $this->loadModel('galeria_model');
        
        if ($this->term_ids) {
            $kapcsolodo_kepek_id = array_unique($this->taxonomy_model->getContentIdByTermIdAndContentType($this->term_ids, $this->content_types['kep']));
            return $kapcsolodo_kepek = $this->galeria_model->getImagesById($kapcsolodo_kepek_id);
        } else {
            return $kapcsolodo_cikkek = array();
        }
    }    

}

?>