<!-- This page will allowe the admin to delete users -->
<?php
  
  //Confirm that the admin is indeed logged in. 
  $path = $_SERVER['DOCUMENT_ROOT'];
  $path .= "/product_handling/check_admin.php";
  include_once($path);

  session_start();

  //creates connection to database
  $path = $_SERVER['DOCUMENT_ROOT'];
  $path .= "/database.php";
  include_once($path);

  $inp = 0;

  //If the search bar is used to look for specific accounts. 
  if(isset($_POST["user_name"]) && $_POST["user_name"]!= ""){

    $search_word = (int)$_POST["user_name"];

    $query = $con->prepare("SELECT user_id, order_id, purchase_date FROM ORDERS WHERE user_id=? or order_id=?");
    $query->bind_param("ii", $search_word,$search_word);
    $query->execute();
    $result = $query->get_result();
    $query->fetch();
    $query->close();
    
  }else{
    $query = $con->prepare("SELECT user_id, order_id, purchase_date FROM ORDERS WHERE user_id>?");
    $query->bind_param("i", $inp);
    $query->execute();
    $result = $query->get_result();
    $query->fetch();
    $query->close();
  }
?>
<!DOCTYPE html>
  <html>
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" href="/Css/admin_delete_page.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script><!-- Include JQuery library -->
      <title>Offbrand.pwr - delete user</title>
    </head>
    <body>
      <div class="container">
        <header>
          <h1>OFF<span>BRAND</span></h1>
          <nav>
            <ul class="nav_menu">
              <li><a href="/index.php"><i class="fa fa-sign-out"></i>Home</a></li>
              <li><a href="/Accounts/site_director.php">My Page</a></li>
            </ul>
          </nav>
        </header>
        <div class="user_container">
          <div class="search_bar_container">
            <form class="search_bar_form" method="POST" action="">
              <input class="search_bar_inp" type="text" name="user_name" placeholder="Search by user id or order id">
              <button type="submit"><i class="fa fa-search"></i>Search</button>
            </form>
          </div>
          <div class="inner_user_container">
            <h2>Registered users</h2>
            <table>
              <thead>
                <tr>
                  <th>Order Id</th>
                  <th>User Id</th>
                  <th>Email</th>
                  <th>Purchase Date</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <form class="view_order" action="/Shopping/view_order_details.php" method="POST">
                  <input type="hidden" class="form_inp" name="order_id" value="">
                </form>
                <?php
                  $temp = 1;
                  while ($row = $result->fetch_assoc()) {
                    $user_id = $row["user_id"];
                    $order_id = $row["order_id"]; 
                    $purchase_date = $row["purchase_date"]; 

                    $query = $con->prepare("SELECT email_address FROM USERS WHERE user_id=?");
                    $query->bind_param("i", $user_id);
                    $query->execute();
                    $query->bind_result($email_address);
                    $query->fetch();
                    $query->close();

                    if($temp == 1){
                      echo "<tr class='table_row_odd'>";
                      echo "<td>$order_id</td>";
                      echo "<td>$user_id</td>";
                      echo "<td>$email_address</td>";
                      echo "<td>$purchase_date</td>";
                      echo "<td>";
                      ?>
                      <!-- Sends the value of the user_id and email to javascript function when the button is pressed. -->
                      <input type="button" value="View" onclick="view('<?php echo $order_id; ?>')" class="view_btn">
                      <?php
                      echo "</td>";
                      echo "</tr>";
                      $temp = 0;
                    }else{
                      echo "<tr class='table_row_even'>";
                      echo "<td>$order_id</td>";
                      echo "<td>$user_id</td>";
                      echo "<td>$email_address</td>";
                      echo "<td>$purchase_date</td>";                     
                      echo "<td>";
                      ?>
                      <!-- Sends the value of the user_id and email to javascript function when the button is pressed. -->
                      <input type="button" value="View" onclick="view('<?php echo $order_id; ?>')" class="view_btn">
                      <?php
                      echo "</td>";
                      echo "</tr>";
                      $temp = 1;
                      $form_id++;
                    }
                  }
                ?>
              </tbody>
            </table>
	        </div>
        </div>
        <div class="left_side"></div>
        <div class="right_side"></div>
      </div>
      <script>
        function view(id){
          var order_id = id;
          $('.form_inp').attr("value",order_id);//Insert the value of the category into the form on line 24. 
          $('.view_order').submit(); //Submit the form. 
       }
      </script>
    </body>
  </html>      