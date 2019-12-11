<?php
/**
 * @package  bulkPlugin
 */
namespace Inc\Base;

class BulkActivate
{
	public static function activate_bulk() {
		flush_rewrite_rules();

		$default = array();

		if ( ! get_option( 'bulk_delete_plugin' ) ) {
			update_option( 'bulk_delete_plugin', $default );
		}

	}
}