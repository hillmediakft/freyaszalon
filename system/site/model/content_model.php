<?php

class Content_model extends Site_model {

    protected $table = 'content';

    /**
     * Constructor, létrehozza az adatbáziskapcsolatot
     */
    function __construct() {
        parent::__construct();
    }

    /**
     * 	Egy tartalmi elemet kérdez le content_name alapján
     *
     * 	@param	$id String or Integer
     * 	@return	az adatok tömbben
     */
    public function getContent($content_name) {
        $this->query->reset();
        $this->query->set_table(array('content'));
        $this->query->set_columns(array('content_body'));
        $this->query->set_where('content_name', '=', $content_name);
        $result = $this->query->select();
        return $result[0]['content_body'];
    }

    /**
     * 	Egy tartalmi elemet kérdez le content_name alapján
     *
     * 	@param	$id String or Integer
     * 	@return	az adatok tömbben
     */
    public function getContentNames() {
        $this->query->reset();
        $this->query->set_table(array('content'));
        $this->query->set_columns(array('content_name'));
        $result = $this->query->select();
        return $result;
    }

}

?>