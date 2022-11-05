<?php 

class CRUD_DATA{
	protected $host;
	protected $db;
	protected $user;
	protected $pass;

	protected $_crud_host = 'crud-host';
	protected $_crud_db   = 'crud-db';
	protected $_crud_user = 'crud-user';
	protected $_crud_pass = 'crud-pass';

	protected $_crud_new_table = 'crud-new-table';
	protected $_crud_new_table_columns = 'crud-new-table-columns';

	protected $_crud_table_name = 'crud-table-name';

	protected $_crud_conn = 'crud-conn';

	protected $_crud_drop_table = 'crud-drop-table';
	protected $_crud_table_target = 'crud-table-target';
	protected $_crud_new_table_column = 'crud-new-table-column';

	protected $_crud_insert_row = 'crud-insert-row';

	protected $_crud_run_sql = 'crud-run-sql';

	protected $_crud_action_table = 'crud-action-table';
	protected $_crud_update_row = 'crud-update-row';
	protected $_crud_delete_row = 'crud-delete-row';

	protected $options = [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		PDO::ATTR_EMULATE_PREPARES => false,
		PDO::ATTR_PERSISTENT => TRUE
	];
	protected $charset = 'utf8mb4';

	protected $ok = '&#128077;';
	protected $not_ok = '&#128078;';
}

class CRUD_ENV extends CRUD_DATA{
	protected function initCrudEnv(){}

	protected function connectToDB(){
		if(
			isset($_POST[$this->_crud_host]) && 
			isset($_POST[$this->_crud_db])   && 
			isset($_POST[$this->_crud_user]) && 
			isset($_POST[$this->_crud_pass])
		){
			$this->host = $_POST[$this->_crud_host];
			$this->db   = htmlentities($_POST[$this->_crud_db]);
			$this->user = htmlentities($_POST[$this->_crud_user]);
			$this->pass = htmlentities($_POST[$this->_crud_pass]);
			return true;
		}
		return false;
	}

	protected function showAllTablesName(){
		$dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";
		try{
			$pdo = new PDO($dsn, $this->user, $this->pass, $this->options);
			$stmt = $pdo->query('SHOW TABLES');
			$html = '<option></option>';
			while($row = $stmt->fetch(PDO::FETCH_NUM)){
				$html .= '<option>'.$row[0].'</option>';
			}
			return $html;
		}
		catch(PDOException $e){
			// return $e->getMessage();
			return $this->not_ok;
		}
		exit();
	}

	protected function runSQL($sql){
		$dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";
		try{
			$pdo = new PDO($dsn, $this->user, $this->pass, $this->options);
			$stmt = $pdo->query($sql);
		}
		catch(PDOException $e){
			// echo $e->getMessage();
			echo $this->not_ok;
			exit();
		}
	}
}

class CRUD_SERVE extends CRUD_ENV{
	protected function initCrudServe(){
		$this->connectAndShowTable();
		$this->createNewTable();
		$this->showTable();
		$this->runSQLFromUser();
		$this->dropTable();
		$this->insertRow();
		$this->actionOnRow();
	}

	private function connectAndShowTable(){
		if(
			isset($_POST[$this->_crud_conn]) &&
			$this->connectToDB()
		){
			echo $this->showAllTablesName();
		}
	}

	private function createNewTable(){
		if(
			isset($_POST[$this->_crud_new_table]) && 
			isset($_POST[$this->_crud_new_table_columns])
		){
			$table   = $_POST[$this->_crud_new_table];
			$columns = $_POST[$this->_crud_new_table_columns];

			$arrCol = explode(',', $columns);
			$str = 'id INT NOT NULL AUTO_INCREMENT, ';
			for($i=0; $i<count($arrCol); ++$i){
				$str .= "`{$arrCol[$i]}` varchar(4095) NOT NULL DEFAULT '',";
			}
			$_str = "{$str} PRIMARY KEY (id)";
			$sql = "CREATE TABLE IF NOT EXISTS `{$table}` ( {$_str} )";
			if($this->connectToDB()){
				$this->runSQL($sql);
				echo $this->showAllTablesName();
			}
		}
	}

