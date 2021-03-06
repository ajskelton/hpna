<?php
/**
 * Displays the post header
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

$entry_header_classes = '';

if ( is_singular() ) {
	$entry_header_classes .= ' header-footer-group';
}

?>

<header class="entry-header <?php echo esc_attr( $entry_header_classes ); ?>">

	<div class="entry-header-inner section-inner">
        <?php
        if ( 'hpna-newsletters' === get_post_type() ) {
		    the_title( '<h2 class="entry-title"><a target="_blank" href="' . esc_url( get_field( 'newsletter' )['url'] ) . '">', '</a></h2>');
        } elseif ( is_singular() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		} else {
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' );
		}

		$intro_text_width = '';

		if ( is_singular() ) {
			$intro_text_width = ' small';
		} else {
			$intro_text_width = ' thin';
		}

		if ( has_excerpt() && is_singular() ) {
			?>

			<div class="intro-text section-inner max-percentage<?php echo $intro_text_width; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static output ?>">
				<?php the_excerpt(); ?>
			</div>

			<?php
		}

		// Default to displaying the post meta.
  
//		twentytwenty_the_post_meta( get_the_ID(), 'single-top' );
		?>
		<div class="post-meta-wrapper">
			<ul class="post-meta">
				<li class="post-date meta-wrapper">
					<span class="meta-text">
                        <?php the_time( get_option( 'date_format' ) ); ?>
                    </span>
				</li>
                <li class="post-author meta-wrapper">
                    <span class="meta-text">
							<?php
							printf(
							/* translators: %s: Author name */
								__( 'By %s', 'twentytwenty' ),
								'' . esc_html( get_the_author_meta( 'display_name' ) ) . ''
							);
							?>
						</span>
                </li>
			</ul>
		</div>

	</div><!-- .entry-header-inner -->

</header><!-- .entry-header -->
