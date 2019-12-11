<?php
/**
 * @package  bulkPlugin
 */
namespace Inc\Base;

class BulkDeactivate
{
	public static function bulk_deactivate() {
		flush_rewrite_rules();
	}
}