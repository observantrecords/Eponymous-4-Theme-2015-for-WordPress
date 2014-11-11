<?php
/**
 * Created by PhpStorm.
 * User: gbueno
 * Date: 10/14/2014
 * Time: 10:35 AM
 *
 * @package WordPress
 * @subpackage Musicwhore2015
 * @since Musicwhore 2014 1.0
 */

namespace ObservantRecords\WordPress\Themes\ShinkyokuAdvocacy;

get_header();
?>

<div class="col-md-8">
	<?php
	if ( have_posts() ) :
		// Start the Loop.
		while ( have_posts() ) : the_post();
			get_template_part( 'content', get_post_format() );
		endwhile;
	endif;
	?>
</div>


<?php
get_sidebar( 'about' );
get_footer();
