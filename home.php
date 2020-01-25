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
            <div class="entry-content entry-content--sidebar">
				<?php
				
				$page_title = 'Neighborhood <strong>News</strong>';
				
				include_once( 'template-parts/content-page-header.php' );
				
				?>
                <div class="entry-content__posts">
					
					<?php
					
					if ( have_posts() ) {
						
						$i = 0;
						
						while ( have_posts() ) {
							$i ++;
							if ( $i > 1 ) {
								echo '<hr class="post-separator styled-separator is-style-wide section-inner" aria-hidden="true" />';
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
                
                </div><!-- .entry-content__posts -->
                <div class="entry-content__sidebar">
                    <?php get_sidebar( 'news' ); ?>
                </div><!-- entry-content__sidebar -->
	            <?php get_template_part( 'template-parts/pagination' ); ?>
            </div><!-- entry-content--sidebar -->
	       
        </div><!-- post-inner -->

    </main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php
get_footer();
