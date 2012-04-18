<?php

class mysql {
	private $login = array(
		'host'=>'localhost',
		'user'=>'root',
		'pass'=>'',
		'database'=>'my_app'
	);

	public function connect_db() {
		$con = mysql_connect($this->login['host'], $this->login['user'], $this->login['pass']) or die(mysql_error());
		mysql_select_db($this->login['database'], $con) or die(mysql_error());
	}
}

?>
