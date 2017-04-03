<?php
/**
 * Template part for displaying posts.
 *
 * @package Studio
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php 
	/** 
	 * studio_before_entry_container hook
	 *
	 * @hooked studio_archive_content_image - 10
	 */
	do_action( 'studio_before_entry_container' ); ?>

	<div class="entry-container">
		<header class="entry-header">
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

			<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php studio_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<?php 
		$studio_content_layout = get_theme_mod( 'content_layout', studio_get_default_theme_options( 'content_layout' ) );

		if ( is_search() || 'full-content' != $studio_content_layout ) : // Only display Excerpts for Search and if 'full-content' is not selected ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
		<?php else : ?>			
			<div class="entry-content">
				<?php the_content(); ?>
				<?php
					wp_link_pages( array(
						'before' => '<div class="page-links"><span class="pages">' . __( 'Pages:', 'studio' ) . '</span>',
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->
		<?php endif; ?>

		<footer class="entry-footer">
			<?php studio_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</div><!-- .entry-container -->
</article><!-- #post-## -->