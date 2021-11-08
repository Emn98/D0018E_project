<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
<!--    <link rel="stylesheet" href="style.css"/>  -->
</head>
<body>
<?php
    require('database.php');
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['first_name'])) {
        // removes backslashes
        $first_name = stripslashes($_REQUEST['First Name']);
        //escapes special characters in a string
        $first_name = mysqli_real_escape_string($con, $first_name);
        $last_name  = stripslashes($_REQUEST['Last Name']);
        $last_name  = mysqli_real_escape_string($con, $last_name);
        $email_addres = stripslashes($_REQUEST['Email']);
        $email_addres = mysqli_real_escape_string($con, $email_addres);
        $number   = stripslashes($_REQUEST['Telefone Number']);
        $number   = mysqli_real_escape_string($con, $number);
        $addres   = stripslashes($_REQUEST['Addres']);
        $addres   = mysqli_real_escape_string($con, $addres);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $query    = "INSERT INTO users (first_name, last_name, email_addres, number, addres, password)
                     VALUES ('$first_name','$last_name', '$email_addres', '$number', '$addres','" . sha1($password) ."')";
        $email_exist =  mysqli_query($con, "SELECT * FROM users
        WHERE email_addres = $email_addres");
        $result   = mysqli_query($con, $query);
        if ($email_exist) {
            echo "<div class='form'>
                <h3>Required fields are missing.</h3><br/>
                <p class='link'>Click here to <a href='registration_page.php'>registration</a> again.</p>
                </div>";
        elseif ($result) {
            echo "<div class='form'>
                  <h3>You are registered successfully.</h3><br/>
                  <p class='link'>Click here to <a href='login_page.php'>Login</a></p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='registration_page.php'>registration</a> again.</p>
                  </div>";
        }
    } else {
?>
    <form class="form" action="" method="post">
        <h1 class="login-title">Registration</h1>
        <input type="text" class="login-input" name="first_name" placeholder="First Name" required />
        <input type="text" class="login-input" name="last_name" placeholder="Last Name" required>
        <input type="text" class="login-input" name="email_addres" placeholder="Email Adress" required>
        <input type="text" class="login-input" name="number" placeholder="Phone Number" required>
        <input type="text" class="login-input" name="addres" placeholder="Addres" required>
        <input type="password" class="login-input" name="password" placeholder="Password" required>
        <input type="submit" name="submit" value="Register" class="login-button">
        <p class="link"><a href="login_page.php">Click to Login</a></p>
    </form>
<?php
    }
?>
</body>
</html>