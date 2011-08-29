<?php
/**
 * Twenty Eleven Translucence functions and definitions
 * 
 * Notes from Twenty Eleven functions and definitions
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'twentyeleven_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

/**
 * Get the 2011 translucence config.
*/

 if (!function_exists('twentyeleven_translucence_add_config')) {
	function twentyeleven_translucence_add_config() {

	   if (file_exists(dirname(__FILE__).'/config.php')) {
			require_once('config.php');
		} else if (file_exists(dirname(__FILE__).'/config-sample.php')) {
			require_once('config-sample.php');
		}
	return $twentyeleven_translucence_config;
	}
}


$twentyeleven_translucence_config = twentyeleven_translucence_add_config();
/**
 * add functions that depend on plugins
 */

if (file_exists(dirname(__FILE__).'/functions-plugins.php')) {
	require_once('functions-plugins.php');
}


/**
 * Sets up defaults for child theme that are different from parent
 *
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since 2011 Translucence 1.0
 */
function twentyeleven_translucence_setup() {
// 	define( 'HEADER_IMAGE_WIDTH', 950 );
// 	define( 'HEADER_IMAGE_HEIGHT', 150 );
}
add_action( 'after_setup_theme', 'twentyeleven_translucence_setup' );


/**
 * Styles the header image and text displayed on the blog
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_header_style() {

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == get_header_textcolor() )
		return;
	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == get_header_textcolor() ) :
	?>
		#site-title,
		#site-description {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		#site-title a,
		#site-description {
			color: #<?php echo get_header_textcolor(); ?> !important;
		}
	<?php endif; ?>
	</style>
	<?php
}


/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in twentyeleven_setup().
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_admin_header_image() { ?>
	<div id="headimg">
		<?php
		if ( 'blank' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) || '' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) )
			$style = ' style="display:none;"';
		else
			$style = ' style="color:#' . get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) . ';"';
		?>
		<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<img src="<?php echo esc_url( $header_image ); ?>" alt="" />
		<?php endif; ?>
	</div>
<?php }

/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentyeleven_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'twentyeleven' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
						$avatar_size = 68;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 39;

						echo get_avatar( $comment, $avatar_size );

						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s on %2$s <span class="says">said:</span>', 'twentyeleven' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s at %2$s', 'twentyeleven' ), get_comment_date(), get_comment_time() )
							)
						);
					?>

					<?php edit_comment_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-author .vcard -->

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentyeleven' ); ?></em>
					<br />
				<?php endif; ?>

			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'twentyeleven' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}

add_filter( 'twentyeleven_color_schemes', 'twentyeleven_color_schemes_translucence' );
add_action( 'twentyeleven_enqueue_color_scheme', 'twentyeleven_enqueue_color_scheme_translucence' );

function twentyeleven_color_schemes_translucence( $color_schemes ) {
	global $twentyeleven_translucence_config;
	
 	$color_schemes = $twentyeleven_translucence_config['color_schemes'];
	
	return $color_schemes;
}

function twentyeleven_enqueue_color_scheme_translucence( $color_scheme ) {
	if ( 'blue' == $color_scheme ) {
		wp_enqueue_style( 'blue', get_stylesheet_directory_uri() . '/colors/blue.css', array(), null );
	} else if ( 'gray-white' == $color_scheme ) {
		wp_enqueue_style( 'gray-white', get_stylesheet_directory_uri() . '/colors/gray-white.css', array(), null );
	} else if ( 'white-gray' == $color_scheme ) {
		wp_enqueue_style( 'white-gray', get_stylesheet_directory_uri() . '/colors/white-gray.css', array(), null );
	}
}

/** Enqueue the stylesheet for the current color scheme into the child theme. */
function twentyeleven_translucence_enqueue_color_scheme() {
    $options = twentyeleven_get_theme_options();
    $color_scheme = $options['color_scheme'];
    if ( 'dark' == $color_scheme )
        wp_enqueue_style( 'dark_child', get_stylesheet_directory_uri() . '/colors/dark.css', array(), null );
    do_action( 'twentyeleven_translucence_enqueue_color_scheme', 'dark_child' );
}
add_action( 'wp_enqueue_scripts', 'twentyeleven_translucence_enqueue_color_scheme', 11);


 /**
 * Removes Twentyeleven default header images
 *
 *
 * @since 2011 Translucence 1.0
 */
function twentyeleven_translucence_remove_twentyeleven_headers() {
	unregister_default_headers(array('wheel', 'shore', 'trolley', 'pine-cone', 'chessboard', 'lanterns', 'willow', 'hanoi'));
}
add_action('after_setup_theme', 'twentyeleven_translucence_remove_twentyeleven_headers', 11);

 /**
 * Adds 2011 Translucence default header images
 *
 *
 * @since 2011 Translucence 1.0
 */

