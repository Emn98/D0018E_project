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

    $search_word = $_POST["user_name"];
    $search_word_prepare = "%$search_word%";
    
    $query = $con->prepare("SELECT user_id, email_address, first_name, last_name FROM USERS WHERE user_id>? and email_address LIKE ? OR first_name LIKE ? OR Last_name LIKE ?");
    $query->bind_param("isss", $inp, $search_word_prepare, $search_word_prepare, $search_word_prepare );
    $query->execute();
    $result = $query->get_result();
    $query->fetch();
    $query->close();
  }else{
    $query = $con->prepare("SELECT user_id, email_address, first_name, last_name FROM USERS WHERE user_id>?");
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
        <h1 onclick="go_to_start()" style="cursor: pointer;">OFFBRAND</h1>
          <nav>
            <ul class="nav_menu">
              <li><a href="/Accounts/site_director.php">Back</a></li>
            </ul>
          </nav>
        </header>
        <div class="user_container">
          <div class="search_bar_container">
            <form class="search_bar_form" method="POST" action="">
              <input class="search_bar_inp" type="text" name="user_name" placeholder="Search user...">
              <button type="submit"><i class="fa fa-search"></i>Search</button>
            </form>
          </div>
          <div class="inner_user_container">
            <h2>Registered users</h2>
            <table>
              <thead>
                <tr>
                  <th>User_id</th>
                  <th>Email</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $temp = 1;
                  while ($row = $result->fetch_assoc()) {
                    $user_id = $row["user_id"];
                    $email_address = $row["email_address"]; 
                    $first_name = $row["first_name"]; 
                    $last_name = $row["last_name"];
                
                    if($temp == 1){
                      echo "<tr class='table_row_odd'>";
                      echo "<td>$user_id</td>";
                      echo "<td>$email_address</td>";
                      echo "<td>$first_name</td>";
                      echo "<td>$last_name</td>";
                      echo "<td>";
                      ?>
                      <!-- Sends the value of the user_id and email to javascript function when the button is pressed. -->
                      <input type="button" value="Delete" onclick="delete_user('<?php echo $user_id ?>', '<?php echo $email_address ?>')" class="delete_btn">
                      <?php
                      echo "</td>";
                      echo "</tr>";
                      $temp = 0;
                    }else{
                      echo "<tr class='table_row_even'>";
                      echo "<td>$user_id</td>";
                      echo "<td>$email_address</td>";
                      echo "<td>$first_name</td>";
                      echo "<td>$last_name</td>";
                      echo "<td>";
                      ?>
                      <!-- Sends the value of the user_id and email to javascript function when the button is pressed. -->
                      <input type="button" value="Delete" onclick="delete_user('<?php echo $user_id ?>', '<?php echo $email_address ?>')" class="delete_btn">
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
        function delete_user(id, email){
          if (confirm("Would you like to delete user "+ id + " with the email: " + email)){
            $.ajax({
                type: "POST",
                url:  "delete_user.php", // 
                data: {user_id: id},                
                success: function(){
                  alert("User deleted successfully!");
                  location.reload();
                },
                error: function(){
                    alert("failure");
                }
            });
          }
        }

        function go_to_start(){
          window.location.href = "/index.php";
          exit;
        }
      </script>
    </body>
  </html>      