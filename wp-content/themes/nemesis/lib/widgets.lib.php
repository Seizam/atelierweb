<?php

/**
*	Begin Recent Posts Custom Widgets
**/

class Custom_Recent_Posts extends WP_Widget {
	function Custom_Recent_Posts() {
		$widget_ops = array('classname' => 'Custom_Recent_Posts', 'description' => 'The recent posts with thumbnails' );
		$this->WP_Widget('Custom_Recent_Posts', 'Custom Recent Posts', $widget_ops);
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$items = empty($instance['items']) ? ' ' : apply_filters('widget_title', $instance['items']);
		
		if(!is_numeric($items))
		{
			$items = 3;
		}
		
		if(!empty($items))
		{
			pp_posts('recent', $items, TRUE);
		}
		
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['items'] = strip_tags($new_instance['items']);

		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'items' => '') );
		$items = strip_tags($instance['items']);

?>
			<p><label for="<?php echo $this->get_field_id('items'); ?>">Items (default 3): <input class="widefat" id="<?php echo $this->get_field_id('items'); ?>" name="<?php echo $this->get_field_name('items'); ?>" type="text" value="<?php echo esc_attr($items); ?>" /></label></p>
<?php
	}
}

register_widget('Custom_Recent_Posts');

/**
*	End Recent Posts Custom Widgets
**/


/**
*	Begin Category Posts Custom Widgets
**/

class Custom_Cat_Posts extends WP_Widget {
	function Custom_Cat_Posts() {
		$widget_ops = array('classname' => 'Custom_Cat_Posts', 'description' => 'Display category\'s post' );
		$this->WP_Widget('Custom_Cat_Posts', 'Custom Category Posts', $widget_ops);
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$cat_id = empty($instance['cat_id']) ? 0 : $instance['cat_id'];
		$items = empty($instance['items']) ? 0 : $instance['items'];
		
		if(empty($items))
		{
			$items = 5;
		}
		
		if(!empty($cat_id))
		{
			pp_cat_posts($cat_id, $items);
		}

		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['cat_id'] = strip_tags($new_instance['cat_id']);
		$instance['items'] = strip_tags($new_instance['items']);

		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'cat_id' => '', 'items' => '') );
		$cat_id = strip_tags($instance['cat_id']);
		$items = strip_tags($instance['items']);
		
		$categories = get_categories('hide_empty=0&orderby=name');
		$wp_cats = array(
			0		=> "Choose a category"
		);
		foreach ($categories as $category_list ) {
			$wp_cats[$category_list->cat_ID] = $category_list->cat_name;
		}

?>
			
			<p><label for="<?php echo $this->get_field_id('cat_id'); ?>">Category: 
				<select  id="<?php echo $this->get_field_id('cat_id'); ?>" name="<?php echo $this->get_field_name('cat_id'); ?>">
				<?php
					foreach($wp_cats as $wp_cat_id => $wp_cat)
					{
				?>
						<option value="<?php echo $wp_cat_id; ?>" <?php if(esc_attr($cat_id) == $wp_cat_id) { echo 'selected="selected"'; } ?>><?php echo $wp_cat; ?></option>
				<?php
					}
				?>
				</select>
			</label></p>
			
			<p><label for="<?php echo $this->get_field_id('items'); ?>">Items (default 5): <input class="widefat" id="<?php echo $this->get_field_id('items'); ?>" name="<?php echo $this->get_field_name('items'); ?>" type="text" value="<?php echo esc_attr($items); ?>" /></label></p>
<?php
	}
}

register_widget('Custom_Cat_Posts');

/**
*	End Category Posts Custom Widgets
**/


/**
*	Begin Popular Posts Custom Widgets
**/

class Custom_Popular_Posts extends WP_Widget {
	function Custom_Popular_Posts() {
		$widget_ops = array('classname' => 'Custom_Popular_Posts', 'description' => 'The popular posts with thumbnails' );
		$this->WP_Widget('Custom_Popular_Posts', 'Custom Popular Posts', $widget_ops);
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$items = empty($instance['items']) ? ' ' : apply_filters('widget_title', $instance['items']);
		
		if(!is_numeric($items))
		{
			$items = 3;
		}
		
		if(!empty($items))
		{
			pp_posts('popular', $items, TRUE);
		}
		
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['items'] = strip_tags($new_instance['items']);

		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'items' => '') );
		$items = strip_tags($instance['items']);

