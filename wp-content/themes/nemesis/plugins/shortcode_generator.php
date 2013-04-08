<?php

/*
	Begin Create Shortcode Generator Options
*/

add_action('admin_menu', 'pp_shortcode_generator');

function pp_shortcode_generator() {

  //add_submenu_page('functions.php', 'Shortcode Generator', 'Shortcode Generator', 'manage_options', 'pp_shortcode_generator', 'pp_shortcode_generator_options');
  
  global $page_postmetas;
	if ( function_exists('add_meta_box') && isset($page_postmetas) && count($page_postmetas) > 0 ) {  
		add_meta_box( 'shortcode_metabox', 'Shortcode Options', 'pp_shortcode_generator_options', 'page', 'side', 'high' );
		add_meta_box( 'shortcode_metabox', 'Shortcode Options', 'pp_shortcode_generator_options', 'post', 'side', 'high' );  
		add_meta_box( 'shortcode_metabox', 'Shortcode Options', 'pp_shortcode_generator_options', 'portfolios', 'side', 'high' );  
	}

}

function pp_shortcode_generator_options() {

  	$plugin_url = get_stylesheet_directory_uri().'/plugins/shortcode_generator';
  	
  	$args = array(
	    'numberposts' => -1,
	    'post_type' => array('gallery'),
	);
	
	$galleries_arr = get_posts($args);
	$galleries_select = array();
	$galleries_select[''] = '';
	
	foreach($galleries_arr as $gallery)
	{
		$galleries_select[$gallery->ID] = $gallery->post_title;
	}

	//Begin shortcode array
	$shortcodes = array(
		'dropcap' => array(
			'attr' => array(),
			'desc' => array(),
			'content' => TRUE,
		),
		'quote' => array(
			'attr' => array(),
			'desc' => array(),
			'content' => TRUE,
		),
		'button' => array(
			'attr' => array(
				'href' => 'text',
				'align' => 'select',
				'bg_color' => 'text',
				'text_color' => 'text',
			),
			'desc' => array(
				'href' => 'Enter URL for button',
				'align' => 'Button Alignment',
				'bg_color' => 'Enter background color code ex. #000000',
				'text_color' => 'Enter text color code ex. #ffffff',
			),
			'options' => array(
				'left' => 'left',
				'right' => 'right',
				'center' => 'center',
			),
			'content' => TRUE,
			'content_text' => 'Enter text on button',
		),
		'lightbox' => array(
			'attr' => array(
				'type' => 'select',
				'title' => 'text',
				'href' => 'text',
				'youtube_id' => 'text',
				'vimeo_id' => 'text',
			),
			'desc' => array(
				'href' => 'Enter URL for button',
				'align' => 'Button Alignment',
				'bg_color' => 'Enter background color code ex. #000000',
				'text_color' => 'Enter text color code ex. #ffffff',
			),
			'options' => array(
				'image' => 'Image',
				'iframe' => 'iFrame',
				'youtube' => 'Youtube Video',
				'vimeo' => 'Vimeo Video',
			),
			'content' => TRUE,
			'content_text' => 'Enter content (can be normal text, HTML code or shortcode)',
		),
		'frame_left' => array(
			'attr' => array(
				'src' => 'text',
				'href' => 'text',
			),
			'desc' => array(
				'src' => 'Enter image URL',
				'href' => 'Enter hyperlink URL for image',
			),
			'content' => TRUE,
			'content_text' => 'Image Caption',
		),
		'frame_right' => array(
			'attr' => array(
				'src' => 'text',
				'href' => 'text',
			),
			'desc' => array(
				'src' => 'Enter image URL',
				'href' => 'Enter hyperlink URL for image',
			),
			'content' => TRUE,
			'content_text' => 'Image Caption',
		),
		'frame_center' => array(
			'attr' => array(
				'src' => 'text',
				'href' => 'text',
			),
			'desc' => array(
				'src' => 'Enter image URL',
				'href' => 'Enter hyperlink URL for image',
			),
			'content' => TRUE,
			'content_text' => 'Image Caption',
		),
		'img_reflect_left' => array(
			'attr' => array(
				'src' => 'text',
			),
			'desc' => array(
				'src' => 'Enter image URL',
			),
			'content' => FALSE,
		),
		'img_reflect_right' => array(
			'attr' => array(
				'src' => 'text',
			),
			'desc' => array(
				'src' => 'Enter image URL',
			),
			'content' => FALSE,
		),
		'img_reflect_center' => array(
			'attr' => array(
				'src' => 'text',
			),
			'desc' => array(
				'src' => 'Enter image URL',
			),
			'content' => FALSE,
		),
		'one_half' => array(
			'attr' => array(),
			'desc' => array(),
			'content' => TRUE,
			'repeat' => 1,
		),
		'one_third' => array(
			'attr' => array(),
			'desc' => array(),
			'content' => TRUE,
			'repeat' => 2,
		),
		'one_third_last' => array(
			'attr' => array(),
			'desc' => array(),
			'content' => TRUE,
		),
		'two_third' => array(
			'attr' => array(),
			'desc' => array(),
			'content' => TRUE,
		),
		'two_third_last' => array(
			'attr' => array(),
			'desc' => array(),
			'content' => TRUE,
		),
		'one_fourth' => array(
			'attr' => array(),
			'desc' => array(),
			'content' => TRUE,
			'repeat' => 3,
		),
		'one_fourth_last' => array(
			'attr' => array(),
			'desc' => array(),
			'content' => TRUE,
		),
		'one_fifth' => array(
			'attr' => array(),
			'desc' => array(),
			'content' => TRUE,
			'repeat' => 4,
		),
		'one_fifth_last' => array(
			'attr' => array(),
			'desc' => array(),
			'content' => TRUE,
		),
		'portfolio1' => array(
			'attr' => array(
				'title' => 'text',
				'items' => 'text',
				'set_id' => 'text',
				'pause_time' => 'text',
			),
			'desc' => array(
				'title' => 'Portfolio Section Title',
				'items' => 'Enter number of items you want to dsiplay',
				'set_id' => 'Your portfolio set ID so it will display only portfolios in this set',
				'pause_time' => 'Enter number of seconds for slideshow timer',
			),
			'content' => TRUE,
		),
		'portfolio2' => array(
			'attr' => array(
				'items' => 'text',
				'set_id' => 'text',
				'pause_time' => 'text',
			),
			'desc' => array(
				'items' => 'Enter number of portfolio items (ex. 8)',
				'set_id' => 'Your portfolio set ID so it will display only portfolios in this set',
				'pause_time' => 'Enter number of seconds for slideshow timer',
			),
		),
		'service1' => array(
			'attr' => array(
				'items' => 'text',
			),
			'desc' => array(
				'items' => 'Enter number of items you want to dsiplay',
			),
			'content' => FALSE,
		),
		'service2' => array(
			'attr' => array(
				'items' => 'text',
			),
			'desc' => array(
				'items' => 'Enter number of service items (ex. 8)',
			),
			'content' => FALSE,
		),
		'styled_box' => array(
			'attr' => array(
				'title' => 'text',
				'color' => 'select',
			),
			'desc' => array(
				'href' => 'Enter URL for button',
				'color' => 'Select box color',
			),
			'options' => array(
				'black' => 'Black',
				'gray' => 'Gray',
				'white' => 'White',
				'blue' => 'Blue',
				'yellow' => 'Yellow',
				'red' => 'Red',
				'orange' => 'Orange',
				'green' => 'Green',
				'pink' => 'Pink',
				'purple' => 'Purple',
			),
			'content' => TRUE,
			'content_text' => 'Enter Content',
		),
		'map' => array(
			'attr' => array(
				'width' => 'text',
				'height' => 'text',
				'lat' => 'text',
				'long' => 'text',
				'zoom' => 'text',
			),
			'desc' => array(
				'width' => 'Map width in pixels',
				'height' => 'Map height in pixels',
				'lat' => 'Map latitude <a href="http://www.tech-recipes.com/rx/5519/the-easy-way-to-find-latitude-and-longitude-values-in-google-maps/">Find here</a>',
				'long' => 'Map longitude <a href="http://www.tech-recipes.com/rx/5519/the-easy-way-to-find-latitude-and-longitude-values-in-google-maps/">Find here</a>',
				'zoom' => 'Enter zoom number (1-16)',
			),
			'content' => FALSE,
			'options' => array(
				1 => 'Open',
				0 => 'Close',
			),
		),
		'youtube' => array(
			'attr' => array(
				'width' => 'text',
				'height' => 'text',
				'video_id' => 'text',
			),
			'desc' => array(
				'width' => 'Video width in pixels',
				'height' => 'Video height in pixels',
				'video_id' => 'Youtube video ID something like Js9Z8UQAA4E',
			),
			'content' => FALSE,
		),
		'vimeo' => array(
			'attr' => array(
				'width' => 'text',
				'height' => 'text',
				'video_id' => 'text',
			),
			'desc' => array(
				'width' => 'Video width in pixels',
				'height' => 'Video height in pixels',
				'video_id' => 'Vimeo video ID something like 9380243',
			),
			'content' => FALSE,
		),
		'video' => array(
			'attr' => array(
				'width' => 'text',
				'height' => 'text',
				'img_src' => 'text',
				'video_src' => 'text',
			),
			'desc' => array(
				'width' => 'Video width in pixels',
				'height' => 'Video height in pixels',
				'img_src' => 'Poster image for video',
				'video_src' => 'Video URL in mp4 or flv format',
			),
			'content' => FALSE,
		),
		'gallery' => array(
			'attr' => array(
				'id' => 'select',
				'width' => 'text',
				'height' => 'text',
			),
			'options' => $galleries_select,
			'desc' => array(
				'width' => 'Image width in pixels',
				'height' => 'Image height in pixels',
			),
			'content' => FALSE,
		),
		'tagline' => array(
			'attr' => array(
				'title' => 'text',
			),
			'desc' => array(
				'width' => 'Enter Tagline\'s title',
			),
			'content' => TRUE,
		),
	);

?>
<script>
jQuery(document).ready(function(){ 
	jQuery('#shortcode_select').change(function() {
  		var target = jQuery(this).val();
  		jQuery('.rm_section').hide()
  		jQuery('#div_'+target).fadeIn()
	});	
	
	jQuery('.code_area').click(function() { 
		document.getElementById(jQuery(this).attr('id')).focus();
    	document.getElementById(jQuery(this).attr('id')).select();
	});
	
	jQuery('.button').click(function() { 
		var target = jQuery(this).attr('id');
		var gen_shortcode = '';
  		gen_shortcode+= '['+target;
  		
  		if(jQuery('#'+target+'_attr_wrapper .attr').length > 0)
  		{
  			jQuery('#'+target+'_attr_wrapper .attr').each(function() {
				gen_shortcode+= ' '+jQuery(this).attr('name')+'="'+jQuery(this).val()+'"';
			});
		}
		
		gen_shortcode+= ']';
		
		if(jQuery('#'+target+'_content').length > 0)
  		{
  			gen_shortcode+= jQuery('#'+target+'_content').val()+'[/'+target+']';
  			
  			var repeat = jQuery('#'+target+'_content_repeat').val();
  			for (count=1;count<=repeat;count=count+1)
			{
				if(count<repeat)
				{
					gen_shortcode+= '['+target+']';
					gen_shortcode+= jQuery('#'+target+'_content').val()+'[/'+target+']';
				}
				else
				{
					gen_shortcode+= '['+target+'_last]';
					gen_shortcode+= jQuery('#'+target+'_content').val()+'[/'+target+'_last]';
				}
			}
  		}
  		
  		jQuery('#'+target+'_code').val(gen_shortcode);
	});
});
</script>

	<div style="padding:20px 10px 10px 10px">
	<?php
		if(!empty($shortcodes))
		{
	?>
			<strong>Select Shortcode</strong><hr class="pp_widget_hr">
			<div class="pp_widget_description">Please select short code from list below then enter short code attributes and click "Generate Shortcode". <a href="<?php echo THEMEDEMOURL; ?>" target="_blank">Go to demo site</a> and click "Shortcode" to see all short codes available and their sample code.</div>
			<br/>
			<select id="shortcode_select">
				<option value="">(no short code selected)</option>
			
	<?php
			foreach($shortcodes as $shortcode_name => $shortcode)
			{
	?>
	
			<option value="<?php echo $shortcode_name; ?>"><?php echo $shortcode_name; ?></option>
	
	<?php
			}
	?>
			</select>
	<?php
		}
	?>
	
	<br/><br/>
	
	<?php
		if(!empty($shortcodes))
		{
			foreach($shortcodes as $shortcode_name => $shortcode)
			{
	?>
	
			<div id="div_<?php echo $shortcode_name; ?>" class="rm_section" style="display:none">
				<div class="rm_title">
					<h3><?php echo ucfirst($shortcode_name); ?></h3>
					<div class="clearfix"></div>
				</div>
				
				<div class="rm_text" style="padding: 10px 0 20px 0">
				
				<!-- img src="<?php echo $plugin_url.'/'.$shortcode_name.'.png'; ?>" alt=""/><br/><br/><br/ -->
				
				<?php
					if(isset($shortcode['content']) && $shortcode['content'])
					{
						if(isset($shortcode['content_text']))
						{
							$content_text = $shortcode['content_text'];
						}
						else
						{
							$content_text = 'Your Content';
						}
				?>
				
				<strong><?php echo $content_text; ?>:</strong><br/>
				<input type="hidden" id="<?php echo $shortcode_name; ?>_content_repeat" value="<?php echo $shortcode['repeat']; ?>"/>
				<textarea id="<?php echo $shortcode_name; ?>_content" style="width:100%;height:70px" rows="3" wrap="off"></textarea><br/><br/>
				
				<?php
					}
				?>
			
				<?php
					if(isset($shortcode['attr']) && !empty($shortcode['attr']))
					{
				?>
						
						<div id="<?php echo $shortcode_name; ?>_attr_wrapper">
						
				<?php
						foreach($shortcode['attr'] as $attr => $type)
						{
				?>
				
							<?php echo '<strong>'.ucfirst($attr).'</strong>: '.$shortcode['desc'][$attr]; ?><br/><br/>
							
							<?php
								switch($type)
								{
									case 'text':
							?>
							
									<input type="text" id="<?php echo $shortcode_name; ?>_text" style="width:100%" class="attr" name="<?php echo $attr; ?>"/>
							
							<?php
									break;
									
									case 'select':
							?>
							
									<select id="<?php echo $shortcode_name; ?>_select" style="width:25%" class="attr" name="<?php echo $attr; ?>">
									
										<?php
											if(isset($shortcode['options']) && !empty($shortcode['options']))
											{
												foreach($shortcode['options'] as $select_key => $option)
												{
										?>
										
													<option value="<?php echo $select_key; ?>"><?php echo $option; ?></option>
										
										<?php	
												}
											}
										?>							
									
									</select>
							
							<?php
									break;
								}
							?>
							
							<br/><br/>
				
				<?php
						} //end attr foreach
				?>
				
						</div>
				
				<?php
					}
				?>
				<br/>
				
				<input type="button" id="<?php echo $shortcode_name; ?>" value="Generate Shortcode" class="button"/>
				
				<br/><br/><br/>
				
				<strong>Shortcode:</strong><br/>
				<textarea id="<?php echo $shortcode_name; ?>_code" style="width:90%;height:70px" rows="3" readonly="readonly" class="code_area" wrap="off"></textarea>
				
				</div>
				
			</div>
	
	<?php
			} //end shortcode foreach
		}
	?>
	
</div>

<?php

}

/*
	End Create Shortcode Generator Options
*/

?>