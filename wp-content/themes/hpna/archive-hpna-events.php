<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link       https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package    WordPress
 * @subpackage Twenty_Twenty
 * @since      1.0.0
 */

get_header();
?>

    <main id="site-content" role="main">
        <div class="post-inner">
            <div class="entry-content">
				
				<?php
				
				$page_title = 'HPNA <strong>Events</strong>';
				
				get_template_part( 'template-parts/content', 'page-header', array( 'page_title' => $page_title ) );
				
				get_template_part( 'template-parts/events', 'ongoing' );
				
				if ( have_posts() ) {
					
					$i = 0;
					
					echo '<h2 class="text-center">Upcoming Events</h2>';
					
					while ( have_posts() ) {
						$i ++;
						if ( $i > 1 ) {
							echo '<hr class="wp-block-separator is-style-wide" aria-hidden="true" />';
						}
						the_post();
						
						get_template_part( 'template-parts/content', get_post_type() );
						
					}
				}
				?>
				
				<?php get_template_part( 'template-parts/pagination' ); ?>
                
                <?php get_template_part( 'template-parts/events', 'past' ); ?>
                
            </div>
        </div>
    </main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php
get_footer();
