<!-- This page will display the admin frontend for our site -->
<?php 
  //Confirm that the admin is indeed logged in. 
  $path = $_SERVER['DOCUMENT_ROOT'];
  $path .= "/product_handling/check_admin.php";
  include_once($path);
?>
<!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="UTF-8">
      <link rel="stylesheet" href="/Css/admin_page.css">
      <title>Admin page - Offbrand.pwr</title>
    </head>
    <body>
      <div class="container">
        <header>
          <h1 onclick="go_to_start()" style='cursor: pointer; font-family: "Hoefler Text", "Baskerville old face", Garamond, "Times New Roman", serif; '>OFFBRAND</h1>
          <nav>
            <ul class="nav_menu">
              <li><a href="/index.php">Home</a></li>
              <li><a href="log_out.php"><i class="fa fa-sign-out"></i> Log out</a></li>
            </ul>
          </nav>
        </header>
        <main>
          <div class="admin_menu_container">
            <h1>Welcome Admin</h1>
            <h2>Admin Menu</h2>
            <ul class="admin_menu">
              <li><a href='/product_handling/add_category_form.php'>Add Category</a></li>
              <li><a href='/product_handling/add_product_form.php'>Add Product</a></li>
              <li><a href='/product_handling/edit_product_form.php'>Edit Product</a></li>
              <li><a href='/product_handling/remove_product_form.php'>Remove Product</a></li>
              <li><a href='/Accounts/delete_user_admin_form.php'>Delete User(s)</a></li>
              <li><a href='/Accounts/view_all_orders.php'>View All Orders</a></li>
            </ul>
          </div>
        </main>
	    </div>
      <script>
      function go_to_start(){
        window.location.href = "/index.php";
        exit;
      }
      </script>
    </body>
  </html>