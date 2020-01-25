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
				
				$page_title = 'Upcoming <strong>Events</strong>';
				
				include_once( 'template-parts/content-page-header.php' );
				
				
				if ( have_posts() ) {
					
					$i = 0;
					
					while ( have_posts() ) {
						$i ++;
						if ( $i > 1 ) {
							echo '<hr class="wp-block-separator is-style-wide" aria-hidden="true" />';
						}
						the_post();
						
						get_template_part( 'template-parts/content', get_post_type() );
						
					}
				} elseif ( is_search() ) {
					?>

                    <div class="no-search-results-form section-inner thin">
						
						<?php
						get_search_form(
							array(
								'label' => __( 'search again', 'twentytwenty' ),
							)
						);
						?>

                    </div><!-- .no-search-results -->
					
					<?php
				}
				?>
				
				<?php get_template_part( 'template-parts/pagination' ); ?>
            </div>
        </div>
    </main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php
get_footer();
