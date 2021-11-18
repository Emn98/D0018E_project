<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/Css/product.css">
      <title>Edit Information</title>
    <div>
      <h1>Edit Account</h1>
    </div>
  </head>
  <body>
    <div class="edit_user_box">
        <form action="edit_user.php" method="post">
        <label for="first_name">First Name</label>
        <input type="text" id="first_name" name="first_name" placeholder="First Name" required><br>
        <label for="last_name">Last Name</label>
        <input type="text" id="last_name" name="last_name" placeholder="Last Name" required><br>
        <label for="email_addres">Emali Address</label>
        <input type="email" id="email_addres" name="email_addres" placeholder="Email Address" required><br>
        <label for="t_number">Telefone Number</label>
        <input type="tel" id="t_number" name="t_number" placeholder="Telefone Number" pattern="[0-9]{10}"required><br>
        <label for="post_code">Post Code</label>
        <input type="text" class="login-input" name="post_code" placeholder="postcode: xxx xx"  pattern="[0-9]{3} [0-9]{2}" required><br>
        <label for="city">City</label>
        <input type="text" class="login-input" name="city" placeholder="City" required><br>
        <label for="addres">Address</label>
        <input type="text" id="addres" name="addres" placeholder="Address" required><br>
        <label for="care_of_address">C/O</label>
        <input type="text" class="login-input" name="care_of_address" placeholder="C/O"><br>
        <label for="pwd">Password</label>
        <input type="text" id="pwd" name="pwd" placeholder="Password" required><br>
        <button type="submit" class="btn">Send</button>
        </form>
        <form action="/Accounts/my_page.php" method="post">
          <button type="submit" class="btn">Return</button>
        </form>
      </div>
  </body>
</html>