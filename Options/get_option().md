# get_option(): - https://developer.wordpress.org/reference/functions/get_option/

`SourceFile`: wp-includes/option.php view on [View on GitHub](<[url](https://github.com/WordPress/wordpress-develop/blob/6.2/src/wp-includes/option.php#L78-L254)>)

```php
function get_option( $option, $default_value = false ) {
	global $wpdb;

	if ( is_scalar( $option ) ) {
		$option = trim( $option );
	}

	if ( empty( $option ) ) {
		return false;
	}

	/*
	 * Until a proper _deprecated_option() function can be introduced,
	 * redirect requests to deprecated keys to the new, correct ones.
	 */
	$deprecated_keys = array(
		'blacklist_keys'    => 'disallowed_keys',
		'comment_whitelist' => 'comment_previously_approved',
	);

	if ( isset( $deprecated_keys[ $option ] ) && ! wp_installing() ) {
		_deprecated_argument(
			__FUNCTION__,
			'5.5.0',
			sprintf(
				/* translators: 1: Deprecated option key, 2: New option key. */
				__( 'The "%1$s" option key has been renamed to "%2$s".' ),
				$option,
				$deprecated_keys[ $option ]
			)
		);
		return get_option( $deprecated_keys[ $option ], $default_value );
	}
```

This is the `get_option()` function from the WordPress core, which is responsible for retrieving an option value from the database. Let's break it down line by line:

```php
function get_option( $option, $default_value = false ) {
	global $wpdb;
```

The function begins by defining the `get_option()` function, which takes two parameters: $option and `$default_value.`The $option parameter represents the name of the option to retrieve, while`$default_value` is an optional parameter that specifies the default value to return if the option doesn't exist.

The `global $wpdb;` statement makes the WordPress database object (`$wpdb`) available within the function. It allows the function to interact with the database.

```php
	if ( is_scalar( $option ) ) {
		$option = trim( $option );
	}
```

This section checks if the `$option` parameter is a scalar value, which includes integers, floats, strings, and booleans. If it is, the `trim()` function is used to remove any leading or trailing whitespace from the option name.

```php
	if ( empty( $option ) ) {
		return false;
	}
```

Here, the function checks if the option name is empty. If it is, the function immediately returns `false` since there is no option to retrieve.

```php
	$deprecated_keys = array(
		'blacklist_keys'    => 'disallowed_keys',
		'comment_whitelist' => 'comment_previously_approved',
	);
```

An array called `$deprecated_keys` is defined, which maps deprecated option names to their corresponding new option names. This is used to redirect requests for deprecated options to the correct ones.

```php
	if ( isset( $deprecated_keys[ $option ] ) && ! wp_installing() ) {
		_deprecated_argument(
			__FUNCTION__,
			'5.5.0',
			sprintf(
				/* translators: 1: Deprecated option key, 2: New option key. */
				__( 'The "%1$s" option key has been renamed to "%2$s".' ),
				$option,
				$deprecated_keys[ $option ]
			)
		);
		return get_option( $deprecated_keys[ $option ], $default_value );
	}
```

This section checks if the `$option` parameter matches any of the keys in the `$deprecated_keys` array and if the WordPress installation is not in the process of being installed (`! wp_installing()`). If both conditions are met, it means that the option being requested is deprecated.

In such cases, the `_deprecated_argument()` function is called to generate a deprecation notice. The notice indicates that the deprecated option key has been renamed to the new option key. Then, the function recursively calls get_option() with the new option key and the default value, effectively redirecting the request to the correct option.

If the option is not deprecated or the installation is in the process of being installed, the function continues execution without redirection.

This explanation covers the first part of the get_option() function. There might be additional lines of code following this portion, but they are not included in the provided snippet.
