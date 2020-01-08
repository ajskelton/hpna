<?php

$icon = get_field( 'icon' );
$text = get_field( 'text' );
$link = get_field( 'link' );
?>

<div class="c-card c-card--cta">
    <a href="<?php echo esc_url( $link['url'] ); ?>">
        <div class="c-card__top">
            <figure class="w-64 mx-auto">
	            <?php echo hpna_load_inline_svg( "/icon-{$icon}.svg" ); ?>
            </figure>
        </div>
        <div class="c-card__bottom">
			<p><?php echo esc_html( $text ); ?></p>
        </div>
    </a>
</div>