?>
			<p><label for="<?php echo $this->get_field_id('items'); ?>">Items (default 3): <input class="widefat" id="<?php echo $this->get_field_id('items'); ?>" name="<?php echo $this->get_field_name('items'); ?>" type="text" value="<?php echo esc_attr($items); ?>" /></label></p>
<?php
	}
}

register_widget('Custom_Popular_Posts');

/**
*	End Popular Posts Custom Widgets
**/

/**
*	Begin Portfolios Custom Widgets
**/

class Custom_Portfolios extends WP_Widget {
	function Custom_Portfolios() {
		$widget_ops = array('classname' => 'Custom_Portfolios', 'description' => 'Portfolio items widget' );
		$this->WP_Widget('Custom_Portfolios', 'Custom Recent Portfolios', $widget_ops);
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$items = empty($instance['items']) ? ' ' : apply_filters('widget_title', $instance['items']);
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		$pause_time = empty($instance['pause_time']) ? ' ' : apply_filters('widget_title', $instance['pause_time']);
		$pause_time = $pause_time * 1000;
		
		if(!is_numeric($items))
		{
			$items = 3;
		}
		
		if(!empty($items))
		{
			$custom_id = time().rand();
			$pp_portfolio_sort = get_option('pp_portfolio_sort'); 
			if(empty($pp_portfolio_sort))
			{
				$pp_portfolio_sort = 'ASC';
			}
				
			$portfolio_items = get_posts('numberposts='.$items.'&order='.$pp_portfolio_sort.'&orderby=date&post_type=portfolios');
			
			if(isset($portfolio_items) && !empty($portfolio_items))
			{
				echo '<h2 class="widgettitle">'.$title.'</h2>';
				echo '<div id="porftolio_widget_wrapper_'.$custom_id.'" class="porftolio_widget_wrapper">';
				echo '<ul class="slides">';
			
				foreach($portfolio_items as $key => $portfolio_item)
				{
					echo '<li>';
					$image_url = '';
								
					if(has_post_thumbnail($portfolio_item->ID, 'portfolio4'))
					{
					    $image_id = get_post_thumbnail_id($portfolio_item->ID);
					    $image_url = wp_get_attachment_image_src($image_id, 'portfolio4', true);
					    $large_image_url = wp_get_attachment_image_src($image_id, 'full', true);
					}
					
					$permalink_url = get_permalink($portfolio_item->ID);
					$portfolio_type = get_post_meta($portfolio_item->ID, 'portfolio_type', true);
					$portfolio_video_id = get_post_meta($portfolio_item->ID, 'portfolio_video_id', true);
					$portfolio_link_url = get_post_meta($portfolio_item->ID, 'portfolio_link_url', true);
																
					if(empty($portfolio_link_url))
					{
					    $permalink_url = get_permalink($portfolio_item->ID);
					}
					else
					{
					    $permalink_url = $portfolio_link_url;
					}
										
					switch($portfolio_type)
					{
						case 'External Link':
						default:
							echo '<div class="portfolio200_shadow">';
							echo '<a href="'.$permalink_url.'"><img src="'.$image_url[0].'" alt="" class="portfolio_img"/><div class="portfolio200_overlay"><img src="'.get_stylesheet_directory_uri().'/images/icon_link.png" alt="" class=""/></div></a>';
							echo '</div>';
						break;
						// end external link
						
						case 'Portfolio Content':
						default:
							echo '<div class="portfolio200_shadow">';
							echo '<a href="'.get_permalink($portfolio_item->ID).'"><img src="'.$image_url[0].'" alt="" class="portfolio_img"/><div class="portfolio200_overlay"><img src="'.get_stylesheet_directory_uri().'/images/icon_link.png" alt="" class=""/></div></a>';
							echo '</div>';
						break;
						// end portfolio content
						
						case 'Image':
							echo '<div class="portfolio200_shadow">';
							echo '<a href="'.$large_image_url[0].'" class="img_frame"><img src="'.$image_url[0].'" alt="" class="portfolio_img"/><div class="portfolio200_overlay"><img src="'.get_stylesheet_directory_uri().'/images/icon_image.png" alt="" class=""/></div></a>';
							echo '</div>';
						break;
						// end image
						
						case 'Youtube Video':
							echo '<div class="portfolio200_shadow">';
							echo '<a href="#video_'.$portfolio_video_id.'" class="lightbox_youtube"><img src="'.$image_url[0].'" alt="" class="portfolio_img"/><div class="portfolio200_overlay"><img src="'.get_stylesheet_directory_uri().'/images/icon_video.png" alt="" class=""/></div></a>';
							echo '</div>';
							
							echo '<div style="display:none;">
										    <div id="video_'.$portfolio_video_id.'" style="width:900px;height:488px"><iframe width="900" height="488" src="http://www.youtube.com/embed/'.$portfolio_video_id.'?theme=dark&amp;rel=0&amp;wmode=opaque" frameborder="0"></iframe></div>	
										</div>';
						break;
						// end youtube video
						
						case 'Vimeo Video':
							echo '<div class="portfolio200_shadow">';
							echo '<a href="#video_'.$portfolio_video_id.'" class="lightbox_vimeo"><img src="'.$image_url[0].'" alt="" class="portfolio_img"/><div class="portfolio200_overlay"><img src="'.get_stylesheet_directory_uri().'/images/icon_video.png" alt="" class=""/></div></a>';
							echo '</div>';
							
							echo '<div style="display:none;">
										    <div id="video_'.$portfolio_video_id.'" style="width:900px;height:506px"><iframe src="http://player.vimeo.com/video/'.$portfolio_video_id.'?title=0&amp;byline=0&amp;portrait=0" width="900" height="506" frameborder="0"></iframe></div>	
										</div>';
						break;
						// end vimeo video
						
						case 'Self-Hosted Video':
					    	        
					    	//Get video URL
					    	$portfolio_mp4_url = get_post_meta($portfolio_item->ID, 'portfolio_mp4_url', true);
							$preview_image = wp_get_attachment_image_src($image_id, 'large', true);
							
							echo '<div class="portfolio200_shadow">';
							echo '<a href="#video_self_'.$key.'" class="lightbox_vimeo"><img src="'.$image_url[0].'" alt="" class="portfolio_img"/><div class="portfolio200_overlay"><img src="'.get_stylesheet_directory_uri().'/images/icon_video.png" alt="" class=""/></div></a>';
							echo '</div>';
							
							echo '<div style="display:none;">
					    		    <div id="video_self_'.$key.'" style="width:900px;height:488px">
					    		    
					    		        <div id="self_hosted_vid_'.$key.'">JW Player goes here</div>
								
										<script type="text/javascript">
											jwplayer("self_hosted_vid_'.$key.'").setup({
												flashplayer: "'.get_stylesheet_directory_uri().'/js/player.swf",
												file: "'.$portfolio_mp4_url.'",
												image: "'.$preview_image[0].'",
												width: 900,
												height: 488,
											});
										</script>
					    		        
					    		    </div>	
					    		</div>';
						break;
						// end self-hosted video
					}
?>
					<div class="portfolio_desc">
					    <h6><a href="<?php echo $permalink_url; ?>"><?php echo $portfolio_item->post_title?></a></h6>
					    <?php echo $portfolio_item->post_excerpt; ?>
					</div>

<?php
					echo '</li>';
				}
				
				echo '</ul>';
				echo '</div>';
			}
		}
		
		if(!empty($items))
		{
			$return_script = '
				<script>
	    	    $j("#porftolio_widget_wrapper_'.$custom_id.'").flexslider({
					animation: "slide",
					controlNav: false, 
					directionNav: false,
					slideshowSpeed: '.$pause_time.',
					start: function(slider) {
						$j(".home_portfolio .flex-control-nav li").css("width", "30px");
			      	}
				});
				</script>
			';
			
			echo $return_script;
		}
		
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['items'] = strip_tags($new_instance['items']);
		$instance['pause_time'] = strip_tags($new_instance['pause_time']);
		$instance['title'] = strip_tags($new_instance['title']);

		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'items' => '' ) );
		$items = strip_tags($instance['items']);
		$title = strip_tags($instance['title']);
		$pause_time = strip_tags($instance['pause_time']);

