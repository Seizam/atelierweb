<?php

// [dropcap foo="foo-value"]
function dropcap_func($atts, $content) {
	remove_filter('the_content', 'pp_formatter', 99);

	//extract short code attr
	extract(shortcode_atts(array(
		'style' => 1
	), $atts));
	
	//get first char
	$first_char = substr($content, 0, 1);
	$text_len = strlen($content);
	$rest_text = substr($content, 1, $text_len);

	$return_html = '<span class="dropcap'.$style.'">'.$first_char.'</span>';
	$return_html.= do_shortcode($rest_text);
	$return_html.= '<br class="clear"/><br/>';
	
	return $return_html;
}
add_shortcode('dropcap', 'dropcap_func');


// [quote foo="foo-value"]
function quote_func($atts, $content) {
	remove_filter('the_content', 'pp_formatter', 99);
	$return_html = '<blockquote>'.do_shortcode($content).'</blockquote>';
	$return_html.= '<br class="clear"/>';
	
	return $return_html;
}
add_shortcode('quote', 'quote_func');


function pre_func($atts, $content) {
	remove_filter('the_content', 'pp_formatter', 99);
	$return_html = '<pre>'.strip_tags($content).'</pre>';
	
	return $return_html;
}
add_shortcode('pre', 'pre_func');


// [button foo="foo-value"]
function button_func($atts, $content) {
	remove_filter('the_content', 'pp_formatter', 99);

	//extract short code attr
	extract(shortcode_atts(array(
		'href' => '',
		'align' => '',
		'bg_color' => '#cccccc',
		'text_color' => '#444444',
		'size' => 'small',
		'style' => '',
		'color' => '',
		'target' => '_self',
	), $atts));
	
	if(!empty($color))
	{
		switch(strtolower($color))
		{
			case 'black':
				$bg_color = '#000000';
				$text_color = '#ffffff';
			break;
			case 'grey':
				$bg_color = '#666666';
				$text_color = '#ffffff';
			break;
			case 'white':
				$bg_color = '#f5f5f5';
				$text_color = '#444444';
			break;
			case 'blue':
				$bg_color = '#004a80';
				$text_color = '#ffffff';
			break;
			case 'yellow':
				$bg_color = '#f9b601';
				$text_color = '#ffffff';
			break;
			case 'red':
				$bg_color = '#9e0b0f';
				$text_color = '#ffffff';
			break;
			case 'orange':
				$bg_color = '#fe7201';
				$text_color = '#ffffff';
			break;
			case 'green':
				$bg_color = '#7aad34';
				$text_color = '#ffffff';
			break;
			case 'pink':
				$bg_color = '#d2027d';
				$text_color = '#ffffff';
			break;
			case 'purple':
				$bg_color = '#582280';
				$text_color = '#ffffff';
			break;
		}
	}
	
	$border_color = '#'.hex_darker(substr($bg_color, 1), 10);
	
	$return_html = '<a class="button '.$size.' '.$align.'" style="background-color:'.$bg_color.';border:1px solid '.$border_color.';color:'.$text_color.';'.$style.'"';
	
	if(!empty($href))
	{
		$return_html.= ' onclick="window.open(\''.$href.'\', \''.$target.'\')"';
	}
	
	$return_html.= '>'.$content.'</a>';
	
	return $return_html;
}
add_shortcode('button', 'button_func');


function lightbox_func($atts, $content) {
	remove_filter('the_content', 'pp_formatter', 99);

	//extract short code attr
	extract(shortcode_atts(array(
		'title' => '',
		'href' => '',
		'type' => 'image',
		'youtube_id' => '',
		'vimeo_id' => '',
		'dailymotion_id' => '',
	), $atts));
	
	$class = 'lightbox';
	
	if($type != 'image')
	{
		$class.= '_'.$type;
	}
	
	if($type == 'youtube')
	{
		$href = '#video_'.$youtube_id;
	}
	
	if($type == 'vimeo')
	{
		$href = '#video_'.$vimeo_id;
	}
	
	$data_iframe = '';
	if($type=='iframe')
	{
		$data_iframe = 'data-fancybox-type="iframe"';
	}
	
	$return_html.= '<a href="'.$href.'" class="'.$class.'" '.$data_iframe.'>'.do_shortcode($content).'</a>';
	
	if(!empty($youtube_id))
	{
		$return_html.= '<div style="display:none;"><div id="video_'.$youtube_id.'" style="width:900px;height:488px"><iframe width="900" height="488" src="http://www.youtube.com/embed/'.$youtube_id.'?theme=dark&amp;rel=0&amp;wmode=opaque" frameborder="0"></iframe></div>	
							</div>';
	}
	
	if(!empty($vimeo_id))
	{
		$return_html.= '<div style="display:none;">
							   <div id="video_'.$vimeo_id.'" style="width:900px;height:506px"><iframe src="http://player.vimeo.com/video/'.$vimeo_id.'?title=0&amp;byline=0&amp;portrait=0" width="900" height="506" frameborder="0"></iframe></div>	
							</div>';
	}
	
	return $return_html;
}
add_shortcode('lightbox', 'lightbox_func');


function styled_box_func($atts, $content) {
	remove_filter('the_content', 'pp_formatter', 99);

	//extract short code attr
	extract(shortcode_atts(array(
		'title' => '',
		'width' => '95%',
		'style' => '',
		'color' => '',
	), $atts));
	
	switch(strtolower($color))
		{
			case 'black':
				$bg_color = '#000000';
				$text_color = '#ffffff';
			break;
			default:
			case 'gray':
				$bg_color = '#666666';
				$text_color = '#ffffff';
			break;
			case 'white':
				$bg_color = '#f5f5f5';
				$text_color = '#444444';
			break;
			case 'blue':
				$bg_color = '#004a80';
				$text_color = '#ffffff';
			break;
			case 'yellow':
				$bg_color = '#f9b601';
				$text_color = '#ffffff';
			break;
			case 'red':
				$bg_color = '#9e0b0f';
				$text_color = '#ffffff';
			break;
			case 'orange':
				$bg_color = '#fe7201';
				$text_color = '#ffffff';
			break;
			case 'green':
				$bg_color = '#7aad34';
				$text_color = '#ffffff';
			break;
			case 'pink':
				$bg_color = '#d2027d';
				$text_color = '#ffffff';
			break;
			case 'purple':
				$bg_color = '#582280';
				$text_color = '#ffffff';
			break;
		}
	
	$bg_color_light = '#'.hex_lighter(substr($bg_color, 1), 20);
	$border_color = '#'.hex_lighter(substr($bg_color, 1), 10);
	
	$return_html = '<div class="styled_box_title" style="background: -webkit-gradient(linear, left top, left bottom, from('.$bg_color_light.'), to('.$bg_color.'));background: -moz-linear-gradient(top,  '.$bg_color_light.',  '.$bg_color.');filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr=\''.$bg_color_light.'\', endColorstr=\''.$bg_color.'\');border:1px solid '.$border_color.';color:'.$text_color.';width:'.$width.';'.$style.'">'.$title.'</div>';
	$return_html.= '<div class="styled_box_content" style="border:1px solid '.$border_color.';border-top:0;width:'.$width.'">'.html_entity_decode(do_shortcode($content)).'</div>';
	
	return $return_html;
}
add_shortcode('styled_box', 'styled_box_func');


