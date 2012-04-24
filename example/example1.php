<?php
require_once '../mysql.class.php';
$_mysql = new mysql;

$_mysql->connect_db();
$_mysql->query("INSERT INTO konto (1500, 636.0, 1045);");
$_mysql->query("INSERT INTO konto (1510, 4984.30, 1052);");

function func($sql) {
	while ($row = mysql_fetch_row($sql)) {
		if ($row['value'] < 0) {
			return false;
		}
	}
	return true;
}

$funcObject = &func($sql);

$_mysql->transaction('
	UPDATE SET value=value+34579.84 WHERE userid = 1045;
	UPDATE SET value=value-34579.84 WHERE userid = 1052;
	SELECT id, value, userid FROM konto;
', $funcObject);
?>
