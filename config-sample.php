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
$twentyeleven_translucence_config['custom_header']['shore']['url'] = "$header_dir/images/headers/shore.jpg";
$twentyeleven_translucence_config['custom_header']['shore']['thumbnail_url'] = "$header_dir/images/headers/shore-thumbnail.jpg";
$twentyeleven_translucence_config['custom_header']['shore']['description'] = __( 'None', '2011-translucence' );

$twentyeleven_translucence_config['custom_header']['pine-cone']['url'] = "$header_dir/images/headers/pine-cone.jpg";
$twentyeleven_translucence_config['custom_header']['pine-cone']['thumbnail_url'] = "$header_dir/images/headers/pine-cone-thumbnail.jpg";
$twentyeleven_translucence_config['custom_header']['pine-cone']['description'] = __( 'White Gradient', '2011-translucence' );

