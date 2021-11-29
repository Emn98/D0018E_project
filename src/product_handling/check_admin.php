<?php

session_start();

if(!isset($_SESSION["user_id"])){
    header("Location: /Accounts/login_page_form.php");
    exit;
}

if( $_SESSION["user_id"] != 0){
    header("Location: /Accounts/user_page.php");
    exit;
}