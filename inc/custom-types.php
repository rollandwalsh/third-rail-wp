<?php

if ( ! function_exists( 'thirdrail_custom_page_show' ) ) :
  function thirdrail_custom_page_show() {
	  $labels = array(
			'name'               => _x( 'Shows', 'post type general name', 'third-rail' ),
			'singular_name'      => _x( 'Show', 'post type singular name', 'third-rail' ),
			'menu_name'          => _x( 'Shows', 'admin menu', 'third-rail' ),
			'name_admin_bar'     => _x( 'Show', 'add new on admin bar', 'third-rail' ),
			'add_new'            => _x( 'Add New', 'show', 'third-rail' ),
			'add_new_item'       => __( 'Add New Show', 'third-rail' ),
			'new_item'           => __( 'New Show', 'third-rail' ),
			'edit_item'          => __( 'Edit Show', 'third-rail' ),
			'view_item'          => __( 'View Show', 'third-rail' ),
			'all_items'          => __( 'All Shows', 'third-rail' ),
			'search_items'       => __( 'Search Shows', 'third-rail' ),
			'parent_item_colon'  => __( 'Parent Shows:', 'third-rail' ),
			'not_found'          => __( 'No shows found.', 'third-rail' ),
			'not_found_in_trash' => __( 'No shows found in Trash.', 'third-rail' )
		);
		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'show' ),
			'capability_type'    => 'page',
			'has_archive'        => true,
			'hierarchical'       => true,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'thumbnail', 'page-attributes' )
		);
    register_post_type('show', $args);
  }
  add_action( 'init', 'thirdrail_custom_page_show' );
endif;


if ( ! function_exists( 'thirdrail_custom_page_company_member' ) ) :
  function thirdrail_custom_page_company_member() {
    $labels = array(
      'name' => 'Company Members',
      'singular_name' => 'Company Member',
      'add_new' => 'Add Company Member',
      'add_new_item' => 'Add New Company Member',
      'edit_item' => 'Edit Company Member',
      'new_item' => 'New Company Member',
      'all_items' => 'All Company Members',
      'view_item' => 'View Company Member',
      'search_items' => 'Search Company Members',
      'not_found' =>  'No Company Members found',
      'not_found_in_trash' => 'No Company Members found in Trash', 
      'menu_name' => 'Company Members'
  
    );
    $args = array(
      'labels' => $labels,
      'public' => true,
      'publicly_queryable' => true,
      'show_ui' => true, 
      'show_in_menu' => true, 
      'query_var' => true,
      'rewrite' => true,
      'capability_type' => 'page',
      'has_archive' => true, 
      'hierarchical' => true,
      'menu_position' => 20,
      'supports' => array( 'title', 'editor', 'exerpt', 'thumbnail', 'page-attributes' )
    ); 
    register_post_type('company_member', $args);
  }
  add_action( 'init', 'thirdrail_custom_page_company_member' );
endif;

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
		register_taxonomy( 'actor', array( 'show' ), $args );
	
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
		register_taxonomy( 'creative', array( 'show' ), $args );
	
	}
	
	add_action( 'init', 'thirdrail_custom_creative', 0 );
endif;

?>