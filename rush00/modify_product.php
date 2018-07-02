<?php

include 'db_connect.php';
print_r($_POST);
if (isset($_POST['modify']))
{
	$prod = $_POST['prod_name'];
	$price = $_POST['price'];
	$description = $_POST['description'];
	$image = $_POST['image_pr'];
	$product_id = $_POST['id'];
	$query = "UPDATE products
			SET prod_name = '$prod',
			description = '$description',
			image_pr = '$image',
			price = '$price'
			WHERE id = '$product_id'
			;";
echo $query;
	$result = mysqli_query($mysql_connection, $query);
}
else
	echo "not possible\n";

header("Location: ./admin.php");
?>
