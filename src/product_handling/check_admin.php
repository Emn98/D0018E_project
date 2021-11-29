<?php

session_start();


if( $_SESSION["user_id"] != 0){
    header("Location: /Accounts/user_page.php");
    exit;
}