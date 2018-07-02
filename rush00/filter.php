<?php
    include 'db_connect.php';
     session_start();
$odd = 0;
$cat = $_POST['category'];

$sql_pr = "SELECT id, prod_name, category, price, image_pr, description
            FROM products
            ;";
$res = mysqli_query($mysql_connection, $sql_pr);
$res_check = mysqli_num_rows($res);
if ($res_check > 0)
    {
        while ($row = mysqli_fetch_array($res)) {

            if ($row['category'] == $cat)
            {

                $odd++;
                if ($odd % 2 == 0)
                {?>
                    <div class="card right">
                <?php ;}
                else {?>
                    <div class="card left">
                <?php ;}
                $img = $row['image_pr'];
                echo "<img class=\"incard\" src='$img'>";
                ?>
                    <div><?php echo $row['prod_name']; ?></div>
                    <div class="price_block"><?php echo $row['price'];?></div>
                    <div><?php echo $row['description']."\n";?></div>
                <form method='post' action='add_to_basket.php'>
                <button type="sumbit" name="id" value="<?php echo $row['id']; ?>" class="add">Add to basket</button>
                </form>
                  </div>
                <?php ; }
            }
            
            mysqli_free_result($res);

        }
        else
            echo 'no items';


?>
