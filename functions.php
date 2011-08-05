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
 * add functions that depend on plugins
 */

if (file_exists(dirname(__FILE__).'/functions-plugins.php')) {
	require_once('functions-plugins.php');
}


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
	$color_schemes['blue'] = array(
		'value' => 'blue',
		'label' => __( 'Blue', 'twentyeleven' ),
		'thumbnail' => get_stylesheet_directory_uri() . '/inc/images/blue.png',
		'default_link_color' => '#003366',
	);
	$color_schemes['dark'] = array(
		'value' => 'dark',
		'label' => __( 'dark', 'twentyeleven' ),
		'thumbnail' => get_stylesheet_directory_uri() . '/inc/images/dark.png',
		'default_link_color' => '#FBEB74',
	);
	$color_schemes['gray-white'] = array(
		'value' => 'gray-white',
		'label' => __( 'Gray White', 'twentyeleven' ),
		'thumbnail' => get_stylesheet_directory_uri() . '/inc/images/gray-white.png',
		'default_link_color' => '#003366',
	);
	$color_schemes['white-gray'] = array(
		'value' => 'white-gray',
		'label' => __( 'White Gray', 'twentyeleven' ),
		'thumbnail' => get_stylesheet_directory_uri() . '/inc/images/white-gray.png',
		'default_link_color' => '#003366',
	);	
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
function twentyelevenchild_enqueue_color_scheme() {
    $options = twentyeleven_get_theme_options();
    $color_scheme = $options['color_scheme'];
    if ( 'dark' == $color_scheme )
        wp_enqueue_style( 'dark_child', get_stylesheet_directory_uri() . '/colors/dark.css', array(), null );
    do_action( 'twentyelevenchild_enqueue_color_scheme', 'dark_child' );
}
add_action( 'wp_enqueue_scripts', 'twentyelevenchild_enqueue_color_scheme', 11);

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

