<?php 
/**
 * @package  bulkPlugin
 */
namespace Inc\Base;

use Inc\Api\SettingsApi;
use Inc\Base\Controller;
use Inc\Api\Callbacks\BulkAdminCallbacks;
use Inc\Api\Callbacks\BulkManageCallbacks;

class Dashboard extends Controller
{
	public $settings;

	public $callbacks;

	public $callbacks_mngr;

	public $pages = array();

	public function register()
	{
		$this->settings = new SettingsApi();

		$this->callbacks = new BulkAdminCallbacks();

		$this->callbacks_mngr = new BulkManageCallbacks();

		$this->setPages();

		$this->setSettings();
		$this->setSections();
		$this->setFields();

		$this->settings->addPages( $this->pages )->withSubPage( 'Dashboard' )->register();
	}

	public function setPages() 
	{
		$this->pages = array(
			array(
				'page_title' => 'Bulk Delete Posts',
				'menu_title' => 'Bulk WP',
				'capability' => 'manage_options', 
				'menu_slug' => 'bulk_delete_plugin', 
				'callback' => array( $this->callbacks, 'adminDashboard' ), 
				'icon_url' => 'dashicons-trash',
				'position' => 110
			)
		);
	}

	public function setSettings()
	{
		$args = array(
			array(
				'option_group' => 'bulk_delete_plugin_settings',
				'option_name' => 'bulk_delete_plugin',
				'callback' => array( $this->callbacks_mngr, 'checkboxSanitize' )
			)
		);

		$this->settings->setSettings( $args );
	}

	public function setSections()
	{
		$args = array(
			array(
				'id' => 'bulk_delete_admin_index',
				'title' => '',
				'callback' => array( $this->callbacks_mngr, 'adminSectionManager' ),
				'page' => 'bulk_delete_plugin'
			)
		);

		$this->settings->setSections( $args );
	}

	public function setFields()
	{
		$args = array();

		foreach ( $this->managers as $key => $value ) {
			$args[] = array(
				'id' => $key,
				'title' => $value,
				'callback' => array( $this->callbacks_mngr, 'checkboxField' ),
				'page' => 'bulk_delete_plugin',
				'section' => 'bulk_delete_admin_index',
				'args' => array(
					'option_name' => 'bulk_delete_plugin',
					'label_for' => $key,
					'class' => 'ui-toggle'
				)
			);
		}

		$this->settings->setFields( $args );
	}
}