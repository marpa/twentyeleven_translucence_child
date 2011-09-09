<?php
/*********************************************************
 * 
 * Configuration options for 2011 Translucence theme
 * To create your own configuration options save this file
 * as config.php in this child theme
 *
 *********************************************************/
$twentyeleven_translucence_config = array();

/******************************************************************************
 * Custom headers
 ******************************************************************************/
$header_dir = get_bloginfo('stylesheet_directory');
$twentyeleven_translucence_config['custom_header']['central-park']['url'] = "$header_dir/images/headers/central-park.gif";
$twentyeleven_translucence_config['custom_header']['central-park']['thumbnail_url'] = "$header_dir/images/headers/central-park-thumbnail.jpg";
$twentyeleven_translucence_config['custom_header']['central-park']['description'] = __( 'Central Park', '2011-translucence' );
$twentyeleven_translucence_config['custom_header']['central-park']['color_schemes'] = "dark,transparent-dark";


$twentyeleven_translucence_config['custom_header']['rockefeller-view']['url'] = "$header_dir/images/headers/rockefeller-view.gif";
$twentyeleven_translucence_config['custom_header']['rockefeller-view']['thumbnail_url'] = "$header_dir/images/headers/rockefeller-view-thumbnail.jpg";
$twentyeleven_translucence_config['custom_header']['rockefeller-view']['description'] = __( 'Rockefeller View', '2011-translucence' );
$twentyeleven_translucence_config['custom_header']['rockefeller-view']['color_schemes'] = "dark,transparent-dark";

$twentyeleven_translucence_config['custom_header']['paris-nights01']['url'] = "$header_dir/images/headers/paris-nights01.gif";
$twentyeleven_translucence_config['custom_header']['paris-nights01']['thumbnail_url'] = "$header_dir/images/headers/paris-nights01-thumbnail.jpg";
$twentyeleven_translucence_config['custom_header']['paris-nights01']['description'] = __( 'Paris Nights01', '2011-translucence' );
$twentyeleven_translucence_config['custom_header']['paris-nights01']['color_schemes'] = "dark,transparent-dark";


$twentyeleven_translucence_config['custom_header']['moss-drops']['url'] = "$header_dir/images/headers/moss-drops.jpg";
$twentyeleven_translucence_config['custom_header']['moss-drops']['thumbnail_url'] = "$header_dir/images/headers/moss-drops-thumbnail.jpg";
$twentyeleven_translucence_config['custom_header']['moss-drops']['description'] = __( 'Moss Drops', '2011-translucence' );
$twentyeleven_translucence_config['custom_header']['moss-drops']['color_schemes'] = "blue,transparent-light";

$twentyeleven_translucence_config['custom_header']['waves01']['url'] = "$header_dir/images/headers/waves01.jpg";
$twentyeleven_translucence_config['custom_header']['waves01']['thumbnail_url'] = "$header_dir/images/headers/waves01-thumbnail.jpg";
$twentyeleven_translucence_config['custom_header']['waves01']['description'] = __( 'Waves', '2011-translucence' );
$twentyeleven_translucence_config['custom_header']['waves01']['color_schemes'] = "blue,transparent-light,light";


/******************************************************************************
 * Color schemes
 ******************************************************************************/
$twentyeleven_translucence_config['color_scheme'] = "random";
$twentyeleven_translucence_config['random-light'] = "blue,white-gray,gray-white,transparent-light";
$twentyeleven_translucence_config['random-dark'] = "dark,transparent-dark";

$twentyeleven_translucence_config['color_schemes']['blue']['value'] = 'blue';
$twentyeleven_translucence_config['color_schemes']['blue']['label'] = __( 'Blue', 'twentyeleven' );
$twentyeleven_translucence_config['color_schemes']['blue']['thumbnail'] = get_stylesheet_directory_uri() . '/inc/images/blue.png';
$twentyeleven_translucence_config['color_schemes']['blue']['default_link_color'] = '#003366';
$twentyeleven_translucence_config['color_schemes']['blue']['custom_header'] = 'moss-drops,waves01';

