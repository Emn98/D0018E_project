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

            //creates connection to database
            $path = $_SERVER['DOCUMENT_ROOT'];
            $path .= "/database.php";
            include_once($path);

            //Admin want's to delete a user.
            if(isset($_POST["email"])){
                if($_POST["email"] == "admin@gmail.com"){//If admin tries to delete the admin profile it wont work.
                    echo "<div class='form'>";
                    echo "<h3>you are not allowed to delete the admin profile</h3>";
                    echo "<br>";
                    echo "<a href='my_page.php'>Go back</a>";
                    echo "</div>";
                    exit;
                }else{
                    $query = $con->prepare("DELETE FROM USERS WHERE email_address=?");
                    $query->bind_param("s", $_POST["email"]);
                    $query->execute();
                    if($query->affected_rows == 0){//If no user with that email exists
                        echo "<div class='form'>";
                        echo "<h3>No account with this email exist in the database<h3>";
                        echo "<br>";
                        echo "<a href='delete_user_admin_form.php'>Do you want to enter another email?</a>";
                        echo "<br>";
                        echo "<a href='my_page.php'>Go back</a>";
                        echo "</div>";
                        $query->close();
                        exit;
                    }
                    $query->close();
                    $link = "/Accounts/my_page.php";
                }
            }else{//User delete their own account
                $query = $con->prepare("DELETE FROM USERS WHERE user_id=?");
                $query->bind_param("s", $_SESSION["user_id"]);
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