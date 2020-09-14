<?php

function add_fontawesome_kit() {
	echo '<script src="https://kit.fontawesome.com/3cdb745b2a.js" crossorigin="anonymous"></script>';
}
add_action('wp_head', 'add_fontawesome_kit');
add_action('admin_head', 'add_fontawesome_kit');

function hpna_read_more_text( $more ) {
	if ( is_single() ) {
		return $more;
	}

	$more = sprintf(
		' ... <a class="read-more" href="%1$s">%2$s</a>',
		get_permalink( get_the_ID() ),
		__( 'Read More &#187;', 'hpna' )
	);
	
	return $more;
}
add_filter( 'excerpt_more', 'hpna_read_more_text' );

function hpna_improved_excerpt_trim( $text ) {
	global $post;
	if ( '' !== $text ) {
		return $text;
	}
	$text = get_the_content('');
	$text = apply_filters('the_content', $text);
	$text = str_replace('\]\]\>', ']]&gt;', $text);
	$text = preg_replace('@<script[^>]*?>.*?</script>@si', '', $text);
	$text = strip_tags($text, '<p><ul><li>' );
	$read_more_link = " <a href='".get_permalink(get_the_id())."'>Read More</a>";
	$excerpt_length = 40;
	$words = explode(' ', $text, $excerpt_length + 1);
	if (count($words)> $excerpt_length) {
		array_pop($words);
		$words[] = '...';
		$words[] = $read_more_link;
		$text    = implode(' ', $words);
	}
	return $text;
}
remove_filter( 'get_the_excerpt', 'wp_trim_excerpt');
add_filter( 'get_the_excerpt', 'hpna_improved_excerpt_trim' );

function hpna_meeting_minutes_excerpts( $string ) {
	if ( is_single() ) {
		return $string;
	}
	
	if ( 'hpna-meeting-minutes' !== get_post_type() ) {
		return $string;
	}
	
	if ( is_home() || is_archive() ) {
		return strip_tags( $string, '<p>,<a>' );
	}
}
add_filter( 'the_content', 'hpna_meeting_minutes_excerpts' );

function hpna_read_more_link( $more_link_element, $more_link_text ) {
	return sprintf( '<a class="more-link" href="%s">Read More ...</a>', get_the_permalink() );
}
add_filter( 'the_content_more_link', 'hpna_read_more_link', 11, 2 );

function hpna_google_analytics() {
	?>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-169300157-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-169300157-1');
	</script>
	
	<?php
}
add_action( 'wp_head', 'hpna_google_analytics', -1 );

function hpna_purple_air() {
    
    $enable = get_field( 'enable_purple_air_info_bar', 'options' );
    
    if ( !$enable ) {
        return;
    }
    
    $purple_air = new HPNA_Purple_Air();
    echo $purple_air->render_info_bar();
}
add_action( 'wp_body_open', 'hpna_purple_air' );