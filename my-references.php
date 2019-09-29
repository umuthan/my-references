<?php
/**
 * My References
 *
 * @package           My References
 * @author            Umuthan Uyan
 * @copyright         2019
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       My References
 * Plugin URI:        https://wordpress.org/plugins/my-references/
 * Description:       Reference list for your Wordpress Site
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Umuthan Uyan
 * Author URI:        http://umuthan.com
 * Text Domain:       my-references
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

include('includes/functions.php');
include('includes/post-type.php');
include('includes/shortcode.php');
include('includes/widget.php');

/**
 * Add scripts and css to frontend
 */
add_action('wp_enqueue_scripts', 'my_references_callback_for_setting_up_script');
function my_references_callback_for_setting_up_script() {
  wp_register_style( 'my-references-css', plugin_dir_url( __FILE__ ).'assets/css/style.css' );
  wp_enqueue_style( 'my-references-css' );
  wp_register_style( 'my-references', plugin_dir_url( __FILE__ ).'assets/vendor/css/slick.css' );
  wp_enqueue_style( 'my-references-slick-css' );
  wp_enqueue_script( 'my-references-slick-js', plugin_dir_url( __FILE__ ).'assets/vendor/js/slick.min.js', array() );
  wp_enqueue_script( 'my-references-scripts-js', plugin_dir_url( __FILE__ ).'assets/js/scripts.js', array() );
}
