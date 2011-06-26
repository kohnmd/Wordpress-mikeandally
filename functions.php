<?php

function pre_print ($var, $desc="") {
	echo '<pre>' . $desc;
	print_r($var);
	echo '</pre>';
}


//*********************************************************************************
// Clean up head.
//*********************************************************************************

	// Add RSS links to <head> section
	automatic_feed_links();
	
	// Clean up the <head>
	function removeHeadLinks() {
    	remove_action('wp_head', 'rsd_link');
    	remove_action('wp_head', 'wlwmanifest_link');
    }
    add_action('init', 'removeHeadLinks');
    remove_action('wp_head', 'wp_generator');

// add js to allow comment replies
function theme_queue_js(){
  if (!is_admin()){
    if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1))
      wp_enqueue_script( 'comment-reply' );
  }
}
add_action('wp_print_scripts', 'theme_queue_js');


	
//*********************************************************************************
// Shorter excerpt
// Currently used in header.php for meta description
//*********************************************************************************	
	
function excerpt($num=35) {
  $limit = $num+1;
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  array_pop($excerpt);
  $excerpt = implode(" ",$excerpt)."...";
  return strip_tags($excerpt);
}
	
	
//*********************************************************************************
// Register sidebar widgets & menu nav
//*********************************************************************************

