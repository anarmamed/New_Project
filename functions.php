<?php
/**
 * Main Functions file
 */

namespace Plugin_Scope;


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

/**
 * Core constants
 */

define(__NAMESPACE__ . '\PREFIX', '{Plugin_Prefix}');

define(__NAMESPACE__ . '\PLUGIN_VERSION', '0.0.0');

define(__NAMESPACE__ . '\PLUGIN_NAME', '{Plugin_Name}');

define(__NAMESPACE__ . '\PLUGIN_SHORTNAME', '{Plugin_Shortname}');

define(__NAMESPACE__ . '\TEXT_DOMAIN', '{Text_Domain}');

define(__NAMESPACE__ . '\PLUGIN_DIR', get_stylesheet_directory());

define(__NAMESPACE__ . '\PLUGIN_URL', get_stylesheet_directory_uri());

define(__NAMESPACE__ . '\ERROR_PATH', get_stylesheet_directory() . '/error.log');

/**
 * ACF Dependency
 */

define(__NAMESPACE__ . '\ACF_PRO', false);

/**
 * Init
 */

if (!class_exists( __NAMESPACE__ . '\Core')){
    include_once PLUGIN_DIR . '/includes/class-core.php';
}

/**
 * On theme activation hook
 */

add_action( 'after_setup_theme', __NAMESPACE__ . '\Core::on_activation' );

/**
 * Load translation, make sure this hook runs before all, so we set priority to 1
 */

add_action('init', function(){
    load_plugin_textdomain( __NAMESPACE__ . '\TEXT_DOMAIN', false, PLUGIN_DIR . '/languages/' );
}, 1);