<?php

include 'db_connect.php';

function	is_admin($mysql_connection, $login)
{
	$sql = "SELECT * FROM users ;";
	$res = mysqli_query($mysql_connection, $sql);
	while ($row = mysqli_fetch_assoc($res))
	{
		if ($row['login'] == $login && $row['type'] == "admin")
		{
			mysqli_free_result($res);
			return true;
		}
	}
	mysqli_free_result($res);
	return false;
}

include("auth.php");

session_start();
if ($_POST['login'] && $_POST['pass'] && auth($_POST['login'], $_POST['pass']))
{
	$_SESSION['loggued_on_user'] = $_POST['login'];
	if (is_admin($mysql_connection, $_POST['login']))
		$str = "Location: http://".$_SERVER['HTTP_HOST']."/admin.php";
	else
	{
		$query = "UPDATE basket SET user_name = '".$_POST['login']."' WHERE user_name = '' ;";
		$result = mysqli_query($mysql_connection, $query);
		$str = "Location: http://".$_SERVER['HTTP_HOST']."/index.php";	
	}
	header($str);
} 
else
  echo "Wrong login/password\n";

?>
