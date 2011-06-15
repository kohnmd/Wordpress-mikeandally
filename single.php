<?php get_header(); ?>

<!--Begin Middle-->
<div id="middle">

	<!--Begin main -->
	<div id="main">
		
		<!--Begin content -->
		<div id="content">
		
			<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
			
			<div class="post-wrap">
				<h2 class="page-title"><?php the_title(); ?></h2>
			</div>
			
			<div class="post-wrap">
			
				<div class="post" id="post-<?php the_ID(); ?>" >
					
					<div class="entry">
						<?php the_content(); ?>
					</div> <!-- END .entry -->
					
					<div class="clear"></div>
					
					<div class="metadata">
						<ul>
							<li><?php the_date('d M Y'); ?></li>
							<li><?php the_category('</li><li>'); ?></li>
						</ul>
					</div> <!-- END .metadata -->
					
					<?php if(get_the_tags()) : ?>
					<div class="metadata">
						<?php the_tags(); ?>
					</div> <!-- END .metadata (tags) -->
					<?php endif; ?>
				
					<div class="clear"></div>
				</div> <!-- END .post -->
			</div> <!-- END .post_wrap -->
			
			<?php comments_template(); ?>

		</div> <!-- END #content -->
		
		<!--Begin Sidebar-->
		<?php get_sidebar(); ?>
		<!--End Sidebar-->
		
		<!--Begin Pagination-->
		<div class="pagination-wrap">
			<div class="pagination">
				<ol class="wp-paginate">
					<li class="pages-page"><?php next_post_link('%link', '&laquo; next post'); ?></li>
					<li class="pages-page pages-current"><?php the_title(); ?></li>
					<li class="pages-page"><?php previous_post_link('%link', 'previous post &raquo;'); ?></li>
				</ol>
			</div>
		</div>
		<!--End Pagination-->
		
		<?php endwhile; endif; ?>
	</div>
	<!-- End #main -->

</div> <!--End Middle-->
<?php get_footer(); ?>
