<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/Css/edit_user.css">

    <title>Edit User</title>  
  </head>
  <body>
    
      <?php

        session_start();
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $first_name = $_POST['first_name'];
        $last_name  = $_POST['last_name'];
        $email_addres = $_POST['email_addres'];
        $t_number   = $_POST['t_number'];
        $addres     = $_POST['addres'];
        $pwd        = $_POST['pwd'];
        $post_code  = $_POST["post_code"];
        $city       = $_POST["city"];
        $care_of_address = $_POST["care_of_address"];
        $sha_pwd = sha1($pwd);
        // establish connection

        $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= "/database.php";
        include_once($path);

        $stmt = $con->prepare("UPDATE USERS SET first_name=?, last_name=?, email_addres=?,
         t_number=?, address_1=?, pwd=?, address_2=?, city=?, postal_code=? WHERE user_id = ?");

        // perform query
        $stmt->bind_param("sssSsssssi", $first_name, $last_name, $email_addres, $t_number, $addres, $sha_pwd, $care_of_address, $city, $post_code, $_SESSION["user_id"]);
        $stmt->execute();
        echo "<div class='form'>
            <h3>Information has Succesfully Been Changed.</h3><br/>
            <p class='link'>Click here to <a href='Accounts/login_page.php'>Log in</a>.</p>
            </div>";
        $con->close();
        
      ?>

    <form action="edit_user_form.php" method="post">
    <button type="submit" class="btn">Return</button>
    </form>

  </body>
</html>