	private function showTableData($table){
		if($this->connectToDB()){
			$dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";

			try{
				$pdo = new PDO($dsn, $this->user, $this->pass, $this->options);
				$sql = array(
					"SHOW COLUMNS FROM `{$table}`",
					"SELECT * FROM `{$table}`"
				);
				// get all columns name
				$stmt = $pdo->query($sql[0]);
				$columns = $stmt->fetchAll(PDO::FETCH_NUM);
				// get all records
				$stmt = $pdo->query($sql[1]);
				$records = $stmt->fetchAll(PDO::FETCH_ASSOC);

				// 1. add all html btns
				$html_arr = array(
					'<span data-tname="'.$table.'" class="crud-drop-table lang-crud-table-drop-js"></span>',
					'<div data-tname="'.$table.'" class="crud-run-sql lang-run-sql-js"></div>'
				);
				$html = '<div class="crud-table-btns">';
				for($i=0;$i<count($html_arr);++$i){
					$html .= $html_arr[$i];
				}
				$html .= '</div>';
				// 1.1 add all columns name
				$html .= '<div class="crud-table-data"><table><thead><tr>';
				// 1.2 get from array
				$html .= "<th>{$columns[0][0]}</th>";
				for($i=1, $n=0; $i<count($columns); ++$i,++$n){
					$html .= '<th class="crud-cn-js">'.$columns[$i][0].'</th>';
				}
				$html .= '<th><span class="lang-crud-action-js"></span></th></thead>';
				// 1.3 add fields for new record
				$html .= '<tbody><tr><td>&#128273;</td>';
				for($i=0; $i<$n; ++$i){
					$html .= '<td><textarea class="crud-textarea"></textarea><samp class="crud-count"></samp></td>';
				}
				$html .= '<td><div data-tname="'.$table.'" class="crud-btn crud-new-row-js lang-crud-action-n-js"></div></td>';
				$html .= '</tr>';

				// 2. if we have records, add all
				if($records){
					// 2.1 get all values coresponding to each key
					foreach($records as $indexArr){
						$id = $indexArr['id'];
						$html .= '<tr>';
						foreach($indexArr as $key => $value){
							$html .= "<td>{$value}</td>";
						}
						$html .= '<td>';
						$html .= '<div data-tname="'.$table.'" data-id="'.$id.'" class="crud-btn crud-action-e-js lang-crud-action-e-js"></div>';
						$html .= '<div data-tname="'.$table.'" data-id="'.$id.'" class="crud-btn crud-action-d-js lang-crud-action-d-js"></div>';
						$html .= '</td></tr>';
					}
				}

				$html .= '</tbody></table></div>';
				echo $html;
				exit();
			}
			catch(PDOException $e){
				// echo $e->getMessage();
				echo $this->not_ok;
			}
		}
	}

	private function showTable(){
		if(isset($_POST[$this->_crud_table_name])){
			$table = htmlentities($_POST[$this->_crud_table_name]);
			$this->showTableData($table);
		}
	}

	private function dropTable(){
		if(
			isset($_POST[$this->_crud_drop_table]) && 
			$this->connectToDB()
		){
			$table = $_POST[$this->_crud_drop_table];
			$sql = "DROP TABLE IF EXISTS `{$table}`";
			$this->runSQL($sql);
			$data = "{$this->showAllTablesName()},{$this->ok}";
			echo $data;
		}
	}

	private function runSQLFromUser(){
		if(
			isset($_POST[$this->_crud_run_sql]) &&
			$this->connectToDB()
		){
			$sql = $_POST[$this->_crud_run_sql];
			$this->runSQL($sql);
			echo $this->ok;
			exit();
		}
	}

	private function insertRow(){
		if(
			isset($_POST[$this->_crud_insert_row]) &&
			$this->connectToDB()
		){
			$sql = $_POST[$this->_crud_insert_row];
			$this->runSQL($sql);
			$data = "{$this->ok}";
			echo $data;
			exit();
		}
	}

	private function actionOnRow(){
		if(
			isset($_POST[$this->_crud_action_table]) && 
			$this->connectToDB()
		){
			$table = $_POST[$this->_crud_action_table];
			$id_row = $_POST[$this->_crud_delete_row];
			$sql = "DELETE FROM {$table} WHERE id={$id_row}";
			$this->runSQL($sql);
			$data = "{$this->ok}";
			echo $data;
			exit();
		}

		if(
			isset($_POST[$this->_crud_update_row]) && 
			$this->connectToDB()
		){
			$sql = $_POST[$this->_crud_update_row];
			$this->runSQL($sql);
			$data = "{$this->ok}";
			echo $data;
			exit();
		}
	}
}

class CRUD extends CRUD_SERVE{
	public function initCrud(){
		$this->initCrudEnv();
		$this->initCrudServe();
	}
}
$objCrud = new CRUD();
$objCrud->initCrud();

?>