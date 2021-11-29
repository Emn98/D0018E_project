<?php

session_start();


if( $_SESSION['user_id'] != 0){
    header("Location: /Account/user_page.php");
    exit;
}