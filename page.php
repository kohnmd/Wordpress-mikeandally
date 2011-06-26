<?php get_header(); ?>

<!--Begin Middle-->
<div id="middle">

	<!--Begin #main -->
	<div id="main">
		
		<!--Begin #content -->
		<div id="content">
			<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
			
			<div class="post-wrap">
				<div class="post" id="post-<?php the_ID(); ?>" >
					<h1 class="title"><?php the_title(); ?></h1>
					<?php the_content(); ?>
				</div> <!-- .post -->
			</div>
			
			<?php endwhile; ?>
			<?php endif; ?>
			
			
			<?php
			$args = array('child_of' => $post->ID, 'sort_columns' => 'menu_order', 'sort_order' => 'desc');
			$counter = 0;
			$wrap = true;
			
			foreach(get_pages($args) as $page) { ?>
			<?php
				if((++$counter % 2) == 0) {
					$wrap = false;
				} else {
					$wrap = true;
				}
				
				if($wrap) echo '<div class="post-wrap">'; 
				?>
				
					<div class="post <?php echo $wrap ? 'left' : 'right'; ?>">
					
						<h1 class="title"><?php	echo $page->post_title; ?></h1>
						<?php echo $page->post_content; ?>
					
					</div><!-- .post -->
				
				<?php if(!$wrap) echo '</div><!-- .post-wrap --->'; ?>
			<?php
			} // endforeach
			?>
			
			
			
			<?php comments_template(); ?>
			
		</div>
		<!-- END #content -->
		
	</div>
	<!--End #main-->
	

</div> <!--End Middle-->
<?php get_footer(); ?>
