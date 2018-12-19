<?php
/**
 * Twenty Sixteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

/**
 * Twenty Sixteen only works in WordPress 4.4 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'expert_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * Create your own expert_setup() function to override in a child theme.
 *
 * @since Twenty Sixteen 1.0
 */
function expert_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/expert
	 * If you're building a theme based on Twenty Sixteen, use a find and replace
	 * to change 'expert' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'expert' );

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
	 * Enable support for custom logo.
	 *
	 *  @since Twenty Sixteen 1.2
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 9999 );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'expert' ),
		'social'  => __( 'Social Links Menu', 'expert' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'status',
		'audio',
		'chat',
	) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', expert_fonts_url() ) );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif; // expert_setup
add_action( 'after_setup_theme', 'expert_setup' );

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since Twenty Sixteen 1.0
 */
function expert_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'expert_content_width', 840 );
}
add_action( 'after_setup_theme', 'expert_content_width', 0 );

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since Twenty Sixteen 1.0
 */
function expert_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'expert' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'expert' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Content Bottom 1', 'expert' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'expert' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Content Bottom 2', 'expert' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'expert' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer', 'expert' ),
		'id'            => 'footer',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'expert' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Copyright', 'expert' ),
		'id'            => 'copy',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'expert' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'expert_widgets_init' );

if ( ! function_exists( 'expert_fonts_url' ) ) :
/**
 * Register Google fonts for Twenty Sixteen.
 *
 * Create your own expert_fonts_url() function to override in a child theme.
 *
 * @since Twenty Sixteen 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function expert_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Merriweather font: on or off', 'expert' ) ) {
		$fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';
	}

	/* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'expert' ) ) {
		$fonts[] = 'Montserrat:400,700';
	}

	/* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'expert' ) ) {
		$fonts[] = 'Inconsolata:400';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Sixteen 1.0
 */
function expert_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'expert_javascript_detection', 0 );

/**
 * Enqueues scripts and styles.
 *
 * @since Twenty Sixteen 1.0
 */
