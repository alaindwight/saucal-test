<?php
// -----------
// My Account API Settings Tab
// -----------

// Register new endpoint / url for My Account page		
function add_api_settings_endpoint() {
	add_rewrite_endpoint( 'api-settings', EP_ROOT | EP_PAGES );
}		

// Add new query var		
function api_settings_query_vars( $vars ) {
	$vars[] = 'api-settings';
	return $vars;
}		
		
// add tab for new endpoint to My Account menu		
function add_api_settings_link_my_account( $items ) {
	$items['api-settings'] = 'API Settings';
	return $items;
}		
		
// add content to new My Account tab
function api_settings_content() {
	$response = api_call()->json;
	?>

	<h3>API Settings</h3>
	<p>Please enter your twitter username in order to fetch your tweets. Enter a date range if you would to limit the fetched tweets to a specific range.</p>

    <form name="update_api_user_meta" id="update_api_user_meta" action="<?php echo esc_url( home_url() ); ?>?update_api_user_meta=true" method="POST">

		<?php $username = get_user_meta( get_current_user_id(), 'username', true ); ?>
		<label for="username" >Username:</label>
		<input type="text" id="username" name="username" value="<?php echo $username ? $username : null ?>" required> <br>

		<?php $start = get_user_meta( get_current_user_id(), 'start-date', true ); ?>
		<label for="start-date">Start date:</label>
		<input type="date" id="start-date" name="start-date" value="<?php echo $start ? $start : null ?>"> <br>

		<?php $end = get_user_meta( get_current_user_id(), 'end-date', true ); ?>
		<label for="end-date">End date:</label>
		<input type="date" id="end-date" name="end-date" value="<?php echo $end ? $end : null ?>"> <br>

		<button name="submit" type="submit">Submit</button>
		<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />

	</form>

	<?php
	echo "<ul>";
	foreach($response as $tweet) {
		if ($tweet->response_or_request === 'request') { continue; }
		$name = filter_var($tweet->user->name, FILTER_SANITIZE_STRING);
		$text = filter_var($tweet->text, FILTER_SANITIZE_STRING);
		echo "<li>$name : $text </li>";
	}
	echo "</ul>";
}		

// when My Account api settings form is submitted, then update user meta and return to original request page
function update_api_user_meta() {
	if ( ! empty( $_GET['update_api_user_meta'] ) &&
		isset( $_POST['username'] )               &&
		$user_id = get_current_user_id()
	) {
		update_user_meta( $user_id, 'username', sanitize_text_field( $_POST['username'] ) );

		if ( ! empty( $_POST['start-date'] ) ) {
			update_user_meta( $user_id, 'start-date', sanitize_text_field( $_POST['start-date'] ) );
		}

		if ( ! empty( $_POST['end-date'] ) ) {
			update_user_meta( $user_id, 'end-date', sanitize_text_field( $_POST['end-date'] ) );
		}
		
		if ( ! empty( $_POST['redirect_to'] ) ) {
			wp_redirect( $_POST['redirect_to'] );
			exit;
		}
	}
}