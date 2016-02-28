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
		$query->with('song', 'recording.audio')->orderBy('track_disc_num')->orderBy('track_track_num');
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
						<th class="play-column">&nbsp;</th>
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
							<td class="play-column">
								<?php if ((boolean) $track->track_audio_is_linked === true && !empty( $track->recording->audio ) ): ?>
									<audio id="track-<?php echo $track->track_recording_id; ?>" preload="none">
										<?php foreach ($track->recording->audio as $audio): ?>
											<source src="/audio/<?php echo $audio->audio_id; ?>/" type="<?php echo $audio->audio_file_type;?>" />
										<?php endforeach; ?>
									</audio>
									<a href="#" id="button-<?php echo $track->track_recording_id; ?>" class="play-button"><img src="<?php echo TemplateTags::get_cdn_uri(); ?>/web/images/icons/speaker-grey.gif" alt="[Play]" title="[Play]" /></a>
								<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>

				<p>
					<audio controls id="page-playback"></audio>
				</p>

				<script type="text/javascript">
					(function ($) {
						$('.play-button').click(function () {
							// Get the visible control on the page.
							var page_playback = document.getElementById('page-playback');

							// Remove anything that's currently loaded or playing.
							page_playback.pause();
							$(page_playback).removeAttr('src');
							$(page_playback).find('source').remove();

							// Get the source from the speaker icon that was clicked.
							var recording_id = String(this.id).split('-')[1];

							// Replace the visible control with the clicked source.
							$('#track-' + recording_id).children('source').each(function () {
								var source = $(this).clone();
								// Only load the source that can be played by the browser.
								if (page_playback.canPlayType($(this).attr('type')) != '') {
									source.appendTo(page_playback);
									return false;
								}
							});

							// Warn the user if no files could be found supported by the browser.
							if ($(page_playback).children('source').length < 1) {
								alert('A file supported by this browser is not yet available to play. We\'re working on providing one soon!');
								return false;
							}

							// Play the file.
							page_playback.play();

							// Don't let the anchor go anywhere.
							return false;
						});
					})(jQuery);
				</script>
			<?php endif; ?>
		<?php endif;?>

		<?php the_content( __( 'Continue reading &raquo;', WP_TEXT_DOMAIN ) ); ?>
	</div>

</article>
