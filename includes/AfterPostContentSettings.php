<?php
/**
 * Created by PhpStorm.
 * User: Jonathan Bossenger
 * Date: 2019/02/09
 * Time: 9:34 PM
 */

class AfterPostContentSettings {

	public function __construct() {
		$this->register_settings_sections();
		$this->regsiter_settings_fields();
	}

	public function register_settings_sections() {
		add_settings_section(
			'apc_setting_section',
			'After post content settings',
			array( $this, 'apc_settings_section' ),
			'reading'
		);
	}

	public function regsiter_settings_fields() {
		$categories = get_categories(
			array(
				'orderby' => 'name',
				'order'   => 'ASC',
			)
		);
		foreach ( $categories as $category ) {
			register_setting( 'reading', 'apc_after_post_content_for' . $category->slug );
			add_settings_field(
				'apc_after_post_content_for' . $category->slug,
				'After Post Content For ' . $category->name,
				array( $this, 'after_post_content_field' ),
				'reading',
				'apc_setting_section'
			);
		}
	}

	public function apc_settings_section() {
		echo '<p>After Post Content information.</p>';
	}

	public function post_content_settings() {
		// get the value of the setting we've registered with register_setting()
		$setting = get_option( 'apc_after_post_content' );
		// output the field
		?>
		<input type="text" name="apc_after_post_content" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
		<?php
	}

}
