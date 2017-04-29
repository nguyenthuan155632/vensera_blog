/*
 * Settings of the sticky menu
 */
jQuery(document).ready(function(){
   var wpAdminBar = jQuery('#wpadminbar');
   if (wpAdminBar.length) {
      jQuery('#sticky_header').sticky({topSpacing:wpAdminBar.height()});
   } else {
      jQuery('#sticky_header').sticky({topSpacing:0});
   }
});