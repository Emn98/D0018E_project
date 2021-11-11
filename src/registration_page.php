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
if (isset($_POST['submit'])) {
    $first_name = $_POST['first_name'];
    $last_name  = $_POST['last_name'];
    $email_addres = $_POST['email_addres'];
    $t_number   = $_POST['t_number'];
    $addres     = $_POST['addres'];
    $pwd        = $_POST['pwd'];
    $sha_pwd = sha1($pwd);

        $email_exist = $con->prepare("SELECT email_addres FROM USERS WHERE email_addres = ?");
        $email_exist->bind_param("s", $email_addres);
        $email_exist->execute();
        $email_exist->bind_result($email_addres_exists);
        $email_exist->fetch();
        $email_exist->close();

        $query   = $con->prepare("INSERT INTO USERS (first_name, last_name, email_addres, t_number, addres, pwd)
                   VALUES (?, ?, ?, ?, ?, ?)"); 
        $query -> bind_param("sssiss", $first_name, $last_name, $email_addres, $t_number, $addres, $sha_pwd);
        $query -> execute();
        $query->close();

        echo $email_addres_exists;
        if ($email_addres_exists == "") {  
            echo "<div class='form'>
            <h3>User Created Succesfully.</h3><br/>
            <p class='link'>Click here to <a href='Accounts/login_page.php'>Log in</a>.</p>
            </div>";
        }
        else{
            echo "<div class='form'>
                 <h3>Email already in use.</h3><br/>
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
        <input type="text" class="login-input" name="t_number" placeholder="Phone Number" required>
        <input type="text" class="login-input" name="addres" placeholder="Addres" required>
        <input type="password" class="login-input" name="pwd" placeholder="Password" required>
        <input type="submit" name="submit" value="Register" class="login-button">
        <p class="link"><a href="Accounts/login_page.php">Click to Login</a></p>
    </form>
<?php
    }
?>
</body>
</html>