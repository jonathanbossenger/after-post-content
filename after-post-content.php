<?php
/*
 * Plugin Name: After Post Content
 * Version: 1.0
 * Plugin URI: http://atlanticwave.co/
 * Description: Add some custom content after posts.
 * Author: Atlantic Wave
 * Author URI: http://atlanticwave.co/
 * Requires at least: 4.0
 * Tested up to: 4.0
 *
 * Text Domain: aw-divi-post-controls
 * Domain Path: /lang/
 *
 * @package WordPress
 * @author Atlantic Wave
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_filter( 'the_content', 'apc_content_filter' );
function apc_content_filter( $content ) {
	global $post;
	if ( ! is_single( $post ) ) {
		return $content;
	}

	$post_categories = wp_get_post_categories( $post->ID, array( 'fields' => 'names' ) );

	$after_post_content = '';
	/* hard coding this for now, should be dynamic at some later stage, but too lazy */

	// first Freelancing
	if ( empty( $after_post_content ) && in_array( 'Freelancing', $post_categories ) ) {
		$after_post_content = '
        <div class="after-post-content">
            <a href="https://codeable.io/?ref=E0fMZ">
              <img style="width: auto;" src=\'https://referoo.co/creatives/19/asset.png\' />
            </a>
        </div>';
	}
	// then Divi
	if ( empty( $after_post_content ) && in_array( 'Divi', $post_categories ) ) {
		$after_post_content = '
        <div class="after-post-content">
            <div class="after-post-emp">
                <a href="https://elegantmarketplace.com/">Buy my Divi Plugins from<br> Elegant Marketplace.</a>    
            </div>
        </div>';
	}

	// then WordPress
	if ( empty( $after_post_content ) && in_array( 'WordPress', $post_categories ) ) {
		$after_post_content = '
        <div class="after-post-content">
            <div class="after-post-wordpress">
                <a href="https://wordpress.org/">Download WordPress.</a>    
            </div>
        </div>';
	}

	return $content . $after_post_content;
}


add_action( 'wp_head', 'apc_hook_css' );
function apc_hook_css() {
	$site_url = get_site_url();
	$output   = "<style> 
        .after-post-content { margin: 50px 0; }
        .after-post-content a { color: #fff; text-align: center; display: block; font-size: 18px; box-shadow: none; }
		.after-post-content a:hover { box-shadow: none; }
        .after-post-wordpress { padding: 20px; margin: 0 30px; background-color: #21759b; background-image: url(" . $site_url . "/wp-content/uploads/adverts/wordpress-logo-notext-rgb-small.png); background-repeat: no-repeat; background-position: 10px; }
        .after-post-emp { padding:20px; margin: 0 30px; background-color: #e56c10; background-image: url(" . $site_url . "/wp-content/uploads/adverts/emp-site-logo.png); background-repeat: no-repeat; background-position: 10px; }
    </style>";

	echo $output;

}

