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
?>