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

        $first_name = $_POST['first_name'];
        $last_name  = $_POST['last_name'];
        $email_addres = $_POST['email_addres'];
        $t_number   = $_POST['t_number'];
        $addres     = $_POST['addres'];
        $post_code  = $_POST["post_code"];
        $city       = $_POST["city"];
        $care_of_address = $_POST["care_of_address"];

        // establish connection
        $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= "/database.php";
        include_once($path);

        $email_exist = $con->prepare("SELECT email_address FROM USERS WHERE email_address=? AND user_id!=?");
        $email_exist->bind_param("si", $email_addres, $_SESSION['user_id']);
        $email_exist->execute();
        $email_exist->bind_result($email_address_exists);
        $email_exist->fetch();
        $email_exist->close();


        if($email_address_exists == ""){
          $stmt = $con->prepare("UPDATE USERS SET first_name=?, last_name=?, email_address=?,
                                t_number=?, address_1=?, address_2=?, city=?, postal_code=? WHERE user_id = ?");
          $stmt->bind_param("ssssssssi", $first_name, $last_name, $email_addres, $t_number, $addres, $care_of_address, $city, $post_code, $_SESSION["user_id"]);
          $stmt->execute();
          $con->close();

          $hased_new_pwd = sha1($email_address.$_SESSION["user_pwd"]);

          $query = $con->prepare("UPDATE USERS SET pwd=? WHERE user_id=?");
          $query->bind_param("ss", $hased_new_pwd, $_SESSION["user_id"]) ;
          $query->execute();
          $query->close();

          $_SESSION["user_pwd"] = $hased_new_pwd;

          echo "<div class='form'>";
          echo "<h3>The information have been successfully changed.</h3>";
          echo "<p class='link'>Click here to <a href='/Accounts/user_page.php'>continue</a>.</p>";
          echo "<p class='link'>Click here to <a href='/Accounts/edit_user_form.php'>edit user</a>.</p>";
          echo "</div>"; 

        }else{
          echo "<div class='form'>";
          echo "<h3>New email already in use.</h3><br/>";
          echo "<p class='link'>Click here to <a href='/Accounts/user_page.php'>continue</a>.</p>";
          echo "<p class='link'>Click here to <a href='/Accounts/edit_user_form.php'>edit user</a>.</p>";
          echo "</div>"; 
        }
      ?>
  </body>
</html>