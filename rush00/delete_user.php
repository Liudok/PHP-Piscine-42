<?php
	print_r($_POST);
	include 'db_connect.php';

	if($_POST['Delete'] == 'Delete')
	{
		$uid = $_POST['delete'];
		$query = "DELETE FROM users WHERE id = '".$uid."';";
		echo $query;
		$result = mysqli_query($mysql_connection, $query);
	}
	else if ($_POST['Modify'] == 'Modify')
	{
	  	$uid = $_POST['delete'];
		$query = "UPDATE users SET type = '".$_POST['change']."' WHERE id = '".$uid."';";
		echo $query;
		$result = mysqli_query($mysql_connection, $query);
	 }
	else
		echo "Not deletable\n";
	header("Location: ./admin.php");
?>
