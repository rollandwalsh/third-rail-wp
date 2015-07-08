<?php

add_filter( 'rwmb_meta_boxes', 'third_rail_parent_show' );

function third_rail_parent_show( $meta_boxes )
{

	$meta_boxes[] = array(
		'id'         => 'parent_show',
		'title'      => __( 'Parent Show', 'tr_' ),
		'post_types' => 'post',
		'priority'   => 'low',
		'autosave'   => true,

		'fields'     => array(
			array(
				'name'    => __( 'Parent Show', 'tr_' ),
				'id'      => "parent_show",
				'type'    => 'text'
			)
		)
	);

	return $meta_boxes;
}