function frame_left_func($atts, $content) {
	remove_filter('the_content', 'pp_formatter', 99);

	//extract short code attr
	extract(shortcode_atts(array(
		'src' => '',
		'href' => '',
	), $atts));
	
	$return_html = '<div class="frame_left">';
	
	if(!empty($href))
	{
		$return_html.= '<a href="'.$href.'" class="img_frame">';
	}
	
	$return_html.= '<img src="'.$src.'" alt=""/>';
	
	if(!empty($href))
	{
		$return_html.= '</a>';
	}
	
	if(!empty($content))
	{
		$return_html.= '<span class="caption">'.$content.'</span>';
	}
	
	$return_html.= '</div>';
	
	return $return_html;
}
add_shortcode('frame_left', 'frame_left_func');


function frame_right_func($atts, $content) {
	remove_filter('the_content', 'pp_formatter', 99);

	//extract short code attr
	extract(shortcode_atts(array(
		'src' => '',
		'href' => '',
	), $atts));
	
	$return_html = '<div class="frame_right">';
	
	if(!empty($href))
	{
		$return_html.= '<a href="'.$href.'" class="img_frame">';
	}
	
	$return_html.= '<img src="'.$src.'" alt=""/>';
	
	if(!empty($href))
	{
		$return_html.= '</a>';
	}
	
	if(!empty($content))
	{
		$return_html.= '<span class="caption">'.$content.'</span>';
	}
	
	$return_html.= '</div>';
	
	return $return_html;
}
add_shortcode('frame_right', 'frame_right_func');


function frame_center_func($atts, $content) {
	remove_filter('the_content', 'pp_formatter', 99);

	//extract short code attr
	extract(shortcode_atts(array(
		'src' => '',
		'href' => '',
	), $atts));
	
	$return_html = '<div class="frame_center">';
	
	if(!empty($href))
	{
		$return_html.= '<a href="'.$href.'" class="img_frame">';
	}
	
	$return_html.= '<img src="'.$src.'" alt=""/>';
	
	if(!empty($href))
	{
		$return_html.= '</a>';
	}
	
	if(!empty($content))
	{
		$return_html.= '<span class="caption">'.$content.'</span>';
	}
	
	$return_html.= '</div>';
	
	return $return_html;
}
add_shortcode('frame_center', 'frame_center_func');


function list_func($atts, $content) {
	remove_filter('the_content', 'pp_formatter', 99);

	//extract short code attr
	extract(shortcode_atts(array(
		'type' => '',
	), $atts));
	
	$return_html = '
		<style>
			.pp_list.'.$type.' ul li {
				display: block;
				background: url("'.get_bloginfo( 'stylesheet_directory' ).'/images/icon/'.$type.'_16x16.png") no-repeat top left;
			}
		</style>
	';
	
	$return_html.= '<div class="pp_list '.$type.'">'.strip_tags($content,'<ul><li><a>').'</div>';
	
	return $return_html;
}
add_shortcode('list', 'list_func');


function highlight_func($atts, $content) {
	remove_filter('the_content', 'pp_formatter', 99);

	//extract short code attr
	extract(shortcode_atts(array(
		'type' => 'yellow',
	), $atts));
	
	$return_html.= '<span class="highlight_'.$type.'">'.strip_tags($content).'</span>';
	
	return $return_html;
}
add_shortcode('highlight', 'highlight_func');


function tagline_func($atts, $content) {
	remove_filter('the_content', 'pp_formatter', 99);

	//extract short code attr
	extract(shortcode_atts(array(
		'title' => '',
	), $atts));
	
	$return_html.= '
		<div class="tagline"><h2>'.strip_shortcodes(strip_tags($title)).'</h2><div class="tagline_desc">'.strip_shortcodes($content).'</div></div><br class="clear"/>
	';
	
	return $return_html;
}
add_shortcode('tagline', 'tagline_func');


function one_half_func($atts, $content) {
	remove_filter('the_content', 'pp_formatter', 99);

	//extract short code attr
	extract(shortcode_atts(array(
		'class' => '',
	), $atts));
	
	$return_html = '<div class="one_half '.$class.'">'.do_shortcode($content).'</div>';
	
	return $return_html;
}
add_shortcode('one_half', 'one_half_func');


function one_half_last_func($atts, $content) {
	remove_filter('the_content', 'pp_formatter', 99);

	//extract short code attr
	extract(shortcode_atts(array(
		'class' => '',
	), $atts));
	
	$return_html = '<div class="one_half last '.$class.'">'.do_shortcode($content).'</div><br class="clear"/>';
	
	return $return_html;
}
add_shortcode('one_half_last', 'one_half_last_func');


function one_third_func($atts, $content) {
	remove_filter('the_content', 'pp_formatter', 99);
	
	$return_html = '<div class="one_third">'.do_shortcode($content).'</div>';
	
	return $return_html;
}
add_shortcode('one_third', 'one_third_func');


function one_third_last_func($atts, $content) {
	remove_filter('the_content', 'pp_formatter', 99);
	
	$return_html = '<div class="one_third last">'.do_shortcode($content).'</div><br class="clear"/>';
	
	return $return_html;
}
add_shortcode('one_third_last', 'one_third_last_func');


