<!-- This php script will delete a user from the database -->
<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <title>Offbrand.pwr</title>
        </head>
        <body>
        <?php
            session_start();

            //creates connection to database
            $path = $_SERVER['DOCUMENT_ROOT'];
            $path .= "/database.php";
            include_once($path);

            //Admin want's to delete a user.
            if(isset($_POST["email"])){
                if($_POST["email"] == "admin"){
                    echo "you are not allowed to delete the admin profile";
                    echo "<a href='my_page.php'>Go back</a>";
                }else{
                    echo "admin delete stuff";
                    $query = $con->prepare("DELETE FROM USERS WHERE email_addres=?");
                    $query->bind_param("s", $_POST["email"]);
                    $query->execute();
                    printf("%d row deleted.\n", $query->affected_rows);
                    $query->close();
                    $link = "/Accounts/my_page.php";
                }
            }else{//User delete their own account
                $query = $con->prepare("DELETE FROM USERS WHERE user_id=?");
                $query->bind_param("s", $_SESSION["user_id"]);
                $query->execute();
                $query->close();
                session_destroy();
                $link = "/index.php";
                }
?>
            <h1>Account deleted successfully <a href=<?php echo $link;?>>Click here to continue</a></h1>
        </body>
    </html>