<?php 
  //creates connection to database
  $path = $_SERVER['DOCUMENT_ROOT'];
  $path .= "/database.php";
  include_once($path);

  // When form submitted, insert values into the database.
  if (isset($_POST['submit'])) {  
    $first_name = $_POST['first_name'];
    $last_name  = $_POST['last_name'];
    $email_addres = $_POST['email_address'];
    $t_number   = $_POST['phone_nr'];
    $addres     = $_POST['address'];
    $pwd        = $_POST['pwd'];
    $post_code  = $_POST["post_code"];
    $city       = $_POST["city"];
    $care_of_address = $_POST["care_of_address"];

      //Checks so the user have written the same password twice
    if($_POST["pwd"] == $_POST["pwd2"]){
      $email_exist = $con->prepare("SELECT email_address FROM USERS WHERE email_address = ?");
      $email_exist->bind_param("s", $email_addres);
      $email_exist->execute();
      $email_exist->bind_result($email_addres_exists);
      $email_exist->fetch();
      $email_exist->close();

      if ($email_addres_exists == "") { // Account creation successfull
        $sha_pwd = sha1($email_addres.$pwd);//Salt password with email address
        $query   = $con->prepare("INSERT INTO USERS (first_name, last_name, email_address, t_number, address_1, pwd, address_2, 
        city, postal_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"); 
        $query -> bind_param("sssssssss", $first_name, $last_name, $email_addres, $t_number, $addres, $sha_pwd, $care_of_address, $city, $post_code);
        $query -> execute();
        $query->close();
                ?>
                <div class='form'>
                  <h3>User Created Succesfully.</h3><br/>
                  <p class='link'>Click here to <a href='/Accounts/login_page_form.php'>Log in</a>.</p>
                </div>
                <?php
                Dont_draw_out_form();
                
            }else{ //If a user with the submitted email already exists
                ?>
                <div class='form'>
                  <h3>Email already in use.</h3><br/>
                  <p class='link'>Click here to <a href='registration_page_2.php'>register with another email</a>.</p>
                </div>
                <?php
                Dont_draw_out_form();    
        }
        }else{//If the repeated password dosent match the first submitted one
          ?>
          <div class='form'>
            <h3>The repeated password differed from the first password</h3><br/>
            <p class='link'>Click here to <a href='registration_page_2.php'>try again</a></p>
          </div>";
          <?php
          Dont_draw_out_form();   
        }
    }
?>
<!DOCTYPE html>
 <html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/Css/reg_page_2.css">
    <title>My Page - Offbrand.pwr</title>
  </head>
  <body>
    <form class="registration_form" method="post" action="">
      <h1 class="form_title">Register</h1>
      <div class="form_elements">
        <input type="text" id="first_name" name="first_name" class="register_input" placeholder="First Name" required>
        <label for="first_name" class="form_label">Enter First Name</label>
      </div>
      <div class="form_elements">
        <input type="text" id="last_name" name="last_name" class="register_input" placeholder="Last Name" required>
        <label for="last_name" class="form_label">Enter Last Name</label>
      </div>
      <div class="form_elements">
        <input type="email" id="email_address" name="email_address" class="register_input" placeholder="Example@gmail.com" required>
        <label for="email_address" class="form_label">Enter Email Address</label>
      </div>
      <div class="form_elements">
        <input type="text" id="phone_nr" name="phone_nr" class="register_input" placeholder="xxxxxxxxxx" pattern="[0-9]{10}" required>
        <label for="phone_nr" class="form_label">Enter Phone Number</label>
      </div>
      <div class="form_elements">
        <input type="text" id="post_code" name="post_code" class="register_input" placeholder="xxxxx"  pattern="[0-9]{5}" required>
        <label for="post_code" class="form_label">Enter Post Code</label>
      </div>
      <div class="form_elements">
        <input type="text" id="city" name="city" class="register_input" placeholder="City" required>
        <label for="city" class="form_label">Enter City</label>
      </div>
      <div class="form_elements">
        <input type="text" id="address" name="address" class="register_input" required placeholder="Examplestreet 12">
        <label for="address" class="form_label">Enter Address</label>
      </div>
      <div class="form_elements">
        <input type="text" id="care_of_address" name="care_of_address" class="register_input" placeholder="C/O">
        <label for="care_of_address" class="form_label">(Optional) Enter C/O</label>
      </div>
      <div class="form_elements">
        <input type="password" id="pwd" name="pwd" class="register_input" placeholder="Password"  required>
        <label for="pwd" class="form_label">Enter Password</label>
      </div>
      <div class="form_elements">
        <input type="password" id="pwd2" name="pwd2" class="register_input" placeholder="Confirm Password" required>
        <label for="pwd2" class="form_label">Repeat Password</label>
      </div>
      <button class="form_button" name="submit">Register</button>
      <p class="link">Already have an account?<a href="/Accounts/login_page_form.php"> Click here to Login</a></p>
    </form>
  </body>
</html>

<?php
    function Dont_draw_out_form(){//Makes it so the form dosen't show up on the page. 
        echo "<link rel='stylesheet' href='/Css/reg_page_2.css'>";
        exit;
    }

?>