function two_third_func($atts, $content) {
	remove_filter('the_content', 'pp_formatter', 99);
	
	$return_html = '<div class="two_third">'.do_shortcode($content).'</div>';
	
	return $return_html;
}
add_shortcode('two_third', 'two_third_func');


function two_third_last_func($atts, $content) {
	remove_filter('the_content', 'pp_formatter', 99);
	
	$return_html = '<div class="two_third last">'.do_shortcode($content).'</div><br class="clear"/>';
	
	return $return_html;
}
add_shortcode('two_third_last', 'two_third_last_func');


function one_fourth_func($atts, $content) {
	remove_filter('the_content', 'pp_formatter', 99);
	
	$return_html = '<div class="one_fourth">'.do_shortcode($content).'</div>';
	
	return $return_html;
}
add_shortcode('one_fourth', 'one_fourth_func');


function one_fourth_last_func($atts, $content) {
	remove_filter('the_content', 'pp_formatter', 99);
	
	$return_html = '<div class="one_fourth last">'.do_shortcode($content).'</div><br class="clear"/>';
	
	return $return_html;
}
add_shortcode('one_fourth_last', 'one_fourth_last_func');


function one_fifth_func($atts, $content) {
	remove_filter('the_content', 'pp_formatter', 99);
	
	$return_html = '<div class="one_fifth">'.do_shortcode($content).'</div>';
	
	return $return_html;
}
add_shortcode('one_fifth', 'one_fifth_func');


function one_fifth_last_func($atts, $content) {
	remove_filter('the_content', 'pp_formatter', 99);
	
	$return_html = '<div class="one_fifth last">'.do_shortcode($content).'</div><br class="clear"/>';
	
	return $return_html;
}
add_shortcode('one_fifth_last', 'one_fifth_last_func');


function one_sixth_func($atts, $content) {
	remove_filter('the_content', 'pp_formatter', 99);
	
	$return_html = '<div class="one_sixth">'.do_shortcode($content).'</div>';
	
	return $return_html;
}
add_shortcode('one_sixth', 'one_sixth_func');


function one_sixth_last_func($atts, $content) {
	remove_filter('the_content', 'pp_formatter', 99);
	
	$return_html = '<div class="one_sixth last">'.do_shortcode($content).'</div><br class="clear"/>';
	
	return $return_html;
}
add_shortcode('one_sixth_last', 'one_sixth_last_func');


function accordion_func($atts, $content) {
	remove_filter('the_content', 'pp_formatter', 99);

	//extract short code attr
	extract(shortcode_atts(array(
		'title' => '',
		'close' => 0,
	), $atts));
	
	$close_class = '';
	
	if(!empty($close))
	{
		$close_class = 'pp_accordion_close';
	}
	else
	{
		$close_class = 'pp_accordion';
	}
	
	$return_html = '<div class="'.$close_class.'"><h3><a href="#">'.$title.'</a></h3>';
	$return_html.= '<div><p>';
	$return_html.= do_shortcode($content);
	$return_html.= '</p></div></div>';
	
	return $return_html;
}
add_shortcode('accordion', 'accordion_func');


function pp_pre_func($atts, $content) {
	remove_filter('the_content', 'pp_formatter', 99);

	//extract short code attr
	extract(shortcode_atts(array(
		'title' => '',
		'close' => 1,
	), $atts));
	
	$return_html.= '<pre>';
	$return_html.= $content;
	$return_html.= '</pre>';
	
	return $return_html;
}
add_shortcode('pp_pre', 'pp_pre_func');



function tabs_func($atts, $content) {
	remove_filter('the_content', 'pp_formatter', 99);

	//extract short code attr
	extract(shortcode_atts(array(
		'tab1' => '',
		'tab2' => '',
		'tab3' => '',
		'tab4' => '',
		'tab5' => '',
		'tab6' => '',
		'tab7' => '',
		'tab8' => '',
		'tab9' => '',
		'tab10' => '',
	), $atts));
	
	$tab_arr = array(
		$tab1,
		$tab2,
		$tab3,
		$tab4,
		$tab5,
		$tab6,
		$tab7,
		$tab8,
		$tab9,
		$tab10,
	);
	
	$return_html = '<div class="tabs"><ul>';
	
	foreach($tab_arr as $key=>$tab)
	{
		//display title1
		if(!empty($tab))
		{
			$return_html.= '<li><a href="#tabs-'.($key+1).'">'.$tab.'</a></li>';
		}
	}
	
	$return_html.= '</ul>';
	$return_html.= do_shortcode($content);
	$return_html.= '</div>';
	
	return $return_html;
}
add_shortcode('tabs', 'tabs_func');


function tab_func($atts, $content) {
	remove_filter('the_content', 'pp_formatter', 99);

	//extract short code attr
	extract(shortcode_atts(array(
		'id' => '',
	), $atts));
	
	$return_html.= '<div id="tabs-'.$id.'" class="tab_wrapper"><br class="clear"/>'.do_shortcode($content).'<br class="clear"/></div>';
	
	return $return_html;
}
add_shortcode('tab', 'tab_func');



function recent_posts_func($atts) {
	remove_filter('the_content', 'pp_formatter', 99);
	
	//extract short code attr
	extract(shortcode_atts(array(
		'items' => 3,
	), $atts));

	$return_html = pp_posts('recent', $items, FALSE, 'black', FALSE);
	
	return $return_html;
}
add_shortcode('recent_posts', 'recent_posts_func');



function popular_posts_func($atts) {
	remove_filter('the_content', 'pp_formatter', 99);
	
	//extract short code attr
	extract(shortcode_atts(array(
		'items' => 3,
	), $atts));

	$return_html = pp_posts('poopular', $items, FALSE, 'black', FALSE);
	
	return $return_html;
}
add_shortcode('popular_posts', 'popular_posts_func');


function pricing_func($atts, $content) {
	remove_filter('the_content', 'pp_formatter', 99);
	
	//extract short code attr
	extract(shortcode_atts(array(
		'size' => '',
		'title' => '',
		'column' => 3,
		'last' => 0,
	), $atts));
	
	$width_class = 'three';
	switch($column)
	{
		case 3:
			$width_class = 'three';
		break;
		case 4:
			$width_class = 'four';
		break;
	}
	
	$return_html = '<div class="pricing_box '.$size.' '.$width_class.'">';
	
	if(!empty($title))
	{
		$return_html.= '<div class="header">';
		$return_html.= '<span>'.$title.'</span>';
		$return_html.= '</div>';
	}
	
	$return_html.= do_shortcode($content);
	$return_html.= '</div>';
	
	if(!empty($last))
	{
		$return_html.= '<br class="clear"/>';
	}
	
	return $return_html;
}
add_shortcode('pricing', 'pricing_func');

