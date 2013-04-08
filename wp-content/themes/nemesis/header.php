<?php
/**
 * The Header for the template.
 *
 * @package WordPress
 */

$pp_theme_version = THEMEVERSION;
 
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />

<?php
$pp_advance_responsive = get_option('pp_advance_responsive');

if(!empty($pp_advance_responsive))
{
?>
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
<?php
}
?>

<?php
$pp_seo_enable = get_option('pp_seo_enable');

if(!empty($pp_seo_enable))
{
	if(is_home())
	{
		$pp_seo_home_title = get_option('pp_seo_home_title');
	}
	else if(is_single())
	{
		$page = get_page($post->ID);
		$current_page_id = $page->ID;
		
		$pp_seo_home_title = get_post_meta($current_page_id, 'post_seo_title', true);
	}
}
else
{
	$pp_seo_home_title = '';
}

if(empty($pp_seo_home_title))
{
?>
<title><?php wp_title('&lsaquo;', true, 'right'); ?><?php bloginfo('name'); ?></title>
<?php
} else {
?>
<title><?php echo $pp_seo_home_title; ?></title>
<?php
}
?>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />


<?php
if(!empty($pp_seo_enable))
{
	if(is_single())
	{
		$page = get_page($post->ID);
		$current_page_id = $page->ID;
		
		$pp_seo_meta_desc = get_post_meta($current_page_id, 'post_seo_desc', true);
	}
	else
	{
		$pp_seo_meta_desc = get_option('pp_seo_meta_desc');
	}
}
else
{
	$pp_seo_meta_desc = '';
}

if(!empty($pp_seo_meta_desc))
{
?>
<meta name="description" content="<?php echo $pp_seo_meta_desc; ?>" />
<?php
}
?>
<?php
if(!empty($pp_seo_enable))
{
	if(is_single())
	{
		$page = get_page($post->ID);
		$current_page_id = $page->ID;
		
		$pp_seo_meta_key = get_post_meta($current_page_id, 'post_seo_keyword', true);
	}
	else
	{
		$pp_seo_meta_key = get_option('pp_seo_meta_key');
	}
}
else
{
	$pp_seo_meta_key = '';
}

if(!empty($pp_seo_meta_key))
{
?>
<meta name="keywords" content="<?php echo $pp_seo_meta_key; ?>" />
<?php
}
?>

<?php
	/**
	*	Get favicon URL
	**/
	$pp_favicon = get_option('pp_favicon');
	
	if(!empty($pp_favicon))
	{
?>
		<link rel="shortcut icon" href="<?php echo $pp_favicon; ?>" />
<?php
	}
?>

<!-- Template stylesheet -->
<?php    
    $pp_advance_combine_css = get_option('pp_advance_combine_css');
	
	if(!empty($pp_advance_combine_css))
	{	
		if(!file_exists(THEMEUPLOAD."combined.css"))
		{
			$cssmin = new CSSMin();
    		
			$css_arr = array(
			    TEMPLATEPATH.'/js/flexslider/flexslider.css',
			    TEMPLATEPATH.'/js/fancybox/jquery.fancybox.css',
			);
			
   			$cssmin->addFiles($css_arr);
 			
    		// Set original CSS from all files
    		$cssmin->setOriginalCSS();
    		$cssmin->compressCSS();
 			
    		$css = $cssmin->printCompressedCSS();
    		file_put_contents(THEMEUPLOAD."combined.css", $css);
    	}
    	
    	wp_enqueue_style("jqueryui_css", get_stylesheet_directory_uri()."/css/jqueryui/custom.css", false, $pp_theme_version, "all");
		wp_enqueue_style("combined_css", THEMEUPLOADURL."combined.css", false, $pp_theme_version);
		wp_enqueue_style("screen_css", get_stylesheet_directory_uri()."/css/screen.css", false, $pp_theme_version, "all");
		
	}
	else
	{
		wp_enqueue_style("jqueryui_css", get_stylesheet_directory_uri()."/css/jqueryui/custom.css", false, $pp_theme_version, "all");
		wp_enqueue_style("flexslider_css", get_stylesheet_directory_uri()."/js/flexslider/flexslider.css", false, $pp_theme_version, "all");
		wp_enqueue_style("screen_css", get_stylesheet_directory_uri()."/css/screen.css", false, $pp_theme_version, "all");
		wp_enqueue_style("fancybox_css", get_stylesheet_directory_uri()."/js/fancybox/jquery.fancybox.css", false, $pp_theme_version, "all");
	}
