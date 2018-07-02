<?php

function	is_admin($mysql_connection, $login)
{
	$sql = "SELECT * FROM users ;";
	$res = mysqli_query($mysql_connection, $sql);
	while ($row = mysqli_fetch_assoc($res))
	{
		if ($row['login'] == $login && $row['type'] == "admin")
		{
			mysqli_free_result($res);
			return true;
		}
	}
	mysqli_free_result($res);
	return false;
}

	include 'db_connect.php';
	session_start();

	$login = $_SESSION['loggued_on_user'];
	if (!is_admin($mysql_connection, $login))
	{
		$str = "Location: http://".$_SERVER['HTTP_HOST']."/index.php";
		header($str);
	}	
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Vintage life admin panel</title>
    <link rel="stylesheet" type="text/css" href="style_admin.css">
</head>
<body>
	<form action = "admin.php" method = "post">

	<?php
		$sql_cat = "SELECT * FROM products;";
		$result = mysqli_query($mysql_connection, $sql_cat);
	while ($rows = mysqli_fetch_array($result))
	{
		?><form action = "modify_product.php" method="post" >
		<input type="hidden" name="id" value="<?php echo $rows['id'];?>">
		<?php
		echo "<div class=\"line\">";
		echo "<div class=\"product_content\" type=\"text\">";
		echo "<input class=\"data_field\" type=\"text\" name=\"prod_name\" value=\"";
		echo $rows['prod_name'];
		echo "\" /></div>";
		echo "<div class=\"product_content\" type=\"text\">";
		echo "<input class=\"data_field\" type=\"text\" name=\"price\" value=\"";
		echo $rows['price'];
		echo "\" /></div>";
		echo "<div class=\"product_content\" type=\"text\">";
		echo "<input class=\"data_field\" type=\"text\" name=\"description\" value=\"";
		echo $rows['description'];
		echo "\" /></div>";
		echo "<div class=\"product_content\" type=\"text\">";
		echo "<input class=\"data_field\" type=\"text\" name=\"image_pr\" value=\"";
		echo $rows['image_pr']; 
		echo "\" /></div>";
	?>
	<input type="hidden" name="modify" value="<?php echo $rows['prod_name'];?>">
	<input class="modify" type="submit" name="modifypr" value="Modify" />
	</form>
	<form action = "delete_product.php" method="post" >
		<input type="hidden" name="delete" value="<?php echo $rows['prod_name'];?>">
		<input class="remove" type="submit" name="removepr" value="Delete" />
	</form></div>
<?php
}
mysqli_free_result($result);
?>
</br>
</form>

<form action = "add_prod_to_db.php" method = "post">
	<p>Add new product</p>
	<div class="line">
    <input class="adding" type = "text" name = "prod_name" placeholder="Product name"/>
	<input class="adding" type = "text" name = "price" placeholder="Price"/>
	<select name="category" multiple="multiple">
	<?php
		$sql_cat = "SELECT category_name FROM categories;";
		$result = mysqli_query($mysql_connection, $sql_cat);
		while ($row1 = mysqli_fetch_array($result))
		{
			echo "<option value=\"";
			echo $row1['category_name'];
			echo "\">";
			echo $row1['category_name'];
			echo "</option>";
		}
		print_r($_POST['category']);
		mysqli_free_result($result);
	?>
	</select>
    <input class="adding" type = "text" name = "description" placeholder="Description"/>
    <input class="adding" type = "text" name = "image_pr" placeholder="put link in here"/>
    <input class="add_to" type = "submit" value="ADD to db" />
</form>
</div>
<div class="manage_users">
	<p>Manage users:</p>
	<form action = "admin.php" method = "post">
    	<?php
	    $sql_user = "SELECT * FROM users;";
		$result = mysqli_query($mysql_connection, $sql_user);
		$res_check = mysqli_num_rows($result);
		if ($res_check > 0)
	    {
			while ($row = mysqli_fetch_array($result))
				{
					echo "<form class=\"deleting\" action = \"delete_user.php\" method=\"post\"><div class=\"text-right\">";
					echo $row['login'];
						?></div>
						<input type="hidden" name="delete" value="<?php echo $row['id'];?>">
						<input class="delete_user" name = "Delete" type = "submit" value = "Delete">
             
						<input class="make-admin" name = "change" type = "text" placeholder = "change type" value ="">
						<input class="delete_user" name = "Modify" type = "submit" value = "Modify">
        				</form><?php
					}
					mysqli_free_result($result);
				}
				else
					echo "no users";
	    		?>

	<form action = "add_user_to_db.php" method = "post">
	<p>Add new user</p>
	<div class="line">
    <input class="adding" type = "text" name = "login" placeholder="Login" value=""/>
	<input class="adding" type = "text" name = "pass" placeholder="Password" value=""/>
	<input class="adding" type = "text" name = "email" placeholder="Email" value=""/>
    <input class="adding" type = "text" name = "type" placeholder="type" value=""/>
    <input class="add_to" type = "submit" name = "submit" value="ADD user" />
	</form>
