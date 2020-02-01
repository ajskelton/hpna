<?php

$minutes = get_field( 'minutes' );

?>
<?php if ( $minutes ) : ?>
	<p><a href="<?php echo esc_url( $minutes['url'] ); ?>">Download the PDF</a></p>
<?php endif; ?>
<?php if ( !is_single() ) : ?>
	<p><a href="<?php echo get_the_permalink(); ?>">Read the Minutes</a></p>
<?php endif;
