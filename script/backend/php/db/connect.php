<?php 

class Connect extends Data{
	public function test_if_user_exists($user, $pass){
		$data = $this->get_data_connect();
		$_domain = $data['domain'];
		$_user = $data['user'];
		$_db_name = $data['db-name'];
		$_db_table_accounts =  $data['db_table_accounts'];
		$_db_pass = $data['db-pass'];

		// var_dump($data);

		$dsn = "mysql:host={$_domain};dbname={$_db_name};charset={$this->charset}";
		$pdo = new PDO($dsn, $_user, $_db_pass, $this->options);
		$stmt = $pdo->query('SELECT * FROM ' . $_db_table_accounts);
		// var_dump($stmt);
		
		while($row = $stmt->fetch(PDO::FETCH_NUM)){
			// $row[1] contine numele utilizatorului
			// verificam daca user-ul si parola primite la login se gasesc in tabela accounts
			if($user == $row[1] && $pass == $row[2]){
				return true;
			}
		}
		return false;
	}
}


?>