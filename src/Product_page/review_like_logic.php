<?php
          if(!has_pressed_like_button($user_id, $review_id,1) && isset($user_id)){
            echo "<button onclick='like($user_id, $review_id,1)'><i class='fa fa-thumbs-up'></i></button>";
          } elseif(has_pressed_like_button($user_id, $review_id,1) && isset($user_id)){
            echo "<button style='background-color:lightblue;' onclick='like($user_id, $review_id,0)'><i class='fa fa-thumbs-up'></i></button>";
          }
          else{
            echo "<button style='background-color:lightblue;'><i class='fa fa-thumbs-up'></i></button>";
          }
          ?>
          <label><?php echo $like_to_dislike_ratio ?></label>
          <?php
          if(!has_pressed_like_button($user_id, $review_id,0) && isset($user_id)){
            echo "<button onclick='dislike($user_id, $review_id,1)'><i class='fa fa-thumbs-down'></i></button>";
          } elseif(has_pressed_like_button($user_id, $review_id,0) && isset($user_id)){
            echo "<button style='background-color:lightblue;' onclick='dislike($user_id, $review_id,0)'><i class='fa fa-thumbs-down'></i></button>";
          } else{
            echo "<button style='background-color:lightblue;'><i class='fa fa-thumbs-down'></i></button>";
          }
          ?>
<script>
    function like(u_id, r_id, type){
        $.ajax({
            type: "POST",
            url:  "like_review.php", // 
            data: {user_id: u_id, review_id: r_id, type:type},                
            success: function(){
                location.reload();
            },
            error: function(){
                alert("failure");
            }
        });
    }
    function dislike(u_id, r_id, type){
        $.ajax({
            type: "POST",
            url:  "dislike_review.php", // 
            data: {user_id: u_id, review_id: r_id, type:type},                
            success: function(){
                location.reload();
            },
            error: function(){
                alert("failure");
            }
        });
    }
</script>

<?php
  if(!function_exists('has_pressed_like_button')){
    function has_pressed_like_button($u_id, $r_id, $decide){
      if($decide == 1){
        //user pressed like button

        $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= "/database.php";
        include($path);

        $stmt = $con->prepare("SELECT * FROM USER_LIKES_REVIEW WHERE user_id=? AND review_id=?");
        $stmt->bind_param("ii",$u_id, $r_id);
        $stmt->execute();
        $r = $stmt->get_result();
        $stmt->fetch();
        $stmt->close();

        if(mysqli_num_rows($r)==0) {
            return FALSE;
        } else{
          
          $like_row = $r->fetch_assoc();

          if($like_row['user_liked']){
            return TRUE;
          } else{
            return FALSE;
          }
        }

      } else{
        //user pressed dislike button

        $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= "/database.php";
        include($path);

        $stmt = $con->prepare("SELECT * FROM USER_LIKES_REVIEW WHERE user_id=? AND review_id=?");
        $stmt->bind_param("ii",$u_id, $r_id);
        $stmt->execute();
        $r = $stmt->get_result();
        $stmt->fetch();
        $stmt->close();

        if(mysqli_num_rows($r)==0) {
            return FALSE;
        } else{
          
          $like_row = $r->fetch_assoc();

          if($like_row['user_disliked']){
            return TRUE;
          } else{
            return FALSE;
          }
        }
      }
    }
  }
?>