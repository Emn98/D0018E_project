<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/Css/auth_failed.css">
 </head>
  <body>
     <?php

        session_start();

        //creates connection to database
        $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= "/database.php";
        include_once($path);

        $input_email = $_POST["email"];
        $input_pwd = $_POST["password"];
        $hashed_pwd = sha1($input_pwd);
    
        $query = $con->prepare("SELECT user_id FROM USERS WHERE email_address=? and pwd=?");
        $query->bind_param("ss", $input_email, $hashed_pwd);
        $query->execute();
        $query->bind_result($user_id);
        $query->fetch();
        $query->close();

        if(!isset($user_id)){
            //If user_id dosen't exists then the authentication failed. Display this to the user.
            echo "<div class='auth_failed_container'>";
            echo "<h1>The account information provided does not exist</h1>";
            echo "<br>";
            echo "<ul class='user_choices'>";
            echo "<li><p class='try again'>Click here to <a href='/Accounts/login_page_form.php'>try again</a></p></li>";
            echo "<li><p class='registration_link'>Don't have an account? <a href='/Accounts/registration_page.php'>Register here</a></p></li>";
            echo "</ul>";
            echo "</div>";
        }else{//if user_id is set then the user exists in the database
            //The user will now be seen as logged in by the site.
            $_SESSION["user_id"] = $user_id;
            $_SESSION["user_pwd"] = $hashed_pwd;

            if($_SESSION["user_id"] != 0){ 
                header("Location: user_page.php");//if user logged in go to user page.
                exit;
            }else{
                header("Location: admin_page.php");//if admin logged in go to admin page.
                exit;
            }
        }
     ?>
    </body>
</html>