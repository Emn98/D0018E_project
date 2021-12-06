<!-- This php script will delete a user from the database -->
<!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel='stylesheet' href='/Css/delete_user_response.css'>
      <title>Offbrand.pwr</title>
    </head>
    <body>
      <?php
        session_start();

        //Check so the user is logged in
        require("log_in_check.php");

        include("delete_user_help_func.php");

        //creates connection to database
        $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= "/database.php";
        include_once($path);

        //Admin want's to delete a user.
        if(isset($_POST["email"])){

          delete_user_cart_admin($_POST["user_id"]);//Delete the cart associated with the user. 

          $query = $con->prepare("DELETE FROM USERS WHERE email_address=?");
          $query->bind_param("s", $_POST["email"]);
          $query->execute();
          
          if($query->affected_rows == 0){//If no user with that email exists
            echo "div class='form'>";
            echo "<h3>No account with this email exist in the database<h3>";
            echo "<br>";
            echo "<a href='delete_user_admin_form.php'>Do you want to enter another email?</a>";
            echo "<br>";
            echo "<a href='/Accounts/admin_page.php'>Go back</a>";
            echo "</di>";
            $query->close();
            exit;
          }

          $query->close();
          $link = "/Accounts/delete_user_admin_form.php";
                
        }else{//User delete their own account

          //Delete the cart if user have one. 
          $path = $_SERVER['DOCUMENT_ROOT'];
          $path .= "/Shopping/delete_cart.php";
          include_once($path);

          $query = $con->prepare("DELETE FROM USERS WHERE user_id=?");
          $query->bind_param("i", $_SESSION["user_id"]);
          $query->execute();
          $query->close();
          session_destroy();
          $link = "/index.php";
        }
      ?>
      <div class="form">
        <h3>Account deleted successfully</h3>
        <br> 
        <a href=<?php echo $link;?>>Click here to continue</a>
      </div>
    </body>
  </html>