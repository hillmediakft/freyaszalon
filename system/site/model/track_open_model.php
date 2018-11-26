<?php 
class Track_open_model extends Model {

	/**
     * Constructor, létrehozza az adatbáziskapcsolatot
     */
	function __construct()
	{
		parent::__construct();
		
	}
	/**
	 * Ajánlat update
	 *	
	 * @param 	int 	$id	ajánlat id-je
	 * @return 	string 	üzenet
	 */
	public function get_email_open_count($newsletter_id)
	{
		$this->query->reset();
		$this->query->set_table(array('stats_newsletters'));
		$this->query->set_columns('email_opens');
		$this->query->set_where('statid', '=', $newsletter_id);
		return $this->query->select();
	}
	
	
	
	/**
	 * Ajánlat update
	 *	
	 * @param 	int 	$id	ajánlat id-je
	 * @return 	string 	üzenet
	 */
	public function increase_email_open_count($newsletter_id, $count)
	{


		$this->query->reset();
		$this->query->set_table(array('stats_newsletters'));
		$this->query->set_where('statid', '=', $newsletter_id);
		$result = $this->query->update(array('email_opens' => $count));
		return;
	}	
	
	/**
	 * Ajánlat update
	 *	
	 * @param 	int 	$id	ajánlat id-je
	 * @return 	string 	üzenet
	 */
	public function get_unique_email_opens($newsletter_id)
	{

		$sth = $this->connect->query("SELECT COUNT(DISTINCT(subscriber_id)) FROM stats_emailopens WHERE campaign_id =" . $newsletter_id); 
		$result = $sth->fetch(PDO::FETCH_NUM);
		return (int)$result[0];

	}

	/**
	 * Ajánlat update
	 *	
	 * @param 	int 	$id	ajánlat id-je
	 * @return 	string 	üzenet
	 */
	public function update_unique_email_opens($newsletter_id, $unique_opens)
	{

		$this->query->reset();
		$this->query->set_table(array('stats_newsletters'));
		$this->query->set_where('statid', '=', $newsletter_id);
		$result = $this->query->update(array('unique_email_opens' => $unique_opens));
		return;

	}	
	
	/**
	 * Email megnyitás adatbázisba írása
	 *	
	 * @param 	int 	$newsletter_id	kampány id-je
	 * @param 	int 	$user_id		user id-je
	 * @param 	string 	$open_time		megnyitás ideje
	 * @param 	int 	$open_ip		a megnyitó user IP címe
	 * @return 	void
	 */
	public function insert_email_open($newsletter_id, $user_id, $open_time, $open_ip)
	{
		$data['campaign_id'] = $newsletter_id;
		$data['subscriber_id'] = $user_id;
		$data['open_time'] = $open_time;
		$data['open_ip'] = $open_ip;
		
		$this->query->reset();
		$this->query->set_table(array('stats_emailopens'));
		$this->query->insert($data);
		return;
	}	
	
}

?>