?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
			
			<p><label for="<?php echo $this->get_field_id('pause_time'); ?>">Pause time (default 5 seconds): <input class="widefat" id="<?php echo $this->get_field_id('pause_time'); ?>" name="<?php echo $this->get_field_name('pause_time'); ?>" type="text" value="<?php echo esc_attr($pause_time); ?>" /></label></p>
			
			<p><label for="<?php echo $this->get_field_id('items'); ?>">Items (default 3): <input class="widefat" id="<?php echo $this->get_field_id('items'); ?>" name="<?php echo $this->get_field_name('items'); ?>" type="text" value="<?php echo esc_attr($items); ?>" /></label></p>
<?php
	}
}

register_widget('Custom_Portfolios');

/**
*	End Portfolios Posts Custom Widgets
**/

/**
*	Begin Twitter Feed Custom Widgets
**/

class Custom_Twitter extends WP_Widget {
	function Custom_Twitter() {
		$widget_ops = array('classname' => 'Custom_Twitter', 'description' => 'Display your recent Twitter feed' );
		$this->WP_Widget('Custom_Twitter', 'Custom Twitter', $widget_ops);
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$twitter_username = empty($instance['twitter_username']) ? ' ' : apply_filters('widget_title', $instance['twitter_username']);
		$title = $instance['title'];
		$items = empty($instance['items']) ? ' ' : apply_filters('widget_title', $instance['items']);
		
		if(!is_numeric($items))
		{
			$items = 5;
		}
		
		if(empty($title))
		{
			$title = 'Recent Tweets';
		}
		
		if(!empty($items) && !empty($twitter_username))
		{
			// Begin get user timeline
			include_once (TEMPLATEPATH . "/lib/twitter.lib.php");
			$obj_twitter = new Twitter($twitter_username); 
			$tweets = $obj_twitter->get($items);

			if(!empty($tweets))
			{
				echo '<h2 class="widgettitle">'.$title.'</h2>';
				echo '<ul class="twitter">';
				
				foreach($tweets as $tweet)
				{
					echo '<li>';
					
					if(isset($tweet[0]))
					{
						echo $tweet[0];
					}
					
					echo '</li>';
				}
				
				echo '</ul>';
				echo '<div class="twitter_arrow"></div>';
				echo '<div class="twitter_username"><img src="'.get_stylesheet_directory_uri().'/images/icon_twitter_bird.png" class="middle" alt="" style="margin-right:5px"/>Follow <a href="http://twitter.com/'.$twitter_username.'">@'.$twitter_username.'</a></div>';
			}
		}
		
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['items'] = strip_tags($new_instance['items']);
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['twitter_username'] = strip_tags($new_instance['twitter_username']);

		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'items' => '', 'twitter_username' => '', 'title' => '') );
		$items = strip_tags($instance['items']);
		$twitter_username = strip_tags($instance['twitter_username']);
		$title = strip_tags($instance['title']);

