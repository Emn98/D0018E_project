<!-- This php page includes help functions for deleting user -->
<?php 

  /*This function will delete the shopping cart for a user about to...
    get deleted provided the user have one in the database */   
  function delete_user_cart_admin($user_id){

    $user_id = (int) $user_id;

    //Connect to the database.
    $con = mysqli_connect("localhost","phpmyadmin","Offbrand123$","Website");

    $query = $con->prepare("SELECT cart_id FROM CARTS WHERE user_id=?");
    $query->bind_param("i", $user_id);
    $query->execute();
    $query->bind_result($user_cart_id);
    $query->fetch();
    $query->close();

    echo $user_cart_id;
    echo gettype($user_cart_id);

    if($user_cart_id!="NULL"){//If the user have a cart in the database
    
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