function expert_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'expert-fonts', expert_fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.4.1' );

	// Theme stylesheet.
	wp_enqueue_style( 'expert-style', get_stylesheet_uri() );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'expert-ie', get_template_directory_uri() . '/css/ie.css', array( 'expert-style' ), '20160816' );
	wp_style_add_data( 'expert-ie', 'conditional', 'lt IE 10' );

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'expert-ie8', get_template_directory_uri() . '/css/ie8.css', array( 'expert-style' ), '20160816' );
	wp_style_add_data( 'expert-ie8', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'expert-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'expert-style' ), '20160816' );
	wp_style_add_data( 'expert-ie7', 'conditional', 'lt IE 8' );

	// Load the html5 shiv.
	wp_enqueue_script( 'expert-html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
	wp_script_add_data( 'expert-html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'expert-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20160816', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'expert-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20160816' );
	}

	wp_enqueue_script( 'expert-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20160816', true );

	wp_localize_script( 'expert-script', 'screenReaderText', array(
		'expand'   => __( 'expand child menu', 'expert' ),
		'collapse' => __( 'collapse child menu', 'expert' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'expert_scripts' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function expert_body_classes( $classes ) {
	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}

	// Adds a class of group-blog to sites with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of no-sidebar to sites without active sidebar.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'expert_body_classes' );

/**
 * Converts a HEX value to RGB.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function expert_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
	} else if ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function expert_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	if ( 840 <= $width ) {
		$sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';
	}

	if ( 'page' === get_post_type() ) {
		if ( 840 > $width ) {
			$sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
		}
	} else {
		if ( 840 > $width && 600 <= $width ) {
			$sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
		} elseif ( 600 > $width ) {
			$sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
		}
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'expert_content_image_sizes_attr', 10 , 2 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return array The filtered attributes for the image markup.
 */
function expert_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( 'post-thumbnail' === $size ) {
		if ( is_active_sidebar( 'sidebar-1' ) ) {
			$attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
		} else {
			$attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
		}
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'expert_post_thumbnail_sizes_attr', 10 , 3 );

/**
 * Modifies tag cloud widget arguments to display all tags in the same font size
 * and use list format for better accessibility.
 *
 * @since Twenty Sixteen 1.1
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array The filtered arguments for tag cloud widget.
 */
function expert_widget_tag_cloud_args( $args ) {
	$args['largest']  = 1;
	$args['smallest'] = 1;
	$args['unit']     = 'em';
	$args['format']   = 'list'; 

	return $args;
}
add_filter( 'widget_tag_cloud_args', 'expert_widget_tag_cloud_args' );
/*********************Get Star Rating ****************/
function rating_stars11( $rating ){
//echo $rating; die;
            $output = '';

            if ( ! empty( $rating ) ) {

                $output = '<span class="rating-stars">';

                for ( $count = 1; $count <= $rating; $count++ ) {
                    $output .= '<i class="fa fa-star-o rated"></i>';
                }

                $unrated = 5 - $rating;
                for ( $count = 1; $count <= $unrated; $count++ ) {
                    $output .= '<i class="fa fa-star-o"></i>';
                }

                $output .= '</span>';
            }

            return $output;
        }
//change text to leave a reply on comment form
function isa_comment_reform ($arg) {
$arg['title_reply'] = __('Leave a Comment:');
return $arg;
}
add_filter('comment_form_defaults','isa_comment_reform');
/***************Booking Request*************/
add_action('wp_ajax_book_insider', 'book_insider');
add_action('wp_ajax_nopriv_book_insider', 'book_insider');
function book_insider(){
	global $wpdb;
	//print_r($_POST);
	$current_user = wp_get_current_user();
	$UserId = $current_user->ID;
	$UserEmail = $current_user->user_email; 
    $UserName = $current_user->user_firstname . $current_user->user_lastname; 
	$InsiderName = $_POST['InsiderName'];
	$InsiderId = $_POST['InsiderID'];
	$admin_email = get_option('admin_email');
    $to = $admin_email;
	$subject = 'Insider Booking Reqest';
	$headers = "From: " . strip_tags($UserEmail) . "\r\n";
	$headers .= "Reply-To: ". strip_tags($UserEmail) . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
	$message = '<p><strong>Dear Admin,</strong><br/>Below are the details of Insider booking Request</p>';
	$message .= '<p><strong>User Name: </strong>' .$UserName.'</p>';
	$message .= '<p><strong>User Email: </strong>' .$UserEmail.'</p>';
	$message .= '<p><strong>Insider Name: </strong>' .$InsiderName.'</p>';
	$message .= '<p><strong>Insider ID: </strong>' .$InsiderId.'</p>';
    if(mail($to, $subject, $message, $headers))
	{
		$sql = "INSERT INTO `wp_book_insiders` (`UserId`,`UserName`,`InsiderId`,`InsiderName`) values ($UserId, '$UserEmail', $InsiderId, '$InsiderName')";
		//echo $sql; die;
        $inserId = $wpdb->query($sql);
		if($inserId)
		{
		   echo 1;
		   die;
		}
	}

}
/***************Modify Looged In message for comment*************/
add_filter( 'comment_form_defaults', function( $fields ) {
	$url = site_url();
    $fields['must_log_in'] = sprintf( 
        __( '<p class="must-log-in">
                 You must <a href="'.$url.'/login">Login</a> to post a comment.</p>' 
        ),
        wp_registration_url(),
        wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )   
    );
    return $fields;
});
/***************Get Insider*************/
add_action('wp_ajax_get_insider', 'get_insider');
add_action('wp_ajax_nopriv_get_insider', 'get_insider');
function get_insider(){
	global $wpdb;
	$join='';
	$where='';
	$html ='';
	//print_r($_POST);
	 $totalRowCount = $wpdb->get_var("SELECT COUNT(*) FROM wp_posts AS wps ".$join." WHERE `post_type` = 'insider' AND `ID` < ".$_POST['insiderid']." ".$where." and `post_status` = 'publish' order by id DESC");
	$showLimit = 5;
     $sql = "SELECT distinct  wps.* FROM wp_posts AS wps ".$join." WHERE `post_type` = 'insider' AND `ID` < ".$_POST['insiderid']." ".$where." and `post_status` = 'publish' order by id DESC LIMIT ".$showLimit.""; 
	 $results = $wpdb->get_results($sql, OBJECT);
        if(!empty($results))
				{
				foreach($results as $row):
			//print_r($row);
			$post_id = $row->ID;	
            $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post_id) );
			$link= $row->guid;
			$tilte= $row->post_title;
			$content =$row->post_content;
			/*****************Get Cooments***********/
            $args = array(
                'post_id' => $post_id,
                'status' => 'approve'
            );

            $comments = get_comments( $args );
            $ratings = array();
            $count = 0;

            foreach( $comments as $comment ) {

                $rating = get_comment_meta( $comment->comment_ID, 'rating', true );

                if ( ! empty( $rating ) ) {
                    $ratings[] = absint( $rating );
                    $count++;
                }
            }
	    $html .='<div class="insider-row">
		<div class="i-logo"><a href="'.$link.'"><img src="'.$feat_image.'" alt="" /></a></div>
		<div class="i-about">
<h3><a href="'.$link.'" style="color:#22262d;text-decoration:none;">'.$tilte.' </a></h3>'.$content.'</div>';
$html .='<div class="i-ratings">';
			if ( 0 != count( $ratings )  ) { 
			$html .='<div class="ratings">';
                $avg = round( array_sum( $ratings ) / count( $ratings ) );
                 $html .=rating_stars11( $avg ).
					'</div>
					<p>'.$count.' reviews</p>';
		            }
				    else
				    {
				$html .='<p>no reviews</p>';
		             } 
  $Consultcount = $wpdb->get_var("SELECT COUNT(*) FROM `wp_book_insiders` WHERE InsiderId = $post_id");	
   $html .='<p>'.$Consultcount.' consult</p>
				</div>
			<div class="clr"></div>
			</div>';
  endforeach;  
 if($totalRowCount > $showLimit){ 
         $html .='<div class="show_more_main" id="show_more_main'.$post_id.'">
            <span id="'.$post_id.'" class="show_more" title="Load more posts">Show more</span>
            <span class="loding" style="display: none;"><span class="loding_txt">Loading...</span></span>
        </div>';
        }
	}
echo $html;
die;	
}
