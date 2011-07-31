<?php
/**
 * 2010 Translucence plugin functions 
 *
 * Add here any functions from plugins
 *
 * @package WordPress
 * @subpackage 2010_Translucence
 * @since 2010 Translucence 1.0
 */
 
/**
 * default twentyeleven_posted_on() overridden here to support use of
 * co-author plugin
 *
 * Prints HTML with meta information for the current post-date/time and author.
 * Create your own twentyeleven_posted_on to override in a child theme
 *
 * @since 2011 Translucence 1.0
 */
function twentyeleven_posted_on() {
	printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a>', 'twentyeleven' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	if (function_exists('coauthors_posts_links')) {
		print ( __( '<span class="sep"> by </span>' ));
		coauthors_posts_links();
	} else {
		print ( __( '<span class="sep"> by </span>' ));
		the_author_posts_link();
	}

}


 /**
 * default translucence_get_author() overridden here to support use of
 * co-author plugin
 *
 * @since 2011 Translucence 1.0
 * @return string link to parent page
 */

function twentyeleven_translucence_get_author() {
	if ( function_exists('coauthors_posts_links') ) {
		$i = new CoAuthorsIterator();
		while ($i->iterate()) {
			twentyeleven_translucence_get_author_info();
		}
	} else {
		twentyeleven_translucence_get_author_info();
	}
}



?>
