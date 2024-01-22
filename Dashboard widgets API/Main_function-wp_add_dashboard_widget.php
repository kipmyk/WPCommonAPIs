<?php
/**
 * Add a new dashboard widget.
 */
function wpdocs_add_dashboard_widgets() {
	wp_add_dashboard_widget( 'dashboard_widget', 'Example Dashboard Widget', 'dashboard_widget_function' );
}
add_action( 'wp_dashboard_setup', 'wpdocs_add_dashboard_widgets' );

/**
 * Output the contents of the dashboard widget
 */
function dashboard_widget_function( $post, $callback_args ) {
	esc_html_e( "Hello World, this is my first Dashboard Widget!", "textdomain" );
}