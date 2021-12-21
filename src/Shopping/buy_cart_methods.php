<?php
    
//Connect to database
//$con = mysqli_connect("localhost","phpmyadmin","Offbrand123$","website");

function get_product_info_cart_items($con, $cart_id){
    $query = $con->prepare("SELECT product_id, quantity, color, total_price FROM CART_ITEMS WHERE cart_id=?" );
    $query->bind_param("i", $cart_id);
    $query->execute();
    $result = $query->get_result();
    $query->fetch();
    $query->close();
    return $result;
} 

function get_quantity_product_inventory($con, $product_id, $color){
    $query2 = $con->prepare("SELECT quantity FROM PRODUCT_INVENTORY WHERE product_id=? and color=?" );
    $query2->bind_param("is", $product_id, $color);
    $query2->execute();
    $query2->bind_result($stock_quantity);
    $query2->fetch();
    $query2->close();
    return $stock_quantity;
}

function update_product_inventory_quantity($con, $new_quantity, $product_id, $color){
    $stmt = $con->prepare("UPDATE PRODUCT_INVENTORY SET quantity=? WHERE product_id=? AND color=?");
    $stmt->bind_param("iis", $new_quantity, $product_id, $color);
    $stmt->execute();
    $stmt->close();
}

function get_amount_of_order_items($con, $order_id){
    $query = $con->prepare("SELECT COUNT(*) FROM ORDER_ITEMS WHERE order_id=?" );
    $query->bind_param("i", $order_id);
    $query->execute();
    $query->bind_result($no_items_in_order);
    $query->fetch();
    $query->close();
    return $no_items_in_order;
}

function delete_from_orders($con, $order_id){
    $query = $con->prepare("DELETE FROM ORDERS WHERE order_id=?");
    $query->bind_param("i", $order_id);
    $query->execute();
    $query->close();
}

function insert_into_order_items($con, $order_id, $cart_id){
    $query = $con->prepare("INSERT INTO ORDER_ITEMS (order_id, product_id, quantity, color) SELECT ?, product_id, quantity, color FROM CART_ITEMS WHERE cart_id=?");
    $query->bind_param("ii", $order_id, $cart_id);
    $query->execute();
    $query->close();
}

function update_purchase_price_into_ORDER_ITEMS($con, $cart_id, $order_id){
    $query = $con->prepare("SELECT product_id FROM CART_ITEMS WHERE cart_id=?" );
    $query->bind_param("i", $cart_id);
    $query->execute();
    $result = $query->get_result();
    $query->fetch();
    $query->close();

    while($row = $result->fetch_assoc()) {

        $product_id = $row["product_id"];

        $query = $con->prepare("SELECT price, discount FROM PRODUCTS WHERE product_id=?");
        $query->bind_param("ii", $price, $discount);
        $query->execute();
        $query->close();

        if($discount == 0){
            $stmt = $con->prepare("UPDATE ORDER_ITEMS SET purchase_price=? WHERE order_id=? AND product_id=?");
            $stmt->bind_param("iis", $price, $order_id, $product_id);
            $stmt->execute();
            $stmt->close();
        }else{
            $stmt = $con->prepare("UPDATE ORDER_ITEMS SET purchase_price=? WHERE order_id=? AND product_id=?");
            $stmt->bind_param("iis", $discount, $order_id, $product_id);
            $stmt->execute();
            $stmt->close();
        }
    }
}

function delete_from_cart_items($con, $cart_id){
    $query = $con->prepare("DELETE FROM CART_ITEMS WHERE cart_id=?");
    $query->bind_param("i", $cart_id);
    $query->execute();
    $query->close();
}

function delete_from_carts($con, $cart_id){
    $query = $con->prepare("DELETE FROM CARTS WHERE cart_id=?");
    $query->bind_param("i", $cart_id);
    $query->execute();
    $query->close();
}
?>