?>
			<p><label for="<?php echo $this->get_field_id('twitter_username'); ?>">Twitter Username: <input class="widefat" id="<?php echo $this->get_field_id('twitter_username'); ?>" name="<?php echo $this->get_field_name('twitter_username'); ?>" type="text" value="<?php echo esc_attr($twitter_username); ?>" /></label></p>
			
			<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>

			<p><label for="<?php echo $this->get_field_id('items'); ?>">Items (default 5): <input class="widefat" id="<?php echo $this->get_field_id('items'); ?>" name="<?php echo $this->get_field_name('items'); ?>" type="text" value="<?php echo esc_attr($items); ?>" /></label></p>
<?php
	}
}

register_widget('Custom_Twitter');

/**
*	End Twitter Feed Custom Widgets
**/


/**
*	Begin Map Custom Widgets
**/

class Custom_Map extends WP_Widget {
	function Custom_Map() {
		$widget_ops = array('classname' => 'Custom_Map', 'description' => 'Display map' );
		$this->WP_Widget('Custom_Map', 'Custom Map', $widget_ops);
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$title = empty($instance['title']) ? 'Map' : $instance['title'];
		$width = empty($instance['width']) ? 240 : $instance['width'];
		$height = empty($instance['height']) ? 240 : $instance['height'];
		$lat = empty($instance['lat']) ? 0 : $instance['lat'];
		$long = empty($instance['long']) ? 0 : $instance['long'];
		
		$custom_id = time().rand();
		
		echo '<h2 class="widgettitle">'.$title.'</h2><br/>';
		
		$marker = '';
		if(!empty($lat) && !empty($long))
		{
			$marker = '{ zoom: 12, markers: [ { latitude: '.$lat.', longitude: '.$long.' } ] }';
		}
?>

			<div id="map<?php echo $custom_id; ?>" style="width:<?php echo $width; ?>px;height:<?php echo $height; ?>px;margin-bottom:15px"></div>
			<script>
				$j(document).ready(function(){ 
					$j("#map<?php echo $custom_id; ?>").gMap(<?php echo $marker; ?>);
				});
			</script>
		
<?php
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['width'] = strip_tags($new_instance['width']);
		$instance['height'] = strip_tags($new_instance['height']);
		$instance['lat'] = strip_tags($new_instance['lat']);
		$instance['long'] = strip_tags($new_instance['long']);

		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'items' => '', 'title' => '', 'width' => '', 'height' => '', 'lat' => '', 'long' => '') );
		$title = strip_tags($instance['title']);
		$width = strip_tags($instance['width']);
		$height = strip_tags($instance['height']);
		$lat = strip_tags($instance['lat']);
		$long = strip_tags($instance['long']);

