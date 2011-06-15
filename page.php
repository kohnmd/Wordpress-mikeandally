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
			$children = get_pages('child_of='.$post->ID.'&parent='.$post->ID);
			
			if(count($children)) {
				$i = 0;
			
				foreach($children as $child) {
					if(++$i % 2 == 0) {
						echo '<div class="post right">';
					} else {
						echo '<div class="post-wrap">';
						echo '<div class="post left">';
					} ?>
					
						<h1 class="title"><?php echo $child->post_title ?></h1>
						<?php echo $child->post_content; ?>
					
					
					<?php if($i % 2 == 0) {
						echo '</div><!-- .post.right -->';
						echo '</div><!-- .post-wrap -->';
					} else {
						echo '</div><!-- .post.left -->';
					}
				} // endforeach
			} // endif
			?>
		
		</div>
		<!-- END #content -->
		
	</div>
	<!--End #main-->
	

</div> <!--End Middle-->
<?php get_footer(); ?>
