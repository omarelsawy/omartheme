<?php
get_header();
include (get_template_directory() . '/includes/breadcrumb.php');
?>

<br>
<div class="container">
        <?php

        if (have_posts()){//chick for posts
            while (have_posts()){//loop through posts
                the_post(); ?>

                    <div class="main-post single-post">
                        <?php edit_post_link('Edit <i class="fa fa-pencil"></i>') ?>
                        <h3 class="post-title">
                            <a href="<?php the_permalink() ?>">
                                <?php the_title() ?>
                            </a>
                        </h3>
                        <span class="post-author">
                       <i class="fa fa-user fa-fw"></i> <?php the_author_posts_link() ?>,
                   </span>
                        <span class="post-date">
                       <i class="fa fa-calendar fa-fw"></i> <?php the_time('F j, Y') ?>
                   </span>
                        <span class="post-comments">
                       <i class="fa fa-comment-o fa-fw"></i> <?php comments_popup_link('no comments' , '1 comment' , '% comments' , 'comment-url' , 'comments disabled') ?>
                   </span>
                        <?php the_post_thumbnail('medium' , ['class' => 'img-responsive img-thumbnail' , 'title' => 'post image']) ?>
                        <div class="post-content">
                            <?php the_content() ?>
                        </div>
                        <hr>
                        <p class="post-categories">
                            <i class="fa fa-tags fa-fw"></i>
                            <?php the_category(', ') ?>
                        </p>
                        <p class="post-tags">
                            <?php
                            if (has_tag()){
                                the_tags();
                            }else{
                                echo 'Tags: no tags';
                            }
                            ?>
                        </p>
                    </div>
                <?php
            }//end while loop
        }//end if condition

        //get post id => get_queried_object_id()
       // get categories id => wp_get_post_categories(get_queried_object_id())

        $random_posts_arguments = array(
             'posts_per_page' => 3,
             'orderby' => 'rand',
             'category__in' => wp_get_post_categories(get_queried_object_id()),
             'post__not_in' => array(get_queried_object_id())

        );

        $random_post = new WP_Query($random_posts_arguments);

        if ($random_post->have_posts()){//chick for posts ?>
            <hr><h3>Same posts</h3><br>
        <?php
        while ($random_post->have_posts()){//loop through posts
            $random_post->the_post(); ?>
             <div class="main-post">
                    <h3 class="post-title">
                        <a href="<?php the_permalink() ?>">
                            <?php the_title() ?>
                        </a>
                    </h3>
                </div>
            <?php
        }//end while loop ?>
            <hr>
     <?php
        }else{
           echo '<h3>No same posts</h3><br><hr>';
        }

         ?>
    <?php wp_reset_postdata();  //reset loop query ?>

        <div class="author">

       <?php

       $avatar_argument = array(
         'class' => 'img-responsive img-thumbnail'
       );

       //get_avatar('id or email' , 'size' , 'default' , 'alternate text' , 'image arguments')
        echo get_avatar(get_the_author_meta('id') , 96 , '' , 'User Avatar' , $avatar_argument) ;

            ?>

       <h4>
         <?php the_author_meta('first_name') ?>
         <?php the_author_meta('last_name') ?>
         (<?php the_author_meta('nickname') ?>)
       </h4>

       <?php if (get_the_author_meta('description')){ ?>
          <p>
              <?php the_author_meta('description'); ?>
          </p>
       <?php }else{
           echo 'no biography';
       } ?>

    <br><br>
    <p class="author-stats">
       User Posts Count:<span class="posts-count"><?php echo count_user_posts(get_the_author_meta('id')) ?></span>
       <br> User Profile Link: <?php the_author_posts_link() ?>
    </p>
        </div>
    <!-- end author area -->

      <?php
        echo '<hr class="comment-separator">';
        echo '<div class="post-pagination">';
        if (get_previous_post_link()){
            previous_post_link('%link' , '<i class="fa fa-chevron-left fa-lg" aria-hidden="true"></i>%title');
        }else{
            echo '<span class="previous-span">prev</span>';
        }
        if (get_next_post_link()){
            next_post_link('%link' , '%title <i class="fa fa-chevron-right fa-lg" aria-hidden="true"></i>');
        }else{
            echo '<span class="next-span">next</span>';
        }
        echo '</div>';
        echo '<hr class="comment-separator">';
        comments_template();

        ?>
    </div>
<br><br>

<?php get_footer(); ?>










