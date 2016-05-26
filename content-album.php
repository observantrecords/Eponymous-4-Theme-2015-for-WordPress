<?php
/**
 * Created by PhpStorm.
 * User: gbueno
 * Date: 10/14/2014
 * Time: 11:05 AM
 *
 * @package WordPress
 * @subpackage Musicwhore 2015
 * @since Musicwhore 2014 1.0
 */

namespace ObservantRecords\WordPress\Themes\Eponymous4;

use ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Albums\Release;
use \ObservantRecords\WordPress\Themes\ObservantRecords2015\TemplateTags;

$release_alias = get_post_meta( get_the_ID(), '_ob_release_alias' );

if ( !empty( $release_alias )):
	$release = Release::with(['tracks' => function ( $query ) {
		$query->with('song')->orderBy('track_disc_num')->orderBy('track_track_num');
	}])->where('release_alias', $release_alias )->first();
endif;
?>

<article id="post-<?php the_ID(); ?>">

	<header>
		<?php if ( is_single() || is_page() ): ?>
			<?php echo the_title('<h2 class="entry-title">', '</h2>'); ?>
		<?php else: ?>
			<?php echo the_title('<h3 class="entry-title"><a href="' . esc_url( get_permalink() )  . '" rel="bookmark">', '</a></h3>'); ?>
		<?php endif; ?>

		<div class="entry-meta">
			<ul class="list-inline">
				<?php if ( 'post' == get_post_type() ): ?>
					<?php TemplateTags::posted_on(); ?>
				<?php endif; ?>

				<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
					<li><span class="glyphicon glyphicon-comment"></span> <?php comments_popup_link( __( 'Leave a comment', WP_TEXT_DOMAIN ), __( '1 Comment', WP_TEXT_DOMAIN ), __( '% Comments', WP_TEXT_DOMAIN ) ); ?></li>
				<?php endif; ?>

				<?php edit_post_link( __( 'Edit', WP_TEXT_DOMAIN ), '<li><span class="glyphicon glyphicon-pencil"></span>', '</li>' ); ?>
			</ul>
		</div>

	</header>

	<div <?php post_class(); ?>>
		<?php if ( is_single() ): ?>
			<?php if ( count( $release->tracks ) > 0 ): ?>
				<table class="track-table table table-striped">
					<thead>
					<tr>
						<th class="track-column">Track</th>
						<th>Title</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($release->tracks as $track): ?>
						<tr>
							<td class="track-column"><?php echo $track->track_track_num; ?></td>
							<td>
								<?php if ((boolean) $track->track_is_visible === true && !empty( $track->track_alias ) ): ?>
									<?php $track_query = new \WP_Query( array( 'meta_key' => '_ob_track_alias', 'meta_value' => $track->track_alias, 'post_type' => 'track' ) ); ?>
									<?php if (!empty( $track_query->posts[0] ) ): ?>
									<a href="<?php echo get_permalink( $track_query->posts[0]->ID ); ?>"><?php echo $track->song->song_title; ?></a>
									<?php else: ?>
										<?php echo $track->song->song_title; ?>
									<?php endif; ?>
								<?php else: ?>
									<?php echo $track->song->song_title; ?>
								<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>

			<?php endif; ?>
		<?php endif;?>

		<?php the_content( __( 'Continue reading &raquo;', WP_TEXT_DOMAIN ) ); ?>
	</div>

</article>
