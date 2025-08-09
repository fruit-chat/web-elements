add_filter( 'site_transient_update_plugins', '__return_empty_array' );
add_filter( 'transient_update_plugins', '__return_empty_array' );
add_filter( 'site_transient_update_themes', '__return_empty_array' );
add_filter( 'transient_update_themes', '__return_empty_array' );

// Disable core wp updates.
add_filter( 'pre_site_transient_update_core', function ( $object = null ) {
	global $wp_version;

	// Return an empty object to prevent extra checks.
	return (object) array(
		'last_checked'    => time(),
		'updates'         => array(),
		'version_checked' => $wp_version,
	);
} );

add_action( 'init', function () {
	remove_action( 'init', 'wp_version_check' );
	add_filter( 'pre_option_update_core', '__return_null' );
	remove_all_filters( 'plugins_api' );
} );

// Disable even other external updates related to core.
add_filter( 'auto_update_translation', '__return_false' );
add_filter( 'automatic_updater_disabled', '__return_true' );
add_filter( 'allow_minor_auto_core_updates', '__return_false' );
add_filter( 'allow_major_auto_core_updates', '__return_false' );
add_filter( 'allow_dev_auto_core_updates', '__return_false' );
add_filter( 'auto_update_core', '__return_false' );
add_filter( 'wp_auto_update_core', '__return_false' );
add_filter( 'auto_update_plugin', '__return_false' );
add_filter( 'auto_update_theme', '__return_false' );
add_filter( 'auto_core_update_send_email', '__return_false' );
add_filter( 'automatic_updates_send_debug_email ', '__return_false' );
add_filter( 'send_core_update_notification_email', '__return_false' );
add_filter( 'automatic_updates_is_vcs_checkout', '__return_true' );

add_filter( 'pre_site_transient_update_plugins', function () {
	global $wp_version;
	// Get all registered plugins.
	$plugins = get_transient( 'wpcode_prevent_updates_plugins' );
	if ( false === $plugins ) {
		if ( ! function_exists( 'get_plugins' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}
		$plugins = array();

		foreach ( get_plugins() as $file => $plugin ) {
			$plugins[ $file ] = $plugin['Version'];
		}

		set_transient( 'wpcode_prevent_updates', $plugins, DAY_IN_SECONDS );
	}

	// Return an empty object to prevent extra checks.
	return (object) array(
		'last_checked'    => time(),
		'updates'         => array(),
		'version_checked' => $wp_version,
		'checked'         => $plugins,
	);
} );

add_filter( 'pre_site_transient_update_themes', function () {
	global $wp_version;
	// Get all registered themes.
	$themes = get_transient( 'wpcode_prevent_updates_themes' );
	if ( false === $themes ) {
		$themes = array();
		foreach ( wp_get_themes() as $theme ) {
			$themes[ $theme->get_stylesheet() ] = $theme->get( 'Version' );
		}

		set_transient( 'wpcode_prevent_updates_themes', $themes, DAY_IN_SECONDS );
	}

	// Return an empty object to prevent extra checks.
	return (object) array(
		'last_checked'    => time(),
		'updates'         => array(),
		'version_checked' => $wp_version,
		'checked'         => $themes,
	);
} );

add_action( 'admin_init', function () {
	// Remove updates page.
	remove_submenu_page( 'index.php', 'update-core.php' );

	// Disable plugin API checks.
	remove_all_filters( 'plugins_api' );

	// Disable theme checks.
	remove_action( 'load-update-core.php', 'wp_update_themes' );
	remove_action( 'load-themes.php', 'wp_update_themes' );
	remove_action( 'load-update.php', 'wp_update_themes' );
	remove_action( 'wp_update_themes', 'wp_update_themes' );
	remove_action( 'admin_init', '_maybe_update_themes' );
	wp_clear_scheduled_hook( 'wp_update_themes' );

	// Disable plugin checks.
	remove_action( 'load-update-core.php', 'wp_update_plugins' );
	remove_action( 'load-plugins.php', 'wp_update_plugins' );
	remove_action( 'load-update.php', 'wp_update_plugins' );
	remove_action( 'admin_init', '_maybe_update_plugins' );
	remove_action( 'wp_update_plugins', 'wp_update_plugins' );
	wp_clear_scheduled_hook( 'wp_update_plugins' );

	// Disable any other update/cron checks.
	remove_action( 'wp_version_check', 'wp_version_check' );
	remove_action( 'admin_init', '_maybe_update_core' );
	remove_action( 'wp_maybe_auto_update', 'wp_maybe_auto_update' );
	remove_action( 'admin_init', 'wp_maybe_auto_update' );
	remove_action( 'admin_init', 'wp_auto_update_core' );
	wp_clear_scheduled_hook( 'wp_version_check' );
	wp_clear_scheduled_hook( 'wp_maybe_auto_update' );

	// Hide nag messages.
	remove_action( 'admin_notices', 'update_nag', 3 );
	remove_action( 'network_admin_notices', 'update_nag', 3 );
	remove_action( 'admin_notices', 'maintenance_nag' );
	remove_action( 'network_admin_notices', 'maintenance_nag' );
} );
