<!-- This page will allowe the admin to delete users -->
<?php
  
  require("log_in_check.php");//Checks so the user is logged in

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
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script><!-- Include JQuery library -->
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
                  $form_id = 0;
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
                      echo "<form method='POST' action='delete_user_admin_confirm.php'>";
                      echo gettype($email_address);
                      echo gettype($user_id);
                      echo "<input type='button' value='Delete' onclick='dosomething(\"" . $user_id . $email_address . "\")' class='delete_btn'>";
                      echo "</td>";
                      echo "</tr>";
                      $temp = 0;
                      $form_id++;
                    }else{
                      echo "<tr class='table_row_even'>";
                      echo "<td>$user_id</td>";
                      echo "<td>$email_address</td>";
                      echo "<td>$first_name</td>";
                      echo "<td>$last_name</td>";
                      echo "<td>";
                      echo "<form method='POST' action='delete_user_admin_confirm.php' name='user_form'>";
                      echo "<button class='delete_btn' type='submit'>Delete</button>";
                      echo "<input type='hidden' name='delete_user_id' value=$user_id>";
                      echo "<input type='hidden' name='delete_user_email' value=$email_address>";
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
        function dosomething(val, vall){
          console.log(val, vall);
        }
      </script>
    </body>
  </html>
        