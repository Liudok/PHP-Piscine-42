#!/usr/bin/php
<?php

$DB_USER = "root";
$DB_PASS = "123456";
$DB_SERVER = "localhost";

$mysql_connection = mysqli_connect($DB_SERVER, $DB_USER, $DB_PASS) or die("Sorry, could not connect to db");

$sql = "CREATE DATABASE IF NOT EXISTS shop";
if (!mysqli_query($mysql_connection, $sql))
	echo "Error creating database: " . mysqli_error($mysql_connection);
mysqli_select_db($mysql_connection, "shop"); 


if (!mysqli_query($mysql_connection, "users"))
{
	$sql = "CREATE TABLE users (
		id INT AUTO_INCREMENT PRIMARY KEY,
		login VARCHAR(50) NOT NULL,
		pass VARCHAR(10000) NOT NULL,
		email VARCHAR(20) NOT NULL,
		type VARCHAR(100) NOT NULL
		)";
	if (!mysqli_query($mysql_connection, $sql))
		echo "Error creating table: " . mysqli_error($mysql_connection);


	$hash = hash("whirlpool", "admin");
	$sql = "INSERT INTO users (login, pass, email, type)
		VALUES ('admin', '" . $hash . "','admin@gmail.com', 'admin')";
	mysqli_query($mysql_connection, $sql) or die(mysqli_error($mysql_connection));
}

if (!mysqli_query($mysql_connection, "products"))
{
	$sql = "CREATE TABLE products (
		id INT AUTO_INCREMENT PRIMARY KEY,
		prod_name VARCHAR(50) NOT NULL,
		category VARCHAR(50) NOT NULL,
		price DOUBLE NOT NULL,
		image_pr VARCHAR(1000) NOT NULL,
		stock INT(32) NOT NULL,
		description VARCHAR(255) NOT NULL
		)";
	mysqli_query($mysql_connection, $sql) or die(mysqli_error($mysql_connection));
	$sql = "INSERT INTO products (prod_name, category, price, image_pr,  stock, description) VALUES('Vintage Batoo', 'Clocks', '250',
		'./imgs/clock_arco1.jpg',
		4, 'Old fashion clock');";
	mysqli_query($mysql_connection, $sql) or die(mysqli_error($mysql_connection));
	$sql = "INSERT INTO products (prod_name, category, price, image_pr,  stock, description) VALUES('Printing machine', 'Other', '990',
		'./imgs/machi.jpg',
		1, 'Old fashion machine');";
	mysqli_query($mysql_connection, $sql) or die(mysqli_error($mysql_connection));
	$sql = "INSERT INTO products (prod_name, category, price, image_pr,  stock, description) VALUES('Vintage pipe', 'Other', '190',
		'./imgs/pipe.jpg',
		4, 'Vintage lense');";
	mysqli_query($mysql_connection, $sql) or die(mysqli_error($mysql_connection));
	$sql = "INSERT INTO products (prod_name, category, price, image_pr,  stock, description) VALUES('Ckocky', 'Clocks', '550',
		'./imgs/clock_Batoo.jpg',
		4, 'Old fashion clock');";
	mysqli_query($mysql_connection, $sql) or die(mysqli_error($mysql_connection));
	$sql = "INSERT INTO products (prod_name, category, price, image_pr,  stock, description) VALUES('Vintage Mao', 'Clocks', '250',
		'./imgs/clock_mao.jpg',
		4, 'Amazing clock');";
	mysqli_query($mysql_connection, $sql) or die(mysqli_error($mysql_connection));
	$sql = "INSERT INTO products (prod_name, category, price, image_pr,  stock, description) VALUES('Vintage compas-clock', 'Clocks', '250',
		'./imgs/clo.jpg',
		4, 'Amazing old clock');";
	mysqli_query($mysql_connection, $sql) or die(mysqli_error($mysql_connection));
	$sql = "INSERT INTO products (prod_name, category, price, image_pr,  stock, description) VALUES('Olympus', 'Camera', '850',
		'./imgs/cam5.jpg',
		5, 'Amazing camera');";
	mysqli_query($mysql_connection, $sql) or die(mysqli_error($mysql_connection));
	$sql = "INSERT INTO products (prod_name, category, price, image_pr,  stock, description) VALUES('Kodak', 'Camera', '830',
		'./imgs/cam6.jpg',
		5, 'Old fashion camera');";
	mysqli_query($mysql_connection, $sql) or die(mysqli_error($mysql_connection));
	$sql = "INSERT INTO products (prod_name, category, price, image_pr,  stock, description) VALUES('Nice Light', 'Lights', '130',
		'./imgs/li.jpg',
		5, 'Old fashion light');";
	mysqli_query($mysql_connection, $sql) or die(mysqli_error($mysql_connection));
	$sql = "INSERT INTO products (prod_name, category, price, image_pr,  stock, description) VALUES('Olympus old', 'Camera', '950',
		'./imgs/cam4.jpg',
		5, 'Amazing camera');";
	mysqli_query($mysql_connection, $sql) or die(mysqli_error($mysql_connection));
}

if (!mysqli_query($mysql_connection, "categories"))
{
	$sql = "CREATE TABLE categories (
		id INT AUTO_INCREMENT PRIMARY KEY,
		category_name VARCHAR(30) NOT NULL
		)";
	mysqli_query($mysql_connection, $sql) or die(mysqli_error($mysql_connection));
	$sql = "INSERT INTO categories (category_name) VALUES('Clocks')";
	mysqli_query($mysql_connection, $sql) or die(mysqli_error($mysql_connection));
	$sql = "INSERT INTO categories (category_name) VALUES('Camera')";
	mysqli_query($mysql_connection, $sql) or die(mysqli_error($mysql_connection));
	$sql = "INSERT INTO categories (category_name) VALUES('Lights')";
	mysqli_query($mysql_connection, $sql) or die(mysqli_error($mysql_connection));
	$sql = "INSERT INTO categories (category_name) VALUES('Other')";
	mysqli_query($mysql_connection, $sql) or die(mysqli_error($mysql_connection));
}

if (!mysqli_query($mysql_connection, "orders"))
{
	$sql = "CREATE TABLE orders (
		id INT AUTO_INCREMENT PRIMARY KEY,
		product_id INT(32) NOT NULL,
		amount INT(32) NOT NULL,
		order_id INT(32) NOT NULL,
		user_name VARCHAR(1000) NOT NULL,
		status VARCHAR(32) NOT NULL
		)";
	mysqli_query($mysql_connection, $sql) or die(mysqli_error($mysql_connection));
}

if (!mysqli_query($mysql_connection, "basket"))
{
	$sql = "CREATE TABLE basket (
		id INT AUTO_INCREMENT PRIMARY KEY,
		user_name VARCHAR(500) NOT NULL,
		product_id INT(32) NOT NULL,
		amount INT(32) NOT NULL
		)";
	mysqli_query($mysql_connection, $sql) or die(mysqli_error($mysql_connection));
}

if (!mysqli_query($mysql_connection, "cat_prod"))
{
	$sql = "CREATE TABLE cat_prod (
		id INT AUTO_INCREMENT PRIMARY KEY,
		cat_name VARCHAR(1000) NOT NULL,
		prod_name VARCHAR(1000) NOT NULL
		)";
	mysqli_query($mysql_connection, $sql) or die(mysqli_error($mysql_connection));
}

mysqli_close($mysql_connection);
$str = "Location: http://".$_SERVER['HTTP_HOST']."/index.php";
header($str);

?>
