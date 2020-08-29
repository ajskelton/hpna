<?php
/**
 * The template for displaying single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

get_header();
?>
<main id="site-content" role="main">
    <div class="post-inner">
		    <?php
		
		    $page_title = 'Neighborhood <strong>News</strong>';
		
		    get_template_part( 'template-parts/content', 'page-header', array( 'page_title' => $page_title ) );
		
		    ?>

			<?php
			
			if ( have_posts() ) {
				
				while ( have_posts() ) {
					the_post();
					
					get_template_part( 'template-parts/content', get_post_type() );
					
				}
			}
			
			?>
    </div>
</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
