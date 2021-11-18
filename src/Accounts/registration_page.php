<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Register - Offbrand.pwr</title>
<!--    <link rel="stylesheet" href="style.css"/>  -->
</head>
    <body>
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
            $t_number   = $_POST['t_number'];
            $addres     = $_POST['address'];
            $pwd        = $_POST['pwd'];
            $post_code  = $_POST["post_code"];
            $city       = $_POST["city"];
            $care_of_address = $_POST["care_of_address"];
            $sha_pwd = sha1($pwd);

            //Checks so the user have written the same password twice
            if($_POST["pwd"] == $_POST["pwd2"]){
                $email_exist = $con->prepare("SELECT email_address FROM USERS WHERE email_address = ?");
                $email_exist->bind_param("s", $email_addres);
                $email_exist->execute();
                $email_exist->bind_result($email_addres_exists);
                $email_exist->fetch();
                $email_exist->close();
    
                $query   = $con->prepare("INSERT INTO USERS (first_name, last_name, email_address, t_number, address_1, pwd, address_2, 
                                    city, postal_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"); 
                $query -> bind_param("sssssssss", $first_name, $last_name, $email_addres, $t_number, $addres, $sha_pwd, $care_of_address, $city, $post_code);
                $query -> execute();
                $query->close();
    
        
                if ($email_addres_exists == "") {  //If a user with the submitted email already exists
                    echo "<div class='form'>
                    <h3>User Created Succesfully.</h3><br/>
                    <p class='link'>Click here to <a href='/Accounts/login_page.php'>Log in</a>.</p>
                    </div>";
                }else{ // Account creation successfull
                    echo "<div class='form'>
                    <h3>Email already in use.</h3><br/>
                    <p class='link'>Click here to <a href='registration_page.php'>register</a> again.</p>
                    </div>";
                }
                }else{//If the repeated password dosent match the first submitted one
                    echo "<div class='form'>
                    <h3>The repeated password differed from the first password</h3><br/>
                    <p class='link'>Click here to <a href='registration_page.php'>try again</a></p>
                    </div>";
                }
            }else{
                ?>
                <form class="form" action="" method="post">
                    <h1 class="login-title">Register</h1>
                    <label class="first_name">Enter First Name</label>
                    <input type="text" class="login-input" name="first_name" placeholder="First Name" required><br>
                    <label class="last_name">Enter Last Name</label>
                    <input type="text" class="login-input" name="last_name" placeholder="Last Name" required><br>
                    <label class="email_address">Enter Email Address</label>
                    <input type="email" class="login-input" name="email_address" placeholder="Example@gmail.com" required><br>
                    <label class="t_number">Enter Phone Number</label>
                    <input type="text" class="login-input" name="t_number" placeholder="xxxxxxxxxx" pattern="[0-9]{10}|[0-9]{3}-[0-9]{7}" require><br>
                    <label class="post_code">Enter Post Code</label>
                    <input type="text" class="login-input" name="post_code" placeholder="xxx xx"  pattern="[0-9]{5}|[0-9}{3} [0-9]{2}" required><br>
                    <label class="city">Enter City</label>
                    <input type="text" class="login-input" name="city" placeholder="City" required><br>
                    <label class="address_1">Enter Address</label>
                    <input type="text" class="login-input" name="address" placeholder="Examplestreet 12" required><br>
                    <label class="care_of_address">(Optional) Enter C/O</label>
                    <input type="text" class="login-input" name="care_of_address" placeholder="C/O"><br>
                    <label class="password_1">Enter Password</label>
                    <input type="password" class="login-input" name="pwd" placeholder="Password" required><br>
                    <label class="password_2">Repeat Password</label>
                    <input type="password" class="login-input" name="pwd2" placeholder="Repeat Password" required><br>
                    <input type="submit" name="submit" value="Register" class="login-button">
                    <p class="link">Already have an account?<a href="/Accounts/login_page.php"> Click here to Login</a></p>
                </form>
                <?php
            }
                ?>
    </body>
</html>