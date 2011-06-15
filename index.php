<?php get_header(); ?>

	<div id="main">
		<div id="content">
			
			<div class="post-wrap">
				<div class="post left">
					<?php
						$args = array( 'page_id'=>498);
						$home_left_query = new WP_Query( $args );
						if($home_left_query->have_posts()) while($home_left_query->have_posts()) : $home_left_query->the_post();
							echo '<h1 class="title">' . get_the_title() . '</h1>';
							the_content();
							
							
						endwhile;
					?>
				</div><!-- .half-left -->
				
				<div class="post right">
					<?php
						$args = array( 'page_id'=>520);
						$home_left_query = new WP_Query( $args );
						if($home_left_query->have_posts()) while($home_left_query->have_posts()) : $home_left_query->the_post();
							echo '<h1 class="title">' . get_the_title() . '</h1>';
							the_content();
							
							
						endwhile;
					?>
				</div><!-- .half-right -->
			</div><!-- .post -->
			
			
			<?php /* <div class="content-block">
				<h2>On May 18, 2012 we'll look like this:</h2>
			</div>
			<div id="main-image">
				<img src="<?php bloginfo('template_url'); ?>/images/wedding-photo.jpg" height="371" width="938" />
			</div> */ ?>
		
		</div><!-- #content -->
	</div><!-- #main-->	

<?php get_footer(); ?>
