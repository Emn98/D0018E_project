<?php

$query = $con->prepare("SELECT * FROM PRODUCTS ORDER BY product_id DESC LIMIT 20");
$query->execute();
$recently_added = $query->get_result();
$query->fetch();
$query->close();

$query = $con->prepare("SELECT * FROM PRODUCTS ORDER BY average_score DESC LIMIT 20");
$query->execute();
$highest_rated = $query->get_result();
$query->fetch();
$query->close();

?>


<div class="recently_added_div">
    <h2 class="title_header">Recently Added</h2>
    <div class="grid_container">
        <div class="latest_products">
            <form class="view_product" method="POST" action="/Product_page/product_details.php">
            <input type="hidden" class="form_inp" value="" name="product_id">
            </form>
            <?php 
            while ($row = $recently_added->fetch_assoc()) {
            $product_name = $row["product_name"];
            $product_id = $row["product_id"];
            $product_description = $row["product_description"];
            $price = $row["price"];
            $discount = $row["discount"];
            $img = $row["picture"];
            ?>
            <div class="card">
                <img src="<?php echo $img; ?>" width="170" height="200">
                <h2><?php echo $product_name; ?></h2>
                <p class="description"><?php echo $product_description; ?></p>
                <?php 
                if($discount==0){
                echo "<p class='price'>$$price </p>"; 
            }else{
                echo "<p class='price'><strike> $$price</strike></p>"; 
                echo "<p class='price' style='color:red';>$$discount <p>"; 
            }
            ?>
            <input type="button" value="View" onclick="go_to_product('<?php echo $product_id ?>')"  class="view_btn">
            </div>
            <?php  
            }
            ?>
        </div>
    </div>
</div>
<div class="highest_rating_div">
    <h2 class="title_header">Highest rating</h2>
    <div class="grid_container">
        <div class="latest_products">
            <form class="view_product" method="POST" action="/Product_page/product_details.php">
            <input type="hidden" class="form_inp" value="" name="product_id">
            </form>
            <?php 
            while ($row = $highest_rated->fetch_assoc()) {
            $product_name = $row["product_name"];
            $product_id = $row["product_id"];
            $product_description = $row["product_description"];
            $price = $row["price"];
            $discount = $row["discount"];
            $img = $row["picture"];
            ?>
            <div class="card">
                <img src="<?php echo $img; ?>" width="170" height="200">
                <h2><?php echo $product_name; ?></h2>
                <p class="description"><?php echo $product_description; ?></p>
                <?php 
                if($discount==0){
                echo "<p class='price'>$$price </p>"; 
            }else{
                echo "<p class='price'><strike> $$price</strike></p>"; 
                echo "<p class='price' style='color:red';>$$discount <p>"; 
            }
            ?>
            <input type="button" value="View" onclick="go_to_product('<?php echo $product_id ?>')"  class="view_btn">
            </div>
            <?php  
            }
            ?>
        </div>
    </div>
</div> 