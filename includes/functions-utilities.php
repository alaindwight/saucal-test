<?php
// -----------
// Utilities
// -----------
function pre_var( $var = false ) {
	foreach ( func_get_args() as $var ) {
		echo '<pre>';
		print_r( $var );
		echo '</pre>';
	}
}