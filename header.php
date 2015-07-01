<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 11/9/14
 * Time: 10:38 AM
 */

namespace ObservantRecords\WordPress\Themes\Eponymous4;

?>
<!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel="icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" type="image/x-icon">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

<body>

	<div id="container" class="container">
		<div id="masthead" class="row">
			<header class="col-md-6">
				<h1 id="title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo __('Home', WP_TEXT_DOMAIN); ?>" rel="home">
						<?php bloginfo( 'name' ); ?>
					</a>
				</h1>
			</header>

			<nav id="nav-header" class="col-md-6">
				<?php $nav_menu_args = array( 'theme_location' => 'primary', 'items_wrap' => '<ul id="%1$s" class="%2$s links">%3$s</ul>' ); ?>
				<?php if ( function_exists( 'bootstrap_page_menu' ) ) { $nav_menu_args[ 'fallback_cb' ] = 'bootstrap_page_menu'; } ?>
				<?php wp_nav_menu( $nav_menu_args ); ?>
			</nav>
		</div>

		<div id="content" class="row">
