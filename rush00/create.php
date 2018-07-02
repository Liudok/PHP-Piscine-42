<?php
session_start();
$folder = "../htdocs/private/";
$filename = "passwd";
include 'db_connect.php';

function	check_values($arr, $login)
{
	foreach ($arr as $value)
		if ($value['login'] == $login)
			return false;
	return true;
}

if ($_POST['submit'] == 'Sign up' && $_POST['login'] && $_POST['pass'])
{
	$accounts = array();	
	$sql = "SELECT * FROM users;";
	$res = mysqli_query($mysql_connection, $sql);
	while ($row = mysqli_fetch_assoc($res)) {
		$accounts[] = $row;
	}
	mysqli_free_result($res);
	if (check_values($accounts, $_POST['login']) == false)
		echo "Wrong login\n";
	else
	{
		$hashed = hash('whirlpool', $_POST['pass']);
		$query = "INSERT INTO users (login, pass, email, type) VALUES ('".$_POST['login']."', '".$hashed."', 'a@a.com', 'user');";
		$result = mysqli_query($mysql_connection, $query);
		$str = "Location: http://".$_SERVER['HTTP_HOST']."/index.php";
		header($str);
	}
}
else
	echo "ERROR\n"; 
?>
