```php
/**
 * Add a new dashboard widget for Displaying User's Name and Avatar.
 */
function wpdocs_add_dashboard_widgets_user_avatar() {
    wp_add_dashboard_widget( 'dashboard_widget', 'Welcome 🙏', 'dashboard_widget_function' );
}
add_action( 'wp_dashboard_setup', 'wpdocs_add_dashboard_widgets_user_avatar' );

/**
 * Output the contents of the dashboard widget
 */
function dashboard_widget_function( $post, $callback_args ) {
    // Get current user information
    $current_user = wp_get_current_user();

    // Output user's name and avatar with increased size (e.g., 54 pixels)
    echo '<p>Hello, ' . esc_html( $current_user->display_name ) . '!</p>';
    echo get_avatar( $current_user->ID, 500 ); // Change the size as needed
}
```
