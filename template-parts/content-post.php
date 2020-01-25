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

	get_template_part( 'template-parts/entry-header' );

	if ( ! is_search() ) {
		get_template_part( 'template-parts/featured-image' );
	}

	?>

	<div class="post-inner">

		<div class="entry-content__post">

			<?php
			$categories = get_the_category_slugs();
			
			if ( ! is_singular() && in_array('minutes', $categories, true ) ) {
				get_template_part( 'template-parts/content', 'post-minutes' );
			} else if ( ! is_singular()  ) {
				the_excerpt();
			} else {
				the_content( __( 'Continue reading', 'twentytwenty' ) );
			}
			?>

		</div><!-- .entry-content -->

	</div><!-- .post-inner -->

	<div class="section-inner">
		<?php

		edit_post_link();

		// Single bottom post meta.
		//twentytwenty_the_post_meta( get_the_ID(), 'single-bottom' );
		
		?>
        <div class="post-meta-wrapper post-meta-single post-meta-single-bottom">
            <ul class="post-meta">
                <?php if ( has_category() ) : ?>
                <li class="post-categories meta-wrapper">
                    <span class="meta-text">
							<?php _ex( 'Posted in', 'A string that is output before one or more categories', 'twentytwenty' ); ?> <?php the_category( ', ' ); ?>
						</span>
                </li>
                <?php endif; ?>
                <?php if ( has_tag() ) : ?>
                <li class="post-tags meta-wrapper">
                    <span class="meta-text">
							<?php the_tags( 'Tagged ', ', ', '' ); ?>
						</span>
                </li>
                <?php endif; ?>
            </ul>
        </div>

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
