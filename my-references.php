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

 /* My References Post Type */
 add_action( 'init', 'my_references_create_reference_post_type' );
 function my_references_create_reference_post_type() {
   register_post_type( 'reference',
     array(
       'labels' => array(
         'name' => __( 'References' ),
         'singular_name' => __( 'Reference' )
       ),
       'public' => true,
       'has_archive' => false,
       'exclude_from_search' => true,
       'supports' => array( 'title', 'thumbnail', 'editor', 'custom-fields', 'page-attributes' )
     )
   );
   flush_rewrite_rules();
 }
 /* My References Post Type */
