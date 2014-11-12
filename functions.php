<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 11/9/14
 * Time: 10:54 AM
 */

namespace ObservantRecords\WordPress\Themes\Eponymous4 {

	const WP_TEXT_DOMAIN = 'eponymous4';

	if (!function_exists( __NAMESPACE__ . '\\autoload' )) {
		function autoload( $class_name )
		{
			$class_name = ltrim($class_name, '\\');
			if ( strpos( $class_name, __NAMESPACE__ ) !== 0 ) {
				return;
			}

			$class_name = str_replace( __NAMESPACE__, '', $class_name );

			$path = get_stylesheet_directory() . '/lib' . str_replace('\\', DIRECTORY_SEPARATOR, $class_name) . '.php';

			require_once($path);
		}
	}

	spl_autoload_register(__NAMESPACE__ . '\\autoload');
	Setup::init();

}


