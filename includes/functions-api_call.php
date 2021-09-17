<?php
// -----------
// API Call
// -----------
function api_call() {
	$username = get_user_meta( get_current_user_id(), 'username', true ) ?? null;
	if (!$username) { return false; }

	$url = 'http://httpbin.org/post';
	$options = get_option( 'saucal_api_test_plugin_options' );			
	$start_date = get_user_meta( get_current_user_id(), 'start-date', true ) ?? null;
	$end_date = get_user_meta( get_current_user_id(), 'end-date', true ) ?? null;			
		
	$args = array(
		'headers' => array(
			'Authorization' => 'Basic ' . base64_encode( $options['api_key'] ),
			'Content-Type' => 'application/json; charset=utf-8'
		  ),
		'method'      => 'POST',
		'data_format' => 'body',
		'body' => json_encode(
			array(
				array(
					"response_or_request" => "request",
					"username" => $username,
					"start_date" => $start_date,
					"end_date" => $end_date,
				),
				array(
					"response_or_request" => "response",
					"created_at" => "2021-04-21",
					"id_str" => "850006245121695744",
					"text" => "Test tweet 1",
					"user" => array(
						"name" => $username,
						"location" => "Canada",
					)
				),
				array(
					"response_or_request" => "response",
					"created_at" => "2021-04-21",
					"id_str" => "850006245121695745",
					"text" => "Test tweet 2",
					"user" => array(
						"name" => $username,
						"location" => "Canada",
					)
				)
			)
		)
	);
	
	$request = wp_remote_post( $url, $args );
	$response = json_decode( wp_remote_retrieve_body( $request ) );
		
	return $response;
}