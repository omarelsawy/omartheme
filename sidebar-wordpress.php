    <?php

    //get category comments count
    $comments_args = array(
        'status' => 'approve'
    );
    $comments_count = 0;
    $all_comments = get_comments($comments_args);
    foreach ($all_comments as $comment){
        $post_id = $comment->comment_post_ID;
        if (! in_category('wordpress' , $post_id)){
           continue;
        }
        $comments_count++;
    }

    //get category posts counts
     $cat = get_queried_object(); //get full object properties
     $posts_count = $cat->count;

    ?>

    <div class="sb-wp">
        <div class="widget">
            <h3 class="widget-title-2"><?php single_cat_title() ?> Statistics</h3>
            <div class="widget-content-2">
                <ul>
                    <li>
                        <span>Comments Count</span>:<?php echo $comments_count ?>
                    </li>
                    <li>
                        <span>Posts Count</span>:<?php echo $posts_count ?>
                    </li>
                </ul>
            </div>
        </div>
        <div class="widget">
            <h3 class="widget-title-2">Latest php posts</h3>
            <div class="widget-content-2">
                <ul>
                    <?php
                      $posts_args = array(
                          'posts_per_page' => 5,
                          'cat' => 7
                      );
                      $query = new WP_Query($posts_args);
                      if ($query->have_posts()){
                         while ($query->have_posts()){
                             $query->the_post();
                             ?>
                             <li>
                                 <a target="_blank" href="<?php the_permalink() ?>">
                                     <?php the_title() ?>
                                 </a>
                             </li>
                        <?php
                        }
                      }
                    ?>
                </ul>
            </div>
        </div>
        <div class="widget">
            <h3 class="widget-title-2">Hot post by comments</h3>
            <div class="widget-content-2">
                <ul>
                    <?php
                    $hotpost_args = array(
                        'posts_per_page' => 1,
                        'orderby' => 'comment_count'
                    );
                    $hotquery = new WP_Query($hotpost_args);
                    if ($hotquery->have_posts()){
                        while ($hotquery->have_posts()){
                            $hotquery->the_post();
                            ?>
                            <li>
                                <a target="_blank" href="<?php the_permalink() ?>">
                                    <?php the_title() ?>
                                </a>
                                <hr>
                                <?php comments_popup_link('no comments' , '1 comment' , '% comments' , 'comment-url' , 'comments disabled') ?>
                            </li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>