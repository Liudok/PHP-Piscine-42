<?php
session_start();

include 'db_connect.php';

function	check_values($arr, $login)
{
	foreach ($arr as $value)
		if ($value['login'] == $login)
			return false;
	return true;
}

if ($_POST['submit'] == "ADD user" && $_POST['login'] && $_POST['pass'] && $_POST['type'] && $_POST['email'])
{
	$accounts = array();	
	$sql = "SELECT * FROM users;";
	$res = mysqli_query($mysql_connection, $sql);
	while ($row = mysqli_fetch_assoc($res)) {
		$accounts[] = $row;
	}
	mysqli_free_result($res);
	if (check_values($accounts, $_POST['login']) == false)
		;//echo "Wrong login\n";
	else
	{
		$hashed = hash('whirlpool', $_POST['pass']);
		$query = "INSERT INTO users (login, pass, email, type) VALUES ('".$_POST['login']."', '".$hashed."', '".$_POST['email']."', '".$_POST['type']."');";
		$result = mysqli_query($mysql_connection, $query);
	}
}
$str = "Location: http://".$_SERVER['HTTP_HOST']."/admin.php";
header($str);

?>
