<?php
    include 'db_connect.php';
     session_start();
     $cat = 'Other';
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Vintage life</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <header>
        <h1>Vintage your world</h1>
        
        <form method='post' action='basket.php'>
            <input id="basket" type='submit' name="basket" value='Basket' />
        </form>
        <button id="signin" type = "submit">Sign in</button>
        <div id="sign_in" class="modal">
            <div class="modal-content">
                <form action = "login.php" method = "post">
                    <input type = "text" name = "login" placeholder="Your login" />
                    <br />
                    <br />
                    <input type = "password" placeholder="Your password" name="pass" />
                    <input type = "submit" value="Sign in" />
                </form>
                <span class="close">&times;</span>
            </div>
        </div>
        <button id="signup" type = "submit">Sign up</button>
        <div id="sign_up" class="modal2">
            <div class="modal-content">
                <form action = "create.php" method = "post">
                    <input type = "text" name="login" placeholder="Your login"/>
                    <br />
                    <input type = "password" placeholder="Your password" name="pass"/>
                    <input type = "submit" name="submit" value="Sign up" />
                </form>
                <span class="close">&times;</span>
            </div>
        </div>

        <?php
        if ($_SESSION['loggued_on_user'])
        {
            echo "Welcome ".$_SESSION['loggued_on_user']."\n";
        ?>
            <form method='post' action='logout.php'>
                <input type='submit' class="logout" value='Log out' />
            </form>
        <?php
        }
        else
            $_PHP_SELF;
    ?>
        
    </header>
     <content class="cont">
        <div class="cover">
             <?php require 'filter.php'; ?>
        </div>
     </content>
      
      
   </body>
   <footer>
       <script type="text/javascript">
        var modal = document.getElementById('sign_in');
        var btn = document.getElementById("signin");
        var modal2 = document.getElementById('sign_up');
        var btn2 = document.getElementById("signup");
        var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}
btn2.onclick = function() {
    modal2.style.display = "block";
}
// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
    modal2.style.display = "none";
}
// span.onclick = function() {
//     modal2.style.display = "none";
// }
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
        
    }
    else if (event.target == modal2)
    {
        modal2.style.display = "none";
    }
}
       </script>
   </footer>
</html>