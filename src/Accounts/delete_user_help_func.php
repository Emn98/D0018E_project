<!-- This php page includes help functions for deleting user -->
<?php 

  /*This function will delete the shopping cart for a user admin is about to...
   delete provided the user have one in the database */   
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

  /*This function will delete the shopping cart for a user about to...
    delete his or hers account provided the user have one in the database */   
    function delete_user_cart(){
      session_start();

      //Connect to the database.
      $con = mysqli_connect("localhost","phpmyadmin","Offbrand123$","Website");

      $cart_id = $_SESSION["cart_id"];

      //If the user have a cart delete it. 
      if(gettype($_SESSION["cart_id"]) != "NULL" && isset($_SESSION["cart_id"])){
        
        $query = $con->prepare("DELETE FROM CART_ITEMS WHERE cart_id=?");
        $query->bind_param("i", $cart_id);
        $query->execute();
        $query->close();
        
        $query = $con->prepare("DELETE FROM CARTS WHERE cart_id=?");
        $query->bind_param("i", $cart_id);
        $query->execute();
        $query->close();
        
        unset($_SESSION["cart_id"]);//Reset cart_id variable
        
        return;
      }else{
          return;
      }
    }
?>