?>
			
			<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
			
			<p><label for="<?php echo $this->get_field_id('width'); ?>">Width: <input class="widefat" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" type="text" value="<?php echo esc_attr($width); ?>" /></label></p>
			
			<p><label for="<?php echo $this->get_field_id('height'); ?>">Height: <input class="widefat" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php echo esc_attr($height); ?>" /></label></p>
			
			<p><label for="<?php echo $this->get_field_id('lat'); ?>">Latitude (<a href="http://www.tech-recipes.com/rx/5519/the-easy-way-to-find-latitude-and-longitude-values-in-google-maps/">Find here</a>): <input class="widefat" id="<?php echo $this->get_field_id('lat'); ?>" name="<?php echo $this->get_field_name('lat'); ?>" type="text" value="<?php echo esc_attr($lat); ?>" /></label></p>
			
			<p><label for="<?php echo $this->get_field_id('long'); ?>">Longitude (<a href="http://www.tech-recipes.com/rx/5519/the-easy-way-to-find-latitude-and-longitude-values-in-google-maps/">Find here</a>): <input class="widefat" id="<?php echo $this->get_field_id('long'); ?>" name="<?php echo $this->get_field_name('long'); ?>" type="text" value="<?php echo esc_attr($long); ?>" /></label></p>
<?php
	}
}

register_widget('Custom_Map');

/**
*	End Map Custom Widgets
**/


/**
*	Begin Flickr Feed Custom Widgets
**/

class Custom_Flickr extends WP_Widget {
	function Custom_Flickr() {
		$widget_ops = array('classname' => 'Custom_Flickr', 'description' => 'Display your recent Flickr photos' );
		$this->WP_Widget('Custom_Flickr', 'Custom Flickr', $widget_ops);
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$flickr_id = empty($instance['flickr_id']) ? ' ' : apply_filters('widget_title', $instance['flickr_id']);
		$title = $instance['title'];
		$items = $instance['items'];
		
		if(!is_numeric($items))
		{
			$items = 9;
		}
		
		if(empty($title))
		{
			$title = 'Photostream';
		}
		
		if(!empty($items) && !empty($flickr_id))
		{
			$photos_arr = get_flickr(array('type' => 'user', 'id' => $flickr_id, 'items' => $items));
			
			if(!empty($photos_arr))
			{
				echo '<h2 class="widgettitle">'.$title.'</h2>';
				echo '<ul class="flickr">';
				
				foreach($photos_arr as $photo)
				{
					echo '<li>';
					echo '<a href="'.$photo['url'].'" title="'.$photo['title'].'"><img src="'.$photo['thumb_url'].'" alt="" class="img_nofade" /></a>';
					echo '</li>';
				}
				
				echo '</ul><br class="clear"/>';
			}
		}
		
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['items'] = strip_tags($new_instance['items']);
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['flickr_id'] = strip_tags($new_instance['flickr_id']);

		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'items' => '', 'flickr_id' => '', 'title' => '') );
		$items = strip_tags($instance['items']);
		$flickr_id = strip_tags($instance['flickr_id']);
		$title = strip_tags($instance['title']);

?>
			<p><label for="<?php echo $this->get_field_id('flickr_id'); ?>">Flickr ID <a href="http://idgettr.com/">Find your Flickr ID here</a>: <input class="widefat" id="<?php echo $this->get_field_id('flickr_id'); ?>" name="<?php echo $this->get_field_name('flickr_id'); ?>" type="text" value="<?php echo esc_attr($flickr_id); ?>" /></label></p>
			
			<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>

			<p><label for="<?php echo $this->get_field_id('items'); ?>">Items (default 9): <input class="widefat" id="<?php echo $this->get_field_id('items'); ?>" name="<?php echo $this->get_field_name('items'); ?>" type="text" value="<?php echo esc_attr($items); ?>" /></label></p>
