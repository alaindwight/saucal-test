<?php
// -----------
// Plugin Settings
// -----------

function add_saucal_api_test_setting_page() {
	add_options_page( 'Example plugin page', 'Saucal API Test', 'manage_options', 'saucal-api-test', 'render_saucal_api_test_setting_page' );
}

function render_saucal_api_test_setting_page() {
	?>
	<h2>Saucal API Test Settings</h2>
	<form action="options.php" method="post">
		<?php 
		settings_fields( 'saucal_api_test_plugin_options' );
		do_settings_sections( 'saucal_api_test_plugin' ); ?>
		<input name="submit" class="button button-primary" type="submit" value="<?php esc_attr_e( 'Save' ); ?>" />
	</form>
	<?php
}

function saucal_api_test_register_settings() {
	register_setting( 'saucal_api_test_plugin_options', 'saucal_api_test_plugin_options', 'saucal_api_test_plugin_options_validate' );
	add_settings_section( 'api_settings', 'API Settings', 'api_plugin_section_text', 'saucal_api_test_plugin' );
	add_settings_field( 'api_plugin_setting_api_key', 'API Key', 'api_plugin_setting_api_key', 'saucal_api_test_plugin', 'api_settings' );
}

function api_plugin_section_text() {
	echo '<p>Please enter your API key</p>';
}
		
function api_plugin_setting_api_key() {
	$options = get_option( 'saucal_api_test_plugin_options' );
	echo "<input id='api_plugin_setting_api_key' name='saucal_api_test_plugin_options[api_key]' type='text' value='" . esc_attr( $options['api_key'] ) . "' />";
}

add_action( 'widgets_init', 'api_load_widget' );