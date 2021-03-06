<?php
include("check_admin.php");
?>

<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/Css/product.css">
    <title>Edit Product</title>  
  </head>
  <body>   
      <?php
        
        $product_id = $_POST['product_id'];
        $product_name = $_POST['new_product_name'];
        $product_description = $_POST['product_description'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        $discount = $_POST['discount'];
        $picture = $_POST['picture'];
        $color_arr = $_POST['color'];
        $quantity_arr = $_POST['quantity'];
        $inventory_id_arr = $_POST['inventory_id'];

        // establish connection

        $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= "/database.php";
        include($path);

        // UPDATE PRODUCTS -> UPDATE PRODUCT_INVENTORY -> done

        mysqli_begin_transaction($con);

        try{

          $stmt = $con->prepare("UPDATE PRODUCTS SET product_name=?, product_description=?, category_id=(SELECT category_id FROM CATEGORIES WHERE category_name=?)
          , price=?, discount=?, picture=? WHERE product_id=?");
          $stmt->bind_param("sssiisi", $product_name, $product_description, $category, $price, $discount, $picture, $product_id);
          $stmt->execute();
          $stmt->close();
          
          
          $sql = "UPDATE PRODUCT_INVENTORY
          SET color = 
          CASE ";
          for($i = 0; $i < sizeof($inventory_id_arr); $i++){
            $inventory_id = $inventory_id_arr[$i];
            $color = $color_arr[$i];
            $sql .= " WHEN inventory_id = $inventory_id THEN '$color'";
          }
          $sql .= " END,
          quantity =
          CASE ";
          for($i = 0; $i < sizeof($inventory_id_arr); $i++){
            $inventory_id = $inventory_id_arr[$i];
            $quantity = $quantity_arr[$i];
            $sql .= " WHEN inventory_id = $inventory_id THEN $quantity";
          }
          $sql .= " END WHERE inventory_id IN (";
          for($i = 0; $i < sizeof($inventory_id_arr); $i++){
            $inventory_id = $inventory_id_arr[$i];
            $sql .= "$inventory_id";
            if($i < sizeof($inventory_id_arr)-1){
              $sql .= ", ";
            }
          }
            
          $sql .= ")";

          echo "<br>";

          $con->query($sql);
          
          mysqli_commit($con);
        } catch (mysqli_sql_exception $exception) {
            mysqli_rollback($con);
            echo "Something went wrong";
            throw $exception;
        }
      ?>
      

    <form action="edit_product_form.php" method="post">
    <button type="submit" class="btn">Return</button>
    </form>

  </body>
</html>