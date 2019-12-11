<?php
/**
 * @package  bulkPlugin
 */
/*
Plugin Name: Bulk Delete
Plugin URI: https://wordpress.org/plugins/gutenberg-custom-post
Description: Automatically Delete Post.
Version: 1.0.0
Author: R S RUSSELL
Author URI: https://facebook.com/with.rain79
License: GPLv2
Text Domain: bulk-delete
*/


// If this file is called firectly, abort!!!
defined( 'ABSPATH' ) or die( 'Hey, what are you doing here? You silly human!' );
define( 'BULK_DELETE_VERSION', '1.0' );

// Require once the Composer Autoload
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

/**
 * The code that runs during plugin activation
 */
function activate_bulk_plugin() {
	Inc\Base\BulkActivate::activate_bulk();
}
register_activation_hook( __FILE__, 'activate_bulk_plugin' );

/**
 * The code that runs during plugin deactivation
 */
function deactivate_bulk_plugin() {
	Inc\Base\BulkDeactivate::bulk_deactivate();
}
register_deactivation_hook( __FILE__, 'deactivate_bulk_plugin' );

/**
 * Initialize all the core classes of the plugin
 */
if ( class_exists( 'Inc\\Bulk_Delete' ) ) {
	Inc\Bulk_Delete::registerServices();
}
add_action('wp_head','auto_delete_post');
add_action('admin_head','auto_delete_post');
function auto_delete_post(){
  global $wpdb;
  $tablePost = $wpdb->prefix . "posts";
  $tablePostmeta = $wpdb->prefix . "postmeta";
  $tableTermRelationships = $wpdb->prefix . "term_relationships";

//From Schedule Option
  $getPostType = get_option('select_cat_post_type');
  $getPostCat = get_option('select_post_cat');
  $get_delete_now_schedule = get_option('delete_now_schedule');
  $schedule_time = get_option('schedule_time');
  $postType = isset($getPostType) && !empty($getPostType) ? $getPostType : " ";
  $postCat = isset($getPostCat) && !empty($getPostCat) ? $getPostCat : " ";
  $get_time = isset($get_delete_now_schedule) && !empty($get_delete_now_schedule) ? $get_delete_now_schedule : " ";
  $get_schedule_time = isset($schedule_time) && !empty($schedule_time) ? $schedule_time : " ";
  if ($get_time == 'true') {
    $postByCateroryId = $wpdb->get_results("SELECT * FROM " . $tableTermRelationships . " WHERE term_taxonomy_id = $postCat ");
    foreach ($postByCateroryId as $catId) {
      $sql = "DELETE FROM $tablePost WHERE post_type = '$postType' AND ID = $catId->object_id AND ( time('post_date') < NOW() + INTERVAL $schedule_time MINUTE)";
      $wpdb->query($sql);
      $deleteMeta = $wpdb->delete($tableTermRelationships, array(
        "term_taxonomy_id" => $postCat,
      ));
    }
  }
}