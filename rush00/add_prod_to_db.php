<?php

include 'db_connect.php';

session_start();
$prod = $_POST['prod_name'];
$categ = $_POST['category'];
$price = $_POST['price'];
$im = $_POST['image_pr'];
$description = $_POST['description'];
$sql = "INSERT INTO products (prod_name, category, price, image_pr,  stock, description)
		VALUES('$prod', '$categ', '$price','$im', 1, '$description')
		;";
mysqli_query($mysql_connection, $sql) or die(mysqli_error($mysql_connection));
$str = "Location: http://".$_SERVER['HTTP_HOST']."/admin.php";
header($str);

?>