?>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

<?php
	wp_enqueue_script("jquery", get_stylesheet_directory_uri()."/js/jquery.js", false, $pp_theme_version);
	wp_enqueue_script("jquery_UI_js", get_stylesheet_directory_uri()."/js/jquery-ui.js", false, $pp_theme_version);
	wp_enqueue_script("swfobject.js", get_stylesheet_directory_uri()."/swfobject/swfobject.js", false, $pp_theme_version);
	
	$pp_font = get_option('pp_font_family');
	$pp_font = urlencode($pp_font);
	
	if(!empty($pp_font))
	{
		wp_enqueue_style('google_fonts', "http://fonts.googleapis.com/css?family=".$pp_font, false, "", "all");
	}
	else
	{
		wp_enqueue_style('google_fonts', "http://fonts.googleapis.com/css?", false, "", "all");
	}
	
	$js_path = TEMPLATEPATH."/js/";
	$js_arr = array(
	    'fancybox/jquery.fancybox.pack.js',
	    'jquery.easing.js',
	    'gmap.js',
	    'jquery.validate.js',
	    'browser.js',
	    'jquery.isotope.js',
	    'flexslider/jquery.flexslider-min.js',
	    'reflection.js',
	    'jwplayer.js',
	    'hint.js',
	    'custom.js',
	);
	$js = "";

	$pp_advance_combine_js = get_option('pp_advance_combine_js');
	
	if(!empty($pp_advance_combine_js))
	{	
		if(!file_exists(THEMEUPLOAD."combined.js"))
		{
			foreach($js_arr as $file) {
				if($file != 'jquery.js' && $file != 'jquery-ui.js')
				{
    				$js .= JSMin::minify(file_get_contents($js_path.$file));
    			}
			}
			
			file_put_contents(THEMEUPLOAD."combined.js", $js);
		}

		wp_enqueue_script("combined_js", THEMEUPLOADURL."combined.js", false, $pp_theme_version);
	}
	else
	{
		foreach($js_arr as $file) {
			if($file != 'jquery.js' && $file != 'jquery-ui.js')
			{
				wp_enqueue_script($file, get_stylesheet_directory_uri()."/js/".$file, false, $pp_theme_version);
			}
		}
	}
?>

<?php
	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>

<!--[if IE]>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/ie.css?v=<?php echo $pp_theme_version; ?>.css" type="text/css" media="all"/>
<![endif]-->

<?php

//Get custom CSS template
$pp_advance_enable_custom = get_option('pp_advance_enable_custom');
if(!empty($pp_advance_enable_custom))
{
	include (TEMPLATEPATH . "/templates/custom-css.php");
}

?>

<?php
if(!empty($pp_advance_responsive))
{
?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri()?>/css/grid.css" type="text/css" media="all"/>
<?php
}
?>

</head>

<?php

/**
*	Get Current page object
**/
$page = get_page($post->ID);


/**
*	Get current page id
**/
$current_page_id = '';

if(isset($page->ID))
{
    $current_page_id = $page->ID;
}
?>