$twentyeleven_translucence_config['color_schemes']['light']['value'] = 'light';
$twentyeleven_translucence_config['color_schemes']['light']['label'] = __( 'Light', 'twentyeleven' );
$twentyeleven_translucence_config['color_schemes']['light']['thumbnail'] = get_stylesheet_directory_uri() . '/inc/images/light.png';
$twentyeleven_translucence_config['color_schemes']['light']['default_link_color'] = '#003366';
$twentyeleven_translucence_config['color_schemes']['light']['custom_header'] = 'moss-drops,waves01';

$twentyeleven_translucence_config['color_schemes']['dark']['value'] = 'dark';
$twentyeleven_translucence_config['color_schemes']['dark']['label'] = __( 'Dark', 'twentyeleven' );
$twentyeleven_translucence_config['color_schemes']['dark']['thumbnail'] = get_stylesheet_directory_uri() . '/inc/images/dark.png';
$twentyeleven_translucence_config['color_schemes']['dark']['default_link_color'] = '#FFC';
$twentyeleven_translucence_config['color_schemes']['dark']['custom_header'] = 'rockefeller-view,paris-nights01';

$twentyeleven_translucence_config['color_schemes']['white-gray']['value'] = 'white-gray';
$twentyeleven_translucence_config['color_schemes']['white-gray']['label'] = __( 'White Gray', 'twentyeleven' );
$twentyeleven_translucence_config['color_schemes']['white-gray']['thumbnail'] = get_stylesheet_directory_uri() . '/inc/images/white-gray.png';
$twentyeleven_translucence_config['color_schemes']['white-gray']['default_link_color'] = '#003366';
$twentyeleven_translucence_config['color_schemes']['white-gray']['custom_header'] = 'moss-drops,waves01';

$twentyeleven_translucence_config['color_schemes']['gray-white']['value'] = 'gray-white';
$twentyeleven_translucence_config['color_schemes']['gray-white']['label'] = __( 'Gray White', 'twentyeleven' );
$twentyeleven_translucence_config['color_schemes']['gray-white']['thumbnail'] = get_stylesheet_directory_uri() . '/inc/images/gray-white.png';
$twentyeleven_translucence_config['color_schemes']['gray-white']['default_link_color'] = '#003366';
$twentyeleven_translucence_config['color_schemes']['gray-white']['custom_header'] = 'moss-drops,waves01';

$twentyeleven_translucence_config['color_schemes']['transparent-light']['value'] = 'transparent-light';
$twentyeleven_translucence_config['color_schemes']['transparent-light']['label'] = __( 'Transparent Light', 'twentyeleven' );
$twentyeleven_translucence_config['color_schemes']['transparent-light']['thumbnail'] = get_stylesheet_directory_uri() . '/inc/images/transparent-light.png';
$twentyeleven_translucence_config['color_schemes']['transparent-light']['default_link_color'] = '#003366';
$twentyeleven_translucence_config['color_schemes']['transparent-light']['custom_header'] = 'moss-drops,waves01';

$twentyeleven_translucence_config['color_schemes']['transparent-dark']['value'] = 'transparent-dark';
$twentyeleven_translucence_config['color_schemes']['transparent-dark']['label'] = __( 'Transparent Dark', 'twentyeleven' );
$twentyeleven_translucence_config['color_schemes']['transparent-dark']['thumbnail'] = get_stylesheet_directory_uri() . '/inc/images/transparent-dark.png';
$twentyeleven_translucence_config['color_schemes']['transparent-dark']['default_link_color'] = '#FFC';
$twentyeleven_translucence_config['color_schemes']['transparent-dark']['custom_header'] = 'rockefeller-view,paris-nights01,central-park';
