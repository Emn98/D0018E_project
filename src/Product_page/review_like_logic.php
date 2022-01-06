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
