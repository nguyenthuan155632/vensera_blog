<?php $mts_options = get_option('spike'); ?>
<form method="get" id="searchform" class="search-form" action="<?php echo home_url(); ?>" _lpchecked="1">
	<fieldset>
		<input type="text" name="s" id="s" value="<?php the_search_query(); ?>" placeholder="<?php _e('Search the site','mythemeshop'); ?>" x-webkit-speech="x-webkit-speech"<?php if (!empty($mts_options['mts_ajax_search'])) echo ' autocomplete="off"'; ?> >
		<input id="search-image" class="sbutton" type="submit" value="<?php _e('Search','mythemeshop'); ?>">
	</fieldset>
</form>