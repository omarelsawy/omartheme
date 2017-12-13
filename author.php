<?php get_header() ?>

<br>
  <div class="container author-page">
      <div class="author-main-info">
      <h1 class="profile-header text-center">
          <?php the_author_meta('first_name') ?>
          <?php the_author_meta('last_name') ?> page
      </h1>
      <div class="row">
         <div class="col-md-3">

             <?php
             $avatar_argument = array(
                 'class' => 'img-responsive img-thumbnail'
             );
             //get_avatar('id or email' , 'size' , 'default' , 'alternate text' , 'image arguments')
             echo get_avatar(get_the_author_meta('ID') , 196 , '' , 'User Avatar' , $avatar_argument) ;
             ?>

         </div>
         <div class="col-md-9">
            <ul class="list-unstyled">
                <li>First Name: <?php the_author_meta('first_name') ?></li>
                <li>Last Name:  <?php the_author_meta('last_name') ?> </li>
                <li>Nickname: <?php the_author_meta('nickname') ?></li>
            </ul>
             <hr>

             <?php if (get_the_author_meta('description')){ ?>
                 <p>
                     <?php the_author_meta('description'); ?>
                 </p>
             <?php }else{
                 echo 'no biography';
             } ?>

         </div>
      </div>
      </div>
      <div class="row author-stats-2">
          <div class="col-md-3">
              <div class="stats">
                  Posts count
                  <span><?php echo count_user_posts(get_the_author_meta('ID')) ?></span>
              </div>
          </div>
          <div class="col-md-3">
              <div class="stats">
                  Comments Count
                  <span>
                      <?php
                         $commentscount_argument = array(
                           'user_id' => get_the_author_meta('ID'),
                           'count' => true
                         );
                         echo get_comments($commentscount_argument);
                      ?>
                  </span>
              </div>
          </div>
          <div class="col-md-3">
              <div class="stats">
                  Total Posts View
                  <span></span>
              </div>
          </div>
      </div>
<hr>
      <?php

      $author_posts_arguments = array(
              'author' => get_the_author_meta('ID'),
              'posts_per_page' => -1,

      );

      $author_post = new WP_Query($author_posts_arguments);

      if ($author_post->have_posts()){//chick for posts ?>
         <h3><?php the_author_meta('first_name') ?> posts</h3>
      <br>
      <div class="row">
            <?php
          while ($author_post->have_posts()){//loop through posts
              $author_post->the_post(); ?>

              <div class="col-sm-6">
                  <div class="main-post">
                      <h3 class="post-title">
                          <a href="<?php the_permalink() ?>">
                              <?php the_title() ?>
                          </a>
                      </h3>
                      <span class="post-date">
                       <i class="fa fa-calendar fa-fw"></i> <?php the_time('F j, Y') ?>
                   </span>
                      <span class="post-comments">
                       <i class="fa fa-comment-o fa-fw"></i> <?php comments_popup_link('no comments' , '1 comment' , '% comments' , 'comment-url' , 'comments disabled') ?>
                   </span>
                      <?php the_post_thumbnail('medium' , ['class' => 'img-responsive img-thumbnail' , 'title' => 'post image']) ?>
                      <div class="post-content">
                          <?php the_excerpt() ?>
                      </div>

                  </div>
              </div>
              <?php
          }//end while loop
      }//end if condition ?>
            </div>
           <?php wp_reset_postdata();  //reset loop query


       //show comments
            $comments_per_page = 6;
            $comments_argument = array(
                    'user_id' => get_the_author_meta('ID'),
                    'status' => 'approve',
                    'number' => $comments_per_page,
                    'post_status' => 'publish',
                    'post_type' => 'post'
            );

            $comments = get_comments($comments_argument);
            if ($comments){  ?>
                 <h3>Latest comments of: <?php the_author_meta('first_name') ?> </h3>
          <?php  foreach ($comments as $comment){ ?>
                    <a href="<?php echo get_permalink($comment->comment_post_ID) ?>">
                        <?php echo get_the_title($comment->comment_post_ID); ?>
                    </a>
                    <br>
                    <?php echo 'Added on ' .mysql2date('l, F j, Y' , $comment->comment_date) ?>
                    <br>
                    <?php echo $comment->comment_content ?>
                    <hr>
                <?php  }

            }else{
                echo 'This person donot have comments';
            }
      ?>
  </div>
<br><br><br>
<?php get_footer() ?>









