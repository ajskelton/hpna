<?php
/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php
    
    if ( ! is_single() ) {
	    get_template_part( 'template-parts/entry-header' );
    }

	if ( ! is_search() ) {
		get_template_part( 'template-parts/featured-image' );
	}

	?>

	<div class="post-inner <?php echo is_single() ? '' : 'post-inner--thumbnail-content' ?>">
        
        <?php if ( ! is_single() ) : ?>
            <div class="entry-content__thumbnail">
                <?php echo hpna_load_inline_svg( '/meeting-minutes.svg' ); ?>
            </div>
        <?php endif; ?>

		<div class="entry-content<?php echo !is_single() ? '__post' : '' ?>">

			<?php
			the_content( __( 'Read More &#187;', 'twentytwenty' ) );
			
			$minutes = get_field( 'minutes' );
			
			if ( $minutes && isset( $minutes['url'] ) ) :
			?>
            <div class="wp-block-buttons mt-8">
                <div class="wp-block-button"><a class="wp-block-button__link has-green-background-color has-background" href="<?php echo esc_url( $minutes['url'] ); ?>" target="_blank" rel="noreferrer noopener">Download the Minutes</a></div>
            </div>
            <?php endif; ?>

		</div><!-- .entry-content -->

	</div><!-- .post-inner -->

	<div class="section-inner">
		<?php

		edit_post_link();

		?>

	</div><!-- .section-inner -->

	<?php

	if ( is_single() ) {

		get_template_part( 'template-parts/navigation' );

	}

	/**
	 *  Output comments wrapper if it's a post, or if comments are open,
	 * or if there's a comment number – and check for password.
	 * */
	if ( ( is_single() || is_page() ) && ( comments_open() || get_comments_number() ) && ! post_password_required() ) {
		?>

		<div class="comments-wrapper section-inner">

			<?php comments_template(); ?>

		</div><!-- .comments-wrapper -->

		<?php
	}
	?>

</article><!-- .post -->
