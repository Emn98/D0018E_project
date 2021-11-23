<!--This page will allow the admin to write in the email of the user
    that the admin want to delete -->

<?php 
  require("log_in_check.php");//Checks so the user is logged in
?>
<!DOCTYPE html>
  <html>
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" href="/Css/admin_page.css">
      <title>Offbrand.pwr</title>
    </head>
    <body>
      <div class="container">
        <header>
          <h1>OFF<span>BRAND</span></h1>
          <nav>
            <ul class="nav_menu">
              <li><a href="/admin_page.php">Go Back</a></li>
              <li><a href="log_out.php"><i class="fa fa-sign-out"></i> Log out</a></li>
            </ul>
          </nav>
        </header>
        <main>
          <form class="delete_user_form" method="POST" action="delete_user.php">
            <h1 class="form_title">Delete User</h1>
            <div class="form_elements">
              <input type="email" class="delete_inp" id="delete_inp" placeholder="Example@gmail.com" name="email" autocomplete="off" required>
              <label class="form_label" for="email">Enter Email</label>
            </div>
            <button type="submit" class="delete_btn">Confirm</button>
          </form>
        </main>
	  </div>
    </body>
  </html>
        