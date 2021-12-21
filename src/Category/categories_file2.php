<?php 
  //creates connection to database
  $path = $_SERVER['DOCUMENT_ROOT'];
  $path .= "/database.php";
  include_once($path);

  $inp = 0;

  $query = $con->prepare("SELECT category_id, category_name, is_deleted FROM CATEGORIES WHERE category_id>=?");
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
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>
  </head>
   <body>
     <div class="category_container">
     <form method="post" action="/Category/category.php" name="redirect" class="redirect">
     <input type="hidden" class="category_id" name="category_id" value="">
     <input type="hidden" class="category_name" name="category_name" value="">
         <table>
           <?php
              while ($row = $result->fetch_assoc()) {
                $is_deleted = $row["is_deleted"];
                if($is_deleted == 1){
                  continue;
                }
                $category_id = $row["category_id"];
                $category_name = $row["category_name"];
                
                echo "<tr>";
           ?>
                  <th> <input type="button" value="<?php echo $category_name;?>" onclick="go_to_category('<?php echo $category_id ?>','<?php echo $category_name?>')"  class="category_btn"> </th>
           <?php
                echo "</tr>";
              }
           ?>
         </table>
       </form> 
     </div>
     <script>
       function go_to_category(id, name){
        var category_id = id;
        var category_name = name;
        $('.category_id').attr("value",category_id);//Insert value in form on line 25.
        $('.category_name').attr("value",category_name);//Insert value in form on line 26.
        $('.redirect').submit(); //Submit the form. 
       }
     </script>
  </body>
</html>  