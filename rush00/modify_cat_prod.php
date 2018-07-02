<?php
print_r($_POST);
include 'db_connect.php';

if($_POST['Delete_cn'] == 'Delete_cn')
{
	$uid = $_POST['delete'];
	$query = "DELETE FROM cat_prod WHERE id = '".$uid."';";
	echo $query;
	$result = mysqli_query($mysql_connection, $query);
}
else if ($_POST['Modify'] == 'Modify')
{
  	$uid = $_POST['delete'];
	$query = "UPDATE categories SET category_name = '".$_POST['change']."' WHERE id = '".$uid."';";
	echo $query;
	$result = mysqli_query($mysql_connection, $query);
 }
else
	echo "Not deletable\n";
header("Location: ./index.php");

?>