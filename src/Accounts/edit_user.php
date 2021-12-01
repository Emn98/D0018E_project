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

        $email_exist = $con->prepare("SELECT email_address FROM USERS WHERE user_id!=?");
        $email_exist->bind_param("i", $_SESSION['user_id']);
        $email_exist->execute();
        $email_exist->bind_result($email_addres_exists);
        $email_exist->fetch();
        $email_exist->close();

        if($email_addres_exists == ""){
          $stmt = $con->prepare("UPDATE USERS SET first_name=?, last_name=?, email_address=?,
         t_number=?, address_1=?, address_2=?, city=?, postal_code=? WHERE user_id = ?");

          // perform query
          $stmt->bind_param("ssssssssi", $first_name, $last_name, $email_addres, $t_number, $addres, $care_of_address, $city, $post_code, $_SESSION["user_id"]);
          $stmt->execute();
          $con->close();

          echo "<div class='form'>";
          echo "<h3>Information has Succesfully Been Changed.</h3><br/>";
          echo "<p class='link'>Click here to <a href='/Accounts/user_page.php'>go back</a>.</p>";
          echo "</div>"; 

        }else{
          echo "<div class='form'>";
          echo "<h3>New Email already in use.</h3><br/>";
          echo "<p class='link'>Click here to <a href='/Accounts/edit_user_form.php'>go back</a>.</p>";
          echo "</div>"; 
        }
      ?>

    <form action="edit_user_form.php" method="post">
    <button type="submit" class="btn">Return</button>
    </form>

  </body>
</html>