<!-- This page will let the user edit his or her's account -->
<?php 
  require("log_in_check.php");

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

  print_r($address_1);
?>
<!DOCTYPE html>
<html>
    <head>
      <meta charset="UTF-8">
      <link rel="stylesheet" href="/Css/edit_user_page.css">
      <title>Edit User - Offbrand.pwr</title>
    </head>
    <body>
    <div class="container">
      <header>
        <h1>OFF<span>BRAND</span></h1>
        <nav>
          <ul class="nav_menu">
            <li><a href="/Accounts/user_page.php">Go Back</a></li>
            <li><a href="log_out.php"><i class="fa fa-sign-out"></i> Log out</a></li>
          </ul>
        </nav>
      </header>
      <main>
        <form class="edit_user_form" method="post" action="edit_user.php">
          <h2 class="form_title">Edit User Information</h2>
          <div class="form_elements">
            <input type="text" id="first_name" name="first_name" placeholder="First Name" class="edit_user_inp" value=<?php echo $first_name ?> require>
            <label class="form_label" for="first_name">First Name</label>
          </div>
          <div class="form_elements">
            <input type="text" id="last_name" name="last_name" placeholder="Last Name" class="edit_user_inp" value=<?php echo $last_name ?> require>
            <label class="form_label" for="last_name">Last Name</label>
          </div>
          <div class="form_elements">
            <input type="email" id="email_addres" name="email_addres" placeholder="Example@gmail.com" class="edit_user_inp" value=<?php echo $email_address ?> require>
            <label class="form_label" for="email_addres">Email Address</label>
          </div>
          <div class="form_elements">
            <input type="text" id="t_number" name="t_number" placeholder="xxxxxxxxxx" pattern="[0-9]{10}" class="edit_user_inp" value=<?php echo $tel_nr ?> require>
            <label class="form_label" for="t_number">Telephone Number</label>
          </div>
          <div class="form_elements">
            <input type="text" id="post_code" name="post_code" placeholder="xxxxx"  pattern="[0-9]{5}" class="edit_user_inp" value=<?php echo $postal_code ?> require>
            <label class="form_label" for="post_code">Post code</label>
          </div>
          <div class="form_elements">
            <input type="text" id="city" name="city" placeholder="City" class="edit_user_inp" value=<?php echo $city ?> require>
            <label class="form_label" for="city">City</label>
          </div>
          <div class="form_elements">
            <input type="text" id="addres" name="addres" placeholder="Address" class="edit_user_inp" value=<?php echo $address_1 ?> require>
            <label class="form_label" for="addres">Address</label>
          </div>
          <div class="form_elements">
            <input type="text" id="care_of_address" name="care_of_address" placeholder="C/O" class="edit_user_inp" value=<?php echo $address_2 ?> require>
            <label class="form_label" for="care_of_address">C/O</label>
          </div>
          <button class="form_button">Save Changes</button>
        </form>
        <form class="change_password_form" action="change_password.php" method="POST">
          <h2 class="form_title">Change Password</h2>
          <div class="form_elements">
            <input type="password" id="old_password" name="old_password" placeholder="Current Password" class="edit_user_inp" required>
            <label class="form_label" for="old_password">Current Password</label>
          </div>
          <div class="form_elements">
            <input type="password" id="new_password_1" name="new_password_1" placeholder="New Password" class="edit_user_inp" required>
            <label class="form_label" for="new_password_1">New Password</label>
          </div>
          <div class="form_elements">
            <input type="password" id="new_password_2" name="new_password_2" placeholder="Confirm New Password" class="edit_user_inp" required>
            <label class="form_label" for="new_password_2">Confirm New Password</label>
          </div>
          <button class="form_button">Save Changes</button>
        </form>
        <form class="delete_user_form" method="" action="/Accounts/delete_user.php">
          <h2>Delete User</h2>
          <h3>PRESS THIS BUTTON TO DELETE THE USER</h3>
          <button class="delete_button">DELETE USER</button>
        </form>
      </main>
	</div>
  </body>
</html>




