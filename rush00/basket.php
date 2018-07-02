<?php
	include 'db_connect.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Your basket</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  
<?php
session_start();
$logged_user = $_POST['login'];
?><div class="h1">Products in basket of user  <?php echo $logged_user;?></div><?php
$sql_prods = "
			SELECT user_name, product_id, amount FROM basket
			;";
$resul = mysqli_query($mysql_connection, $sql_prods);
$arr_products;
$arr_price;
$arr_amount;
$i = -1;
$total = 0;
while ($row2 = mysqli_fetch_array($resul))
{
	if ($_SESSION['loggued_on_user'] == $row2['user_name'])
	{
		$id_pr = $row2['product_id'];
		$sql_prod = "SELECT id, prod_name, price FROM shop.products;";
		$resu = mysqli_query($mysql_connection, $sql_prod);
		while ($row3 = mysqli_fetch_array($resu))
		{
			if ($row3['id'] == $id_pr && $row2['user_name'] == $_SESSION['loggued_on_user'])
			{
				$arr_products[] = $row3['prod_name'];
				$arr_price[] = $row3['price'];
				$arr_amount[] = $row2['amount'];
				$total += ($row3['price'] * $row2['amount']);
				$i++;
			}
		}
	}
}
mysqli_free_result($resul);
mysqli_free_result($resu);

?>
<?php
while ($i >= 0)
{
	echo '<div class="prods_in_basket">';
	echo $arr_products[$i];
	echo '</div>';
	echo '<div class="price_in_basket">';
	echo $arr_price[$i];
	echo '</div>';
	echo '<div class="price_in_basket">';
	echo $arr_amount[$i];
	echo '</div><br>';
	$i--;
}
?>
<div class="h1">total = <?php echo $total;?></div>
<form method='post' action='add_to_orders.php'>
	<input type="submit" name="index" value="Back to index">
	<input type="submit" name="buy" value="Buy">
</form>
</body>
</html>
