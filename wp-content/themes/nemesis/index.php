<?php
/**
 * The main template file.
 *
 * @package WordPress
 */

session_start();
				
get_header(); 

?>
		
</div>
<!-- End header -->

<?php
//Get slider header content
$pp_slider_header = get_option('pp_slider_header');
$pp_slider_content = get_option('pp_slider_content');

if(!empty($pp_slider_header))
{
?>
	
	<div id="slider_header">
	
	<?php
	//Display slider header title
	if(!empty($pp_slider_header))
	{
	?>
	    <h1><?php echo stripslashes($pp_slider_header); ?></h1>
	<?php
	}
	?>
	
	<?php
	//Display slider header content
	if(!empty($pp_slider_content))
	{
	    echo '<div id="slider_desc">'.stripslashes(html_entity_decode($pp_slider_content)).'</div>';
	}
	?>
	</div>
	
	<?php
		//Include social icons
		include (TEMPLATEPATH . "/templates/socials-icons.php");
	?>
	
	<br class="clear"/>

<?php
}

//Check if enable slider
if(isset($_SESSION['pp_slider_display']))
{
	$pp_slider_display = $_SESSION['pp_slider_display'];
}
else
{
	$pp_slider_display = get_option('pp_slider_display');
}

//Check if slides is empty
$slider_arr = get_posts('numberposts=1&order=ASC&orderby=menu_order&post_type=slides');

if(!empty($pp_slider_display) && !empty($slider_arr))
{
?>
	
	<div id="slider_wrapper">
	
	    <?php
	    	//Include slider template
	    	include (TEMPLATEPATH . "/templates/template-slider-flexslider.php");
	    ?>
	    
	</div>

<?php
} //end if enable slider
?>

<br class="clear"/>

<!-- Begin content -->
<div id="content_wrapper">