<?php
	}
}

register_widget('Custom_Flickr');

/**
*	End Flickr Feed Custom Widgets
**/

/**
*	Begin Testimonials Custom Widgets
**/

class Custom_Testimonial extends WP_Widget {
	function Custom_Testimonial() {
		$widget_ops = array('classname' => 'Custom_Testimonial', 'description' => 'Display customer testimonials' );
		$this->WP_Widget('Custom_Testimonial', 'Custom Testimonial', $widget_ops);
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$title = $instance['title'];
		$message = $instance['message'];
		$from = $instance['from'];
		
		if(empty($title))
		{
			$title = 'Testimonial';
		}
		
		echo '<h2 class="widgettitle">'.$title.'</h2>';
		echo '<div class="testimonial_wrapper">'.$message.'</div>';
		echo '<div class="testimonial_arrow"></div>';
		echo '<div class="testimonial_name"><strong>'.$from.'</strong></div>';
		
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['message'] = strip_tags($new_instance['message']);
		$instance['from'] = strip_tags($new_instance['from']);

		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'message' => '', 'title' => '', 'from' => '') );
		$message = strip_tags($instance['message']);
		$title = strip_tags($instance['title']);
		$from = strip_tags($instance['from']);

?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>

			<p><label for="<?php echo $this->get_field_id('message'); ?>">Message: <textarea class="widefat" id="<?php echo $this->get_field_id('message'); ?>" name="<?php echo $this->get_field_name('message'); ?>"><?php echo esc_attr($message); ?></textarea></label></p>
			
			<p><label for="<?php echo $this->get_field_id('from'); ?>">From: <input class="widefat" id="<?php echo $this->get_field_id('from'); ?>" name="<?php echo $this->get_field_name('from'); ?>" type="text" value="<?php echo esc_attr($from); ?>" /></label></p>
<?php
	}
}

register_widget('Custom_Testimonial');

/**
*	End Testimonials Custom Widgets
**/

/**
*	Begin Facebook Page Custom Widgets
**/

class Custom_Facebook_Page extends WP_Widget {
	function Custom_Facebook_Page() {
		$widget_ops = array('classname' => 'Custom_Facebook_Page', 'description' => 'Facebook page like box' );
		$this->WP_Widget('Custom_Facebook_Page', 'Custom Facebook Page', $widget_ops);
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$fb_page_url = $instance['fb_page_url'];
		
		if(!empty($fb_page_url))
		{
			if(isset($_SESSION['pp_menu_style']))
			{
				$pp_menu_style = $_SESSION['pp_menu_style'];
			}
			else
			{
				$pp_menu_style = get_option('pp_menu_style');
			}
			
			$fb_skin = 'light';
			$fb_border = 'ffffff';
			if($pp_menu_style != 3 && $pp_menu_style != 6)
			{
				$fb_skin = 'light';
				$fb_border = 'ffffff';
			}
			else
			{
				$fb_skin = 'dark';
				$fb_border = '191919';
			}
?>
<h2 class="widgettitle">Find us on Facebook</h2>
<iframe src="//www.facebook.com/plugins/likebox.php?href=<?php echo urlencode($fb_page_url); ?>&amp;width=230&amp;height=258&amp;colorscheme=<?php echo $fb_skin; ?>&amp;show_faces=true&amp;border_color=%23<?php echo $fb_border; ?>&amp;stream=false&amp;header=false&amp;appId=268239076529520" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:230px; height:258px; margin-left:-10px" allowTransparency="true"></iframe>
<?php
		}
		
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['fb_page_url'] = strip_tags($new_instance['fb_page_url']);

		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'fb_page_url' => '') );
		$fb_page_url = strip_tags($instance['fb_page_url']);

?>
			<p><label for="<?php echo $this->get_field_id('fb_page_url'); ?>">Facebook Page URL: <input class="widefat" id="<?php echo $this->get_field_id('fb_page_url'); ?>" name="<?php echo $this->get_field_name('fb_page_url'); ?>" type="text" value="<?php echo esc_attr($fb_page_url); ?>" /></label></p>
<?php
	}
}

register_widget('Custom_Facebook_Page');

/**
*	End Facebook Page Custom Widgets
**/
?>