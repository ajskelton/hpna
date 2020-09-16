<?php

$icon = get_field( 'icon' );
$text = get_field( 'text' );
$link = get_field( 'link' );
?>

<div class="c-card c-card--cta">
    <a class="c-card__wrapper" href="<?php echo esc_url( $link['url'] ); ?>">
        <div class="c-card__top flex item-center justify-center">
            <div class="w-64">
	            <?php echo hpna_load_inline_svg( $icon . '.svg' ) ?>
            </div>
        </div>
        <div class="c-card__bottom">
			<p><?php echo esc_html( $text ); ?></p>
        </div>
    </a>
</div>
