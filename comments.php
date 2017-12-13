    <?php

    if (comments_open()){ ?>
        <h3 class="comments-count"><?php comments_number('0 comment' , '1 comment' , '% comments') ?></h3>
    <?php
        echo '<ul class="list-unstyled comments-list">';
        $comments_argument = array(
            'max_depth' => 3,
            'type' => 'comment',
            'avatar_size' => 64
        );
      wp_list_comments($comments_argument);
      echo '</ul>';
        echo '<hr class="comment-separator">';
        ?>

        <div class="my-form">

        <?php
      $commentform_argument = array(
              'class_submit' => 'btn btn-primary btm-md',
              'comment_notes_before' => ''
      );
      comment_form($commentform_argument);
      ?>

        </div>

    <?php

    }else{
      echo 'comment closed';
    }