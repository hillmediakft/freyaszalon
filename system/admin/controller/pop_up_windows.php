<?php

class Pop_up_windows extends Admin_controller {

    function __construct() {
        parent::__construct();
        $this->loadModel('pop_up_windows_model');
        //Auth::handleLogin();
    }

    public function index() {
        $this->view = new View();
        $this->view->title = 'Felugró ablakok oldal';
        $this->view->description = 'Felugró ablakok oldal';

        $this->view->add_links(array('bootbox', 'pop_up_windows'));

        $this->view->all_pop_up_windows = $this->pop_up_windows_model->all_pop_up_windows();
        $this->view->set_layout('tpl_layout');
        $this->view->render('pop_up_windows/tpl_pop_up_windows');
    }

    /**
     * 	Felugró ablakok módosítása
     *
     */
    public function insert() {

        if ($this->request->has_post('submit_new_pop_up_window')) {
            $result = $this->pop_up_windows_model->insert_pop_up_window();

            if ($result) {
                Message::set('success', 'A felugró ablak sikeresen létrehozva!');
                Util::redirect('pop_up_windows');
            } else {
                Message::set('error', 'A felugró ablak létrehozása nem sikerült!');
                Util::redirect('pop_up_windows/insert');
            }
        }

        $this->view = new View();
        $this->view->title = 'Felugró ablak létrehozása';
        $this->view->description = 'Felugró ablak létrehozása';

        $this->view->add_links(array('bootbox', 'new_pop_up_window', 'ckeditor'));


        $this->view->set_layout('tpl_layout');
        $this->view->render('pop_up_windows/tpl_insert_pop_up_window');
    }

    /**
     * 	Felugró ablakok módosítása
     *
     */
    public function edit() {
        if (!$this->request->has_params('id')) {
            throw new Exception('Nincs "id" nevű eleme az Active::$params tombnek! (lekerdezes nem hajthato vegre id alapjan)');
            return false;
        }
        $id = (int) $this->request->get_params('id');
        if ($this->request->has_post('submit_update_pop_up_window')) {
            $result = $this->pop_up_windows_model->update_pop_up_window($id);
            if ($result) {
                Message::set('success', 'A felugró ablak sikeresen módosítva!');
                Util::redirect('pop_up_windows');
            } else {
                Message::set('error', 'A felugró ablak módosítása nem sikerült!');
                Util::redirect('pop_up_windows/edit/' . $id);
            }
        }

        $this->view = new View();
        $this->view->title = 'Felugró ablakok szerkesztése';
        $this->view->description = 'Felugró ablakok szerkesztése ';

        $this->view->add_links(array('bootbox', 'edit_pop_up_window', 'ckeditor'));

        $this->view->data_arr = $this->pop_up_windows_model->pop_up_window_data_query($id);
        $this->view->set_layout('tpl_layout');
        $this->view->render('pop_up_windows/tpl_edit_pop_up_window');
    }

    /**
     * 	pop-up window törlése
     */
    public function delete() {

        if (!$this->request->has_params('id')) {
            throw new Exception('Nincs "id" nevű eleme a $params tombnek! (a lekerdezes nem hajthato vegre)');
            return false;
        }

        $id = (int) $this->request->get_params('id');
        $result = $this->pop_up_windows_model->delete_pop_up_window($id);

        // visszatérés üzenetekkel
        if ($result) {
             Message::set('success', 'A felugró ablak sikeresen törölve!');
        } else {
            Message::set('error', 'A felugró ablak törlése nem sikerült!');
        }

        Util::redirect('pop_up_windows');
    }

}

?>