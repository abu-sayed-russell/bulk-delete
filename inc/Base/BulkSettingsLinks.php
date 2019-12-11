<?php
/**
 * @package  bulkPlugin
 */
namespace Inc\Base;

use Inc\Base\Controller;

class BulkSettingsLinks extends Controller
{
	public function register() 
	{
		add_filter( "plugin_action_links_$this->plugin", array( $this, 'settings_link' ) );
	}

	public function settings_link( $links ) 
	{
		$settings_link = '<a href="admin.php?page=bulk_delete_plugin">Settings</a>';
		array_push( $links, $settings_link );
		return $links;
	}

}