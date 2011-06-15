<?php get_header(); ?>

<!--Begin Middle-->
<div id="middle">

	<!--Begin #main -->
	<div id="main">
		
		<!--Begin #content -->
		<div id="content">
			<div class="post-wrap">
				<h2 class="page-title">
					Search results for <?php the_search_query(); ?>
					<?php if($paged) echo ' | Page '. $paged; ?>
				</h2>
			</div>
		
			<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
			
			<div class="post-wrap">
				<div class="post" id="post-<?php the_ID(); ?>" >
					<?php /*<div class="post-image" >
						<img width="210" height="200" src="http://www.inatmo.com/opatheme/wp-content/uploads/2010/08/02076_newyorkcity_1920x1200-210x200.jpg" class="mainimage wp-post-image" alt="02076_newyorkcity_1920x1200" title="02076_newyorkcity_1920x1200" />
					</div> <!-- END .post_image --> */ ?>
				
					<h2 class="title"><a href=<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
					
					<div class="entry">
						<?php the_content(); ?>
					</div> <!-- END .entry -->
					
					<div class="clear"></div>
					
					<div class="metadata">
						<ul>
							<li><?php the_date('d M Y'); ?></li>
							<li><?php the_category('</li><li>'); ?></li>
						</ul>
						<div class="metarest">
							<a href="http://www.inatmo.com/opatheme/79/#respond" title="Comment on Proin rutrum commodo tellus">No Comments</a>
						</div>
					</div> <!-- END .metadata -->
					
					<?php if(get_the_tags()) : ?>
					<div class="metadata">
						<?php the_tags(); ?>
					</div> <!-- END .metadata (tags) -->
					<?php endif; ?>
				
					<div class="clear"></div>
				</div> <!-- END .post -->
			</div> <!-- END .post_wrap -->

			<?php endwhile; ?>
			
			<?php else: // else if no posts exist ?>
				
			<div class="post-wrap">
				<div class="post">
					<h2>
						Sorry, no results found, sucka.
					</h2>
				</div>
			</div>
				
			<?php endif; // ends if posts exist ?>
		</div>
		<!-- End #content -->
		
		<!--Begin Sidebar-->
		<?php get_sidebar(); ?>
		<!--End Sidebar-->
		
		<?php
		global $wp_query;
		if (function_exists("emm_paginate") && $wp_query->max_num_pages > 1) : ?>
		<!--Begin Pagination-->
		<div class="pagination-wrap">
			<?php emm_paginate(); ?>
		</div>
		<!--End Pagination-->
		<?php endif; //ends pagination ?>
		
	</div>
	<!--End #main-->

</div> <!--End Middle-->
<?php get_footer(); ?>
