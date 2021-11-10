<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="Css/my_page.css">
    <title>Offbrand.pwr</title>
  </head>
  <body>
    <header>
      <h1><a href="/index.php">OFF<span>BRAND</span></a></h1>
    </header>
    <?php
        session_start();

        //creates connection to database
        $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= "/database.php";
        include_once($path);

        //If customerID is not already set then the user is not logged in. 
        if(!isset($_SESSION["user_id"])){
            $input_email = $_POST["email"];
            $input_pwd = $_POST["password"];
            $hashed_pwd = sha1($input_pwd);

            $query = $con->prepare("SELECT first_name, last_name, t_number, addres, user_id FROM USERS WHERE email_addres=? and pwd=?");
            $query->bind_param("ss", $input_email, $hashed_pwd);
            $query->execute();
            $query->bind_result($first_name, $last_name, $tel_nr, $address, $user_id);
            $query->fetch();
            $query->close();

            //if user_id exists then the user exists in the database
            if($user_id != ""){
                $_SESSION["user_id"] = $user_id;//The user will now be seen as logged in. 
                drawPageLayout($first_name, $last_name, $tel_nr, $address, $user_id, $input_email);
            }else{
                //If user_id dosen't exists then the authentication failed. Display this to the user.
                echo "user don't exist";
                echo "<div class='auth_failed_container'>";
                echo "<div class='auth_failed_container_text'>";
                echo "Wrong account information";
                echo "<br>";
                echo "</div>";
                echo "<a href='login_page.php'>try again</a>";
                echo "</div>";
            }
        }else{
            $query = $con->prepare("SELECT first_name, last_name, email_addres, t_number, addres FROM USERS WHERE user_id=?");
            $query->bind_param("s", $_SESSION["user_id"]);
            $query->execute();
            $query->bind_result($first_name, $last_name, $email, $tel_nr, $address);
            $query->fetch();
            $query->close();

            drawPageLayout($first_name, $last_name, $tel_nr, $address, $_SESSION["user_id"], $email);
        }

        function drawPageLayout($first_name, $last_name, $tel_nr, $address, $user_id, $email){
            //If the current user is logged in as admin, draw the admin page.
            if($user_id == 0){
                echo"you are the admin";

            }else{

            }
        }
    ?>
  </body>
</html>







