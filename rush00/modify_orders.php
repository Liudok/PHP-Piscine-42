<?php
print_r($_POST);
include 'db_connect.php';

if($_POST['Delete'] == 'Delete')
{
	$uid = $_POST['id'];
	$query = "DELETE FROM orders WHERE id = '".$uid."';";
	echo $query;
	$result = mysqli_query($mysql_connection, $query);
}
else if ($_POST['Modify'] == 'Modify')
{
  	$uid = $_POST['id'];
	$query = "UPDATE orders SET status = '".$_POST['change']."' WHERE id = '".$uid."';";
	echo $query;
	$result = mysqli_query($mysql_connection, $query);
 }
else
	echo "Not deletable\n";
header("Location: ./admin.php");
?>