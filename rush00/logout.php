<?php

session_start();
$_SESSION["loggued_on_user"] = "";
$str = "Location: http://".$_SERVER['HTTP_HOST']."/index.php";
header($str);

?>
