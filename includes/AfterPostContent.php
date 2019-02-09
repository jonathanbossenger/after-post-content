<?php
/**
 * Created by PhpStorm.
 * User: Jonathan Bossenger
 * Date: 2019/02/09
 * Time: 9:35 PM
 */

class AfterPostContent {

	public function __construct() {
		add_filter( 'the_content', array( $this, 'content_filter' ) );
	}

	public function content_filter( $content ) {
		global $post;
		if ( ! is_single( $post ) ) {
			return $content;
		}

		$post_categories = wp_get_post_categories( $post->ID, array( 'fields' => 'names' ) );

		$after_post_content = '';

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

}
