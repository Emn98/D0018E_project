<!-- This page will let the user edit his or her's account -->
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/Css/edit_user.css">
      <title>Edit Profile - Offbrand.pwr</title>
    <div>
      <h1>Edit Account</h1>
    </div>
  </head>
  <body>
    <?php
      session_start();

      //creates connection to database
      $path = $_SERVER['DOCUMENT_ROOT'];
      $path .= "/database.php";
      include_once($path);

      //Retrive the user's information from the database
      $query = $con->prepare("SELECT first_name, last_name, email_address, t_number, address_1, address_2, city, postal_code FROM USERS WHERE user_id=?");
      $query->bind_param("s", $_SESSION["user_id"]);
      $query->execute();
      $query->bind_result($first_name, $last_name, $email_address, $tel_nr, $address_1, $address_2, $city, $postal_code);
      $query->fetch();
      $query->close();
    ?>

    <div class="edit_user_box">
      <form action="edit_user.php" method="post">
        <label for="first_name">First Name</label>
        <input type="text" id="first_name" name="first_name" placeholder="First Name" <?php echo"value=$first_name"?>><br>
        <label for="last_name">Last Name</label>
        <input type="text" id="last_name" name="last_name" placeholder="Last Name" <?php echo"value=$last_name"?>><br>
        <label for="email_addres">Emali Address</label>
        <input type="email" id="email_addres" name="email_addres" placeholder="Email Address" <?php echo"value=$email_address"?>><br>
        <label for="t_number">Telefone Number</label>
        <input type="text" id="t_number" name="t_number" placeholder="xxxxxxxxxx" pattern="[0-9]{10}|[0-9]{3}-[0-9]{7}" <?php echo"value=$tel_nr"?>><br>
        <label for="post_code">Post Code</label>
        <input type="text" class="login-input" name="post_code" placeholder="postcode: xxx xx"  pattern="[0-9]{5}|[0-9}{3} [0-9]{2}" <?php echo"value=$postal_code"?>><br>
        <label for="city">City</label>
        <input type="text" class="login-input" name="city" placeholder="City" <?php echo"value=$city"?>><br>
        <label for="addres">Address</label>
        <input type="text" id="addres" name="addres" placeholder="Address" <?php echo"value=$address_1"?>><br>
        <label for="care_of_address">C/O</label>
        <input type="text" class="login-input" name="care_of_address" placeholder="C/O" <?php echo"value=$address_2"?>><br>
        <button type="submit" class="btn">Save changes</button>
      </form>
      <form>
        <input type="button" value="Cancel!" onclick="history.back()">
      </form>
    </div>
  </body>
</html>