if (function_exists('register_sidebar')) {
	
	register_sidebar(array(
		'name' => 'Sidebar',
		'id' => 'whole_sidebar',
		'description' => '',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	
}

function register_my_menus() {
	if ( function_exists( 'register_nav_menus' ) ) {
		register_nav_menus(
			array(
			  'header_menu' => 'Main Header Menu'
			)
		);
	}
}
add_action( 'init', 'register_my_menus' );


//*********************************************************************************
//Pagination
//*********************************************************************************

/**
 * Retrieve or display pagination code.
 *
 * The defaults for overwriting are:
 * 'page' - Default is null (int). The current page. This function will
 *      automatically determine the value.
 * 'pages' - Default is null (int). The total number of pages. This function will
 *      automatically determine the value.
 * 'range' - Default is 3 (int). The number of page links to show before and after
 *      the current page.
 * 'gap' - Default is 3 (int). The minimum number of pages before a gap is 
 *      replaced with ellipses (...).
 * 'anchor' - Default is 1 (int). The number of links to always show at begining
 *      and end of pagination
 * 'before' - Default is '<div class="page-paginate">' (string). The html or text 
 *      to add before the pagination links.
 * 'after' - Default is '</div>' (string). The html or text to add after the
 *      pagination links.
 * 'title' - Default is '__('Pages:')' (string). The text to display before the
 *      pagination links.
 * 'next_page' - Default is '__('&raquo;')' (string). The text to use for the 
 *      next page link.
 * 'previous_page' - Default is '__('&laquo')' (string). The text to use for the 
 *      previous page link.
 * 'echo' - Default is 1 (int). To return the code instead of echo'ing, set this
 *      to 0 (zero).
 *
 * @author Eric Martin <eric@ericmmartin.com>
 * @copyright Copyright (c) 2009, Eric Martin
 * @version 1.0
 *
 * @param array|string $args Optional. Override default arguments.
 * @return string HTML content, if not displaying.
 */
function emm_paginate($args = null) {
	$defaults = array(
		'page' => null, 'pages' => null, 
		'range' => 2, 'gap' => 1, 'anchor' => 1,
		'before' => '<div class="pagination">', 'after' => '</ol></div>',
		'title' => __('Pages'),
		'nextpage' => __('older &raquo;'), 'previouspage' => __('&laquo; newer'),
		'echo' => 1
	);

	$r = wp_parse_args($args, $defaults);
	extract($r, EXTR_SKIP);

	if (!$page && !$pages) {
		global $wp_query;

		$page = get_query_var('paged');
		$page = !empty($page) ? intval($page) : 1;

		$posts_per_page = intval(get_query_var('posts_per_page'));
		$pages = intval(ceil($wp_query->found_posts / $posts_per_page));
	}
	
	$output = "";
	if ($pages > 1) {	
		$output .= "$before<span class='pages-title'>$title</span><ol class='wp-paginate'>";
		$ellipsis = "<li class='pages-gap'>...</li>";

		if ($page > 1 && !empty($previouspage)) {
			$output .= "<li><a href='" . get_pagenum_link($page - 1) . "' class='pages-prev'>$previouspage</a></li>";
		}
		
		$min_links = $range * 2 + 1;
		$block_min = min($page - $range, $pages - $min_links);
		$block_high = max($page + $range, $min_links);
		$left_gap = (($block_min - $anchor - $gap) > 0) ? true : false;
		$right_gap = (($block_high + $anchor + $gap) < $pages) ? true : false;

		if ($left_gap && !$right_gap) {
			$output .= sprintf('%s%s%s', 
				emm_paginate_loop(1, $anchor), 
				$ellipsis, 
				emm_paginate_loop($block_min, $pages, $page)
			);
		}
		else if ($left_gap && $right_gap) {
			$output .= sprintf('%s%s%s%s%s', 
				emm_paginate_loop(1, $anchor), 
				$ellipsis, 
				emm_paginate_loop($block_min, $block_high, $page), 
				$ellipsis, 
				emm_paginate_loop(($pages - $anchor + 1), $pages)
			);
		}
		else if ($right_gap && !$left_gap) {
			$output .= sprintf('%s%s%s', 
				emm_paginate_loop(1, $block_high, $page),
				$ellipsis,
				emm_paginate_loop(($pages - $anchor + 1), $pages)
			);
		}
		else {
			$output .= emm_paginate_loop(1, $pages, $page);
		}

		if ($page < $pages && !empty($nextpage)) {
			$output .= "<li><a href='" . get_pagenum_link($page + 1) . "' class='pages-next'>$nextpage</a></li>";
		}

		$output .= $after;
	}

	if ($echo) {
		echo $output;
	}

	return $output;
}

/**
 * Helper function for pagination which builds the page links.
 *
 * @access private
 *
 * @author Eric Martin <eric@ericmmartin.com>
 * @copyright Copyright (c) 2009, Eric Martin
 * @version 1.0
 *
 * @param int $start The first link page.
 * @param int $max The last link page.
 * @return int $page Optional, default is 0. The current page.
 */
function emm_paginate_loop($start, $max, $page = 0) {
	$output = "";
	for ($i = $start; $i <= $max; $i++) {
		$output .= ($page === intval($i)) 
			? "<li class='pages-page pages-current'><span>{$i}</span></li>" 
			: "<li class='pages-page'><a href='" . get_pagenum_link($i) . "' class='pages-page'>$i</a></li>";
	}
	return $output;
}


//*********************************************************************************
// COMMENT CUSTOMIZATION
//*********************************************************************************


// FORM CUSTOMIZATION

function sebnitu_comment_form($form_options) {
	
	$commenter = wp_get_current_commenter();

//pre_print($form_options);

	// Fields Array
	$fields = array(

		'author' =>	'<div class="comment-form-author row">' .
					'<label for="author">' . __( 'Name' ) . ' <span class="required">*</span></label><br />' .
					'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />' .
					'</div>',

		'email' =>	'<div class="comment-form-email row">' .
					'<label for="email">' . __( 'Email' ) . ' <span class="required">*</span></label><br />' .
					'<input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />' .
					'</div>'
	);

	// Form Options Array
	$form_options = array(
		// Include Fields Array
		'fields' => apply_filters( 'comment_form_default_fields',$fields ),

		// Template Options
		'comment_field' =>
					'<div class="comment-form-comment row">' .
					'<label for="comment">' . _x( 'Comment', 'noun' ) . ' <span class="required">*</span></label><br />' .
					'<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>' .
					'</div>',

		'must_log_in' =>
					'<p class="must-log-in">' .
					sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ),
					wp_login_url( apply_filters( 'the_permalink', get_permalink($post_id) ) ) ) .
					'</p>',

		'logged_in_as' =>
					'<p class="logged-in-as">' .
					sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ),
					admin_url('profile.php'), $user_identity, wp_logout_url( apply_filters('the_permalink', get_permalink($post_id)) ) ) .
					'</p>',

		'comment_notes_before' => '',

		'comment_notes_after' => '',

					
		// Rest of Options
		'id_form' => 'form-comment',
		'id_submit' => 'submit',
		'title_reply' => __( 'Leave a Reply' ),
		'title_reply_to' => __( 'Leave a Reply to %s' ),
		'cancel_reply_link' => __( 'Cancel reply' ),
		'label_submit' => __( 'Post Comment' ),
	);

	return $form_options;
}

add_filter('comment_form_defaults','sebnitu_comment_form');


// COMMENT LIST CUSTOMIZATION

if ( ! function_exists( 'crossfaded_comment' ) ) :
function crossfaded_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>" class="single-comment">
			
			<div class="comment-content">
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, 40 ); ?>
					<cite class="fn"><?php echo get_comment_author_link(); ?></cite>
				</div><!-- .comment-author .vcard -->
				
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentyten' ); ?></em>
					<br />
				<?php endif; ?>

				<div class="comment-body"><?php comment_text(); ?></div>
			</div> <!-- END .comment-content -->
			
			<div class="metadata">
				<ul>
					<li><?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] , 'add_below' => 'comment' ) ) ); ?></li>
					<?php edit_comment_link('Edit', '<li>', '</li>'); ?>
				</ul><!-- .reply -->
			
				<div class="metarest"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><?php comment_date() ?></a></div>
			</div><!-- .metadata (comment) -->

		</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'twentyten' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'twentyten' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;


?>