<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head>
	<title><?php 
	
	bloginfo("name"); 
	
	if(is_page() || is_single()) { echo ' - '; the_title(); }
	
	?></title>
	
	<meta name="description" content="<?php bloginfo('description'); ?>" />	

	
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/fonts/fonts.css" type="text/css" />
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/custom.js"></script> 
	
	<!--<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/scroll.js"></script>-->
	
	<?php wp_head(); ?>
</head>

<body>
<div id="wrap">

	<div id="header-wrap">
	
		<div id="header">
			
			<div id="header-box-wrap">
				<div id="header-box" <?php if(is_home()) echo 'class="home"' ?>>
					<h1 class="site-title"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
					<h4 class="site-desc"><?php bloginfo('description'); ?></h4>
				</div><!-- #header-box -->
			</div><!-- #header-box-wrap -->
			
			<div id="nav-wrap">
				<div id="nav">
				
					<?php wp_nav_menu( array( 'theme_location' => 'header_menu' ) ); ?>
					
				</div>
			</div><!-- #nav-wrap -->
			
		</div><!-- #header -->
	
	</div>
	
	
	<div id="color-bar-top">
		
	</div>