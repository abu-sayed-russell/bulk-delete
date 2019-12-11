<?php
/**
 * @package  bulkPlugin
 */

namespace Inc\Base;

use Inc\Base\Controller;

/**
 *
 */
class BulkEnqueue extends Controller
{
  public function register()
  {
    add_action('admin_enqueue_scripts', array($this, 'enqueue_bulk'));
    $replace_text = get_option('replace_text');

      add_action('wp_enqueue_scripts', array($this, 'front_text_replace'));


  }

  function enqueue_bulk()
  {
    $slug = "";
    $page_includes = array("bulk_delete_plugin", "bulk_schedule_options","bulk_system_info");
    $currentPage = isset($_GET['page']) ? $_GET['page'] : '';
    if (in_array($currentPage, $page_includes)) {
      wp_enqueue_style("bulk-bootstrap-css", $this->plugin_url . 'assets/css/bootstrap.min.css', '', BULK_DELETE_VERSION);
      wp_enqueue_style("bulk-select-css", $this->plugin_url . 'assets/css/bootstrap-select.min.css', '', BULK_DELETE_VERSION);
      wp_enqueue_style('bulk-style', $this->plugin_url . 'assets/css/style.css', '', BULK_DELETE_VERSION);
      wp_enqueue_script("bulk-bootstrap-js", $this->plugin_url . 'assets/js/bootstrap.min.js', '', BULK_DELETE_VERSION, true);
      wp_enqueue_script("bulk-select-js", $this->plugin_url . 'assets/js/bootstrap-select.min.js', '', BULK_DELETE_VERSION, true);
      wp_enqueue_script('bulk-script', $this->plugin_url . 'assets/js/bulk_script.js', '', BULK_DELETE_VERSION, true);
    }
  }
  function front_text_replace(){
    wp_enqueue_script('bulk-replace', $this->plugin_url . 'assets/js/replace.js', '', BULK_DELETE_VERSION, true);
  }
}