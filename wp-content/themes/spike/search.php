<?php $mts_options = get_option('spike'); ?>
<?php get_header(); ?>
<div id="page">
	<div class="article">
		<h1 class="postsby">
			<span><?php _e("Search Results for:", "mythemeshop"); ?></span> <?php the_search_query(); ?>
		</h1>
		<div id="content_box">
			<?php if ($mts_options['mts_layout'] == 'biglayout') { ?>
				<?php $j = 0; if (have_posts()) : while (have_posts()) : the_post(); ?>
					<?php if (++$j == 1 && is_front_page()) { ?>
						<article class="latestPost latestBigPost excerpt">
							<header>
								<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="nofollow" id="featured-thumbnail">
									<?php if (function_exists('wp_review_show_total')) wp_review_show_total(); ?>
									<?php if ( has_post_thumbnail() ) { ?>
										<?php echo '<div class="featured-thumbnail">'; the_post_thumbnail('featured1',array('title' => '')); echo '</div>'; ?>
									<?php } else { ?>
										<div class="featured-thumbnail">
											<img width="223" height="137" src="<?php echo get_template_directory_uri(); ?>/images/nothumb-792x320.png" class="attachment-featured wp-post-image" alt="<?php the_title(); ?>">
										</div>
									<?php } ?>
								</a>
								<h2 class="title front-view-title"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
								<?php if($mts_options['mts_home_headline_meta'] == '1') { ?>
									<div class="post-info">
										<?php if(isset($mts_options['mts_home_headline_meta_info']['author']) == '1') { ?>
											<span class="theauthor"><i class="icon-user"></i> <?php  the_author_posts_link(); ?></span>  
										<?php } ?>
										<?php if(isset($mts_options['mts_home_headline_meta_info']['category']) == '1') { ?>
											<span class="thecategory"><i class="icon-tags"></i> <?php the_category(', ') ?></span> 
										<?php } ?>
										<?php if(isset($mts_options['mts_home_headline_meta_info']['date']) == '1') { ?>
											<span class="thetime"><i class="icon-calendar"></i> <?php the_time( get_option( 'date_format' ) ); ?></span>
										<?php } ?>
									</div>
								<?php } ?>
							</header>
							<div class="front-view-content">
								<?php echo mts_excerpt(75);?>
								<a class="pereadore" href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="nofollow"><?php _e('...Read More','mythemeshop'); ?></a>
								<div class="home_meta_comment_social">
									<?php if(isset($mts_options['mts_home_headline_meta_info']['comment']) == '1' && $mts_options['mts_home_headline_meta'] == '1') { ?>
										<div class="thecomment">
											<a href="<?php comments_link(); ?>" rel="nofollow"><?php comments_number('0 Comment','1 Comment','% Comments'); ?></a>		
										</div>
									<?php } ?>
								</div>	
							</div>
						</article><!--.post excerpt-->
					<?php } else { ?>
						<article class="latestPost latestBigSmallPost excerpt <?php echo (++$j % 3 == 0) ? 'last' : ''; ?>">
							<header>
								<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="nofollow" id="featured-thumbnail">
									<?php if (function_exists('wp_review_show_total')) wp_review_show_total(); ?>
									<?php if ( has_post_thumbnail() ) { ?>
										<?php echo '<div class="featured-thumbnail">'; the_post_thumbnail('featured2',array('title' => '')); echo '</div>'; ?>
									<?php } else { ?>
										<div class="featured-thumbnail">
											<img width="384" height="320" src="<?php echo get_template_directory_uri(); ?>/images/nothumb-384x320.png" class="attachment-featured wp-post-image" alt="<?php the_title(); ?>">
										</div>
									<?php } ?>
								</a>
								<h2 class="title front-view-title"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
								<?php if($mts_options['mts_home_headline_meta'] == '1') { ?>
									<div class="post-info">
										<?php if(isset($mts_options['mts_home_headline_meta_info']['author']) == '1') { ?>
											<span class="theauthor"><i class="icon-user"></i> <?php  the_author_posts_link(); ?></span>  
										<?php } ?>
										<?php if(isset($mts_options['mts_home_headline_meta_info']['category']) == '1') { ?>
											<span class="thecategory"><i class="icon-tags"></i> <?php the_category(', ') ?></span> 
										<?php } ?>
										<?php if(isset($mts_options['mts_home_headline_meta_info']['date']) == '1') { ?>
											<span class="thetime"><i class="icon-calendar"></i> <?php the_time( get_option( 'date_format' ) ); ?></span>
										<?php } ?>
									</div>
								<?php } ?>
							</header>
							<div class="front-view-content">
								<?php echo mts_excerpt(20);?>
								<a class="pereadore" href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="nofollow"><?php _e('...Read More','mythemeshop'); ?></a>
								<div class="home_meta_comment_social">
									<?php if(isset($mts_options['mts_home_headline_meta_info']['comment']) == '1' && $mts_options['mts_home_headline_meta'] == '1') { ?>
										<div class="thecomment">
											<a href="<?php comments_link(); ?>" rel="nofollow"><?php comments_number('0 Comment','1 Comment','% Comments'); ?></a>		
										</div>
									<?php } ?>
								</div>	
							</div>
						</article><!--.post excerpt-->
					<?php } ?>
				<?php endwhile; else: ?>
					<div class="no-results">
						<h2><?php _e('We apologize for any inconvenience, please hit back on your browser or use the search form below.', 'mythemeshop'); ?></h2>
						<?php get_search_form(); ?>
					</div><!--noResults-->
				<?php endif; ?>
			<?php } else { ?>
				<?php
					if ($mts_options['mts_layout'] == 'gridlayout' || $mts_options['mts_layout'] == 'thumblayout') {
						$mts_thumbnail = 'featured2';
						$mts_no_thumbnail = 'nothumb-384x320.png';
					} else if ($mts_options['mts_layout'] == 'gridslayout' || $mts_options['mts_layout'] == 'thumbslayout' || $mts_options['mts_layout'] == 'gridslayoutleft' || $mts_options['mts_layout'] == 'thumbslayoutleft') {
						$mts_thumbnail = 'featured3';
						$mts_no_thumbnail = 'nothumb-272x226.png';
					} else { 
						$mts_thumbnail = 'featured'; 
						$mts_no_thumbnail = 'nothumb.png';
					} ?>
				<?php $j = 0; if (have_posts()) : while (have_posts()) : the_post(); ?>
					<article class="latestPost excerpt <?php echo $mts_options['mts_layout']; echo (++$j % 3 == 0) ? ' last' : ''; ?>">
						<header>
							<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="nofollow" id="featured-thumbnail">
								<?php if (function_exists('wp_review_show_total')) wp_review_show_total(); ?>
								<?php if ( has_post_thumbnail() ) { ?>
									<?php echo '<div class="featured-thumbnail">'; the_post_thumbnail($mts_thumbnail,array('title' => '')); echo '</div>'; ?>
								<?php } else { ?>
									<div class="featured-thumbnail">
										<img src="<?php echo get_template_directory_uri().'/images/'.$mts_no_thumbnail; ?>" class="attachment-featured wp-post-image" alt="<?php the_title(); ?>">
									</div>
								<?php } ?>
							</a>
							<h2 class="title front-view-title"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
							<?php if ($mts_options['mts_layout'] == 'cslayout' || $mts_options['mts_layout'] == 'sclayout' || $mts_options['mts_layout'] == 'gridlayout' || $mts_options['mts_layout'] == 'gridslayout' || $mts_options['mts_layout'] == 'gridslayoutleft') { ?>
								<?php if($mts_options['mts_home_headline_meta'] == '1') { ?>
									<div class="post-info">
										<?php if(isset($mts_options['mts_home_headline_meta_info']['author']) == '1') { ?>
											<span class="theauthor"><i class="icon-user"></i> <?php  the_author_posts_link(); ?></span>  
										<?php } ?>
										<?php if(isset($mts_options['mts_home_headline_meta_info']['category']) == '1') { ?>
											<span class="thecategory"><i class="icon-tags"></i> <?php the_category(', ') ?></span> 
										<?php } ?>
										<?php if(isset($mts_options['mts_home_headline_meta_info']['date']) == '1') { ?>
											<span class="thetime"><i class="icon-calendar"></i> <?php the_time( get_option( 'date_format' ) ); ?></span>
										<?php } ?>
									</div>
								<?php } ?>
							<?php } ?>
						</header>
						<?php if ($mts_options['mts_layout'] == 'cslayout' || $mts_options['mts_layout'] == 'sclayout' || $mts_options['mts_layout'] == 'gridlayout' || $mts_options['mts_layout'] == 'gridslayout' || $mts_options['mts_layout'] == 'gridslayoutleft' ) { ?>
							<div class="front-view-content">
								<?php echo mts_excerpt(45);?>
								<a class="pereadore" href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="nofollow"><?php _e('...Read More','mythemeshop'); ?></a>
								<div class="home_meta_comment_social">
									<?php if(isset($mts_options['mts_home_headline_meta_info']['comment']) == '1' && $mts_options['mts_home_headline_meta'] == '1') { ?>
										<div class="thecomment">
											<a href="<?php comments_link(); ?>" rel="nofollow"><?php comments_number('0 Comment','1 Comment','% Comments'); ?></a>		
										</div>
									<?php } ?>
								</div>	
							</div>
						<?php } ?>
					</article><!--.post excerpt-->
				<?php endwhile; else: ?>
					<div class="no-results">
						<h2><?php _e('We apologize for any inconvenience, please hit back on your browser or use the search form below.', 'mythemeshop'); ?></h2>
						<?php get_search_form(); ?>
					</div><!--noResults-->
				<?php endif; ?>
			<?php } ?>
		</div>
		<!--Start Pagination-->
        <?php if (isset($mts_options['mts_pagenavigation_type']) && $mts_options['mts_pagenavigation_type'] == '1' ) { ?>
            <?php $additional_loop = 0; mts_pagination($additional_loop['max_num_pages']); ?> 
		<?php } else { ?>
			<div class="pagination">
				<ul>
					<li class="nav-previous"><?php next_posts_link( __( '&larr; '.'Older posts', 'mythemeshop' ) ); ?></li>
					<li class="nav-next"><?php previous_posts_link( __( 'Newer posts'.' &rarr;', 'mythemeshop' ) ); ?></li>
				</ul>
			</div>
		<?php } ?>
		<!--End Pagination-->
	</div>
	<?php if ($mts_options['mts_layout'] == 'sclayout' || $mts_options['mts_layout'] == 'cslayout' || $mts_options['mts_layout'] == 'gridslayout' || $mts_options['mts_layout'] == 'thumbslayout' || $mts_options['mts_layout'] == 'thumbslayoutleft' || $mts_options['mts_layout'] == 'gridslayoutleft') { ?>
		<?php get_sidebar(); ?>
	<?php } ?>
<?php get_footer(); ?>