    <?php



    require_once('class-wp-bootstrap-navwalker.php');

    //add featured image support
    add_theme_support('post-thumbnails');

    /*function to add custom styles
    **added by omar elsawy
    **wp_enqueue_style()
    */
    function omar_add_styles(){

         wp_enqueue_style('bootstrap-css' , get_template_directory_uri().'/css/bootstrap.min.css');
         wp_enqueue_style('fontawesome-css' , get_template_directory_uri().'/css/font-awesome.min.css');
         wp_enqueue_style('main' , get_template_directory_uri().'/css/main.css');

    }

    /*function to add custom scripts
    **added by omar elsawy
    **wp_enqueue_script()
    */

    function omar_add_scripts(){

         //remove registered jquery
         wp_deregister_script('jquery');
         //register new jquery in footer
         wp_register_script('jquery' , includes_url('/js/jquery/jquery.js') , false , '' , true);
         //enqueue the new jquery
         wp_enqueue_script('jquery');
         wp_enqueue_script('slim' , get_template_directory_uri().'/js/slim.min.js' , array() , false , true);
         wp_enqueue_script('popper' , get_template_directory_uri().'/js/popper.min.js' , array() , false , true);
         wp_enqueue_script('bootstrap-js' , get_template_directory_uri().'/js/bootstrap.min.js' , array('jquery') , false , true);
         wp_enqueue_script('main-js' , get_template_directory_uri().'/js/main.js' , array() , false , true);
         wp_enqueue_script('html5shiv' , get_template_directory_uri().'/js/html5shiv.js');
         wp_script_add_data('html5shiv' , 'conditional' , 'lt IE 9');
         wp_enqueue_script('respond' , get_template_directory_uri().'/js/respond.min.js');
         wp_script_add_data('respond' , 'conditional' , 'lt IE 9');

    }


    //add custom menu

    function register_custom_menu(){
        register_nav_menus(array(
            'bootstrap-menu' => 'Navigation Bar',
            'footer-menu' => 'Footer Menu'
        ));
    }

    function bootstrap_menu(){
        wp_nav_menu(array(
            'theme_location' => 'bootstrap-menu',
            'menu_class' => 'navbar-nav mr-auto menu',
            'container' => false,
            'depth' => 2,
            'walker' => new WP_Bootstrap_Navwalker()
        ));
    }

    //customize the excerpt word length & read mare dots
    function extend_excerpt_length($length){
        if (is_author()){
            return 15;
        }elseif (is_category()){
            return 25;
        }
        else{
            return 20;
        }
    }

    add_filter('excerpt_length' , 'extend_excerpt_length');

    function excerpt_change_dots($mare){
        return ' ...';
    }

    add_filter('excerpt_more' , 'excerpt_change_dots');

    /*add action*/

    //add css style
    add_action('wp_enqueue_scripts' , 'omar_add_styles');
    //add js script
    add_action('wp_enqueue_scripts' , 'omar_add_scripts');
    //register custom menu
    add_action('init' , 'register_custom_menu');

    //numbering pagination
    function numbering_pagination(){
        global $wp_query;
        $all_pages = $wp_query->max_num_pages;
        $current_page = max(1 , get_query_var('paged'));
        if ($all_pages > 1){
            return paginate_links(array(
               'base' => get_pagenum_link().'%_%',
                'format' => 'page/%#%',
                'current' => $current_page,
                'mid_size' => 3,
                'end_size' => 3
            ));
        }
    }

//register sidebar
    function omar_main_sidebar(){
        //register main sidebar
        register_sidebar(array(
            'name' => 'Main sidebar',
            'id' => 'main-sidebar',
            'description' => 'main',
            'class' => 'main-sidebar',
            'before_widget' => '<div class="widget-content">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>'
        ));
    }

 add_action('widget_init' , omar_main_sidebar());

//remove paragraph element from posts
    function omar_remove_paragraph($content){
        remove_filter('the_content' , 'wpautop');
        return $content;
    }

    add_filter('the_content' , 'omar_remove_paragraph' , 0);   //0 for periority
































