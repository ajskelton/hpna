<?php

    if ( is_archive() ) {
        $page_title = get_the_archive_title();
    } else if ( is_search() ) {
        $page_title = '<strong>Search for:</strong> ' . get_search_query();
    }
?>

<div class="wp-block-cover alignfull has-green-background-color has-background-dim is-style-page-title"><div class="wp-block-cover__inner-container">
        <h1 class="has-text-align-center"><?php echo wp_kses_post( $page_title ); ?></h1>
    </div>
</div>