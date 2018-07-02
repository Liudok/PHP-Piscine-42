<?php

include 'db_connect.php';

session_start();
$user_name = $_SESSION["loggued_on_user"];
$amount = 1;
$product_id = intval($_POST['id']);
	$sql = "SELECT * FROM basket;";
	$res = mysqli_query($mysql_connection, $sql);
	while ($row = mysqli_fetch_assoc($res)) {
		if (intval($row['product_id']) == $product_id && $row['user_name'] == $user_name)
		{
			$amount += intval($row['amount']);
		}
	}
	mysqli_free_result($res);
	if ($amount == 1)
	{
		$query = "INSERT INTO basket (user_name, product_id, amount) VALUES ('".$user_name."', ".$product_id.", ".$amount.");";
		$result = mysqli_query($mysql_connection, $query);
	}
	else
	{
		$query = "UPDATE basket SET amount = ".$amount." WHERE product_id = ".$product_id." AND user_name = '".$user_name."';";
		$result = mysqli_query($mysql_connection, $query);
	}
	$str = "Location: http://".$_SERVER['HTTP_HOST']."/index.php";
	header($str);

?>
