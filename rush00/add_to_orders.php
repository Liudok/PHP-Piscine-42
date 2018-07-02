<?php

function	get_order_id($mysql_connection)
{
	$id = 0;
	$sql = "SELECT * FROM orders;";
	$res = mysqli_query($mysql_connection, $sql);
	while ($row = mysqli_fetch_assoc($res))
		if (intval($row['order_id']) == $id)
			$id++;
	mysqli_free_result($res);
	return $id;
}

include 'db_connect.php';

session_start();
$user_name = $_SESSION["loggued_on_user"];


if ($_POST['index'] == "Back to index")
{
	$str = "Location: http://".$_SERVER['HTTP_HOST']."/index.php";
	header($str);
}
if ($_POST['buy'] == "Buy" && $user_name != "")
{
	$basket_arr = array();
	$sql = "SELECT * FROM basket;";
	$res = mysqli_query($mysql_connection, $sql);
	while ($row = mysqli_fetch_assoc($res))
		if ($row['user_name'] == $user_name)
			$basket_arr[] = $row;
	mysqli_free_result($res);
	$order_id = get_order_id($mysql_connection);
	foreach ($basket_arr as $value)
	{
		$query = "INSERT INTO orders (product_id, amount, order_id, user_name, status) VALUES ('".$value['product_id']."', '".$value['amount']."', '".$order_id."', '".$user_name."','0');";
		$result = mysqli_query($mysql_connection, $query);
	}
	$query = "DELETE FROM basket WHERE user_name = '".$user_name."';";
	$result = mysqli_query($mysql_connection, $query);
	$str = "Location: http://".$_SERVER['HTTP_HOST']."/basket.php";
	header($str);
}
else
{
	echo "Please login\n";
}

?>
