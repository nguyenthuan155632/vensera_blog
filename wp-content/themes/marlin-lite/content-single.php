<?php
/**
 * The template used for displaying single post
 *
 * @package marlin-lite
 */
?>

<?php $sticky_class = ( is_sticky() ) ? 'vt-post-sticky' : null; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <div class="post-inner">
	
	  <?php if ( has_post_thumbnail() ) : ?>
		<div class="marlin-thumbnail">
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php the_post_thumbnail(); ?>
				<span class="marlin-format-icon"></span>
			</a>
			<div class="marlin-categories"><?php the_category(", "); ?></div>
		</div>
	  <?php endif; ?>
                    
		<div class="entry-content">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

			<div class="entry-summary">
				<?php the_content(); ?>
				<?php edit_post_link( __( 'Edit', 'marlin-lite' ), '<span class="edit-link">', '</span>' ); ?>
			</div>
			
			<?php if ( get_the_tags() ) : ?>
			<div class="vt-post-tags">
				<?php the_tags('',' '); ?>
			</div>
			<?php endif; ?>

			<footer class="entry-footer">
				<div class="post-time pull-left">
					<?php 
						$archive_year  = get_the_time( 'Y' ); 
						$archive_month = get_the_time( 'm' ); 
						$archive_day   = get_the_time( 'd' ); 
					?>
					<a href="<?php echo esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) ); ?>">
						<?php the_time(get_option('date_format')); ?>
					</a>
				</div>
				<?php $pin_image = wp_get_attachment_url( get_post_thumbnail_id( get_the_id() ) ); ?>
				<div class="social-share share-buttons">
					<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><i class="fa fa-facebook"></i></a>
					<a target="_blank" href="https://twitter.com/home?status=Check%20out%20this%20article:%20<?php echo marlin_lite_url_encode( get_the_title() ); ?>%20-%20<?php echo urlencode(the_permalink()); ?>"><i class="fa fa-twitter"></i></a>                    			
					<a target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo esc_url($pin_image); ?>&description=<?php the_title(); ?>"><i class="fa fa-pinterest"></i></a>
					<a target="_blank" href="https://plus.google.com/share?url=<?php the_permalink(); ?>"><i class="fa fa-google-plus"></i></a>
				</div>
			</footer>

			<?php the_post_navigation(); ?>
			<?php get_template_part( 'template-parts/single', 'post-author' ); ?>
			<?php comments_template( '', true );  ?>
			
		</div><!-- post-content -->
		
  </div><!-- post-inner -->
		
</article><!-- #post-## -->