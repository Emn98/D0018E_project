<?php 
  //creates connection to database
  $path = $_SERVER['DOCUMENT_ROOT'];
  $path .= "/database.php";
  include_once($path);

  $inp = 0;

  $query = $con->prepare("SELECT category_id, category_name FROM CATEGORIES WHERE category_id>=?");
  $query->bind_param("i", $inp);
  $query->execute();
  $result = $query->get_result();
  $query->fetch();
  $query->close();
?>
 <html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/Css/categorybar_style.css">
  </head>
   <body>
     <div class="category_container">
       <form method="post" action="/Category/category.php" name="redirect">
         <table>
           <?php
              while ($row = $result->fetch_assoc()) {
                $category_id = $row["category_id"];
                $category_name = $row["category_name"];
                
                echo "<tr>";
           ?>
                  <th> <input type="button" value="<?php echo $category_name;?>" onclick="search_product('<?php echo $category_id ?>')"  class="category_btn"> </th>
           <?php
                echo "</tr>";
              }
           ?>
         </table>
       </form> 
     </div>
  </body>
  <script>
    function search_product(id){
      var link = id;
      console.log(id);
      $('.post').attr("value",link);
      $('.redirect').submit(); 
    }
  </script> 
</html>  
