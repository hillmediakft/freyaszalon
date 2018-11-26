<?php

class Crew_model extends Site_model {

    /**
     * 	Egy kolléga minden "nyers" adatát lekérdezi
     * 	A kolléga módosításához kell (itt az id-kre van szükség, és nem a hozzájuk tartozó névre)	
     */
    public function get_crew_member($id) {
        $id = (int) $id;
        $this->query->reset();
        $this->query->set_table(array('crew_members'));
        $this->query->set_columns(array(
            'crew_members.crew_member_id',
            'crew_members.crew_member_name',
            'crew_members.crew_member_title',
            'crew_members.crew_member_phone',
            'crew_members.crew_member_email',
            'crew_members.crew_member_category',
            'crew_members.crew_member_photo',
            'crew_members.crew_member_info',
            'crew_members.crew_member_status',
            'crew_member_categories.crew_member_category_name'
        ));
        $this->query->set_join('left', 'crew_member_categories', 'crew_members.crew_member_category', '=', 'crew_member_categories.crew_member_category_id');
        $this->query->set_where('crew_member_id', '=', $id);
        $result = $this->query->select();
        return $result[0];
    }

    /**
     * 	A crew_members táblázathoz kérdezi le az adatokat
     * 	Itt nem kell minden adat egy munkáról
     */
    public function get_crew_members() {
        $this->query->reset();
//        $this->query->debug(true);
        $this->query->set_table(array('crew_members'));
        $this->query->set_columns(array(
            'crew_members.crew_member_id',
            'crew_members.crew_member_name',
            'crew_members.crew_member_title',
            'crew_members.crew_member_phone',
            'crew_members.crew_member_email',
            'crew_members.crew_member_category',
            'crew_members.crew_member_photo',
            'crew_members.crew_member_info',
            'crew_members.crew_member_status',
            'crew_member_categories.crew_member_category_name'
        ));
        $this->query->set_join('left', 'crew_member_categories', 'crew_members.crew_member_category', '=', 'crew_member_categories.crew_member_category_id');
        $this->query->set_where('crew_members.crew_member_status', '=', 1);
        $this->query->set_orderby('crew_members.crew_member_name', 'ASC');
        return $this->query->select();
    }

    /**
     * 	A crew_members táblázathoz kérdezi le az adatokat
     * 	Itt nem kell minden adat egy munkáról
     */
    public function get_crew_by_category_id($id) {
        $this->query->reset();
//        $this->query->debug(true);
        $this->query->set_table(array('crew_members'));
        $this->query->set_columns(array(
            'crew_members.crew_member_id',
            'crew_members.crew_member_name',
            'crew_members.crew_member_title',
            'crew_members.crew_member_phone',
            'crew_members.crew_member_email',
            'crew_members.crew_member_category',
            'crew_members.crew_member_photo',
            'crew_members.crew_member_info',
            'crew_members.crew_member_status',
            'crew_member_categories.crew_member_category_name'
        ));
        $this->query->set_join('left', 'crew_member_categories', 'crew_members.crew_member_category', '=', 'crew_member_categories.crew_member_category_id');
        $this->query->set_where('crew_member_category', '=', $id);
        $this->query->set_where('crew_members.crew_member_status', '=', 1);
        return $this->query->select();
    }

    /**
     * 	A crew_members táblázathoz kérdezi le az adatokat
     * 	Itt nem kell minden adat egy munkáról
     */
    public function get_crew_member_by_name($name) {
        $this->query->reset();
//        $this->query->debug(true);
        $this->query->set_table(array('crew_members'));
        $this->query->set_columns(array(
            'crew_members.crew_member_id',
            'crew_members.crew_member_name',
            'crew_members.crew_member_title',
            'crew_members.crew_member_phone',
            'crew_members.crew_member_email',
            'crew_members.crew_member_category',
            'crew_members.crew_member_photo',
            'crew_members.crew_member_info',
            'crew_members.crew_member_status',
            'crew_member_categories.crew_member_category_name'
        ));
        $this->query->set_join('left', 'crew_member_categories', 'crew_members.crew_member_category', '=', 'crew_member_categories.crew_member_category_id');
        $this->query->set_where('crew_member_name', '=', $name);
        $result = $this->query->select();
        return $result[0];
    }
    
     /**
     * 	Egy kolléga minden "nyers" adatát lekérdezi
     * 	A kolléga módosításához kell (itt az id-kre van szükség, és nem a hozzájuk tartozó névre)	
     */
    public function crew_members_by_id($array) {
        
        
        $this->query->reset();
        $this->query->debug(false);
        $this->query->set_table(array('crew_members'));
          $this->query->set_columns(array(
          'crew_members.crew_member_id',
          'crew_members.crew_member_name',
          'crew_members.crew_member_title',
          'crew_members.crew_member_phone', 
          'crew_members.crew_member_email',   
          'crew_members.crew_member_category', 
          'crew_members.crew_member_photo',
          'crew_members.crew_member_info',
          'crew_members.crew_member_status', 
          'crew_member_categories.crew_member_category_name'    
          ));
        $this->query->set_join('left', 'crew_member_categories', 'crew_members.crew_member_category', '=', 'crew_member_categories.crew_member_category_id');
        $this->query->set_where('crew_member_id', 'in', $array);
        $result = $this->query->select();
        return $result;
    }     

}

?>