<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 10/14/14
 * Time: 7:44 PM
 *
 * @package WordPress
 * @subpackage Musicwhore 2015
 * @since Musicwhore 2014 1.0
 */

namespace ObservantRecords\WordPress\Themes\ObservantRecords2015;

use ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Album;
use ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Artist;
use ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Release;

$album_model = new Album();
$lps = $album_model->getManyBy( 'album_format_id', 1,  array( 'order_by' => 'album_order' ) );
$eps = $album_model->getManyBy( 'album_format_id', 3,  array( 'order_by' => 'album_order' ) );
$singles = $album_model->getManyBy( 'album_format_id', 2,  array( 'order_by' => 'album_order' ) );
$compilations = $album_model->getManyBy( 'album_format_id', 4,  array( 'order_by' => 'album_order' ) );

$albums = array(
	'Albums' => $lps,
	'EPs' => $eps,
	'Singles' => $singles,
	'Compilations' => $compilations,
);

$artist_model = new Artist();
$release_model = new Release();

$album_entries = get_posts( array(
	'post_type' => 'album',
	'posts_per_page' => -1,
) );

$album_aliases = array();
if ( count( $album_entries ) > 0 ):
	foreach ($album_entries as $album_entry):
		if ( $album_entry->post_status == 'publish' ) :
			$album_aliases[] = get_post_meta( $album_entry->ID, '_ob_album_alias', true );
		endif;
	endforeach;
endif;

?>
<?php get_header(); ?>

	<div class="col-md-12">

	<?php if ( count( $album_entries ) > 0 ) : ?>
		<header>
			<h2>Releases</h2>
		</header>

		<?php if ( !empty( $albums ) ): ?>
			<?php foreach ($albums as $format => $releases): ?>

		<h3><?php echo $format; ?></h3>

				<?php $r = 1; ?>
				<?php if ($r % 4 != 0):?>
		<div class="row">
				<?php endif; ?>
				<?php foreach ($releases as $album): ?>
						<?php if ( ( false !== ( array_search( $album->album_alias, $album_aliases ) ) ) && (boolean) $album->album_is_visible === true ): ?>
							<?php $album->release = $release_model->get( $album->album_primary_release_id ); ?>
							<?php $album->artist = $artist_model->get( $album->album_artist_id ); ?>
							<?php $cover_url_base = TemplateTags::get_cdn_uri() . '/artists/' . $album->artist->artist_alias . '/albums/' . $album->album_alias . '/' . strtolower($album->release->release_catalog_num) . '/images'; ?>
			<div class="col-md-3">

				<p>
					<a href="/releases/<?php echo $album->album_alias; ?>">
						<img src="<?php echo $cover_url_base; ?>/cover_front_medium.jpg" width="200" alt="<?php echo $album->album_title; ?>" title="<?php echo $album->album_title; ?>" />
					</a>
				</p>

				<ul class="release-list-info">
					<li><strong><a href="/releases/<?php echo $album->album_alias; ?>"><?php echo $album->album_title; ?></a></strong></li>
				</ul>
			</div>
							<?php if ($r % 4 == 0):?>
		</div>
		<div class="row">
							<?php endif; ?>
							<?php $r++; ?>
						<?php endif; ?>
				<?php endforeach; ?>
				<?php if ( ( $r > 1 && $r-1 % 4 != 0 ) || $r == 1 ):?>
		</div>
				<?php endif; ?>
			<?php endforeach; ?>
		<?php endif; ?>

	<?php endif; ?>
	</div>

<?php get_footer();
