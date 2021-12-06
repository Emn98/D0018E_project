<!-- This php page includes help functions for deleting user -->
<?php 

  /*This function will delete the shopping cart for a user about to...
    get deleted provided the user have one in the database */   
  function delete_user_cart_admin($user_id){

    echo "test2";

    session_start();

    //Create connection to database
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/database.php";
    include_once($path);

    echo "test3";

    $user_id = (int) $user_id;
    echo gettype($user_id);
    print_r($con);

    $query = $con->prepare("SELECT cart_id FROM CARTS WHERE user_id=?");
    $query->bind_param("i", $user_id);
    $query->execute();
    $query->bind_result($user_cart_id);
    $query->fetch();
    $query->close();

    echo "test4";

    if(isset($user_cart_id)){//If the user have a cart in the database
    
      echo "test5";  
      $query = $con->prepare("DELETE FROM CART_ITEMS WHERE cart_id=?");
      $query->bind_param("i", $user_cart_id);
      $query->execute();
      $query->close();

      echo "test6";
    
      $query = $con->prepare("DELETE FROM CARTS WHERE cart_id=?");
      $query->bind_param("i", $user_cart_id);
      $query->execute();
      $query->close();

      echo "test7";

      return;
    }else{//If the user dosen't have a cart in the database. 
        echo "test8";
        return;
    }
  }

?>