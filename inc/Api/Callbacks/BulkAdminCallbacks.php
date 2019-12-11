<?php 
/**
 * @package  bulkPlugin
 */
namespace Inc\Api\Callbacks;

use Inc\Base\Controller;

class BulkAdminCallbacks extends Controller
{
	public function adminDashboard()
	{
		return require_once( "$this->plugin_path/views/featured_template.php" );
	}

	public function scheduleDashboard()
	{
		return require_once( "$this->plugin_path/views/schedule_view.php" );
	}
	public function system_view()
	{
		return require_once( "$this->plugin_path/views/system_view.php" );
	}


}