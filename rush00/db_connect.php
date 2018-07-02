<?php

$DB_NAME = "shop";
$DB_USER = "root";
$DB_PASS = "123456";
$DB_SERVER = "localhost";

$mysql_connection = mysqli_connect($DB_SERVER, $DB_USER, $DB_PASS, $DB_NAME) or die("Sorry, could not connect to db");

?>