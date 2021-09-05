<?php
add_action( 'init', 'hpna_register_tax_example' );

function hpna_register_tax_example() {
	$labels = array(
		'name'                       => _x( 'Example', 'taxonomy general name', 'hpna' ),
		'singular_name'              => _x( 'Example', 'taxonomy singular name', 'hpna' ),
		'search_items'               => __( 'Search Filter Examples', 'hpna' ),
		'popular_items'              => __( 'Popular Filter Examples', 'hpna' ),
		'all_items'                  => __( 'All Filter Examples', 'hpna' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Filter Example', 'hpna' ),
		'update_item'                => __( 'Update Filter Example', 'hpna' ),
		'add_new_item'               => __( 'Add New Filter Example', 'hpna' ),
		'new_item_name'              => __( 'New Filter Example Name', 'hpna' ),
		'separate_items_with_commas' => __( 'Separate filter orchestrators with commas', 'hpna' ),
		'add_or_remove_items'        => __( 'Add or remove filter orchestrators', 'hpna' ),
		'choose_from_most_used'      => __( 'Choose from the most used filter orchestrators', 'hpna' ),
		'not_found'                  => __( 'No filter orchestrators found.', 'hpna' ),
		'menu_name'                  => __( 'Filter Examples', 'hpna' ),
	);

	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'show_in_rest' 			=> true,
	);

	$post_types = array(
		'post', 'pages'
	);

	register_taxonomy( 'hpna-tax-filter-orchestrator', $post_types, $args );
}
