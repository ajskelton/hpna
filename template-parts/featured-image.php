<?php
/**
 * Displays the featured image
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

if ( has_post_thumbnail() && ! post_password_required() ) {

	$featured_media_inner_classes = '';
	
	$link = get_permalink();
	
	if ( 'hpna-newsletters' === get_post_type() ) {
	    $link = get_field( 'newsletter')['url'];
    }

	// Make the featured media thinner on archive pages.
	if ( ! is_singular() ) {
		$featured_media_inner_classes .= ' medium';
	}
	?>

	<figure class="featured-media">

		<div class="featured-media-inner section-inner<?php echo $featured_media_inner_classes; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static output ?>">

            <a href="<?php echo esc_url( $link ); ?>" target="_blank">
			<?php
			the_post_thumbnail();

			$caption = get_the_post_thumbnail_caption();

			if ( $caption ) {
				?>

				<figcaption class="wp-caption-text"><?php echo esc_html( $caption ); ?></figcaption>

				<?php
			}
			?>
            </a>

		</div><!-- .featured-media-inner -->

	</figure><!-- .featured-media -->

	<?php
}
