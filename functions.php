<?php
/**
 * Dublin functions and definitions
 *
 * @package Dublin
 */


if ( ! function_exists( 'dublin_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function dublin_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Dublin, use a find and replace
	 * to change 'dublin' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'dublin', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );


	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	// Set the content width based on the theme's design and stylesheet.
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 640;
	}

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size('dublin-project', 350, 250, true);
	add_image_size('dublin-thumb', 720);

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'dublin' ),
		'social' => __( 'Social', 'dublin' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'dublin_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // dublin_setup
add_action( 'after_setup_theme', 'dublin_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function dublin_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'dublin' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '<span class="widget-deco"></span></h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer A', 'dublin' ),
		'id'            => 'sidebar-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer B', 'dublin' ),
		'id'            => 'sidebar-4',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer C', 'dublin' ),
		'id'            => 'sidebar-5',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	//Register the custom widgets
	register_widget( 'Dublin_Video' );
	register_widget( 'Dublin_Recent_Posts' );
	register_widget( 'Dublin_Recent_Comments' );

}
add_action( 'widgets_init', 'dublin_widgets_init' );

/**
 * Load the custom widgets
 */
require get_template_directory() . "/widgets/video-widget.php";
require get_template_directory() . "/widgets/recent-posts.php";
require get_template_directory() . "/widgets/recent-comments.php";


/**
 * Enqueue scripts and styles.
 */
function dublin_scripts() {

	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap/css/bootstrap.min.css', array(), true );

	wp_enqueue_style( 'dublin-style', get_stylesheet_uri() );

	$headings_font = get_theme_mod('headings_fonts');
	$body_font = get_theme_mod('body_fonts');
	if( $headings_font ) {
		wp_enqueue_style( 'dublin-headings-fonts', '//fonts.googleapis.com/css?family='. esc_attr($headings_font) );
	} else {
		wp_enqueue_style( 'dublin-headings-fonts', '//fonts.googleapis.com/css?family=Oswald:400');
	}
	if( $body_font ) {
		wp_enqueue_style( 'dublin-body-fonts', '//fonts.googleapis.com/css?family='. esc_attr($body_font) );
	} else {
		wp_enqueue_style( 'dublin-body-fonts', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,700,400italic,700italic');
	}

	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/fonts/font-awesome.min.css' );

	wp_enqueue_script( 'fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array('jquery'), true );

	wp_enqueue_script( 'dublin-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), true );

	wp_enqueue_script( 'dublin-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'dublin-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'dublin_scripts' );

/**
 * Excerpt length
 */
function dublin_excerpt_length( $length ) {

	$excerpt = get_theme_mod('exc_lenght', '55');
	return $excerpt;

}
add_filter( 'excerpt_length', 'dublin_excerpt_length', 999 );

/**
 * Load html5shiv
 */
function dublin_html5shiv() {
    echo '<!--[if lt IE 9]>' . "\n";
    echo '<script src="' . esc_url( get_template_directory_uri() . '/js/html5shiv.js' ) . '"></script>' . "\n";
    echo '<![endif]-->' . "\n";
}
add_action( 'wp_head', 'dublin_html5shiv' );

/**
 * Row style for the page builder
 */
function dublin_panels_row_styles($styles) {
	$styles['full'] = __('Full width', 'dublin');
	return $styles;
}
add_filter('siteorigin_panels_row_styles', 'dublin_panels_row_styles');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Page Builder row styles
 */
require get_template_directory() . '/inc/row-styles.php';

/**
 * Dynamic styles
 */
require get_template_directory() . '/styles.php';

/**
 *TGM Plugin activation.
 */
require_once dirname( __FILE__ ) . '/tgm/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'dublin_recommend_plugin' );
function dublin_recommend_plugin() {

    $plugins = array(

				array(
            'name'      => 'Page Builder by SiteOrigin',
            'slug'      => 'siteorigin-panels',
            'required'  => false,
        ),
				array(
						'name'      => 'WP Product Reviews',
						'slug'      => 'wp-product-reviews',
						'required'  => false,
					),

				array(
						'name'      => 'Intergeo Maps - Google Maps Plugin',
						'slug'      => 'intergeo-maps',
						'required'  => false
					),

				array(
						'name'     => 'Pirate Forms',
						'slug' 	   => 'pirate-forms',
						'required' => false
					)
    );

    tgmpa( $plugins);

}

/**
 * Change priority for Page Builder inline styles
 */
if ( function_exists('siteorigin_panels_activate') ) {
	remove_action('wp_head', 'siteorigin_panels_print_inline_css');
	add_action('wp_head', 'siteorigin_panels_print_inline_css', 1);
}

/**
 * Migrate favicon from theme favicon to core
 */
function dublin_migrate_favicon(){
	if ( function_exists( 'wp_site_icon' ) ) {
		if ( get_theme_mod('site_favicon') ) {
			$id = attachment_url_to_postid( get_theme_mod('site_favicon') );
			if ( is_int( $id ) ) {
				update_option( 'site_icon', $id );
			}
			remove_theme_mod( 'site_favicon' );
		}
	}
}
add_action( 'after_setup_theme', 'dublin_migrate_favicon' );