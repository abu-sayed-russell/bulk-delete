<?phpnamespace Inc\Base;use Inc\Api\Callbacks\BulkAdminCallbacks;use Inc\Api\SettingsApi;class BulkSystemInfo extends Controller{  public $settings;  public $callbacks;  public $subpages = array();  public function register()  {    if (!$this->activated_bulk_option('bulk_system')) return;    $this->settings = new SettingsApi();    $this->callbacks = new BulkAdminCallbacks();    $this->setSubpages();    $this->settings->addSubPages($this->subpages)->register();  }  public function setSubpages() {    $this->subpages = array(      array(        'parent_slug' => 'bulk_delete_plugin',        'page_title'  => 'System Info',        'menu_title'  => 'System Info',        'capability'  => 'manage_options',        'menu_slug'   => 'bulk_system_info',        'callback'    => array( $this->callbacks, 'system_view' )      ),    );  }}