function twentyeleven_translucence_default_headers() {
	global $twentyeleven_translucence_config;
	
	$options = twentyeleven_get_theme_options();
    $color_scheme = $options['color_scheme'];	
	$config_color_schemes = $twentyeleven_translucence_config['color_schemes'];	
	
	foreach ($config_color_schemes as $config_color_scheme) {
		if ($config_color_scheme['value'] == $color_scheme) {
			$config_custom_header_ids = $twentyeleven_translucence_config['color_schemes'][$color_scheme]['custom_header'];
			$config_custom_header_ids = explode (",", $config_custom_header_ids);
			foreach ($config_custom_header_ids as $config_custom_header_id) {
				$config_custom_headers[$config_custom_header_id] = $twentyeleven_translucence_config['custom_header'][$config_custom_header_id];
			}
		}
	}
	register_default_headers( $config_custom_headers );
	//register_default_headers( $twentyeleven_translucence_config['custom_header'] );
}
add_action('after_setup_theme', 'twentyeleven_translucence_default_headers', 11);

 /**
 * Gets author(s) of a given post
 *
 * Referenced on single.php
 *
 * @since 2011 Translucence 1.0
 * @return string markup with author info
 */
if ( ! function_exists( 'twentyeleven_translucence_get_author' ) ) :
	function twentyeleven_translucence_get_author() {
		$authors = twentyeleven_translucence_get_author_info();
		return $authors;
	}
endif;

 /**
 * Gets info about author of a given post
 *
 *
 * @since 2011 Translucence 1.0
 * @return string markup with author info
 */
 
function twentyeleven_translucence_get_author_info() {
  if ( get_the_author_meta( 'description' ) && is_multi_author() ) { // If a user has filled out their description, show a bio on their entries
    ?>
    <div id="entry-author-info">
      <div id="author-avatar">
        <?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentyten_author_bio_avatar_size', 60 ) ); ?>
      </div><!-- #author-avatar -->
      <div id="author-description">
        <h2><?php printf( esc_attr__( 'About %s', '2011-translucence' ), get_the_author() ); ?></h2>
        <?php the_author_meta( 'description' ); ?>
        <div id="author-link">
          <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
            <?php printf( __( 'View all posts by %s <span class="meta-nav">&raquo;</span>', '2011-translucence' ), get_the_author() ); ?>
          </a>
        </div><!-- #author-link	-->
      </div><!-- #author-description -->
    </div><!-- #entry-author-info -->
    <?php
  }
}

/**
 * Get links to sub or related pages
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @uses wp_list_pages() to get a list of related or sub pages
 * @uses get_pages() to get child pages of $post
 * @uses translucence_page_links_display() to show or hide page links based on document cookie
 *
 * @since 2011 Tranlucence 1.0
 */
function twentyeleven_translucence_page_links($post) {

	if ($post->post_parent) {
		$children = wp_list_pages("title_li=<h3>".get_the_title($post->post_parent)."</h3>&child_of=".$post->post_parent."&echo=0");
		$num_children = get_pages("child_of=".$post->post_parent);
	} else {
		$children = wp_list_pages("title_li=<h3>".get_the_title($post->post_parent)."</h3>&child_of=".$post->ID."&echo=0");
		$num_children = get_pages("child_of=".$post->ID);
	}
								
	if (count($num_children) > 1) {
		print $children;
	}
}

 /**
 * Adds breadcrumbs to child pages
 *
 * Referenced on all page templates
 *
 * @since 2011 Translucence 1.0
 * @return string link to parent page
 */

function twentyeleven_translucence_get_breadcrumbs($post) {

	$parent_title = get_the_title($post->post_parent);
	$parent_url = get_permalink($post->post_parent);
	$post_title = get_the_title($post);

	if ($parent_title != $post_title) { 
		$breadcrumbs = "<div class='breadcrumbs'>";
		$breadcrumbs .= "<a href='".$parent_url."'";
		$breadcrumbs .= " title='".$parent_title ."'>".$parent_title."</a> &raquo; ";
		$breadcrumbs .= get_the_title($post);
		$breadcrumbs .= "</div>";
	} else {
		$breadcrumbs = null;
	}

	return $breadcrumbs;
}

/*********************************************************
 * debugging
 *********************************************************/


function printpre($array, $return=FALSE) {
	ob_start();
	print "\n<pre>";
	print_r($array);
	print "\n</pre>";
	
	if ($return)
		return ob_get_clean();
	else
		ob_end_flush();
}

