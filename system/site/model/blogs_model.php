<?php 
class Blogs_model extends Site_model {

	protected $table = 'blog';

    public function __construct()
    {
        parent::__construct();
    }

	/**
     * 	Beolvassa a blog bejegyzéseket a blog táblából
     *
     *  @return array  ahárom legfrissebb blog bejegyzés   
     */
    public function getBlogs($limit = 3)
    {
        $this->query->set_table(array('blog'));
        $this->query->set_columns('*');
        $this->query->set_limit($limit);
        $this->query->set_orderby(array('blog_add_date'), 'DESC');
        return $this->query->select();
    }
}
?>