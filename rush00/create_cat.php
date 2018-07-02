<?php
session_start();

include 'db_connect.php';

function	check_values($arr, $login)
{
	foreach ($arr as $value)
		if ($value['category_name'] == $login)
			return false;
	return true;
}

if ($_POST['submit'] == "ADD to db" && $_POST['category'])
{
	$accounts = array();	
	$sql = "SELECT * FROM categories ;";
	$res = mysqli_query($mysql_connection, $sql);
	while ($row = mysqli_fetch_assoc($res)) {
		$accounts[] = $row;
	}
	mysqli_free_result($res);
	if (check_values($accounts, $_POST['category']) == false)
		;//echo "Wrong login\n"; 										/// rewrite this
	else
	{
		$query = "INSERT INTO categories (category_name) VALUES ('".$_POST['category']."') ;";
		$result = mysqli_query($mysql_connection, $query);
	}
}
$str = "Location: http://".$_SERVER['HTTP_HOST']."/admin.php";
header($str);

?>

