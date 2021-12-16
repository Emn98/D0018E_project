<?php
    
//Connect to database
$con = mysqli_connect("localhost","phpmyadmin","Offbrand123$","website");

function get_product_info_cart_items($cart_id){
    $query = $con->prepare("SELECT product_id, quantity, color FROM CART_ITEMS WHERE cart_id=?" );
    $query->bind_param("i", $cart_id);
    $query->execute();
    $result = $query->get_result();
    $query->fetch();
    $query->close();
    return $result;
} 

function get_quantity_product_inventory($product_id, $color){
    $query2 = $con->prepare("SELECT quantity FROM PRODUCT_INVENTORY WHERE product_id=? and color=?" );
    $query2->bind_param("is", $product_id, $color);
    $query2->execute();
    $query2->bind_result($stock_quantity);
    $query2->fetch();
    $query2->close();
    return $stock_quantity;
}

function update_product_inventory_quantity($new_quantity, $product_id, $color){
    $stmt = $con->prepare("UPDATE PRODUCT_INVENTORY SET quantity=? WHERE product_id=? AND color=?");
    $stmt->bind_param("iis", $new_quantity, $product_id, $color);
    $stmt->execute();
    $stmt->close();
}

function get_amount_of_order_items($order_id){
    $query = $con->prepare("SELECT COUNT(*) FROM ORDER_ITEMS WHERE order_id=?" );
    $query->bind_param("i", $order_id);
    $query->execute();
    $query->bind_result($no_items_in_order);
    $query->fetch();
    $query->close();
    return $no_items_in_order;
}

function delete_from_orders($order_id){
    $query = $con->prepare("DELETE FROM ORDERS WHERE order_id=?");
    $query->bind_param("i", $order_id);
    $query->execute();
    $query->close();
}

function insert_into_order_items($order_id, $cart_id){
    $query = $con->prepare("INSERT INTO ORDER_ITEMS (order_id, product_id, quantity, color) SELECT ?, product_id, quantity, color FROM CART_ITEMS WHERE cart_id=?");
    $query->bind_param("ii", $order_id, $cart_id);
    $query->execute();
    $query->close();
}

function delete_from_cart_items($cart_id){
    $query = $con->prepare("DELETE FROM CART_ITEMS WHERE cart_id=?");
    $query->bind_param("i", $cart_id);
    $query->execute();
    $query->close();
}

function delete_from_carts($cart_id){
    $query = $con->prepare("DELETE FROM CARTS WHERE cart_id=?");
    $query->bind_param("i", $cart_id);
    $query->execute();
    $query->close();
}
?>