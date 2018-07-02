<?php

include 'db_connect.php';
print_r($_POST);
if (isset($_POST['delete']))
{
	$prod = $_POST['delete'];
	echo $prod;
	$query = "DELETE FROM products WHERE products.prod_name LIKE '%$prod%';";
	$result = mysqli_query($mysql_connection, $query);
}
else
	echo "Deleting imposible\n";
header("Location: ./admin.php");
?>