function map_func($atts) {
	remove_filter('the_content', 'pp_formatter', 99);

	//extract short code attr
	extract(shortcode_atts(array(
		'width' => 400,
		'height' => 300,
		'lat' => 0,
		'long' => 0,
		'zoom' => 12,
		'type' => '',
		'popup' => '',
		'address' => '',
	), $atts));
	
	$custom_id = time().rand();
	
	$marker = '{';
	
	if((!empty($lat) && !empty($long)) OR (!empty($address)))
	{
		if(!empty($lat) && !empty($long))
		{
			$marker.= 'markers: [ { latitude: '.$lat.', longitude: '.$long;
		}
		elseif(!empty($address))
		{
			$marker.= 'markers: [ { address: "'.$address.'"';
		}
		
		if(!empty($popup))
		{
			$marker.= ', html: "'.$popup.'", popup: false';
		}
		
		$marker.= '} ], ';
	}
	
	if(!empty($type))
	{
		$marker.= 'maptype: google.maps.'.$type.',';
	}
	
	$marker.= 'zoom: '.$zoom;
	$marker.= '}';
	
	$return_html = '<div class="map_shortcode_wrapper" id="map'.$custom_id.'" style="width:'.$width.'px;height:'.$height.'px"></div>';
	$return_html.= '<script>';
	$return_html.= 'jQuery(document).ready(function(){ jQuery("#map'.$custom_id.'").gMap('.$marker.'); });';
	$return_html.= '</script>';
	
	return $return_html;
}
add_shortcode('map', 'map_func');


function youtube_func($atts) {
	remove_filter('the_content', 'pp_formatter', 99);

	//extract short code attr
	extract(shortcode_atts(array(
		'width' => 640,
		'height' => 385,
		'video_id' => '',
	), $atts));
	
	$custom_id = time().rand();
	
	$return_html = '<iframe title="YouTube video player" width="'.$width.'" height="'.$height.'" src="http://www.youtube.com/embed/'.$video_id.'?theme=dark&rel=0&wmode=transparent" frameborder="0" allowfullscreen></iframe>';
	
	return $return_html;
}
add_shortcode('youtube', 'youtube_func');


function vimeo_func($atts, $content) {

	//extract short code attr
	extract(shortcode_atts(array(
		'width' => 640,
		'height' => 385,
		'video_id' => '',
	), $atts));
	
	$custom_id = time().rand();
	
	$return_html = '<iframe src="http://player.vimeo.com/video/'.$video_id.'?title=0&amp;byline=0&amp;portrait=0" width="'.$width.'" height="'.$height.'" frameborder="0"></iframe>';
	
	return $return_html;
}
add_shortcode('vimeo', 'vimeo_func');


function video_func($atts) {
	remove_filter('the_content', 'pp_formatter', 99);

	//extract short code attr
	extract(shortcode_atts(array(
		'width' => 640,
		'height' => 385,
		'img_src' => '',
		'video_src' => '',
		
	), $atts));
	
	$custom_id = time().rand();
	
	$return_html = '<div id="video_self_'.$custom_id.'" style="width:'.$width.'px;height:'.$height.'px">';
	$return_html.= '<div id="self_hosted_vid_'.$custom_id.'">JW Player goes here</div>';
	$return_html.= '<script type="text/javascript">';
	$return_html.= 'jwplayer("self_hosted_vid_'.$custom_id.'").setup({';
	$return_html.= 'flashplayer: "'.get_stylesheet_directory_uri().'/js/player.swf",';
	$return_html.= 'file: "'.$video_src.'",';
	$return_html.= 'image: "'.$img_src.'",';
	$return_html.= 'width: '.$width.',';
	$return_html.= 'height: '.$height;
	$return_html.= '});';
	$return_html.= '</script>';
	$return_html.= '</div>';
	
	return $return_html;
}
add_shortcode('video', 'video_func');


function table_func($atts, $content) {
	remove_filter('the_content', 'pp_formatter', 99);

	//extract short code attr
	extract(shortcode_atts(array(
		'color' => '',
	), $atts));
	
	switch(strtolower($color))
		{
			case 'black':
				$bg_color = '#000000';
				$text_color = '#ffffff';
			break;
			default:
			case 'gray':
				$bg_color = '#666666';
				$text_color = '#ffffff';
			break;
			case 'white':
				$bg_color = '#f5f5f5';
				$text_color = '#444444';
			break;
			case 'blue':
				$bg_color = '#004a80';
				$text_color = '#ffffff';
			break;
			case 'yellow':
				$bg_color = '#f9b601';
				$text_color = '#ffffff';
			break;
			case 'red':
				$bg_color = '#9e0b0f';
				$text_color = '#ffffff';
			break;
			case 'orange':
				$bg_color = '#fe7201';
				$text_color = '#ffffff';
			break;
			case 'green':
				$bg_color = '#7aad34';
				$text_color = '#ffffff';
			break;
			case 'pink':
				$bg_color = '#d2027d';
				$text_color = '#ffffff';
			break;
			case 'purple':
				$bg_color = '#582280';
				$text_color = '#ffffff';
			break;
		}
	
	$bg_color_light = '#'.hex_lighter(substr($bg_color, 1), 20);
	$border_color = '#'.hex_lighter(substr($bg_color, 1), 10);
	
	$return_html = '<style>
	#content_wrapper .table_'.strtolower($color).' table 
	{
		border:1px solid '.$border_color.';
	}
	#content_wrapper .table_'.strtolower($color).' table tr th
	{
		background: -webkit-gradient(linear, left top, left bottom, from('.$bg_color_light.'), to('.$bg_color.'));background: -moz-linear-gradient(top,  '.$bg_color_light.',  '.$bg_color.');filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr=\''.$bg_color_light.'\', endColorstr=\''.$bg_color.'\');color:'.$text_color.';
	}
	#content_wrapper .table_'.strtolower($color).' table tr th, #content_wrapper .table_'.strtolower($color).' table tr td
	{
		border-bottom:1px solid '.$border_color.';
	}
	#content_wrapper table tr:last-child
	{
		border-bottom: 0;
	}
	</style>';
	$return_html.= '<div class="table_'.strtolower($color).'">';
	$return_html.= html_entity_decode(do_shortcode($content));
	$return_html.= '</div>';
	
	return $return_html;
}
add_shortcode('table', 'table_func');


