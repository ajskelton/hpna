<?php

$query_args = array(
	'post_type' => 'hpna-events',
	'meta_query' => array(
		array(
			'key' => 'date',
			'value' => date('Ymd'),
			'compare' => '<'
		)
	),
	'order' => 'DESC',
	'orderby' => 'meta_value',
	'meta_type' => 'DATETIME'
);

$past_events = new WP_Query( $query_args );

if ( $past_events->have_posts() ) :
	
	$i = 0;

	echo '<h2 class="text-center">Past Events</h2>';
	
	while ( $past_events->have_posts() ) : $past_events->the_post();
		
		$i ++;
		if ( $i > 1 ) {
			echo '<hr class="wp-block-separator is-style-wide" aria-hidden="true" />';
		}
		get_template_part( 'template-parts/content', get_post_type() );

	endwhile;
	
endif;

wp_reset_postdata();

