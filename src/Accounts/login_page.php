<!-- This is the log in page for our e-comerce site -->
<?php
    //Checks to see if the input fields have been set.
    if(isset($_POST["email"]) and isset($_POST["password"])){
        //If both email and password have been entered resume to my_page.
        if(($_POST["email"]!= "") and $_POST["password"]!=""){
            header("Location: my_page.php");
            exit;
        }else{
            //Promt the user that you need to fill in both fields to log in. 
            echo '<script type="text/JavaScript">
                 alert("Please fill in both fields to log in");
                 </script>'
                 ;
        }
    }
?>
<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/Css/login_page.css">
    <title>Offbrand.pwr</title>
  </head>
  <body>
    <div class="login_box">
        <h1>Sign in</h1>
        <div class="login_form_box">
            <form class="login_form" method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <h2 class="login_inp_text">Enter Email</h2>
                <input type="text" class="login_inp" name="email">
                <br>
                <h2 class="login_inp_text">Enter Password</h2>
                <input type="text" class="login_inp" name="password">
                <br>
                <button type="submit" class="btn">Login</button>
                <p class="registration_link">Don't have an account? <a href="/registration_page.php">Register here</a></p>
            </form>
        </div>
    </div>
  </body>
</html>