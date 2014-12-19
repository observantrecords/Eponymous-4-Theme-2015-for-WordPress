<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 11/11/14
 * Time: 5:15 PM
 */

namespace ObservantRecords\WordPress\Themes\Eponymous4;

use ObservantRecords\WordPress\Themes\ObservantRecords2015;

class Setup {

	public function __construct() {

	}

	public static function init() {

		add_action( 'widgets_init', array( __CLASS__, 'widgets_init' ) );

		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'wp_enqueue_styles'), 21);
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

	public static function wp_enqueue_styles() {
		wp_dequeue_style( 'observantrecords2015-style' );
		wp_dequeue_style( 'observantrecords2015-typography' );
		wp_dequeue_style( 'observantrecords2015-layout' );

		wp_enqueue_style( 'eponymous42015-style', get_stylesheet_uri() );
		wp_enqueue_style( 'eponymous42015-typography', get_stylesheet_directory_uri() . '/css/typography.css' );
		wp_enqueue_style( 'eponymous42015-layout', get_stylesheet_directory_uri() . '/css/layout.css' );
		wp_enqueue_style( 'eponymous42015-fonts', '//fonts.googleapis.com/css?family=Merriweather+Sans:400,700,700italic,400italic' );
	}

}