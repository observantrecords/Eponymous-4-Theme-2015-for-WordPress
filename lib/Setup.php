<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 11/11/14
 * Time: 5:15 PM
 */

namespace ObservantRecords\WordPress\Themes\Eponymous4;

class Setup {

	public function __construct() {

	}

	public static function init() {

		add_action( 'widgets_init', array( __CLASS__, 'widgets_init' ) );

	}

	public static function widgets_init() {

		register_sidebar( array(
			'name'          => __( 'Video Page Sidebar', WP_TEXT_DOMAIN ),
			'id'            => 'sidebar-video',
			'description'   => __( 'Appears the Eponymous 4 Video page page only.', WP_TEXT_DOMAIN ),
			'before_widget' => '<aside id="%1$s" class="%2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		) );
	}
}