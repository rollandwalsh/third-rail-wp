<?php

add_filter( 'rwmb_meta_boxes', 'third_rail_show_data' );

function third_rail_show_data( $meta_boxes )
{

	// 1st meta box
	$meta_boxes[] = array(
		'id'         => 'show_data',
		'title'      => __( 'Show Data', 'tr_' ),
		'post_types' => 'page',
		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context'    => 'normal',
		'priority'   => 'high',
		'autosave'   => true,

		'fields'     => array(
			array(
				'name'    => __( 'Show Type', 'tr_' ),
				'id'      => "show_type",
				'type'    => 'radio',
				'options' => array(
					'mainstage' => __( 'Mainstage', 'tr_' ),
					'nt_live' => __( 'NT Live', 'tr_' ),
					'wildcard' => __( 'Wild Card', 'tr_' ),
					'bloody_sunday' => __( 'Bloody Sunday', 'tr_' ),
					'event' => __( 'Event', 'tr_' ),
				),
			),
			array(
				'name'  => __( 'Opening Date', 'tr_' ),
				'id'    => "opening_date",
				'type'  => 'date'
			),
			array(
				'name'  => __( 'Closing Date', 'tr_' ),
				'id'    => "closing_date",
				'type'  => 'date'
			),
			array(
				'name'        => __( 'Venue', 'tr_' ),
				'id'          => "venue",
				'type'        => 'select',
				'options'     => array(
					'imago' => __( 'Imago', 'tr_' ),
					'coho' => __( 'CoHo', 'tr_' ),
					'winningstad' => __( 'Winningstad', 'tr_' ),
					'world_trade_center' => __( 'World Trade Center', 'tr_' ),
					'ifcc' => __( 'IFCC', 'tr_' )
				),
				'multiple'    => false,
				'placeholder' => __( 'Select a venue', 'tr_' ),
			),
			array(
				'name'  => __( 'Run Time', 'tr_' ),
				'id'    => "run_time",
				'type'  => 'text'
			),
			array(
				'name'  => __( 'Show Times', 'tr_' ),
				'id'    => "show_times",
				'type'  => 'text'
			),
			array(
				'name'  => __( 'Show Days', 'tr_' ),
				'id'    => "show_days",
				'type'  => 'text'
			),
			array(
				'name'  => __( 'Tickets URL', 'tr_' ),
				'id'    => "tickets_url",
				'type'  => 'url'
			),
			array(
				'name'  => __( 'Ticket Price', 'tr_' ),
				'id'    => "ticket_price",
				'type'  => 'text'
			),
			array(
				'name'  => __( 'Sponsors', 'tr_' ),
				'id'    => "sponsors",
				'type'  => 'text'
			)
		)
	);

	// 2nd meta box
	$meta_boxes[] = array(
		'id'         => 'cast_data',
		'title'  => __( 'Cast', 'tr_' ),
		'post_types' => 'page',
		'context'    => 'normal',
		'priority'   => 'low',
		'autosave'   => true,

		'fields' => array(
			array(
				'id'   => 'cast',
				'name' => __( 'Cast', 'tr_' ),
				'type' => 'key_value',
				'desc' => __( 'Key: Actor Name, Value: Role', 'tr_' ),
				'clone' => true
			)
		)
	);
	
	$meta_boxes[] = array(
  	'id'          => 'creative_data',
  	'title'   => __( 'Creative', 'tr_' ),
  	'post_types'  => 'page',
  	'context'     => 'normal',
  	'priority'    => 'low',
  	'autosave'    => true,
  	
  	'fields'  => array(
    	array(
      	'id'    => 'creatives',
      	'name'  => __( 'Creative Team', 'tr_' ),
      	'type'  => 'key_value',
      	'desc'  => __( 'Key: Creative Name, Value: Role', 'tr_' ),
				'clone' => true
    	)
  	)
	);

	return $meta_boxes;
}
