<?php
/*
Plugin Name: Icon to Link
Plugin URI: http://toscho.de/2010/wordpress-plugin-icon-to-link/
Description: Changes upload icons in the edit screen into text links.
Version: 1.0
Author: Thomas Scholz
Author URI: http://toscho.de
*/

add_action( 'admin_init', 'itb_change' );
/**
 * Registers the script on editor pages.
 * @return void
 */
function itb_change()
{
	// Load the script on editor pages only.
	if ( empty ( $GLOBALS['pagenow'] )
		or ! ( 'post.php' == $GLOBALS['pagenow']
			or 'post-new.php' == $GLOBALS['pagenow'] )
	)
	{
		return;
	}

	$handle  = 'icon-to-links';

	wp_register_script( $handle, plugins_url( 'itl.js', __FILE__ ), 'jquery', '0.4', TRUE );
	wp_enqueue_script( $handle );

	// Localize
	$text = array (
		'image' => __( 'Image' )
	,	'video' => __( 'Video' )
	,	'audio' => __( 'Audio' )
	,	'file'  => _x( 'File', 'column name' )
	);

	// To change the names, add a filter for 'itl_names'.
	$text = apply_filters( 'itl_names', $text );
	wp_localize_script( $handle, 'i2l', $text );
}

/**
 * Sample filter:

add_filter( 'itl_names', 'change_itl_names', 10, 1 );
function change_itl_names( $names )
{
	$names['image'] = 'Foto';
	return $names;
}

*/