<body <?php body_class(); ?>>

	<?php
		$pp_slider_timer = get_option('pp_slider_timer'); 
				
		if(empty($pp_slider_timer))
		{
		    $pp_slider_timer = 5;
		}
	?>
	<input type="hidden" id="slider_timer" name="slider_timer" value="<?php echo $pp_slider_timer; ?>"/>
	
	<input type="hidden" id="pp_blogurl" name="pp_blogurl" value="<?php echo home_url(); ?>"/>
	
	<input type="hidden" id="pp_stylesheet_directory" name="pp_stylesheet_directory" value="<?php echo get_stylesheet_directory_uri(); ?>"/>
	<?php
		$pp_portfolio_sorting = get_option('pp_portfolio_sorting');
	?>
	<input type="hidden" id="pp_portfolio_sorting" name="pp_portfolio_sorting" value="<?php echo $pp_portfolio_sorting; ?>"/>
	<?php
		$pp_footer_style = get_option('pp_footer_style');
	?>
	<input type="hidden" id="pp_footer_style" name="pp_footer_style" value="<?php echo $pp_footer_style; ?>"/>
	
	<input type="hidden" id="pp_is_portfolio_open" name="pp_is_portfolio_open" value="0"/>
	
	<div id="top_wrapper"></div>
	
	<!-- Begin template wrapper -->
	<div id="wrapper">
			
		<!-- Begin header -->
		<div id="header_wrapper">
		
		<div id="top_bg">
			<div id="top_bar">
			
			    <!-- Begin main nav -->
			    
			    <div id="menu_wrapper">
			    
			    	<div class="logo">
			    		<!-- Begin logo -->
			    	
			    		<?php
			    			//get custom logo
			    			$pp_logo = get_option('pp_logo');
			    			
			    			if(empty($pp_logo))
			    			{
			    				$pp_logo = get_stylesheet_directory_uri().'/images/logo.png';
			    			}
			    	
			    		?>
			    		
			    		<a id="custom_logo" href="<?php echo home_url(); ?>"><img src="<?php echo $pp_logo?>" alt=""/></a>
			    		
			    		<!-- End logo -->
			    		
			    	</div>
			    	
			    	<div id="menu_border_wrapper">
			    
			        	<?php 	
			        		//Get page nav
			        		wp_nav_menu( 
			        		    	array( 
			        		    		'menu_id'			=> 'main_menu',
			        		    		'menu_class'		=> 'nav',
			        		    		'theme_location' 	=> 'primary-menu',
			        		    		'container_class' 	=> 'menu-main-menu-container',
			        		    	) 
			        		); 
			        	?>
			        
			        </div>
			    
			    </div>
			    <!-- End main nav -->
			    
			</div>
		</div>
		
		<br class="clear"/>
		
		<?php
			$pp_advance_enable_switcher = get_option('pp_advance_enable_switcher');
		
		    if(!empty($pp_advance_enable_switcher))
		    {
			    $bg_patterns_arr = array(
						'1' => '<div style="float:left;width:55px;height:55px;margin:0 5px 5px 0;float:left;border:1px solid #ebebeb;" class="pp_checkbox_wrapper"></div>',
						'lightpaperfibers.png' => '<div style="float:left;width:55px;height:55px;margin:0 5px 5px 0;float:left;border:1px solid #ebebeb;background:url('.get_bloginfo( 'stylesheet_directory' ).'/images/patterns/lightpaperfibers.png) repeat;" class="pp_checkbox_wrapper"></div>',
						'furley_bg.png' => '<div style="float:left;width:55px;height:55px;margin:0 5px 5px 0;float:left;border:1px solid #ebebeb;background:url('.get_bloginfo( 'stylesheet_directory' ).'/images/patterns/furley_bg.png) repeat;" class="pp_checkbox_wrapper"></div>',
						'subtlenet2.png' => '<div style="float:left;width:55px;height:55px;margin:0 5px 5px 0;float:left;border:1px solid #ebebeb;background:url('.get_bloginfo( 'stylesheet_directory' ).'/images/patterns/subtlenet2.png) repeat;" class="pp_checkbox_wrapper"></div>',
						'crisp_paper_ruffles.png' => '<div style="float:left;width:55px;height:55px;margin:0 5px 5px 0;float:left;border:1px solid #ebebeb;background:url('.get_bloginfo( 'stylesheet_directory' ).'/images/patterns/crisp_paper_ruffles.png) repeat;" class="pp_checkbox_wrapper"></div>',
						'lil_fiber.png' => '<div style="float:left;width:55px;height:55px;margin:0 5px 5px 0;float:left;border:1px solid #ebebeb;background:url('.get_bloginfo( 'stylesheet_directory' ).'/images/patterns/lil_fiber.png) repeat;" class="pp_checkbox_wrapper"></div>',
						'tex2res3.png' => '<div style="float:left;width:55px;height:55px;margin:0 5px 5px 0;float:left;border:1px solid #ebebeb;background:url('.get_bloginfo( 'stylesheet_directory' ).'/images/patterns/tex2res3.png) repeat;" class="pp_checkbox_wrapper"></div>',
						'arches.png' => '<div style="float:left;width:55px;height:55px;margin:0 5px 5px 0;float:left;border:1px solid #ebebeb;background:url('.get_bloginfo( 'stylesheet_directory' ).'/images/patterns/arches.png) repeat;" class="pp_checkbox_wrapper"></div>',
						'hexellence.png' => '<div style="float:left;width:55px;height:55px;margin:0 5px 5px 0;float:left;border:1px solid #ebebeb;background:url('.get_bloginfo( 'stylesheet_directory' ).'/images/patterns/hexellence.png) repeat;" class="pp_checkbox_wrapper"></div>',
						'frenchstucco.png' => '<div style="float:left;width:55px;height:55px;margin:0 5px 5px 0;float:left;border:1px solid #ebebeb;background:url('.get_bloginfo( 'stylesheet_directory' ).'/images/patterns/frenchstucco.png) repeat;" class="pp_checkbox_wrapper"></div>',
						'gradient_squares.png' => '<div style="float:left;width:55px;height:55px;margin:0 5px 5px 0;float:left;border:1px solid #ebebeb;background:url('.get_bloginfo( 'stylesheet_directory' ).'/images/patterns/gradient_squares.png) repeat;" class="pp_checkbox_wrapper"></div>',
						'diagonal_striped_brick.png' => '<div style="float:left;width:55px;height:55px;margin:0 5px 5px 0;float:left;border:1px solid #ebebeb;background:url('.get_bloginfo( 'stylesheet_directory' ).'/images/patterns/diagonal_striped_brick.png) repeat;" class="pp_checkbox_wrapper"></div>',
						'foggy_birds.png' => '<div style="float:left;width:55px;height:55px;margin:0 5px 5px 0;float:left;border:1px solid #ebebeb;background:url('.get_bloginfo( 'stylesheet_directory' ).'/images/patterns/foggy_birds.png) repeat;" class="pp_checkbox_wrapper"></div>',
						'xv.png' => '<div style="float:left;width:55px;height:55px;margin:0 5px 5px 0;float:left;border:1px solid #ebebeb;background:url('.get_bloginfo( 'stylesheet_directory' ).'/images/patterns/xv.png) repeat;" class="pp_checkbox_wrapper"></div>',
						'square_bg.png' => '<div style="float:left;width:55px;height:55px;margin:0 5px 5px 0;float:left;border:1px solid #ebebeb;background:url('.get_bloginfo( 'stylesheet_directory' ).'/images/patterns/square_bg.png) repeat;" class="pp_checkbox_wrapper"></div>',
						'project_papper.png' => '<div style="float:left;width:55px;height:55px;margin:0 5px 5px 0;float:left;border:1px solid #ebebeb;background:url('.get_bloginfo( 'stylesheet_directory' ).'/images/patterns/project_papper.png) repeat;" class="pp_checkbox_wrapper"></div>',
						'brushed_alu.png' => '<div style="float:left;width:55px;height:55px;margin:0 5px 5px 0;float:left;border:1px solid #ebebeb;background:url('.get_bloginfo( 'stylesheet_directory' ).'/images/patterns/brushed_alu.png) repeat;" class="pp_checkbox_wrapper"></div>',
						'stacked_circles.png' => '<div style="float:left;width:55px;height:55px;margin:0 5px 5px 0;float:left;border:1px solid #ebebeb;background:url('.get_bloginfo( 'stylesheet_directory' ).'/images/patterns/stacked_circles.png) repeat;" class="pp_checkbox_wrapper"></div>',
						
					);
		    
		?>
		<form action="<?php echo get_stylesheet_directory_uri(); ?>/option.php" method="get" id="form_option" name="form_option">
		    <div id="option_wrapper">
		    <div class="inner">
		    	<strong>Background Patterns</strong><br/><br/>
		    	<?php
		    		foreach($bg_patterns_arr as $key => $bg_pattern)
		    		{
			    ?>
			    		
			    		<a href="<?php echo get_stylesheet_directory_uri(); ?>/switcher.php?pp_content_bg_img=<?php echo $key; ?>"><?php echo $bg_pattern; ?></a>
			    		
			    <?php
		    		}
		    	?>
		    </div>
		    <div id="option_btn">
		    	<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/color.png"/>
		    </div>
		    </div>
		</form>
		<?php
		    }
		?>