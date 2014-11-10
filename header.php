<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 11/9/14
 * Time: 10:38 AM
 */

namespace ObservantRecords\WordPress\Themes\Eponymous4;

use \ObservantRecords\WordPress\Themes\ObservantRecords2015\TemplateTags;
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
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<link rel='stylesheet' href='//fonts.googleapis.com/css?family=Merriweather+Sans:400,700,700italic,400italic' type='text/css'>
	<link rel="stylesheet" href="<?php echo TemplateTags::get_cdn_uri(); ?>/web/css/facebox.css" type="text/css" media="screen, projection" />
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/typography.css">
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/layout.css">
	<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" type="image/x-icon">
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo TemplateTags::get_cdn_uri(); ?>/web/js/facebox.js"></script>
	<script type="text/javascript">
		var facebox_options = {
			closeImage: '<?php echo TemplateTags::get_cdn_uri(); ?>/web/images/closelabel.gif',
			loadingImage: '<?php echo TemplateTags::get_cdn_uri(); ?>/web/images/loading.gif'
		};
		(function ($) {
			$(function () {
				$('a[rel*=facebox]').facebox(facebox_options);
			});
		})(jQuery);
	</script>
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

			<nav id="nav-column-1" class="col-md-6">
				<?php $nav_menu_args = array( 'theme_location' => 'primary', 'items_wrap' => '<ul id="%1$s" class="%2$s links">%3$s</ul>' ); ?>
				<?php if ( function_exists( 'bootstrap_page_menu' ) ) { $nav_menu_args[ 'fallback_cb' ] = 'bootstrap_page_menu'; } ?>
				<?php wp_nav_menu( $nav_menu_args ); ?>
			</nav>
		</div>
