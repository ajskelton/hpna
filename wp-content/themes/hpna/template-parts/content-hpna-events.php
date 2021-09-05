<?php

/**
 * The Template for displaying single Events
 *
 * @link       https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package    WordPress
 * @subpackage Twenty_Twenty
 * @since      1.0.0
 */

$event_type = get_field( 'event_type' );
$event_date = get_field( 'date' );
$start_time = get_field( 'start_time' );
$end_time   = get_field( 'end_time' );

$date = DateTime::createFromFormat( 'Ymd', $event_date );

$location = get_field( 'location' );

?>

<article <?php post_class( 'alignwide' ); ?> id="post-<?php the_ID(); ?>">

    <div class="post-inner">

        <div class="entry-content__event">
            
            
            <div class="entry-content__event-date-wrapper">
	            <?php if ( $event_type !== 'ongoing' ) : ?>
                <div class="entry-content__event-date">
                    <p class="entry-content__event-date--month"><?php echo $date->format( 'M' ); ?></p>
                    <p class="entry-content__event-date--day"><?php echo $date->format( 'j' ); ?></p>
                </div>
                <?php else : ?>
                <div class="entry-content__event-date">
                    <p class="entry-content__event-date--month text-center">
                        On<br>
                        Go<br>
                        Ing<br>
                    </p>
                </div>
	            <?php endif; ?>
            </div>
            

            <div class="entry-content_event-text-wrapper">
                <div class="entry-content__event-text">
                    <h3 class="mt-0 lg:mt-0"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
                    <?php if ( $event_type !== 'ongoing' ) : ?>
                        <p class="mt-0"><?php echo $date->format( 'l, F j' ); ?><?php echo hpna_event_times( $start_time, $end_time ); ?>
                    <?php endif; ?>
                    <p class="location"><?php echo esc_html( $location ); ?></p>
					<?php the_content(); ?>
                </div>
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