<div class="inner">

    <!-- Begin main content -->
    <div class="inner_wrapper">

    <div class="standard_wrapper">
    	
    	<?php 
    			if(isset($_SESSION['pp_home_style']))
    			{
    				switch($_SESSION['pp_home_style'])
    				{
    					case 1:
    						$pp_homepage_content = array(1923);
    						break;
    					case 2:
    						$pp_homepage_content = array(1797);
    						break;
    					case 3:
    						$pp_homepage_content = array(1668);
    						break;
    					case 4:
    						$pp_homepage_content = array(2575);
    						break;
    					case 5:
    						$pp_homepage_content = array(2581);
    						break;
    					case 6:
    						$pp_homepage_content = array(2586);
    						break;
    					default:
    						$pp_homepage_content = array(1923);
    						break;
    				}
    			}
    			else
    			{
    				$pp_homepage_content = unserialize(get_option('pp_homepage_content_sort_data'));
    			}
    			
    			global $wp_query;
    			
    			$has_homepage_content = get_option('pp_homepage_content');

    			if(is_array($pp_homepage_content) && !empty($pp_homepage_content) && !empty($has_homepage_content))
    			{
    				$count_content = count($pp_homepage_content);
    			
    				foreach($pp_homepage_content as $key => $pp_homepage)
    				{
    					if(!empty($pp_homepage))
    					{
	    					$template_name = get_post_meta( $pp_homepage, '_wp_page_template', true );
	
	    					if(empty($template_name) OR $template_name == 'default')
	    					{
	    						$obj_home = get_page($pp_homepage);
	    					
	    						//Check if use WPML plugin and get current language
	    						if(defined('ICL_LANGUAGE_CODE'))
	    						{
	    							//Get page ID of translated page
	    							$pp_translated_home = icl_object_id( $obj_home->ID, 'page', false, ICL_LANGUAGE_CODE );
	    							$obj_translated_home = get_page($pp_translated_home);
	    							$pp_home_content = $obj_translated_home->post_content;
	    							
	    							//Assign current page ID
	    							$current_page_id = $pp_translated_home;
	    						}
	    						else
	    						{
	    							//Get Homepage content
	    					    	$pp_home_content = $obj_home->post_content;
	    					    	
	    					    	//Assign current page ID
	    					    	$current_page_id = $pp_homepage;
	    						}
	    					    
	    					    $page_style = get_post_meta($pp_homepage, 'page_style', true);
	    						$page_sidebar = get_post_meta($pp_homepage, 'page_sidebar', true);
	    						
	    						if(empty($page_sidebar))
	    						{
	    							$page_sidebar = 'Page Sidebar';
	    						}
	    						
	    						if(empty($page_style))
	    						{
	    							$page_style = 'Fullwidth';
	    						}
	    						
	    						$add_sidebar = FALSE;
	    						$sidebar_class = '';
	    						
	    						if($page_style == 'Right Sidebar')
	    						{
	    							$add_sidebar = TRUE;
	    							$page_class = 'sidebar_content';
	    						}
	    						elseif($page_style == 'Left Sidebar')
	    						{
	    							$add_sidebar = TRUE;
	    							$page_class = 'sidebar_content';
	    							$sidebar_class = 'left_sidebar';
	    						}
	    						else
	    						{
	    							$page_class = 'inner_wrapper';
	    						}
	    					    
	    		?>
	    		
	    	<?php
	    		if($add_sidebar && $page_style == 'Left Sidebar')
	    		{
	    	?>
	    		<div class="sidebar_wrapper <?php echo $sidebar_class; ?>">
	    		
	    			<div class="sidebar_top <?php echo $sidebar_class; ?>"></div>
	    		
	    			<div class="sidebar <?php echo $sidebar_class; ?> <?php echo $sidebar_home; ?>">
	    			
	    				<div class="content">
	    			
	    					<ul class="sidebar_widget">
	    					<?php dynamic_sidebar($page_sidebar); ?>
	    					</ul>
	    				
	    				</div>
	    		
	    			</div>
	    			<br class="clear"/>
	    	
	    			<div class="sidebar_bottom <?php echo $sidebar_class; ?>"></div>
	    		</div>
	    	<?php
	    		}
	    	?>
	    	
	    	<?php if($add_sidebar) { ?>
	    		<div class="sidebar_content <?php echo $sidebar_class; ?>">
	    	<?php } ?>
	    	
	    	<?php 
	    		echo pp_apply_content($pp_home_content); 
	    	?>
	    	<br class="clear"/>
	    	
	    	<?php if($add_sidebar) { ?>
	    		</div>
	    	<?php } ?>
	    	
	    	<?php
	    		if($add_sidebar && $page_style == 'Right Sidebar')
	    		{
	    	?>
	    	
	    		<div class="sidebar_wrapper <?php echo $sidebar_class; ?>">
	    		
	    			<div class="sidebar_top <?php echo $sidebar_class; ?>"></div>
	    		
	    			<div class="sidebar <?php echo $sidebar_class; ?> <?php echo $sidebar_home; ?>">
	    			
	    				<div class="content">
	    			
	    					<ul class="sidebar_widget">
	    					<?php dynamic_sidebar($page_sidebar); ?>
	    					</ul>
	    				
	    				</div>
	    		
	    			</div>
	    			<br class="clear"/>
	    	
	    			<div class="sidebar_bottom <?php echo $sidebar_class; ?>"></div>
	    		</div>
	    	<?php
	    		}
	    	?>
	    		
	    		<?php
	    					}
	    					else
	    					{
	    					    $hide_header = TRUE;
	
	    					    if($key > 0)
	    					    {
	    					    	echo '<br class="clear"/>';
	    					    }
	    					    
	    					    if(file_exists(TEMPLATEPATH.'/'.$template_name))
	    					    {
	    					    	include(TEMPLATEPATH.'/'.$template_name);
	    					    }
	    					}
    					
    					} //end if page is empty
    					
    				}
    			}
    		?>
    </div>
    

</div>

</div>

<?php get_footer(); ?>