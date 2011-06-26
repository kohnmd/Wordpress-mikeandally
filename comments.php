<?php if ( comments_open() ) : ?>
	<div class="post-wrap comment-wrap">
		<div class="post left">
			<?php comment_form(); ?>
		</div><!-- .post.left -->
		
		<div class="post right">
			<div id="comments">
				<?php if ( post_password_required() ) : ?>
						<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'twentyten' ); ?></p>
					</div><!-- #comments -->
				<?php return; endif; ?>

				<?php if ( have_comments() ) : ?>
					
					<h3>
						<?php
						printf( _n( 'One Comment', '%1$s Comments', get_comments_number(), 'twentyten' ), number_format_i18n( get_comments_number() ) );
						?>
					</h3>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
				<div class="navigation">
					<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'twentyten' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?></div>
				</div> <!-- .navigation -->
	<?php endif; // check for comment navigation ?>

				<ol class="commentlist">
					<?php wp_list_comments( array( 'callback' => 'crossfaded_comment' ) ); ?>
				</ol>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
				<div class="navigation">
					<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'twentyten' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?></div>
				</div><!-- .navigation -->
	<?php endif; // check for comment navigation ?>
				
				<?php endif; // end have_comments() ?>
			</div> <!-- #comments -->
		</div><!-- .post.right -->
	
	</div><!-- .post-wrap -->
<?php endif; // end comments_open () ?>