<!-- This php page includes help functions for deleting user -->
<?php 

  /*This function will delete a shopping cart associated to a user*/
  function delete_user_cart($user_id){
    $user_id = (int) $user_id;

    //Connect to the database.
    $con = mysqli_connect("localhost","phpmyadmin","Offbrand123$","website");

    $query = $con->prepare("SELECT cart_id FROM CARTS WHERE user_id=?");
    $query->bind_param("i", $user_id);
    $query->execute();
    $query->bind_result($user_cart_id);
    $query->fetch();
    $query->close();

    if($user_cart_id!=NULL){//If the user have a cart in the database
      $query = $con->prepare("DELETE FROM CART_ITEMS WHERE cart_id=?");
      $query->bind_param("i", $user_cart_id);
      $query->execute();
      $query->close();

      $query = $con->prepare("DELETE FROM CARTS WHERE cart_id=?");
      $query->bind_param("i", $user_cart_id);
      $query->execute();
      $query->close();

      return;

    }else{//If the user dosen't have a cart in the database. 
      return;
    }
  }

  function delete_user_orders($user_id){
    $user_id = (int) $user_id;

    //Connect to the database.
    $con = mysqli_connect("localhost","phpmyadmin","Offbrand123$","website");

    $query = $con->prepare("SELECT order_id FROM ORDERS WHERE user_id=?");
    $query->bind_param("i", $user_id);
    $query->execute();
    $result = $query->get_result();
    $query->fetch();
    $query->close();

    while ($row = $result->fetch_assoc()) {
      $order_id = $row["order_id"];

      $query = $con->prepare("DELETE FROM ORDER_ITEMS WHERE order_id=?");
      $query->bind_param("i", $order_id);
      $query->execute();
      $query->close();

      $query = $con->prepare("DELETE FROM ORDERS WHERE order_id=?");
      $query->bind_param("i", $order_id);
      $query->execute();
      $query->close();
    }
    return;
  }

  function delete_user_reviews($user_id){
    $user_id = (int) $user_id;

    //Connect to the database.
    $con = mysqli_connect("localhost","phpmyadmin","Offbrand123$","website");

    echo "före";
    $query = $con->prepare("DELETE FROM USER_REVIEWS WHERE user_id=?");
    $query->bind_param("i", $user_id);
    $query->execute();
    $query->close();
    echo "efter";

    return;
  }   
  function delete_user_comments($user_id){
    $user_id = (int) $user_id;
    
    //Connect to the database.
    $con = mysqli_connect("localhost","phpmyadmin","Offbrand123$","website");

    $query = $con->prepare("SELECT review_id FROM USER_REVIEWS WHERE user_id=?");
    $query->bind_param("i", $user_id);
    $query->execute();
    $result = $query->get_result();
    $query->fetch();
    $query->close();

    while ($row = $result->fetch_assoc()) {
      $review_id = $row["review_id"];

      $query = $con->prepare("DELETE FROM USER_COMMENTS WHERE review_id=?");
      $query->bind_param("i", $review_id);
      $query->execute();
      $query->close();
    }   
    return;
  }
?>