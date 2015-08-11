<?php

if ( ! function_exists( 'thirdrail_custom_actor' ) ) :
	function thirdrail_custom_actor() {
	
		$labels = array(
			'name'                       => _x( 'Actors', 'Taxonomy General Name', 'text_domain' ),
			'singular_name'              => _x( 'Actor', 'Taxonomy Singular Name', 'text_domain' ),
			'menu_name'                  => __( 'Actor', 'text_domain' ),
			'all_items'                  => __( 'All Actors', 'text_domain' ),
			'parent_item'                => __( 'Parent Actor', 'text_domain' ),
			'parent_item_colon'          => __( 'Parent Actor:', 'text_domain' ),
			'new_item_name'              => __( 'New Actor Name', 'text_domain' ),
			'add_new_item'               => __( 'Add New Actor', 'text_domain' ),
			'edit_item'                  => __( 'Edit Actor', 'text_domain' ),
			'update_item'                => __( 'Update Actor', 'text_domain' ),
			'separate_items_with_commas' => __( 'Separate actors with commas', 'text_domain' ),
			'search_items'               => __( 'Search Actors', 'text_domain' ),
			'add_or_remove_items'        => __( 'Add or remove actors', 'text_domain' ),
			'choose_from_most_used'      => __( 'Choose from the most used actors', 'text_domain' ),
			'not_found'                  => __( 'Not Found', 'text_domain' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
		);
		register_taxonomy( 'actor', array( 'page' ), $args );
	
	}
	
	add_action( 'init', 'thirdrail_custom_actor', 0 );
endif;
	
if ( ! function_exists( 'thirdrail_custom_creative' ) ) :
	function thirdrail_custom_creative() {
	
		$labels = array(
			'name'                       => _x( 'Creatives', 'Taxonomy General Name', 'text_domain' ),
			'singular_name'              => _x( 'Creative', 'Taxonomy Singular Name', 'text_domain' ),
			'menu_name'                  => __( 'Creative', 'text_domain' ),
			'all_items'                  => __( 'All Creatives', 'text_domain' ),
			'parent_item'                => __( 'Parent Creative', 'text_domain' ),
			'parent_item_colon'          => __( 'Parent Creative:', 'text_domain' ),
			'new_item_name'              => __( 'New Creative Name', 'text_domain' ),
			'add_new_item'               => __( 'Add New Creative', 'text_domain' ),
			'edit_item'                  => __( 'Edit Creative', 'text_domain' ),
			'update_item'                => __( 'Update Creative', 'text_domain' ),
			'separate_items_with_commas' => __( 'Separate creatives with commas', 'text_domain' ),
			'search_items'               => __( 'Search Creatives', 'text_domain' ),
			'add_or_remove_items'        => __( 'Add or remove creatives', 'text_domain' ),
			'choose_from_most_used'      => __( 'Choose from the most used creatives', 'text_domain' ),
			'not_found'                  => __( 'Not Found', 'text_domain' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
		);
		register_taxonomy( 'creative', array( 'page' ), $args );
	
	}
	
	add_action( 'init', 'thirdrail_custom_creative', 0 );
endif;

?>