<?php
/*
 * Plugin Name: Social Media Stats
 * Plugin URI: https://wordpress.org/plugins/wpsocialstats/
 * Description: Track the performance of your posts and webpages at Facebook, Twitter, Google+, Pinterest, Linkedin, Stumbleupon using our the Social Media Stats plugin
 * Version: 2.0.7
 * Author: WPRepublic
 * Author URI:  https://wprepublic.com
 * Text Domain: wpsocialstats
 * License: GPL2
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 */

// Pre-2.6 compatibility. For the future needs
if (!defined('WP_CONTENT_URL')) {
	define('WP_CONTENT_URL', get_option('siteurl' . '/wp-content'));
}
if (!defined('WP_CONTENT_DIR')) {
	define('WP_CONTENT_DIR', ABSPATH . 'wp-content');
}
if (!defined('WP_PLUGIN_URL')) {
	define('WP_PLUGIN_URL', WP_CONTENT_URL. '/plugins');
}
if (!defined('WP_PLUGIN_DIR')) {
	define('WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins');
}

//defines
define('SOCIAL_STATISTICS_PLUGIN_FILE', __FILE__ );
define('SOCIAL_STATISTICS_PLUGIN_URL', plugins_url("",__FILE__));
define('SOCIAL_STATISTICS_PLUGIN_DIR', dirname(__FILE__));
define('SOCIAL_STATISTICS_TRACKING_URL', admin_url("admin-ajax.php"));

//includes
require( SOCIAL_STATISTICS_PLUGIN_DIR . "/includes/functions.php");
require( SOCIAL_STATISTICS_PLUGIN_DIR . "/includes/widgets.php");
require(SOCIAL_STATISTICS_PLUGIN_DIR . "/classes/social_stats_table.php");
require( SOCIAL_STATISTICS_PLUGIN_DIR . "/classes/social_stats_dashboard.php");

if(is_admin()){
	$social_stats_admin_menu_instance = new WP_Social_Stats_Dashboard();
}

require( SOCIAL_STATISTICS_PLUGIN_DIR . "/includes/admin.php");

function add_thumbnails_for_cpt() {

    global $_wp_theme_features;

    if( empty($_wp_theme_features['post-thumbnails']) ){
        $_wp_theme_features['post-thumbnails'] = array( array('post','page') );
    }
    elseif( true === $_wp_theme_features['post-thumbnails'])
        return;

    elseif( is_array($_wp_theme_features['post-thumbnails'][0]) )
        $_wp_theme_features['post-thumbnails'][0][] = array( array('post','page') );
}

add_action( 'after_setup_theme', 'add_thumbnails_for_cpt');
add_action('init', 'wordpress_social_stats_init');
add_action('admin_menu', 'wordpress_social_stats_admin_menu');

/* added by GenLEE Begin */
// add_action('wp_ajax_nopriv_phynuchs-casual-loop', 'phynuchs_casual_loop');
/* added by GenLEE End */
?>