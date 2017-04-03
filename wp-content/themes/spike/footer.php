<?php $mts_options = get_option('spike'); ?>
	</div><!--#page-->
</div><!--.main-container-->
<?php if ($mts_options['mts_footer_widget_columns'] == '4') {
	$footer_widget_columns = 'col4';
} else{
	$footer_widget_columns = 'col3';
} ?>
<footer>
	<?php if($mts_options['mts_footer_rainbow'] == '1') { ?>
		<div class="rainbow"></div>
	<?php } ?>
	<?php if ($mts_options['mts_footer_widget'] != '0') { ?>
		<div class="footerTop">
			<div class="container">
				<div class="footer-widgets <?php echo $footer_widget_columns; ?>">
					<div class="f-widget f-widget-1">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widget 1') ) : ?><?php endif; ?>
					</div>
					<div class="f-widget f-widget-2">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widget 2') ) : ?><?php endif; ?>
					</div>
					<div class="f-widget f-widget-3 <?php echo ($footer_widget_columns == 'col3') ? 'last' : ''; ?>">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widget 3') ) : ?><?php endif; ?>
					</div>
					<?php if($footer_widget_columns == 'col4'){ ?>
					<div class="f-widget f-widget-4 last">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widget 4') ) : ?><?php endif; ?>
					</div>
					<?php } ?>
				</div><!--.footer-widgets-->
			</div><!--.container-->
		</div>
	<?php } ?>
	<div class="copyrights">
		<?php mts_copyrights_credit(); ?>
	</div> 
</footer><!--footer-->
</div><!--.main-container-wrap-->
<div class="secondary-navigation mobile">
	<nav id="navigation" class="clearfix">
		<?php if ( has_nav_menu( 'primary-menu' ) ) { ?>
			<?php wp_nav_menu( array( 'theme_location' => 'primary-menu', 'menu_class' => 'menu clearfix', 'container' => '' ) ); ?>
		<?php } else { ?>
			<ul class="menu clearfix">
				<?php wp_list_categories('title_li='); ?>
			</ul>
		<?php } ?>
	</nav>
</div>
<?php mts_footer(); ?>
<?php wp_footer(); ?>
</body>
</html>