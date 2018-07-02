<?php

function	auth($login, $passwd)
{
	include 'db_connect.php';
	if (!$login || !$passwd)
		return false;
	$accounts = array();
	$sql = "SELECT * FROM users;";
	$res = mysqli_query($mysql_connection, $sql);
	while ($row = mysqli_fetch_assoc($res)) {
		$accounts[] = $row;
	}
	mysqli_free_result($res);
	if ($accounts)
		foreach ($accounts as $value)
			if ($value['login'] == $login && $value['pass'] == hash('whirlpool', $passwd))
				return true;
		return false;
	}
?>
