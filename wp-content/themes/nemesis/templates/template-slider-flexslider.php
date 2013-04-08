		<?php
				//Get slider height setting
				$pp_slider_height = get_option('pp_slider_height');
				if(empty($pp_slider_height))
				{
					$pp_slider_height = 400;
				}
		
				//Get slider items setting
				$pp_slider_items = get_option('pp_slider_items');
				if(empty($pp_slider_items))
				{
					$pp_slider_items = 5;
				}
				
				//Get slider timer setting
				$pp_slider_timer = get_option('pp_slider_timer');
				if(empty($pp_slider_timer))
				{
					$pp_slider_timer = 5000;
				}
				else
				{
					$pp_slider_timer = $pp_slider_timer*1000;
				}
			
				$slider_arr = get_posts('numberposts='.$pp_slider_items.'&order=ASC&orderby=menu_order&post_type=slides');

				if(!empty($slider_arr))
				{
		?>
		
				<div id="home_slider" class="flexslider">
				<ul class="slides">
					<?php
						$slide_count = count($slider_arr);
						
					    foreach($slider_arr as $key => $gallery_item)
					    {
					    	//Get slide content type
						    $slide_type = get_post_meta($gallery_item->ID, 'slide_type', true);
						    
						    switch($slide_type)
						    {
						    	case 'image':
						    	default:
						    	
					            	$image_url = '';
					            
					            	if(has_post_thumbnail($gallery_item->ID, 'slide'))
					            	{
					            		$image_id = get_post_thumbnail_id($gallery_item->ID);
					            		$image_url = wp_get_attachment_image_src($image_id, 'slide', true);
					            	}
					            					
					            	$hyperlink_url = get_post_meta($gallery_item->ID, 'gallery_link_url', true);
					            	$slide_display_content = get_post_meta($gallery_item->ID, 'slide_display_content', true);
					            	$slide_img_alt = get_post_meta($gallery_item->ID, 'slide_img_alt', true);
					        ?>
					        <li>
					            <a href="<?php echo $hyperlink_url;?>">
					            
					            	<img src="<?php echo $image_url[0]; ?>" alt="<?php echo $slide_img_alt; ?>"/>
					                
					                <?php
					                	switch($slide_display_content)
					                	{
					                		case 'Display Left':
					                ?>
					                
					                	<div class="slide_content_left">
					                		<h5><?php echo $gallery_item->post_title; ?></h5>
					                	</div>
					                	<div class="slide_desc_left delay">
					                		<?php echo $gallery_item->post_content; ?>
					                	</div>
					                
					                <?php
					                		break;
					                		
					                		case 'Display Right':
					                ?>
					                
					                	<div class="slide_content_right">
					                		<h5><?php echo $gallery_item->post_title; ?></h5>
					                	</div>
					                	<div class="slide_desc_right">
					                		<?php echo $gallery_item->post_content; ?>
					                	</div>
					                
					                <?php
					                		break;
					                ?>
					                
					                <?php
					                	}
					                ?>
					            </a>
					        </li>
					        <?php
					    	    break;
					    	    //end image
					    	    
					    	    case 'Youtube Video':
					    	    	
					    	    $slide_video_id = get_post_meta($gallery_item->ID, 'slide_video_id', true);
					    	?>
					    	<li class="video">
					    		<div class="slide_video_left">
					                <h5><?php echo $gallery_item->post_title; ?></h5><br/>
					                <?php echo $gallery_item->post_content; ?>
					            </div>
					    		<div class="slide_video_right">
					    	    	<iframe title="YouTube video player" width="533" height="300" src="http://www.youtube.com/embed/<?php echo $slide_video_id; ?>?theme=dark&rel=0&wmode=transparent" frameborder="0" allowfullscreen></iframe>
					    		</div>
					    	</li>
					    	<?php
					    	    break;
					    	    //end youtube video
					    	    
					    	    case 'Vimeo Video':
					    	    	
					    	    $slide_video_id = get_post_meta($gallery_item->ID, 'slide_video_id', true);
					    	?>
					    	<li class="video">
					    		<div class="slide_video_left">
					                <h5><?php echo $gallery_item->post_title; ?></h5><br/>
					                <?php echo $gallery_item->post_content; ?>
					            </div>
					    		<div class="slide_video_right">
					    	    	<iframe src="http://player.vimeo.com/video/<?php echo $slide_video_id; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="533" height="300" frameborder="0"></iframe>
					    		</div>
					    	</li>
					    	<?php
					    	    break;
					    	    //end vimeo video
					    	    
					    	    case 'Self-Hosted Video':
					    	    	
					    	    $slide_mp4_url = get_post_meta($gallery_item->ID, 'slide_mp4_url', true);
					    	    $image_url = '';
					    	    
					    	    if(has_post_thumbnail($gallery_item->ID, 'slide'))
					    	    {
					    	    	$image_id = get_post_thumbnail_id($gallery_item->ID);
					    	    	$image_url = wp_get_attachment_image_src($image_id, 'slide', true);
					    	    }
					    	?>
					    	<li class="video">
					    		<div class="slide_video_left">
					                <h5><?php echo $gallery_item->post_title; ?></h5><br/>
					                <?php echo $gallery_item->post_content; ?>
					            </div>
					    		<div class="slide_video_right">
					    	    	<div class="video_frame" id="video_self_<?php echo $key; ?>" style="width:533px;height:300px">
			    		    
							        <div id="slide_self_hosted_vid_<?php echo $key; ?>">JW Player goes here</div>
							    
							        <script type="text/javascript">
							        	jwplayer("slide_self_hosted_vid_<?php echo $key; ?>").setup({
							        		flashplayer: "<?php echo get_stylesheet_directory_uri(); ?>/js/player.swf",
							        		file: "<?php echo $slide_mp4_url; ?>",
							        		image: "<?php echo $image_url[0]; ?>",
							        		width: 533,
							        		height: 300,
							        	});
							        </script>
							        
							    </div>
					    		</div>
					    	</li>
					    	<?php
					    	    break;
					    	    //end self-hosted video
					    	?>
					  <?php
						  } //end foreach
					  ?>
				<?php
					} //end content type switch
				?>	 
				</ul>
				</div>
		
		<?php 
				}
		?>
		
		<?php
			$pp_slider_autoplay = get_option('pp_slider_autoplay');
			
			//Get sliding direction
			$pp_slider_direction = get_option('pp_slider_direction');
			if(empty($pp_slider_direction))
			{
				$pp_slider_direction = 'horizontal';
			}
		?>
		
		<script type="text/javascript"> 
		$j(window).load(function() {
			$j('#slider_wrapper .flexslider').flexslider({
				animation: "fade",
				directionNav: true,
				controlNav: false,
				pauseOnHover: true,
				slideshowSpeed: <?php echo $pp_slider_timer; ?>,
				<?php
				if(empty($pp_slider_autoplay))
				{
				?>
				slideshow: false,
				<?php
				}
				?>
				start: function(slider) {
				
		      	}
			});
			
			$j('#home_slider').hover(function(){
				$j(this).find('.flex-direction-nav li a').animate({ opacity: 1 }, 200);
			},
			function()
			{
				$j(this).find('.flex-direction-nav li a').animate({ opacity: 0 }, 200);
			});
		});
		</script> 