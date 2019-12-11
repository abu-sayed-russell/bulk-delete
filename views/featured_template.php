<?php bulk_html_head('Active Bulk Delete Feature', 'active_option'); ?>
<?php settings_errors(); ?>
<form method="post" action="options.php">
  <?php
  settings_fields('bulk_delete_plugin_settings');
  do_settings_sections('bulk_delete_plugin');
  render_submit_button('Save Option ','','');

  ?>
</form>
<?php bulk_html_footer(); ?>