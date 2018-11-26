<?php

class Datatables extends Admin_controller {

    function __construct()
    {
        parent::__construct();
        $this->loadModel('datatables_model');
    }

    public function index()
    {
        /*
        $this->view = new View();

        $this->view->title = 'Jellemzők oldal';
        $this->view->description = 'Jellemzők oldal description';

        $this->view->add_links(array('datatable', 'bootbox'));

        $this->view->set_layout('tpl_layout');
        $this->view->render('datatables/tpl_datatables');
        */
    }

    /**
     * Ingatlan állapot
     *
     * @return void
     */
    public function ingatlan_allapot()
    {
        $this->view = new View();    

        $this->view->title = 'Állapot oldal';
        $this->view->description = 'Állapot oldal description';

        $this->view->add_links(array('datatable', 'bootbox', 'allapot'));

        $this->view->allapot = $this->datatables_model->get_jellemzo_list('ingatlan_allapot');

        $this->view->set_layout('tpl_layout');  
        $this->view->render('datatables/tpl_allapot');
    }
    
    
    /**
     * Ingatlan kategoria
     *
     * @return void
     */
    public function ingatlan_kategoria()
    {
        $this->view = new View();

        $this->view->title = 'kategória oldal';
        $this->view->description = 'Kategória oldal description';

        $this->view->add_links(array('datatable', 'bootbox', 'kategoria'));

        $this->view->kategoria = $this->datatables_model->get_jellemzo_list('ingatlan_kategoria');

        $this->view->set_layout('tpl_layout');
        $this->view->render('datatables/tpl_kategoria');
    }
    
    /**
     * Ingatlan fűtés
     *
     * @return void
     */
    public function ingatlan_futes()
    {
        $this->view = new View();

        $this->view->title = 'Fűtés oldal';
        $this->view->description = 'Fűtés oldal description';

        $this->view->add_links(array('datatable', 'bootbox', 'futes'));

        $this->view->futes = $this->datatables_model->get_jellemzo_list('ingatlan_futes');

        $this->view->set_layout('tpl_layout');
        $this->view->render('datatables/tpl_futes');
    } 
    
    /**
     * Ingatlan energetikai besorolás
     *
     * @return void
     */
    public function ingatlan_energetika()
    {
        $this->view = new View();

        $this->view->title = 'Energetika oldal';
        $this->view->description = 'Energetika oldal description';

        $this->view->add_links(array('datatable', 'bootbox', 'energetika'));

        $this->view->energetika = $this->datatables_model->get_jellemzo_list('ingatlan_energetika');

        $this->view->set_layout('tpl_layout');
        $this->view->render('datatables/tpl_energetika');
    } 
    
    /**
     * Ingatlan kert kategória
     *
     * @return void
     */
    public function ingatlan_kert()
    {
        $this->view = new View();
        
        $this->view->title = 'Kert oldal';
        $this->view->description = 'Kert description';

        $this->view->add_links(array('datatable', 'bootbox', 'kert'));

        $this->view->kert = $this->datatables_model->get_jellemzo_list('ingatlan_kert');

        $this->view->set_layout('tpl_layout');
        $this->view->render('datatables/tpl_kert');
    }      

    /**
     * Ingatlan kilátás kategória
     *
     * @return void
     */
    public function ingatlan_kilatas()
    {
        $this->view = new View();

        $this->view->title = 'Kilátás oldal';
        $this->view->description = 'Kilátás description';

        $this->view->add_links(array('datatable', 'bootbox', 'kilatas'));
 
        $this->view->kilatas = $this->datatables_model->get_jellemzo_list('ingatlan_kilatas');

        $this->view->set_layout('tpl_layout');
        $this->view->render('datatables/tpl_kilatas');
    }    
    
    /**
     * Ingatlan parkolás kategória
     *
     * @return void
     */
    public function ingatlan_parkolas()
    {
        $this->view = new View();

        $this->view->title = 'Parkolás oldal';
        $this->view->description = 'Parkolás description';

        $this->view->add_links(array('datatable', 'bootbox', 'parkolas'));

        $this->view->parkolas = $this->datatables_model->get_jellemzo_list('ingatlan_parkolas');

        $this->view->set_layout('tpl_layout');
        $this->view->render('datatables/tpl_parkolas');
    }
    
    /**
     * Ingatlan szerkezet kategória
     *
     * @return void
     */
    public function ingatlan_szerkezet()
    {
        $this->view = new View();

        $this->view->title = 'Szerkezet oldal';
        $this->view->description = 'Szerkezet description';

        $this->view->add_links(array('datatable', 'bootbox', 'szerkezet'));

        $this->view->szerkezet = $this->datatables_model->get_jellemzo_list('ingatlan_szerkezet');

        $this->view->set_layout('tpl_layout');
        $this->view->render('datatables/tpl_szerkezet');
    }    
    

    /**
     * 	Jellemző törlése törlése Ajax-szal
     */
    public function ajax_delete()
    {
        if ($this->request->is_ajax()) {
            
            if ($this->request->has_post('action') && $this->request->get_post('action') == 'delete') {
                
                $id = $this->request->get_post('id', 'integer');
                $table = $this->request->get_post('table');
                $id_name = $this->request->get_post('id_name');

                $result = $this->datatables_model->delete($id, $table, $id_name);
                if ($result == true) {
                    echo json_encode(array("status" => 'success', "message" => 'A törlés megtörtént!'));
                } else {
                    echo json_encode(array("status" => 'error', "message" => 'Nem törölhető, mivel létezik ingatlan ezzel a jellemzővel!'));
                }
            }
        }
    }
    
    /**
     * 	Jellemző update Ajax-szal
     */
    public function ajax_update_insert()
    {
        if ($this->request->is_ajax()) {

            if ($this->request->has_post('action') && $this->request->get_post('action') == 'update_insert') {
                
                $id = $this->request->get_post('id', 'integer');
                $table = $this->request->get_post('table');
                $id_name = $this->request->get_post('id_name');
                $leiras_name = $this->request->get_post('leiras_name');
                $data = $this->request->get_post('data');

                $result = $this->datatables_model->update_insert($id, $table, $id_name, $leiras_name, $data);
                if ($result !== false) {
                    echo json_encode(array("status" => 'success', "message" => 'A művelet sikeresen végrehajtva!', 'last_insert_id' => $result));
                } else {
                    echo json_encode(array("status" => 'error', "message" => 'Hiba történt!'));
                }
            }
        }
    }    

}
?>