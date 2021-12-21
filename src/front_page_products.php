<?php

$query = $con->prepare("SELECT * FROM PRODUCTS WHERE category_id IN (SELECT category_id FROM CATEGORIES WHERE is_deleted = 0) ORDER BY product_id DESC LIMIT 20");
$query->execute();
$recently_added = $query->get_result();
$query->fetch();
$query->close();

$query = $con->prepare("SELECT * FROM PRODUCTS  WHERE category_id IN (SELECT category_id FROM CATEGORIES WHERE is_deleted = 0) ORDER BY average_score DESC LIMIT 20");
$query->execute();
$highest_rated = $query->get_result();
$query->fetch();
$query->close();

?>


<div class="recently_added_div">
    <h2 class="title_header">Recently Added</h2>
    <div class="latest_products">  
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
            <form class="view_product" method="POST" action="/Product_page/product_details.php">
                <input type="hidden" class="form_inp" value="" name="product_id">
                <input type="button" value="View" onclick="go_to_product('<?php echo $product_id ?>')"  class="view_btn">
            </form>
        </div>
        <?php  
        }
        ?>
    </div>
</div>
<div class="highest_rating_div">
    <h2 class="title_header">Highest rating</h2>
    <div class="latest_products">  
        <?php 
        while ($row = $highest_rated->fetch_assoc()) {
        $product_name = $row["product_name"];
        $product_id = $row["product_id"];
        $product_description = $row["product_description"];
        $price = $row["price"];
        $discount = $row["discount"];
        $img = $row["picture"];
        $average_score=$row["average_score"];
        ?>
        <div class="card">
            <div class="img_cont">
              <div class="stars">
              <span class="stars"><?php echo $average_score; ?></span>
              </div> 
              <img src="<?php echo $img; ?>" width="170" height="200">
            </div>
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
            <form class="view_product" method="POST" action="/Product_page/product_details.php">
                <input type="hidden" class="form_inp" value="" name="product_id">
                <input type="button" value="View" onclick="go_to_product('<?php echo $product_id ?>')"  class="view_btn">
            </form>
        </div>
        <?php  
        }
        ?>
    </div>
</div>
<script>
$.fn.stars = function() {
    return $(this).each(function() {
        // Get the value
        var val = parseFloat($(this).html());
        val = Math.round(val * 2) / 2; /* To round to nearest half */
        // Make sure that the value is in 0 - 5 range, multiply to get width
        var size = Math.max(0, (Math.min(5, val))) * 16;
        // Create stars holder
        var $span = $('<span />').width(size);
        // Replace the numerical value with stars
        $(this).html($span);
    });
}    
</script> 