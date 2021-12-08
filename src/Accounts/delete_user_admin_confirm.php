<!-- This will be the admins confirmation page when deleteing a user -->
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
        print_r($_POST);
        $user_id = $_POST["delete_user_id"];
        $email = $_POST["delete_user_email"];
      ?>
      <div class='form'>
          <h3>Would you like to delete user <?php echo $user_id ?> with the email: <?php echo $email ?>?</h3>
          <form method="POST" name="forms" action="delete_user.php">
              <input type="hidden" name="email" value=<?php echo $email ?>>
              <input type="hidden" name="user_id" value=<?php echo $user_id ?>>
              <button type="submit">Confirm</button>
          </form>
          <form method="POST" action="delete_user_admin_form.php">
            <button type="submit">Cancel</button>
          </form>
    </body>
</html>   
      