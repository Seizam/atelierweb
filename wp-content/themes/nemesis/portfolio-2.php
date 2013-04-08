<?php
/**
 * Template Name: Portfolio 2 Columns
 * The main template file for display portfolio page.
 *
 * @package WordPress
*/

if(!isset($hide_header) OR !$hide_header)
{
	get_header(); 
}

/**
*	Get Current page object
**/
$page = get_page($post->ID);

/**
*	Get current page id
**/

if(!isset($current_page_id) && isset($page->ID))
{
    $current_page_id = $page->ID;
}

//Get page description
$page_desc = get_post_meta($current_page_id, 'page_desc', true);

//If display on homepage then disable header
if(!isset($hide_header) OR !$hide_header)
{
?>				
		
</div>

<!-- Begin content -->
<div id="content_wrapper">

    <div class="page_caption">
    	<div class="caption_inner">
    		<div class="caption_header">
    			<h1 class="cufon"><span><?php the_title(); ?></span></h1>
    			<div class="caption_desc">
    				<?php echo stripcslashes($page_desc); ?>
    			</div>
    		</div>
    		<?php
				//Include social icons
				include (TEMPLATEPATH . "/templates/socials-icons.php");
			?>
    	</div>
    	<br class="clear"/>
    </div>
    <br class="clear"/>
    
    <div class="inner">
    
    	<!-- Begin main content -->
    	<div class="inner_wrapper">
    	
    	<div class="standard_wrapper">
    	
<?php
}
?>	

			<?php
			    if(!empty($page->post_content) && !is_home())
			    {
			    	echo pp_apply_content($page->post_content).'<br class="clear"/><br/>';
			    }
			?>
			
			<?php
			    $menu_sets_query = '';
			    $portfolio_items = -1;
			    $cur_post = 0;
			    
			    //Get all portfolio items for paging
			    $args = array(
			    	'numberposts' => $portfolio_items,
			    	'order' => 'ASC',
			    	'orderby' => 'menu_order',
			    	'post_type' => array('portfolios'),
			    );
			    if(!empty($term))
			    {
			    	$args['portfoliosets'].= $term;
			    }
			    
			    $all_photo_arr = get_posts($args);
			    $total = count($all_photo_arr);
			?>
			
			<?php
				//Get AJAX portfolio items
				$ajax_portfolios_arr = array();
				
				foreach($all_photo_arr as $key => $portfolio_item)
			    {
			    	$portfolio_type = get_post_meta($portfolio_item->ID, 'portfolio_type', true);
			    
			    	if($portfolio_type == 'AJAX Portfolio Content')
			    	{
			    		$ajax_portfolios_arr[] = $portfolio_item;
			    	}
			    }
			    
			    $count_ajax_items = count($ajax_portfolios_arr);
			    
			    foreach($ajax_portfolios_arr as $key => $portfolio_item)
			    {
			    	//Get portfolio gallery ID
			    	$portfolio_gallery_id = get_post_meta($portfolio_item->ID, 'portfolio_gallery_id', true);
			    	
			    	//Get next and prev ajax item
			    	if(isset($ajax_portfolios_arr[$key+1]))
			    	{
				    	$portfolio_next_id = $ajax_portfolios_arr[$key+1]->ID;
			    	}
			    	else
			    	{
				    	$portfolio_next_id = $ajax_portfolios_arr[0]->ID;
			    	}
			    	
			    	if(isset($ajax_portfolios_arr[$key-1]))
			    	{
				    	$portfolio_prev_id = $ajax_portfolios_arr[$key-1]->ID;
			    	}
			    	else
			    	{
				    	$portfolio_prev_id = $ajax_portfolios_arr[$count_ajax_items-1]->ID;
			    	}
			?>
			    
			    	<div id="ajax_<?php echo $portfolio_item->ID; ?>" class="ajax_portfolio_wrapper">
			    		<a class="ajax_close" data-rel="<?php echo $portfolio_item->ID; ?>">x</a>
			    		<a class="ajax_next ajax_portfolio_direction" data-rel="<?php echo $portfolio_next_id; ?>">→</a>
			    		<a class="ajax_prev ajax_portfolio_direction" data-rel="<?php echo $portfolio_prev_id; ?>">←</a>
						<?php
			    			//If display featured image
			    			if(empty($portfolio_gallery_id))
			    			{
			    		    	$image_thumb = '';
			    		    								
			    		    	if(has_post_thumbnail($portfolio_item->ID, 'slide'))
			    		    	{
			    		    	    $image_id = get_post_thumbnail_id($portfolio_item->ID);
			    		    	    $image_thumb = wp_get_attachment_image_src($image_id, 'slide', true);
			    		    	}
			    		?>
			    				<img src="<?php echo $image_thumb[0]; ?>" alt="" class="portfolio_single_img img_shadow"/>
			    		<?php
			    			}
			    			//If display image gallery
			    			else
			    			{
			    		?>
			    		<br class="clear"/>
			    		<div id="portfolio_slider_<?php echo $portfolio_item->ID; ?>" class="flexslider portfolio">
			    			<ul class="slides">
			    		<?php
			    				$args = array( 
			    	    			'post_type' => 'attachment', 
			    	    			'numberposts' => -1, 
			    	    			'post_status' => null, 
			    	    			'post_parent' => $portfolio_gallery_id,
			    	    			'order' => 'ASC',
			    	    			'orderby' => 'menu_order',
			    	    		); 								
			    	    		$portfolio_slider_arr = get_posts( $args );
			    	    		
			    	    		foreach($portfolio_slider_arr as $key => $photo_item)
			    	    		{
			    	    			$image_slide = wp_get_attachment_image_src($photo_item->ID, 'slide', true);
			    		?>
			    			
			    					<li>
			    						<img src="<?php echo $image_slide[0]; ?>" alt="<?php echo $photo_item->post_title; ?>"/>
			    					</li>
			    			
			    		<?php	
			    				}
			    		?>
			    			</ul>
			    		</div>
			    			
			    		<?php
			    			//Get portfolio slider settings
			    			$pp_portfolio_slider_timer = get_option('pp_portfolio_slider_timer');
			    			if(empty($pp_portfolio_slider_timer))
			    			{
			    				$pp_portfolio_slider_timer = 5;
			    			}
			    			
			    			$pp_portfolio_slider_autoplay = get_option('pp_portfolio_slider_autoplay');
			    		?>
			    		<script type="text/javascript"> 
			    		$j(window).load(function() {
			    		    $j('#portfolio_slider_<?php echo $portfolio_item->ID; ?>').flexslider({
			    		    	animation: "fade",
			    		    	<?php
			    				if(empty($pp_portfolio_slider_autoplay))
			    				{
			    				?>
			    				slideshow: false,
			    				<?php
			    				}
			    				?>
			    				controlNav: true,
			    				slideshowSpeed: <?php echo $pp_portfolio_slider_timer*1000; ?>
			    		    });
			    		});
			    		</script>
			    		
			    		<?php
			    			}
			    		?>	
			    			<div class="ajax_content">
			    				<h4 class="center"><?php echo $portfolio_item->post_title; ?></h4><br/><hr/><br/>
			    				<?php echo pp_apply_content($portfolio_item->post_content); ?>
			    			</div>
					</div>
			    
			<?php
			    }
			?>
			
			<!-- Begin portfolio content -->
			
			<?php
			    if(isset($all_photo_arr) && !empty($all_photo_arr))
			    {
			    	
			?>
				<div class="portfolio-content section content clearfix"> 
			    	<?php

			    	    foreach($all_photo_arr as $key => $portfolio_item)
			    	    {
			    	    	$cur_post++;
			    	    	$image_url = '';
			    	
			    	    	if(has_post_thumbnail($portfolio_item->ID, 'portfolio2'))
			    	    	{
			    	    		$image_id = get_post_thumbnail_id($portfolio_item->ID);
			    	    		$image_url = wp_get_attachment_image_src($image_id, 'portfolio2', true);
			    	    		$full_image_url = wp_get_attachment_image_src($image_id, 'full', true);
			    	    	}
			    	    	
			    	    	$portfolio_link_url = get_post_meta($portfolio_item->ID, 'portfolio_link_url', true);
			    	    	
			    	    	if(empty($portfolio_link_url))
			    	    	{
			    	    		$permalink_url = get_permalink($portfolio_item->ID);
			    	    	}
			    	    	else
			    	    	{
			    	    		$permalink_url = $portfolio_link_url;
			    	    	}
			    	    	
			    	    	$portfolio_item_class = 'one_half portfolio';
			    	    	$pp_portfolio_image_height = 300;
			    	?>
			    	    <div class="<?php echo $portfolio_item_class; ?>">
			    	    <?php
			    	    	$portfolio_type = get_post_meta($portfolio_item->ID, 'portfolio_type', true);
			    	    	$portfolio_video_id = get_post_meta($portfolio_item->ID, 'portfolio_video_id', true);
			    	    	switch($portfolio_type)
			    	    	{
			    	    	case 'External Link':
			    	    	default:
			    	    ?>
			    	    <div class="portfolio460_shadow">
			    	    	<a href="<?php echo $permalink_url; ?>">
			    	    		<img src="<?php echo $image_url[0]?>" alt="" class="portfolio_img"/>
			    	    		<div class="portfolio460_overlay">
				    	    		<div class="portfolio460_overlay">
					    	    		<div class="portfolio460_overlay_inner">
						    	            <h3><?php echo $portfolio_item->post_title; ?></h3>
						    	            <hr/>
						    	            <?php echo pp_substr($portfolio_item->post_excerpt, 600); ?>
						    	            <div class="portfolio_type_wrapper">
						    	            	<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_link.png" alt="" class=""/>
						    	            </div>
					    	        	</div>
				    	    		</div>
			    	    		</div>
			    	    	</a>
			    	    </div>
			    	    
			    	    <?php
			    	    	break;
			    	    	//end external link
			    	    	
			    	    	case 'Portfolio Content':
			    	    	default:
			    	    ?>
			    	    <div class="portfolio460_shadow">
			    	    	<a href="<?php echo get_permalink($portfolio_item->ID); ?>">
			    	    		<img src="<?php echo $image_url[0]?>" alt="" class="portfolio_img"/>
			    	    			<div class="portfolio460_overlay">
				    	    			<div class="portfolio460_overlay_inner">
						    	            <h3><?php echo $portfolio_item->post_title; ?></h3>
						    	            <hr/>
						    	            <?php echo pp_substr($portfolio_item->post_excerpt, 600); ?>
						    	            <div class="portfolio_type_wrapper">
						    	            	<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_link.png" alt="" class=""/>
						    	            </div>
					    	        	</div>
			    	    			</div>
			    	    	</a>
			    	    </div>
			    	    
			    	    <?php
			    	    	break;
			    	    	//end Portfolio Content
			    	    	
			    	    	case 'AJAX Portfolio Content':
	        				
	        				//Get portfolio gallery ID
	        				$portfolio_gallery_id = get_post_meta($portfolio_item->ID, 'portfolio_gallery_id', true);
	        			?>
	        			<div class="portfolio460_shadow">
	        				<a href="javascript:;" data-rel="<?php echo $portfolio_item->ID; ?>" class="ajax_portfolio_link">
	        					<img src="<?php echo $image_url[0]?>" alt="" class="portfolio_img"/>
	        					<div class="portfolio460_overlay">
		        				    <div class="portfolio460_overlay_inner">
					    	        	<h3><?php echo $portfolio_item->post_title; ?></h3>
					    	        	<hr/>
					    	        	<?php echo pp_substr($portfolio_item->post_excerpt, 600); ?>
					    	        	<div class="portfolio_type_wrapper">
					    	        		<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_link.png" alt="" class=""/>
					    	        	</div>
				    	            </div>
	        					</div>
	        				</a>
	        			</div>
	        			
	        			<?php
	        				break;
	        				//end AJAX Portfolio Content
			    	    	
			    	    	case 'Image':
			    	    ?>
			    	    <div class="portfolio460_shadow">
			    	    	<a href="<?php echo $full_image_url[0]; ?>" class="img_frame">
			    	    		<img src="<?php echo $image_url[0]?>" alt="" class="portfolio_img"/>
			    	    		<div class="portfolio460_overlay">
				    	    		<div class="portfolio460_overlay_inner">
						    	        <h3><?php echo $portfolio_item->post_title; ?></h3>
						    	        <hr/>
						    	        <?php echo pp_substr($portfolio_item->post_excerpt, 600); ?>
						    	        <div class="portfolio_type_wrapper">
						    	        	<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_image.png" alt="" class=""/>
						    	        </div>
					    	        </div>
			    	    		</div>
			    	    	</a>
			    	    </div>
			    	    
			    	    <?php
			    	    	break;
			    	    	//end image
			    	    	
			    	    	case 'Youtube Video':
			    	    ?>
			    	    <div class="portfolio460_shadow">
			    	    	<a href="#video_<?php echo $portfolio_video_id; ?>" class="lightbox_youtube">
			    	    		<img src="<?php echo $image_url[0]?>" alt="" class="portfolio_img"/>
			    	    		<div class="portfolio460_overlay">
				    	    		<div class="portfolio460_overlay_inner">
						    	        <h3><?php echo $portfolio_item->post_title; ?></h3>
						    	        <hr/>
						    	        <?php echo pp_substr($portfolio_item->post_excerpt, 600); ?>
						    	        <div class="portfolio_type_wrapper">
						    	        	<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_video.png" alt="" class=""/>
						    	        </div>
					    	        </div>
			    	    		</div>
			    	    	</a>
			    	    </div>
			    	    				
			    	    <div style="display:none;">
			    	        <div id="video_<?php echo $portfolio_video_id; ?>" style="width:900px;height:488px">
			    	            
			    	            <iframe title="YouTube video player" width="900" height="488" src="http://www.youtube.com/embed/<?php echo $portfolio_video_id; ?>?theme=dark&rel=0&wmode=transparent" frameborder="0" allowfullscreen></iframe>
			    	            
			    	        </div>	
			    	    </div>
			    	    			
			    	    <?php
			    	        break;
			    	        //end youtube
			    	    
			    	    case 'Vimeo Video':
			    	    ?>
			    	    <div class="portfolio460_shadow">
			    	        <a href="#video_<?php echo $portfolio_video_id; ?>" class="lightbox_vimeo">
			    	        	<img src="<?php echo $image_url[0]?>" alt="" class="portfolio_img"/>
			    	        	<div class="portfolio460_overlay">
				    	        	<div class="portfolio460_overlay_inner">
						    	        <h3><?php echo $portfolio_item->post_title; ?></h3>
						    	        <hr/>
						    	        <?php echo pp_substr($portfolio_item->post_excerpt, 600); ?>
						    	        <div class="portfolio_type_wrapper">
						    	        	<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_video.png" alt="" class=""/>
						    	        </div>
					    	        </div>
			    	        	</div>
			    	        </a>
			    	    </div>
			    	    				
			    	    <div style="display:none;">
			    	        <div id="video_<?php echo $portfolio_video_id; ?>" style="width:900px;height:506px">
			    	        
			    	            <iframe src="http://player.vimeo.com/video/<?php echo $portfolio_video_id; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="900" height="506" frameborder="0"></iframe>
			    	            
			    	        </div>	
			    	    </div>
			    	    			
			    	    <?php
			    	        break;
			    	        //end vimeo
			    	        
			    	        case 'Self-Hosted Video':
			    	        
			    	        //Get video URL
							$portfolio_mp4_url = get_post_meta($portfolio_item->ID, 'portfolio_mp4_url', true);
							$preview_image = wp_get_attachment_image_src($image_id, 'large', true);
			    	    ?>
			    	    <div class="portfolio460_shadow">
			    	        <a href="#video_self_<?php echo $key; ?>" class="lightbox_vimeo">
			    	        	<img src="<?php echo $image_url[0]?>" alt="" class="portfolio_img"/>
			    	        	<div class="portfolio460_overlay">
				    	        	<div class="portfolio460_overlay_inner">
						    	        <h3><?php echo $portfolio_item->post_title; ?></h3>
						    	        <hr/>
						    	        <?php echo pp_substr($portfolio_item->post_excerpt, 600); ?>
						    	        <div class="portfolio_type_wrapper">
						    	        	<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon_video.png" alt="" class=""/>
						    	        </div>
					    	        </div>
			    	        	</div>
			    	        </a>
			    	    </div>
			    	    				
			    	    <div style="display:none;">
			    		    <div id="video_self_<?php echo $key; ?>" style="width:900px;height:488px">
			    		    
			    		        <div id="self_hosted_vid_<?php echo $key; ?>">JW Player goes here</div>
						
								<script type="text/javascript">
									jwplayer("self_hosted_vid_<?php echo $key; ?>").setup({
										flashplayer: "<?php echo get_stylesheet_directory_uri(); ?>/js/player.swf",
										file: "<?php echo $portfolio_mp4_url; ?>",
										image: "<?php echo $preview_image[0]; ?>",
										width: 900,
										height: 488,
									});
								</script>
			    		        
			    		    </div>	
			    		</div>
			    	    			
			    	    <?php
			    	        break;
			    	        //end self-hosted video
			    	    ?>
			    	    
			    	    <?php
			    	        }
			    	    ?>
			    	        
			    	    </div>
			    	
			    	<?php
			    	    }
			    	    //End foreach loop
			    	    
			    	?>
			    			    
			    <?php
			    	
			    }
			    //End if have portfolio items
			    ?>
			    <br class="clear"/>
			</div>
				
<?php
if(!isset($hide_header) OR !$hide_header)
{
?>				
		</div>
		<!-- End main content -->
		<br class="clear"/><br/><br/>
				
	</div>
		
</div>
<!-- End content -->
				

<?php get_footer(); ?>
<?php
}
?>