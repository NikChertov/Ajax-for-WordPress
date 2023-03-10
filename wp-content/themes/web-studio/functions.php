<?php
/**
 * web-studio functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package web-studio
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function web_studio_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on web-studio, use a find and replace
		* to change 'web-studio' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'web-studio', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'web-studio' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'web_studio_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'web_studio_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function web_studio_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'web_studio_content_width', 640 );
}
add_action( 'after_setup_theme', 'web_studio_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function web_studio_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'web-studio' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'web-studio' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'web_studio_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function web_studio_scripts() {
	wp_enqueue_style( 'web-studio-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'web-studio-style', 'rtl', 'replace' );

	wp_enqueue_style('style', get_template_directory_uri().'/assets/css/style.min.css',array(), _S_VERSION);

	wp_enqueue_script( 'jquery' );
 
	wp_register_script( 'filter', get_template_directory_uri() . '/js/filter.js', array( 'jquery' ), time(), true );
	wp_enqueue_script( 'filter' );
        wp_localize_script( 'filter', 'news', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'web_studio_scripts' );

function web_studio_register() {

	$args = array(
		'hierarchical' => true,
		'labels' => array(
			'name'              => esc_html_x( 'Types', 'taxonomy general name', 'web-studio' ),
			'singular_name'     => esc_html_x( 'Type', 'taxonomy singular name', 'web-studio' ),
			'search_items'      => esc_html__( 'Search Types', 'web-studio' ),
			'all_items'         => esc_html__( 'All Types', 'web-studio' ),
			'parent_item'       => esc_html__( 'Parent Type', 'web-studio' ),
			'parent_item_colon' => esc_html__( 'Parent Type:', 'web-studio' ),
			'edit_item'         => esc_html__( 'Edit Type', 'web-studio' ),
			'update_item'       => esc_html__( 'Update Type', 'web-studio' ),
			'add_new_item'      => esc_html__( 'Add New Type', 'web-studio' ),
			'new_item_name'     => esc_html__( 'New Type Name', 'web-studio' ),
			'menu_name'         => esc_html__( 'Type', 'web-studio' ),
		),
		'show_ui' => true,
		'rewrite' => array('slug'=>'types'),
		'query_var' => true,
		'show_in_rest' => true,
	);
	
	register_taxonomy('Type', array('news'), $args);
	unset($args);

	$args = array(
		'label' => esc_html__('News', 'web-studio'),
		'labels' => array(
			'name'                  => esc_html_x( 'News', 'Post type general name', 'web-studio' ),
			'singular_name'         => esc_html_x( 'New', 'Post type singular name', 'web-studio' ),
			'menu_name'             => esc_html_x( 'News', 'Admin Menu text', 'web-studio' ),
			'name_admin_bar'        => esc_html_x( 'New', 'Add New on Toolbar', 'web-studio' ),
			'add_new'               => esc_html__( 'Add New', 'web-studio' ),
			'add_new_item'          => esc_html__( 'Add New New', 'web-studio' ),
			'new_item'              => esc_html__( 'New New', 'web-studio' ),
			'edit_item'             => esc_html__( 'Edit New', 'web-studio' ),
			'view_item'             => esc_html__( 'View New', 'web-studio' ),
			'all_items'             => esc_html__( 'All New', 'web-studio' ),
			'search_items'          => esc_html__( 'Search News', 'web-studio' ),
			'parent_item_colon'     => esc_html__( 'Parent News:', 'web-studio' ),
			'not_found'             => esc_html__( 'No News found.', 'web-studio' ),
			'not_found_in_trash'    => esc_html__( 'No News found in Trash.', 'web-studio' ),
			'featured_image'        => esc_html_x( 'New Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'web-studio' ),
			'set_featured_image'    => esc_html_x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'web-studio' ),
			'remove_featured_image' => esc_html_x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'web-studio' ),
			'use_featured_image'    => esc_html_x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'web-studio' ),
			'archives'              => esc_html_x( 'New archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'web-studio' ),
			'insert_into_item'      => esc_html_x( 'Insert into New', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'web-studio' ),
			'uploaded_to_this_item' => esc_html_x( 'Uploaded to this New', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'web-studio' ),
			'filter_items_list'     => esc_html_x( 'Filter News list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'web-studio' ),
			'items_list_navigation' => esc_html_x( 'News list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'web-studio' ),
			'items_list'            => esc_html_x( 'News list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'web-studio' ),
		),
		'supports' => array('title','author','thumbnail'),
		'public' => true,
		'public_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'has_archive' => true,
		'show_in_rest' => true,
	);

	register_post_type('news', $args);

}
add_action('init', 'web_studio_register');

function taxonomy_link( $link, $term, $taxonomy ) {
    if ( $taxonomy !== 'type' )
        return $link;
    return str_replace( 'type/type/', '', $link );
}
add_filter( 'term_link', 'taxonomy_link', 10, 3 );

function SearchFilter($query) {
	if ($query->is_search) {
	  $query->set('news', 'post');
	}
	return $query;
  }
add_filter('pre_get_posts','SearchFilter');

add_action( 'wp_ajax_load_posts_by_ajax', 'load_posts_by_ajax_callback' ); 
add_action( 'wp_ajax_nopriv_load_posts_by_ajax', 'load_posts_by_ajax_callback' );
 
function load_posts_by_ajax_callback() {
	
        $item = $_POST['item'];
        $page = $_POST['page'];
        if($item = 'more') {
	 $news = new WP_Query(array(
		'post_type' => 'news',
		'posts_per_page' => 3,
		'paged' => $page,
		'orderby' => 'new-date',
		'order' => 'ASC'
	 ));

	 if($news->have_posts()) {
                while($news->have_posts()){
                        $news->the_post();?>
                        <div class="portfolio__cart">
                                <div class="portfolio__img">
                                        <?php the_post_thumbnail(); ?>
                                </div>
                                <div class="portfolio__title">
                                        <a href="<?php echo the_permalink() ?>"><?php the_title(); ?></a>
                                </div>
                                <div class="portfolio__category">
                                        <p><?php 
                                                $terms =  get_the_terms($post->ID, 'Type');
                                                foreach($terms as $term) {
                                                        echo $term->description;
                                                }
                                        ?></p>
                                </div>
                        </div>
                <?php }
	 }
         wp_reset_postdata();
        }
         wp_die();
}

add_action( 'wp_ajax_filter', 'filter_by_ajax_callback' ); 
add_action( 'wp_ajax_nopriv_filter', 'filter_by_ajax_callback' );

function filter_by_ajax_callback() {
        $page = $_POST['page'];
        global $post;
         $termId = $_POST['id'];
         
         $news = new WP_Query(array(
		'post_type' => 'news',
		'posts_per_page' => -1,
                'paged' => $page,
		'orderby' => 'new-date',
		'order' => 'ASC'
	 ));
         if($news->have_posts()) {
                while($news->have_posts()){
                        $news->the_post();
                        $terms_current = get_the_terms($post->ID, 'Type');
                        foreach($terms_current as $term_current) {
                          $term = $term_current->term_id;
                        }
                        if($term === intval($termId)){?>                                                
                        <div class="portfolio__cart">
                                <div class="portfolio__img">
                                        <?php the_post_thumbnail(); ?>
                                </div>
                                <div class="portfolio__title">
                                        <a href="<?php echo the_permalink() ?>"><?php the_title(); ?></a>
                                </div>
                                <div class="portfolio__category">
                                        <p><?php 
                                                $terms =  get_the_terms($post->ID, 'Type');
                                                foreach($terms as $term) {
                                                        echo $term->description;
                                                }
                                        ?></p>
                                </div>
                        </div>
                <?php }}
	 }
         wp_reset_postdata();
}

add_action( 'wp_ajax_all_posts', 'all_posts_callback' ); 
add_action( 'wp_ajax_nopriv_all_posts', 'all_posts_callback' );
function all_posts_callback() {
        $news = new WP_Query(array(
		'post_type' => 'news',
		'posts_per_page' => -1,
		'orderby' => 'new-date',
		'order' => 'ASC'
	 ));

	 if($news->have_posts()) {
                while($news->have_posts()){
                        $news->the_post();?>
                        <div class="portfolio__cart">
                                <div class="portfolio__img">
                                        <?php the_post_thumbnail(); ?>
                                </div>
                                <div class="portfolio__title">
                                        <a href="<?php echo the_permalink() ?>"><?php the_title(); ?></a>
                                </div>
                                <div class="portfolio__category">
                                        <p><?php 
                                                $terms =  get_the_terms($post->ID, 'Type');
                                                foreach($terms as $term) {
                                                        echo $term->description;
                                                }
                                        ?></p>
                                </div>
                        </div>
                <?php }
	 }
         wp_reset_postdata();
}
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

