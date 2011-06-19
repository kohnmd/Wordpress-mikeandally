<?php get_header(); ?>

	<div id="main">
		<div id="content">
			
			<?php
			$home_page_id = 496; // [CHANGEME] based on what the parent page id is for the pages you want displayed on the homepage
			
			$args = array('child_of' => $home_page_id, 'sort_columns' => 'menu_order');
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
		
		</div><!-- #content -->
	</div><!-- #main-->	

<?php get_footer(); ?>
