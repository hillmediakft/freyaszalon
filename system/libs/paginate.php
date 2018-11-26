<?php

/**
 * Description of paginate
 *
 * @author vucu
 */
class Paginate {
    /*
     * To change this license header, choose License Headers in Project Properties.
     * To change this template file, choose Tools | Templates
     * and open the template in the editor.
     */

    function __construct($page_name, $limit, $model) {
        $this->page_name = $page_name;
        $this->limit = $limit;
        $this->model = $model;
        $this->registry = Registry::get_instance();
        $this->request = $this->registry->request;
        $this->index();

    }

    public function index() {
        // paginator
        // include(LIBS . '/pagine_class.php');
        // paginátor objektum létrehozása (paraméter neve, limit)
        $pagine = new Paginator($this->page_name, $this->limit);
        // adatok lekérdezése limittel
        $this->all_elements = $this->model->properties_filter_query($pagine->get_limit(), $pagine->get_offset());
        // szűrési feltételeknek megfelelő összes rekord száma
        $filter_count = $this->model->properties_filter_count_query();

        $pagine->set_total($filter_count);
        // lapozó linkek
        $this->pagine_links = $pagine->page_links($this->request->get_uri('path'));
        $this->filtered_count = $filter_count;
        $this->no_of_elements = $this->model->get_count();

    }

    public function filtered_count() {
        return $this->filtered_count;
    }

    public function pagine_links() {
        return $this->pagine_links;
    }

    public function no_of_elements() {
        return $this->no_of_elements;
    }
    
    public function get_elements() {
        return $this->all_elements;
    }    

}
