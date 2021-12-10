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

        //creates connection to database
        $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= "/database.php";
        include_once($path);

        //Inlcide help functions
        include("delete_user_help_func.php");

        //Admin want's to delete a user.
        if(isset($_POST["user_id"])){
          $user_id = (int) $_POST["user_id"];

         
          delete_user_cart($user_id);//Delete the cart associated with the user.
          delete_user_orders($user_id);//Delete all orders associated with the user.
          delete_user_reviews($user_id);//Delete all reviews associated with the user.
            

          $query = $con->prepare("DELETE FROM USERS WHERE user_id=?");
          $query->bind_param("i", $user_id);
          $query->execute();
          $query->close();
                
        }else{//User delete their own account
          $user_id = $_SESSION["user_id"];
 
          delete_user_cart($user_id);//Delete the cart associated with the user.
          delete_user_orders($user_id);//Delete all orders associated with the user.
          delete_user_reviews($user_id);//Delete all reviews associated with the user.
            
          $query = $con->prepare("DELETE FROM USERS WHERE user_id=?");
          $query->bind_param("i", $user_id);
          $query->execute();
          $query->close();
          session_destroy();
        }
      ?>
      <div class="form">
        <h3>Account deleted successfully</h3>
        <br> 
        <a href="/index.php">Click here to continue</a>
      </div>
    </body>
  </html>