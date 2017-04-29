<?php
/**
 * The default template for displaying content
 *
 * @package marlin-lite
 */

$sticky_class = ( is_sticky() ) ? 'is_sticky' : null;
$pin_image = wp_get_attachment_url( get_post_thumbnail_id( get_the_id() ) );

?>
			
<article <?php post_class("post {$sticky_class}"); ?>>
					
  <?php if ( has_post_thumbnail() ) : ?>
	<div class="post-format post-standard">
		<div class="marlin-thumbnail">
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php the_post_thumbnail(); ?>
				<span class="marlin-format-icon"></span>
			</a>
			<div class="marlin-categories"><?php the_category(", "); ?></div>
		</div>
	</div>
  <?php endif; ?>
	
	<div class="entry-content">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

		<div class="entry-meta">
			<?php 
				$archive_year  = get_the_time( 'Y' ); 
				$archive_month = get_the_time( 'm' ); 
				$archive_day   = get_the_time( 'd' ); 
			?>
			<a href="<?php echo esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) ); ?>">
				<i class="fa fa-clock-o"></i>
				<?php the_time(get_option('date_format')); ?>
			</a>
			<a class="social-icon" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><i class="fa fa-facebook"></i></a>
			<a class="social-icon" target="_blank" href="https://twitter.com/home?status=Check%20out%20this%20article:%20<?php echo marlin_lite_url_encode( get_the_title() ); ?>%20-%20<?php echo urlencode(the_permalink()); ?>"><i class="fa fa-twitter"></i></a>
			<a class="social-icon" target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo esc_url($pin_image); ?>&description=<?php the_title(); ?>"><i class="fa fa-pinterest"></i></a>
			<a class="social-icon" target="_blank" href="https://plus.google.com/share?url=<?php the_permalink(); ?>"><i class="fa fa-google-plus"></i></a></i></a>
		</div>

		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		<p class="readmore">
			<a href="<?php the_permalink(); ?>" class="link-more"><?php _e( 'Read more', 'marlin-lite' ); ?></a>
		</p>
		
	</div><!-- entry-content -->
	
</article><!-- #post-## -->