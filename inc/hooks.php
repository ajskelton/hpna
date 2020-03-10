<?php

function add_fontawesome_kit() {
	echo '<script src="https://kit.fontawesome.com/3cdb745b2a.js" crossorigin="anonymous"></script>';
}
add_action('wp_head', 'add_fontawesome_kit');