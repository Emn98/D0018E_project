<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/Css/my_page.css">
    <title>Offbrand.pwr</title>
  </head>
  <body>
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
                drawPageLayout($first_name, $last_name, $tel_nr, $address, $input_email);
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
            $query = $con->prepare("SELECT first_name, last_name, email_addres, t_number, addres FROM USERS WHERE user_id=?");
            $query->bind_param("s", $_SESSION["user_id"]);
            $query->execute();
            $query->bind_result($first_name, $last_name, $email_address, $tel_nr, $address);
            $query->fetch();
            $query->close();

            drawPageLayout($first_name, $last_name, $tel_nr, $address, $email_address);
        }

        function drawPageLayout($first_name, $last_name, $tel_nr, $address, $email_address){
            //Draw out the header
            echo "<header>";
            echo "<h1><a href='/index.php'>OFF<span>BRAND</span></a></h1>";
            echo "<nav>";
            echo "<ul class='nav_menu'>";
            echo "<li><a href='log_out.php'>Log Out</a></li>";
            echo "</ul>";
            echo "</nav>";
            echo "</header>";
            
            //If the current user is logged in as admin, draw the admin page.
            if($_SESSION["user_id"] == 0){
                echo "<div class='admin_box'>";
                echo "<h1>Welcome admin</h1>";
                echo "<div class='inner_admin_box'>";
                echo "<ul class='admin_menu'>";
                echo "<li><a href='/product_handling/add_product_form.php'>Add Product</a></li>";
                echo "<li><a href='/product_handling/edit_product_form.php'>Edit product</a></li>";
                echo "<li><a href='/product_handling/remove_product_form.php'>Remove product</a></li>";
                echo "</ul>";
                echo "</div>";
                echo "</div>";
            }else{
                //The user is a normal user, draw the user page.
                echo "<div class='user_box'>";
                echo "<h1>Welcome $first_name </h1>";
                echo "<div class='inner_user_box'>";
                echo "<h2>Account Information</h2>";
                echo "<table>";
                echo "<tr>";
                echo "<th>Name</th>";
                echo "</tr>";
                echo "<tr>";
                echo "<th>$first_name $last_name</th>";
                echo "</tr>";
                echo "<tr>";
                echo "<th>Email address</th>";
                echo "</tr>";
                echo "<tr>";
                echo "<th>$email_address</th>";
                echo "</tr>";
                echo "<tr>";
                echo "<th>Telephone Number</th>";
                echo "</tr>";
                echo "<tr>";
                echo "<th>$tel_nr</th>";
                echo "</tr>";
                echo "<tr>";
                echo "<th>Address</th>";
                echo "</tr>";
                echo "<tr>";
                echo "<th>$address</th>";
                echo "</tr>";
                echo "</table>";
                echo "<div class='user_menu_box'>";
                echo "<ul class='user_menu'>";
                echo "<li><a href='#'>Edit user</a></li>";
                echo "<li><a href='#'>Delete user</a></li>";
                echo "</ul>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        }
    ?>
  </body>
</html>







