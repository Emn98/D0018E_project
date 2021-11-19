<!--This php script will update the user's password to the new one if he/she..
    have put in the right old password-->
<!DOCTYPE html>
    <html lang="en">
        <header>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
        </header>
        <body>
            <?php
                session_start();
                
                $user_id    = $_SESSION["user_id"];
                $stored_pwd = $_SESSION["user_pwd"];
                $old_pwd    = $_POST["old_password"];
                $new_pwd_1  = $_POST["new_password_1"];
                $new_pwd_2  = $_POST["new_password_2"];

                //If the stored password does not match the users old password input  
                if($new_pwd_1 != $new_pwd_2 ){
                    echo "<div class='wrong_old_pwd_container'>";
                    echo "<h1>The confirm new password does not match the new password.</h1>";
                    echo "<br>";
                    echo "<a href='/Accounts/edit_user_form.php'>try again</a>";
                    echo "</div>";
                }elseif($stored_pwd != sha1($old_pwd)){//If the user entered the wrong old password.
                    echo "<div class='wrong_old_pwd_container'>";
                    echo "<h1>The old password does not match the current saved password for this user.</h1>";
                    echo "<br>";
                    echo "<a href='/Accounts/edit_user_form.php'>try again</a>";
                    echo "</div>";
                }else{
                    //creates connection to database
                    $path = $_SERVER['DOCUMENT_ROOT'];
                    $path .= "/database.php";
                    include_once($path);

                    $hased_new_pwd = sha1($new_pwd_1);

                    $query = $con->prepare("UPDATE USERS SET pwd=? WHERE user_id=?");
                    $query->bind_param("ss", $hased_new_pwd, $user_id);
                    $query->execute();
                    $query->close();
                    
                    header("Location: /Accounts/edit_user_form.php");
                    exit;
                }
            ?>
        </body>
    </html>