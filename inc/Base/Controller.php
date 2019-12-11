<?php 
/**
 * @package  bulkPlugin
 */
namespace Inc\Base;

class Controller
{
	public $plugin_path;

	public $plugin_url;

	public $plugin;

	public $managers = array();

	public function __construct() {
		$this->plugin_path = plugin_dir_path( dirname( __FILE__, 2 ) );
		$this->plugin_url = plugin_dir_url( dirname( __FILE__, 2 ) );
		$this->plugin = plugin_basename( dirname( __FILE__, 3 ) ) . '/bulk-delete.php';

		$this->managers = array(
			'bulk_manager' => 'Activate Bulk Delete',
			'bulk_system' => 'Activate System Info',
		);
	}

	public function activated_bulk_option( string $key )
	{
		$option = get_option( 'bulk_delete_plugin' );

		return isset( $option[ $key ] ) ? $option[ $key ] : false;
	}
}