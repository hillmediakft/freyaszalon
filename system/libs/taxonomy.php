<?php

class Taxonomy extends Admin_controller {

    function __construct() {
        parent::__construct();
        $this->taxonomy_model = new Taxonomy_model();
    }

    /*
     * címkék (term) elmentése tartalom típussal és tartalom id-vel
     */

    public function insert($content_id, $terms, $content_type) {

        $this->taxonomy_model->insert($content_id, $terms, $content_type);
    }

    /*
     * címke (term) update tartalom típussal és tartalom id-vel
     */

    public function update($content_id, $terms, $content_type_id) {


        $this->taxonomy_model->deleteByContentTypeAndId($content_id, $content_type_id);
        $this->taxonomy_model->insert($content_id, $terms, $content_type_id);

    }
    
    /*
     * címke (term) update tartalom típussal és tartalom id-vel
     */

    public function delete($content_id, $content_type_id) {

        $this->taxonomy_model->deleteByContentTypeAndId($content_id, $content_type_id);

    }    

}

?>