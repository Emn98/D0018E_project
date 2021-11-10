<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
<!--    <link rel="stylesheet" href="style.css"/>  -->
</head>
<body>
<?php
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/database.php";
    include_once($path);
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['first_name'])) {
        // removes backslashes
        $first_name = stripslashes($_REQUEST['first_name']);
        //escapes special characters in a string
        $first_name = mysqli_real_escape_string($con, $first_name);
        $last_name  = stripslashes($_REQUEST['last_name']);
        $last_name  = mysqli_real_escape_string($con, $last_name);
        $email_addres = stripslashes($_REQUEST['email']);
        $email_addres = mysqli_real_escape_string($con, $email_addres);
        $t_number   = stripslashes($_REQUEST['t_number']);
        $t_number   = mysqli_real_escape_string($con, $t_number);
        $addres   = stripslashes($_REQUEST['addres']);
        $addres   = mysqli_real_escape_string($con, $addres);
        $pwd = stripslashes($_REQUEST['pwd']);
        $pwd = mysqli_real_escape_string($con, $pwd);
        $sha_pwd = sha1($pwd);
        $query    = $con->prepare("INSERT INTO USERS (first_name, last_name, email_addres, t_number, addres, pwd)
                   VALUES (?, ?, ?, ?, ?, ?)"); 
        $query -> bind_param("sssiss", $first_name, $last_name, $email_addres, $t_number, $addres, $sha_pwd);
        $query -> execute();
        
        //$email_exist = $con -> prepare("SELECT * FROM USERS WHERE email_addres = ?");
        //$email_exist->bind_param("s", $email_addres);
        //$email_exist->execute();

        $result = $query->get_result();
        //$email_exist_result = $email_exist -> get_result();

        //if ($email_exist_result) {
        //    echo "<div class='form'>
        //        <h3>Required fields are missing.</h3><br/>
        //        <p class='link'>Click here to <a href='registration_page.php'>registration</a> again.</p>
        //        </div>";
        //if ($result) {              
        //    echo "<div class='form'>
        //          <h3>You are registered successfully.</h3><br/>
        //          <p class='link'>Click here to <a href='login_page.php'>Login</a></p>
        //          </div>";
        //} 
        else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='registration_page.php'>registrater</a> again.</p>
                  </div>";
        }
    } else {
?>
    <form class="form" action="registration_page.php" method="post">
        <h1 class="login-title">Registration</h1>
        <input type="text" class="login-input" name="first_name" placeholder="First Name" required />
        <input type="text" class="login-input" name="last_name" placeholder="Last Name" required>
        <input type="text" class="login-input" name="email_addres" placeholder="Email Adress" required>
        <input type="text" class="login-input" name="t_number" placeholder="Phone Number" required>
        <input type="text" class="login-input" name="addres" placeholder="Addres" required>
        <input type="password" class="login-input" name="pwd" placeholder="Password" required>
        <input type="submit" name="submit" value="Register" class="login-button">
        <p class="link"><a href="login_page.php">Click to Login</a></p>
    </form>
<?php
    }
?>
</body>
</html>