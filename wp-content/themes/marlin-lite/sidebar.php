<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package marlin-lite
 */
?>

<div class="col-md-4 sidebar">
  <aside id="sidebar">
	<?php if ( is_active_sidebar('sidebar') ) { dynamic_sidebar('sidebar'); } ?>
  </aside>
</div>