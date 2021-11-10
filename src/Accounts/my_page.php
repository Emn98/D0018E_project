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

            //if user_id is set then the user exists in the database
            if(isset($user_id)){
                $_SESSION["user_id"] = $user_id;//The user will now be seen as logged in.
                $_SESSION["first_name"] = $first_name;
                $_SESSION["last_name"] = $last_name;
                $_SESSION["t_number"]  = $tel_nr;
                $_SESSION["address"] = $address;
                $_SESSION["email_address"] = $input_email;
                $_SESSION["pwd"] = $hashed_pwd;
                drawPageLayout();
            }else{
                //If user_id dosen't exists then the authentication failed. Display this to the user.
                echo "<div class='auth_failed_container'>";
                echo "<div class='auth_failed_container_text'>";
                echo "The account information provided does not exist";
                echo "<br>";
                echo "</div>";
                echo "<a href='login_page.php'>try again</a>";
                echo "</div>";
            }
        }
        function drawPageLayout(){
            //If the current user is logged in as admin, draw the admin page.
            if($_SESSION["user_id"] == 0){
                echo "<br>";
                echo "you are the admin";

            }else{

            }
        }
    ?>
  </body>
</html>







