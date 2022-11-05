<?php 

class Data{
	private $domain = 'localhost';
	private $user = 'root';
	private $db_name = 'test';
	private $db_table_accounts = 'accounts'; 
	private $db_pass = '';
	protected $charset = 'utf8mb4';
	protected $options = [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		PDO::ATTR_EMULATE_PREPARES => false,
		PDO::ATTR_PERSISTENT => TRUE
	];

	public function get_data_connect(){
		$data = array(
			"domain" => $this->domain,
			"user" => $this->user,
			"db-name" => $this->db_name,
			"db_table_accounts" => $this->db_table_accounts,
			"db-pass" => $this->db_pass
		);
		return $data;
	}
}


?>