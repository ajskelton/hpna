<?php

/**
 * The Template for displaying single Events
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

$event_date = get_field( 'date' );
$date = DateTime::createFromFormat('Ymd', $event_date);

$start_time = get_field( 'start_time' );
$end_time = get_field( 'end_time' );

$location = get_field( 'location' );

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<div class="post-inner">

		<div class="flex items-start" >
            
            <div class="date w-24 h-24 rounded-full p-6 flex justify-center align-center flex-col bg-green uppercase text-white text-center">
                <p class="m-0"><?php echo $date->format('M'); ?></p>
                <p class="m-0"><?php echo $date->format('j'); ?></p>
            </div>
            
            <div class="entry flex-grow">
                <h2 class="mt-0 lg:mt-0"><?php the_title(); ?></h2>
                <p class="mt-0"><?php echo $date->format( 'l, F j' ); ?> | <?php echo $start_time; ?> &ndash; <?php echo $end_time; ?></p>
                <p class="location"><?php echo esc_html( $location ); ?></p>
                <?php the_content(); ?>
            </div>

			

		</div><!-- .entry-content -->

	</div><!-- .post-inner -->

	<div class="section-inner">
		<?php
		wp_link_pages(
			array(
				'before'      => '<nav class="post-nav-links bg-light-background" aria-label="' . esc_attr__( 'Page', 'twentytwenty' ) . '"><span class="label">' . __( 'Pages:', 'twentytwenty' ) . '</span>',
				'after'       => '</nav>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			)
		);

		edit_post_link();

		// Single bottom post meta.
		twentytwenty_the_post_meta( get_the_ID(), 'single-bottom' );

		if ( is_single() ) {

			get_template_part( 'template-parts/entry-author-bio' );

		}
		?>

	</div><!-- .section-inner -->

	<?php

	if ( is_single() ) {

		get_template_part( 'template-parts/navigation' );

	}
	
	?>

</article><!-- .post -->
