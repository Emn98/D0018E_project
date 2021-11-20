<!-- This is the log in page for our e-comerce site -->
<!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/Css/login_page.css">
    <title>Login - Offbrand.pwr</title>
  </head>
  <body>
    <form class="login_form" method="post" action="authenticate_user.php">
      <h1 class="form_title">Login</h1>
      <div class="form_elements">
        <input type="email" id="email" name="email" class="login_input" autocomplete="off" required>
        <label for="email" class="form_label">Email</label>
      </div>
      <div class="form_elements">
        <input type="password" id="password" name="password" class="login_input" required>
        <label for="password" class="form_label">Password</label>
      </div>
        <button class="form_button">Login</button>
        <p class='registration_link'>Don't have an account? <a href='/Accounts/registration_page.php'>Register here</a></p>
    </form>
  </body>
</html>