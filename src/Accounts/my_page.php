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
                $_SESSION["email_addres"] = $input_email;
                $_SESSION["pwd"] = $hashed_pwd;

                drawPageLayout($first_name, $last_name, $tel_nr, $address);
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
        }else{//If customer already logged in, get the right information. 
            $query = $con->prepare("SELECT first_name, last_name, t_number, addres FROM USERS WHERE user_id=?");
            $query->bind_param("s", $_SESSION["user_id"]);
            $query->execute();
            $query->bind_result($first_name, $last_name, $tel_nr, $address);
            $query->fetch();
            $query->close();

            drawPageLayout($first_name, $last_name, $tel_nr, $address);
        }

        function drawPageLayout($first_name, $last_name, $tel_nr, $address){
            //If the current user is logged in as admin, draw the admin page.
            if($_SESSION["user_id"] == 0){
                echo "<div class='admin_box'>";
                echo "<h1>Welcome admin</h1>";
                echo "<div class='inner_admin_box'>";
                echo "<ul class='admin_menu'>";
                echo "<li><href='/product_handling/add_product_form.php'>Add Product</a></li>";
                echo "<li><href='/product_handling/edit_product_form.php'>Edit product</a></li>";
                echo "<li><href='/product_handling/remove_product_form'>Remove product</a></li>";
                echo "<li><href='log_out.php'>Log Out</a></li>";
            }else{

            }
        }
    ?>
  </body>
</html>







