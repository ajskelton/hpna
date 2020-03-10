<?php

$icon = get_field( 'icon' );
$text = get_field( 'text' );
$link = get_field( 'link' );
?>

<div class="c-card c-card--cta">
    <a class="c-card__wrapper" href="<?php echo esc_url( $link['url'] ); ?>">
        <div class="c-card__top">
            <div class="fa-5x text-green">
                <i class="fad fa-<?php echo esc_attr( $icon ) ?>"></i>
            </div>
        </div>
        <div class="c-card__bottom">
			<p><?php echo esc_html( $text ); ?></p>
        </div>
    </a>
</div>
