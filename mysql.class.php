<?php

class mysql {
	private $login = array(
		'host'=>'localhost',
		'user'=>'root',
		'pass'=>'',
		'database'=>'my_app'
	);

	/**
		@param void
		@return void
	*/
	public function connect_db() {
		$con = mysql_connect($this->login['host'], $this->login['user'], $this->login['pass']) or die(mysql_error());
		mysql_select_db($this->login['database'], $con) or die(mysql_error());
	}

	/**
		@param (String) query SQL-Query
		@return (Object) SQL-Handle
	*/
	public function query($q) {
		return mysql_query($q);
	}

	/**
		@param (String) query SQL-Query
		@return (Array) data SQL-Daten als Assitiativ Array
	*/
	public function row($q) {
		$sql = $this->query($q);
		$data = array();
		while ($row = mysql_fetch_row($sql)) {
			$data[] = $row;
		}
		return $data;
	}

	/**
		@param (String) query SQL-Query
		@return (Array) data SQL-Daten als Assitiativ Array
	*/
	public function assoc($q) {
		$sql = $this->query($q);
		$data = array();
		while ($row = mysql_fetch_assoc($sql)) {
			$data[] = $row;
		}
		return $data;
	}

	/**
		@param query SQL-Query
		@param function-object Funktion zum überprüfen
		@return void
	*/
	public function transaction($q, $success) {
		$sql = $this->query($q);	
		if($success($sql)) {
			$this->query("COMMIT;");
		} else {
			$this->query("ROLLBACK;");
		}
	}
}

?>
