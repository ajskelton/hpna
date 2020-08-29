<?php

$query_args = array(
	'post_type' => 'hpna-events',
	'meta_query' => array(
		'relation' => 'AND',
		array(
			'key' => 'event_type',
			'value' => 'ongoing',
			'compare' => '='
		),
		array(
			'key' => 'end_date',
			'value' => date('Ymd'),
			'type' => 'DATE',
			'compare' => '>='
		)
	)
);

$ongoing_events_query = new WP_Query( $query_args );

if ( $ongoing_events_query->have_posts() ) :
	
	$i = 0;

	echo '<h2 class="text-center">Ongoing Events</h2>';
	
	while ( $ongoing_events_query->have_posts() ) : $ongoing_events_query->the_post();
		
		$i ++;
		if ( $i > 1 ) {
			echo '<hr class="wp-block-separator is-style-wide" aria-hidden="true" />';
		}
		get_template_part( 'template-parts/content', get_post_type() );

	endwhile;
	
endif;

wp_reset_postdata();

