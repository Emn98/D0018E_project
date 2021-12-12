<!--This script will check if the user is logged in, if not redirect to log in page -->
<?php
    session_start();
    if(!isset($_SESSION["user_id"])){
        header("Location: /Accounts/login_page_form.php");
        exit;
    }
?>