</form>
</div></div>

<div class="manage_users">
	<p>Manage orders:</p>
	<form action = "admin.php" method = "post">
    	<?php
	    $sql_user = "SELECT * FROM orders;";
		$result = mysqli_query($mysql_connection, $sql_user);
		while ($row = mysqli_fetch_array($result))
				{
					echo "<form class=\"deleting\" action = \"modify_orders.php\" method=\"post\"><div class=\"text-right\">";
					echo $row['id'];
					echo "  ";
					echo $row['order_id'];
					echo "  ";
					echo $row['status'];
						?></div>
						<input type="hidden" name="id" value="<?php echo $row['id'];?>">
						<input class="delete_user" name = "Delete" type = "submit" value = "Delete">
             
						<input class="make-admin" name = "change" type = "text" placeholder = "change status" value ="">
						<input class="delete_user" name = "Modify" type = "submit" value = "Modify">
        				</form><?php
					}
					mysqli_free_result($result);
	    		?>
</form>
    </div></div>


<div class="manage_users">
	<p>Manage categories:</p>
	<form action = "admin.php" method = "post">
    	<?php
	    $sql_user = "SELECT * FROM categories;";
		$result = mysqli_query($mysql_connection, $sql_user);
		$res_check = mysqli_num_rows($result);
		if ($res_check > 0)
	    {
			while ($row = mysqli_fetch_array($result))
				{
					echo "<form class=\"deleting\" action = \"modify_category.php\" method=\"post\"><div class=\"text-right\">";
					echo $row['category_name'];
						?></div>
						<input type="hidden" name="delete" value="<?php echo $row['id'];?>">
						<input class="delete_user" name = "Delete" type = "submit" value = "Delete">
             
						<input class="make-admin" name = "change" type = "text" placeholder = "change type" value ="">
						<input class="delete_user" name = "Modify" type = "submit" value = "Modify">
        				</form><?php
					}
					mysqli_free_result($result);
				}
				else
					echo "no users";
	    		?>

	<form action = "create_cat.php" method = "post">
	<p>Add new Category</p>
	<div class="line">
	    <input class="adding" type = "text" name = "category" placeholder="Category name" value=""/>
	    <input class="add_to" type = "submit" name = "submit" value="ADD to db" />
	</form>
	</form>
    </div></div>

  <div class="manage_users">
	<p>Manage categories vs products:</p>
	<form action = "admin.php" method = "post">
    	<?php
	    $sql_user = "SELECT * FROM cat_prod ;";
		$result = mysqli_query($mysql_connection, $sql_user);
		$res_check = mysqli_num_rows($result);
		if ($res_check > 0)
	    {
			while ($row = mysqli_fetch_array($result))
				{
					echo "<form class=\"deleting\" action = \"modify_cat_prod.php\" method=\"post\"><div class=\"text-right\">";
					echo $row['prod_name'];echo $row['cat_name'];
						?></div>
						<input type="hidden" name="delete" value="<?php echo $row['id'];?>">
						<input class="delete_user" name = "Delete_cn" type = "submit" value = "Delete_cn">
             
						<input class="make-admin" name = "change" type = "text" placeholder = "change type" value ="">
						<input class="delete_user" name = "Modify" type = "submit" value = "Modify">
        				</form><?php
					}
					mysqli_free_result($result);
				}
				else
					echo "no users";
	    		?>

	<form action = "create_cat.php" method = "post">
		<p>Add new Category vs Product connection</p>
		<div class="line">
	    <input class="adding" type = "text" name = "category" placeholder="Category name" value=""/>
	    <input class="adding" type = "text" name = "product" placeholder="Product name" value=""/>
	    <input class="add_to" type = "submit" name = "submit" value="ADD to db" />
	</form>

    	</form> </div>
    </div>
</body>
</html>