function portfolio1_func($atts, $content) {
	remove_filter('the_content', 'pp_formatter', 99);

	//extract short code attr
	extract(shortcode_atts(array(
		'title' => 'Recent Portfolios',
		'items' => 8,
		'set_id' => '',
		'portfolio_url' => '',
		'pause_time' => 5,
	), $atts));
	
	$pause_time = $pause_time * 1000;
	$content = trim($content);

	$return_html = '<div class="portfolio1_wrapper"><div class="one_fourth"><h2 class="cufon">'.$title.'</h2><p>'.$content.'</p>';
	
	if(!empty($portfolio_url))
	{
		$return_html.= '<br/><a class="classic" href="'.$portfolio_url.'">'.__( 'View all works', THEMEDOMAIN ).'</a>';
	}
	
	$return_html.= '</div>';
	
	//Get portfolios items
	$args = array(
	    'numberposts' => $items,
	    'order' => 'ASC',
	    'orderby' => 'menu_order',
	    'post_type' => array('portfolios'),
	);
	
	if(!empty($set_id))
	{
		$args['portfoliosets'] = $set_id;
	}
	
	$recent_portfolios_arr = get_posts($args);
	$custom_id = time().rand();
	
	if(!empty($recent_portfolios_arr))
	{
		$return_html.= '<div id="home_portfolio_'.$custom_id.'" class="home_portfolio three_fourth">';
		$return_html.= '<ul class="slides">';
	
		foreach($recent_portfolios_arr as $key => $recent_portfolio)
		{
			$column_class = 'one_third portfolio';
			
			if(empty($key) OR $key%3 == 0)
			{
				$return_html.= '<li>';
			}
			
			$portfolio_type = get_post_meta($recent_portfolio->ID, 'portfolio_type', true);
			$portfolio_video_id = get_post_meta($recent_portfolio->ID, 'portfolio_video_id', true);
			$portfolio_link_url = get_post_meta($recent_portfolio->ID, 'portfolio_link_url', true);
														
			if(empty($portfolio_link_url))
			{
			    $permalink_url = get_permalink($recent_portfolio->ID);
			}
			else
			{
			    $permalink_url = $portfolio_link_url;
			}
			
			$image_url = '';						
			if(has_post_thumbnail($recent_portfolio->ID, 'portfolio4'))
			{
			    $image_id = get_post_thumbnail_id($recent_portfolio->ID);
			    $image_url = wp_get_attachment_image_src($image_id, 'portfolio4', true);
			    $large_image_url = wp_get_attachment_image_src($image_id, 'original', true);
			}
			
			$return_html.= '<div class="'.$column_class.'">';
			
			switch($portfolio_type)
			{
				case 'External Link':
				default:
					$return_html.= '<div class="portfolio200_shadow">';
					$return_html.= '<a href="'.$permalink_url.'"><img src="'.$image_url[0].'" alt="" class="portfolio_img"/><div class="portfolio200_overlay">';
					$return_html.= '<div class="portfolio200_overlay_inner">
				    	        	<strong>'.$portfolio_item->post_title.'</strong>
				    	        	<hr/>
				    	        	'.pp_substr($recent_portfolio->post_excerpt, 160).'
				    	        	<div class="portfolio_type_wrapper">
				    	        		<img src="'.get_stylesheet_directory_uri().'/images/icon_link.png" alt="" class=""/>
				    	        	</div>
			    	            </div>';
					$return_html.= '</div></a></div>';
				break;
				// end external link
				
				case 'Portfolio Content':
				default:
					$return_html.= '<div class="portfolio200_shadow">';
					$return_html.= '<a href="'.get_permalink($recent_portfolio->ID).'"><img src="'.$image_url[0].'" alt="" class="portfolio_img"/><div class="portfolio200_overlay">';
					$return_html.= '<div class="portfolio200_overlay_inner">
				    	        	<strong>'.$recent_portfolio->post_title.'</strong>
				    	        	<hr/>
				    	        	'.pp_substr($recent_portfolio->post_excerpt, 160).'
				    	        	<div class="portfolio_type_wrapper">
				    	        		<img src="'.get_stylesheet_directory_uri().'/images/icon_link.png" alt="" class=""/>
				    	        	</div>
			    	            </div>';
					$return_html.= '</div></a></div>';
				break;
				// end portfolio content
				
				case 'Image':
					$return_html.= '<div class="portfolio200_shadow">';
					$return_html.= '<a href="'.$large_image_url[0].'" class="img_frame"><img src="'.$image_url[0].'" alt="" class="portfolio_img"/><div class="portfolio200_overlay">';
					$return_html.= '<div class="portfolio200_overlay_inner">
				    	        	<strong>'.$recent_portfolio->post_title.'</strong>
				    	        	<hr/>
				    	        	'.pp_substr($recent_portfolio->post_excerpt, 160).'
				    	        	<div class="portfolio_type_wrapper">
				    	        		<img src="'.get_stylesheet_directory_uri().'/images/icon_image.png" alt="" class=""/>
				    	        	</div>
			    	            </div>';
					$return_html.= '</div></a></div>';
				break;
				// end image
				
				case 'Youtube Video':
					$return_html.= '<div class="portfolio200_shadow">';
					$return_html.= '<a href="#video_'.$portfolio_video_id.'" class="lightbox_youtube"><img src="'.$image_url[0].'" alt="" class="portfolio_img"/><div class="portfolio200_overlay">';
					$return_html.= '<div class="portfolio200_overlay_inner">
				    	        	<strong>'.$recent_portfolio->post_title.'</strong>
				    	        	<hr/>
				    	        	'.pp_substr($recent_portfolio->post_excerpt, 160).'
				    	        	<div class="portfolio_type_wrapper">
				    	        		<img src="'.get_stylesheet_directory_uri().'/images/icon_video.png" alt="" class=""/>
				    	        	</div>
			    	            </div>';
					$return_html.= '</div></a></div>';
					
					$return_html.= '<div style="display:none;">
								    <div id="video_'.$portfolio_video_id.'" style="width:900px;height:488px"><iframe width="900" height="488" src="http://www.youtube.com/embed/'.$portfolio_video_id.'?theme=dark&amp;rel=0&amp;wmode=opaque" frameborder="0"></iframe></div>	
								</div>';
				break;
				// end youtube video
				
				case 'Vimeo Video':
					$return_html.= '<div class="portfolio200_shadow">';
					$return_html.= '<a href="#video_'.$portfolio_video_id.'" class="lightbox_vimeo"><img src="'.$image_url[0].'" alt="" class="portfolio_img"/><div class="portfolio200_overlay">';
					$return_html.= '<div class="portfolio200_overlay_inner">
				    	        	<strong>'.$recent_portfolio->post_title.'</strong>
				    	        	<hr/>
				    	        	'.pp_substr($recent_portfolio->post_excerpt, 160).'
				    	        	<div class="portfolio_type_wrapper">
				    	        		<img src="'.get_stylesheet_directory_uri().'/images/icon_video.png" alt="" class=""/>
				    	        	</div>
			    	            </div>';
					$return_html.= '</div></a></div>';
					
					$return_html.= '<div style="display:none;">
								    <div id="video_'.$portfolio_video_id.'" style="width:900px;height:506px"><iframe src="http://player.vimeo.com/video/'.$portfolio_video_id.'?title=0&amp;byline=0&amp;portrait=0" width="900" height="506" frameborder="0"></iframe></div>	
								</div>';
				break;
				// end vimeo video
				
				case 'Self-Hosted Video':
			    	        
			    	//Get video URL
			    	$portfolio_mp4_url = get_post_meta($recent_portfolio->ID, 'portfolio_mp4_url', true);
					$preview_image = wp_get_attachment_image_src($image_id, 'large', true);
					
					$return_html.= '<div class="portfolio200_shadow">';
					$return_html.= '<a href="#video_self_'.$key.'" class="lightbox_vimeo"><img src="'.$image_url[0].'" alt="" class="portfolio_img"/><div class="portfolio200_overlay">';
					$return_html.= '<div class="portfolio200_overlay_inner">
				    	        	<strong>'.$recent_portfolio->post_title.'</strong>
				    	        	<hr/>
				    	        	'.pp_substr($recent_portfolio->post_excerpt, 160).'
				    	        	<div class="portfolio_type_wrapper">
				    	        		<img src="'.get_stylesheet_directory_uri().'/images/icon_video.png" alt="" class=""/>
				    	        	</div>
			    	            </div>';
					$return_html.= '</div></a></div>';
					
					$return_html.= '<div style="display:none;">
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
			
			$return_html.= '</div>';
			
			if($key>0 && ($key+1)%3 == 0)
			{
				$return_html.= '</li>';
			}
		}
		
		$return_html.= '</ul></div>';
	}
	else
	{
		$return_html.= 'Empty portfolio item. Please make sure you have created it or check the short code.';
	}
	
	$return_html.= '</div><br class="clear"/>';
	
	if(!empty($recent_portfolios_arr))
	{
		$return_html.= '<script>
    	    $j("#home_portfolio_'.$custom_id.'").flexslider({
				animation: "slide",
				controlNav: true, 
				directionNav: false, 
				slideshowSpeed: '.$pause_time.'
			});
			</script>';
	}
	
	return $return_html;
}
add_shortcode('portfolio1', 'portfolio1_func');

function portfolio2_func($atts, $content) {
	remove_filter('the_content', 'pp_formatter', 99);

	//extract short code attr
	extract(shortcode_atts(array(
		'title' => 'Recent Portfolios',
		'items' => 8,
		'set_id' => '',
		'pause_time' => 10,
	), $atts));
	
	$pause_time = $pause_time * 1000;
	$content = trim($content);
	
	$args = array(
	    'numberposts' => $items,
	    'order' => 'ASC',
	    'orderby' => 'menu_order',
	    'post_type' => array('portfolios'),
	);
	
	if(!empty($set_id))
	{
		$args['portfoliosets'] = $set_id;
	}
	
	$recent_portfolios_arr = get_posts($args);
	$custom_id = time().rand();
	
	if(!empty($recent_portfolios_arr))
	{
		$return_html = '<h2><span>'.$title.'</span></h2><div class="divider" style="margin-top:20px;"></div><br class="clear"/>';
		$return_html.= '<div id="home_portfolio_'.$custom_id.'" class="portfolio2_wrapper">';
		$return_html.= '<ul class="slides">';
	
		foreach($recent_portfolios_arr as $key => $recent_portfolio)
		{
			if(($key+1)%4 == 0)
			{
				$column_class = 'one_fourth last';
			}
			else
			{
				$column_class = 'one_fourth';
			}
			
			$portfolio_type = get_post_meta($recent_portfolio->ID, 'portfolio_type', true);
			$portfolio_video_id = get_post_meta($recent_portfolio->ID, 'portfolio_video_id', true);
			$portfolio_link_url = get_post_meta($recent_portfolio->ID, 'portfolio_link_url', true);
														
			if(empty($portfolio_link_url))
			{
			    $permalink_url = get_permalink($recent_portfolio->ID);
			}
			else
			{
			    $permalink_url = $portfolio_link_url;
			}
			
			$image_url = '';						
			if(has_post_thumbnail($recent_portfolio->ID, 'portfolio4'))
			{
			    $image_id = get_post_thumbnail_id($recent_portfolio->ID);
			    $image_url = wp_get_attachment_image_src($image_id, 'portfolio4', true);
			    $full_image_url = wp_get_attachment_image_src($image_id, 'full', true);
			}
			
			if(empty($key) OR $key%4 == 0)
			{
				$return_html.= '<li>';
			}
			
			$return_html.= '<div class="'.$column_class.' css_shadow">';
			
			switch($portfolio_type)
			{
				case 'External Link':
				default:
					$return_html.= '<div class="portfolio200_shadow">';
					$return_html.= '<a href="'.$permalink_url.'"><img src="'.$image_url[0].'" alt="" class="portfolio_img"/><div class="portfolio200_overlay">';
					$return_html.= '<div class="portfolio200_overlay_inner">
				    	        	<strong>'.$portfolio_item->post_title.'</strong>
				    	        	<hr/>
				    	        	'.pp_substr($recent_portfolio->post_excerpt, 160).'
				    	        	<div class="portfolio_type_wrapper">
				    	        		<img src="'.get_stylesheet_directory_uri().'/images/icon_link.png" alt="" class=""/>
				    	        	</div>
			    	            </div>';
					$return_html.= '</div></a></div>';
				break;
				// end external link
				
				case 'Portfolio Content':
				default:
					$return_html.= '<div class="portfolio200_shadow">';
					$return_html.= '<a href="'.get_permalink($recent_portfolio->ID).'"><img src="'.$image_url[0].'" alt="" class="portfolio_img"/><div class="portfolio200_overlay">';
					$return_html.= '<div class="portfolio200_overlay_inner">
				    	        	<strong>'.$recent_portfolio->post_title.'</strong>
				    	        	<hr/>
				    	        	'.pp_substr($recent_portfolio->post_excerpt, 160).'
				    	        	<div class="portfolio_type_wrapper">
				    	        		<img src="'.get_stylesheet_directory_uri().'/images/icon_link.png" alt="" class=""/>
				    	        	</div>
			    	            </div>';
					$return_html.= '</div></a></div>';
				break;
				// end portfolio content
				
				case 'Image':
					$return_html.= '<div class="portfolio200_shadow">';
					$return_html.= '<a href="'.$large_image_url[0].'" class="img_frame"><img src="'.$image_url[0].'" alt="" class="portfolio_img"/><div class="portfolio200_overlay">';
					$return_html.= '<div class="portfolio200_overlay_inner">
				    	        	<strong>'.$recent_portfolio->post_title.'</strong>
				    	        	<hr/>
				    	        	'.pp_substr($recent_portfolio->post_excerpt, 160).'
				    	        	<div class="portfolio_type_wrapper">
				    	        		<img src="'.get_stylesheet_directory_uri().'/images/icon_image.png" alt="" class=""/>
				    	        	</div>
			    	            </div>';
					$return_html.= '</div></a></div>';
				break;
				// end image
				
				case 'Youtube Video':
					$return_html.= '<div class="portfolio200_shadow">';
					$return_html.= '<a href="#video_'.$portfolio_video_id.'" class="lightbox_youtube"><img src="'.$image_url[0].'" alt="" class="portfolio_img"/><div class="portfolio200_overlay">';
					$return_html.= '<div class="portfolio200_overlay_inner">
				    	        	<strong>'.$recent_portfolio->post_title.'</strong>
				    	        	<hr/>
				    	        	'.pp_substr($recent_portfolio->post_excerpt, 160).'
				    	        	<div class="portfolio_type_wrapper">
				    	        		<img src="'.get_stylesheet_directory_uri().'/images/icon_video.png" alt="" class=""/>
				    	        	</div>
			    	            </div>';
					$return_html.= '</div></a></div>';
					
					$return_html.= '<div style="display:none;">
								    <div id="video_'.$portfolio_video_id.'" style="width:900px;height:488px"><iframe width="900" height="488" src="http://www.youtube.com/embed/'.$portfolio_video_id.'?theme=dark&amp;rel=0&amp;wmode=opaque" frameborder="0"></iframe></div>	
								</div>';
				break;
				// end youtube video
				
				case 'Vimeo Video':
					$return_html.= '<div class="portfolio200_shadow">';
					$return_html.= '<a href="#video_'.$portfolio_video_id.'" class="lightbox_vimeo"><img src="'.$image_url[0].'" alt="" class="portfolio_img"/><div class="portfolio200_overlay">';
					$return_html.= '<div class="portfolio200_overlay_inner">
				    	        	<strong>'.$recent_portfolio->post_title.'</strong>
				    	        	<hr/>
				    	        	'.pp_substr($recent_portfolio->post_excerpt, 160).'
				    	        	<div class="portfolio_type_wrapper">
				    	        		<img src="'.get_stylesheet_directory_uri().'/images/icon_video.png" alt="" class=""/>
				    	        	</div>
			    	            </div>';
					$return_html.= '</div></a></div>';
					
					$return_html.= '<div style="display:none;">
								    <div id="video_'.$portfolio_video_id.'" style="width:900px;height:506px"><iframe src="http://player.vimeo.com/video/'.$portfolio_video_id.'?title=0&amp;byline=0&amp;portrait=0" width="900" height="506" frameborder="0"></iframe></div>	
								</div>';
				break;
				// end vimeo video
				
				case 'Self-Hosted Video':
			    	        
			    	//Get video URL
			    	$portfolio_mp4_url = get_post_meta($recent_portfolio->ID, 'portfolio_mp4_url', true);
					$preview_image = wp_get_attachment_image_src($image_id, 'large', true);
					
					$return_html.= '<div class="portfolio200_shadow">';
					$return_html.= '<a href="#video_self_'.$key.'" class="lightbox_vimeo"><img src="'.$image_url[0].'" alt="" class="portfolio_img"/><div class="portfolio200_overlay">';
					$return_html.= '<div class="portfolio200_overlay_inner">
				    	        	<strong>'.$recent_portfolio->post_title.'</strong>
				    	        	<hr/>
				    	        	'.pp_substr($recent_portfolio->post_excerpt, 160).'
				    	        	<div class="portfolio_type_wrapper">
				    	        		<img src="'.get_stylesheet_directory_uri().'/images/icon_video.png" alt="" class=""/>
				    	        	</div>
			    	            </div>';
					$return_html.= '</div></a></div>';
					
					$return_html.= '<div style="display:none;">
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
			
			$return_html.= '</div>';
			
			if($key>0 && ($key+1)%4 == 0)
			{
				$return_html.= '</li>';
			}
		}
		
		$return_html.= '</ul></div><br class="clear"/>';
	}
	else
	{
		$return_html.= 'Empty portfolio item. Please make sure you have created it or check the short code.<br class="clear"/>';
	}
	
	if(!empty($recent_portfolios_arr))
	{
		$return_html.= '
			<script>
    	    $j("#home_portfolio_'.$custom_id.'").flexslider({
				animation: "slide",
				controlNav: true,
				directionNav: false,
				slideshowSpeed: '.$pause_time.'
			});
			</script>
		';
	}
	
	return $return_html;
}
add_shortcode('portfolio2', 'portfolio2_func');


function img_reflect_left_func($atts, $content) {
	remove_filter('the_content', 'pp_formatter', 99);

	//extract short code attr
	extract(shortcode_atts(array(
		'src' => '',
	), $atts));
	
	$return_html = '<div class="alignleft">';
	$return_html.= '<img src="'.$src.'" alt="" class="reflection"/>';
	$return_html.= '</div>';
	
	return $return_html;
}
add_shortcode('img_reflect_left', 'img_reflect_left_func');


function img_reflect_right_func($atts, $content) {
	remove_filter('the_content', 'pp_formatter', 99);

	//extract short code attr
	extract(shortcode_atts(array(
		'src' => '',
	), $atts));
	
	$return_html = '<div class="alignright">';
	$return_html.= '<img src="'.$src.'" alt="" class="reflection"/>';
	$return_html.= '</div>';
	
	return $return_html;
}
add_shortcode('img_reflect_right', 'img_reflect_right_func');


function img_reflect_center_func($atts, $content) {
	remove_filter('the_content', 'pp_formatter', 99);

	//extract short code attr
	extract(shortcode_atts(array(
		'src' => '',
		'href' => '',
	), $atts));
	
	$return_html = '<div class="aligncenter">';
	$return_html.= '<img src="'.$src.'" alt="" class="reflection"/>';
	$return_html.= '</div>';
	
	return $return_html;
}
add_shortcode('img_reflect_center', 'img_reflect_center_func');

function divider_func($atts, $content) {
	remove_filter('the_content', 'pp_formatter', 99);

	//extract short code attr
	extract(shortcode_atts(array(
		'width' => '',
	), $atts));
	
	$return_html.= '<br class="clear"/><div class="divider"></div><hr/>';
	
	return $return_html;
}
add_shortcode('divider', 'divider_func');


function service1_func($atts, $content) {
	remove_filter('the_content', 'pp_formatter', 99);

	//extract short code attr
	extract(shortcode_atts(array(
		'items' => 4,
		'new_line' => 1,
	), $atts));
	
	//Get service items
	$args = array(
	    'numberposts' => $items,
	    'order' => 'ASC',
	    'orderby' => 'menu_order',
	    'post_type' => array('services'),
	);
	
	$services_arr = get_posts($args);
	
	if(!empty($services_arr))
	{
		foreach($services_arr as $key => $service)
		{
			$image_url = '';						
			if(has_post_thumbnail($service->ID, 'full'))
			{
			    $image_id = get_post_thumbnail_id($service->ID);
			    $image_url = wp_get_attachment_image_src($image_id, 'full', true);
			}
		
			if(($key+1)%4 == 0)
			{
				$column_class = 'one_fourth last margintop10';
			}
			else
			{
				$column_class = 'one_fourth margintop10';
			}
			
			$return_html.= '<div class="'.$column_class.'">';
			$return_html.= '<img src="'.$image_url[0].'" class="alignleft"/><h5>'.$service->post_title.'</h5>';
			$return_html.= $service->post_content;
			$return_html.= '</div>';
		}
	}
	else
	{
		$return_html.= 'Empty service item. Please make sure you have created it or check the short code.';
	}
	
	if(!empty($new_line))
	{
		$return_html.= '<br class="clear"/><br/><br/>';
	}
	
	return $return_html;
}
add_shortcode('service1', 'service1_func');

function service2_func($atts, $content) {
	remove_filter('the_content', 'pp_formatter', 99);

	//extract short code attr
	extract(shortcode_atts(array(
		'items' => 3,
		'new_line' => 1,
	), $atts));
	
	//Get service items
	$args = array(
	    'numberposts' => $items,
	    'order' => 'ASC',
	    'orderby' => 'menu_order',
	    'post_type' => array('services'),
	);
	
	$services_arr = get_posts($args);
	
	if(!empty($services_arr))
	{
		foreach($services_arr as $key => $service)
		{
			$image_url = '';						
			if(has_post_thumbnail($service->ID, 'full'))
			{
			    $image_id = get_post_thumbnail_id($service->ID);
			    $image_url = wp_get_attachment_image_src($image_id, 'full', true);
			}
		
			if(($key+1)%3 == 0)
			{
				$column_class = 'one_third last margintop10';
			}
			else
			{
				$column_class = 'one_third margintop10';
			}
			
			$return_html.= '<div class="'.$column_class.'">';
			$return_html.= '<img src="'.$image_url[0].'" class="alignleft"/><h5>'.$service->post_title.'</h5>';
			$return_html.= $service->post_content;
			
			if(($key+1)%3!=0)
			{
				$return_html.= '</div>';
			}
			else
			{
				$return_html.= '</div><br class="clear"/><br/><br/>';
			}
		}
	}
	else
	{
		$return_html.= 'Empty service item. Please make sure you have created it or check the short code.';
	}
	
	return $return_html;
}
add_shortcode('service2', 'service2_func');

function gallery_func($atts, $content) {
	remove_filter('the_content', 'pp_formatter', 99);

	//extract short code attr
	extract(shortcode_atts(array(
		'id' => '',
		'width' => 205,
		'height' => 205,
	), $atts));
	
	//Get service items
	$args = array( 
        'post_type' => 'attachment', 
        'numberposts' => -1, 
        'post_status' => null, 
        'post_parent' => $id,
        'order' => 'ASC',
        'orderby' => 'menu_order',
    );
	
	$images_arr = get_posts($args);
	
	if(!empty($images_arr))
	{
		foreach($images_arr as $key => $image)
		{
			$image_url = $image->guid;
			
			$return_html.= '<div style="float:left;margin-right:20px;margin-bottom:20px">';
			$return_html.= '<a rel="gallery" href="'.$image_url.'">';
			$return_html.= '<img src="'.get_bloginfo( 'stylesheet_directory' ).'/timthumb.php?src='.$image_url.'&amp;h='.$height.'&amp;w='.$width.'&amp;zc=1" alt="" class="img_shadow"/>';
			$return_html.= '</a>';
			$return_html.= '</div>';
		}
	}
	else
	{
		$return_html.= 'Empty gallery item. Please make sure you have upload image to it or check the short code.';
	}
	
	$return_html.= '<br class="clear"/>';
	
	return $return_html;
}
add_shortcode('gallery', 'gallery_func');

?>