<?phpfunction bulk_html_head($html_heading, $collapseId){  echo '<div class="wrapper center-block">';  echo '<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">';  echo ' <div class="panel panel-default">';  echo '<div class="panel-heading active" role="tab" id="heading' . $collapseId . '">';  echo '<h4 class="panel-title">';  echo '<a role="button" data-toggle="collapse" data-parent="#accordion" href="#' . $collapseId . '" aria-expanded="true" aria-controls="' . $collapseId . '">';  echo $html_heading;  echo '</a>';  echo '</h4>';  echo '</div>';  echo '<div id="' . $collapseId . '" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading' . $collapseId . '">';  echo '<div class="panel-body">';}function bulk_html_footer(){  echo '</div>';  echo '</div>';  echo '</div>';  echo '</div>';  echo '</div>';}function render_submit_button($text, $buttonName, $buttonId){  ?>  <p class="submit">    <button type="submit" name="<?php echo $buttonName; ?>" id="<?php echo $buttonId; ?>" class="button-primary"><?php esc_html_e($text . '¨R¨S¨R¨U¨S¨S¨E¨L¨L¨¨ ', 'bulk-delete'); ?>&raquo;</button>  </p>  <?php}