<!-- This php script destroys the current session and the user get's logged out -->
<?php
    session_start();
    session_destroy();
    header("Location: /index.php");
    exit;
?>
