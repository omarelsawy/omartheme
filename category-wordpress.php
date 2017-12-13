<?php get_header(); ?>

<br>
<div class="container">
    <div class="text-center category-desc">
        <h1><?php single_cat_title()?> Cat.</h1>
        <div class="desc"><?php echo category_description() ?>
            <!-- this is the differ from other categories-->
            <h3>Special layaut</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9">
        <?php

        if (have_posts()){//chick for posts
            while (have_posts()){//loop through posts
                the_post(); ?>
                 <div class="main-post">
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
                        <?php the_post_thumbnail('medium_large' , ['class' => 'img-responsive img-thumbnail' , 'title' => 'post image']) ?>
                        <div class="post-content">
                            <?php the_excerpt() ?>
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
        ?>
        </div>
        <div class="col-md-3">
            <div class="wp-sidebar">
            <?php
              /*if (is_active_sidebar('main-sidebar')){
                 dynamic_sidebar('main-sidebar');
              }*/
              get_sidebar('wordpress');
            ?>
            </div>
        </div>
        </div>

        <!--   echo '<div class="post-pagination">';
           if (get_previous_posts_link()){
               previous_posts_link('<i class="fa fa-chevron-left fa-lg" aria-hidden="true"></i> prev');
           }else{
               echo '<span class="previous-span">prev</span>';
           }
            if (get_next_posts_link()){
                next_posts_link('next <i class="fa fa-chevron-right fa-lg" aria-hidden="true"></i>');
            }else{
                echo '<span class="next-span">next</span>';
            }
            echo '</div>';  -->

        <div class="pag">
            <?php  echo numbering_pagination();
            ?>
        </div>
    </div>
    <br><br>

    <?php get_footer(); ?>










