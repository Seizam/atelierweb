<?php

function post_type_slides() {
	$labels = array(
    	'name' => _x('Slides', 'post type general name'),
    	'singular_name' => _x('Slide', 'post type singular name'),
    	'add_new' => _x('Add New Slide', 'book'),
    	'add_new_item' => __('Add New Slide'),
    	'edit_item' => __('Edit Slide'),
    	'new_item' => __('New Slide'),
    	'view_item' => __('View Slide'),
    	'search_items' => __('Search Slides'),
    	'not_found' =>  __('No slide found'),
    	'not_found_in_trash' => __('No slides found in Trash'), 
    	'parent_item_colon' => ''
	);		
	$args = array(
    	'labels' => $labels,
    	'public' => true,
    	'publicly_queryable' => true,
    	'show_ui' => true, 
    	'query_var' => true,
    	'rewrite' => true,
    	'capability_type' => 'post',
    	'hierarchical' => false,
    	'menu_position' => null,
    	'supports' => array('title','editor', 'thumbnail'),
    	'menu_icon' => get_stylesheet_directory_uri().'/functions/images/screen.png'
	); 		

	register_post_type( 'slides', $args );
}
add_action('init', 'post_type_slides');

function post_type_portfolios() {
	$labels = array(
    	'name' => _x('Portfolios', 'post type general name'),
    	'singular_name' => _x('Portfolio', 'post type singular name'),
    	'add_new' => _x('Add New Portfolio', 'book'),
    	'add_new_item' => __('Add New Portfolio'),
    	'edit_item' => __('Edit Portfolio'),
    	'new_item' => __('New Portfolio'),
    	'view_item' => __('View Portfolio'),
    	'search_items' => __('Search Portfolios'),
    	'not_found' =>  __('No Portfolio found'),
    	'not_found_in_trash' => __('No Portfolio found in Trash'), 
    	'parent_item_colon' => ''
	);		
	$args = array(
    	'labels' => $labels,
    	'public' => true,
    	'publicly_queryable' => true,
    	'show_ui' => true, 
    	'query_var' => true,
    	'rewrite' => true,
    	'capability_type' => 'post',
    	'hierarchical' => false,
    	'menu_position' => null,
    	'supports' => array('title','editor', 'thumbnail', 'excerpt'),
    	'menu_icon' => get_stylesheet_directory_uri().'/functions/images/sign.png'
	); 		

	register_post_type( 'portfolios', $args );
	
  	$labels = array(			  
  	  'name' => _x( 'Sets', 'taxonomy general name' ),
  	  'singular_name' => _x( 'Set', 'taxonomy singular name' ),
  	  'search_items' =>  __( 'Search Sets' ),
  	  'all_items' => __( 'All Sets' ),
  	  'parent_item' => __( 'Parent Set' ),
  	  'parent_item_colon' => __( 'Parent Set:' ),
  	  'edit_item' => __( 'Edit Set' ), 
  	  'update_item' => __( 'Update Set' ),
  	  'add_new_item' => __( 'Add New Set' ),
  	  'new_item_name' => __( 'New Set Name' ),
  	); 							  
  	
  	register_taxonomy(
		'portfoliosets',
		'portfolios',
		array(
			'public'=>true,
			'hierarchical' => true,
			'labels'=> $labels,
			'query_var' => 'portfoliosets',
			'show_ui' => true,
			'rewrite' => array( 'slug' => 'portfoliosets', 'with_front' => false ),
		)
	);					  
} 
								  
add_action('init', 'post_type_portfolios');

function post_type_services() {
	$labels = array(
    	'name' => _x('Services', 'post type general name'),
    	'singular_name' => _x('Service', 'post type singular name'),
    	'add_new' => _x('Add New Service', 'book'),
    	'add_new_item' => __('Add New Service'),
    	'edit_item' => __('Edit Service'),
    	'new_item' => __('New Service'),
    	'view_item' => __('View Service'),
    	'search_items' => __('Search Services'),
    	'not_found' =>  __('No Service found'),
    	'not_found_in_trash' => __('No Service found in Trash'), 
    	'parent_item_colon' => ''
	);		
	$args = array(
    	'labels' => $labels,
    	'public' => true,
    	'publicly_queryable' => true,
    	'show_ui' => true, 
    	'query_var' => true,
    	'rewrite' => true,
    	'capability_type' => 'post',
    	'hierarchical' => false,
    	'menu_position' => null,
    	'supports' => array('title','editor', 'thumbnail'),
    	'menu_icon' => get_stylesheet_directory_uri().'/functions/images/sign.png'
	); 		

	register_post_type( 'services', $args );			  
} 
								  
add_action('init', 'post_type_services');


add_filter( 'manage_posts_columns', 'rt_add_gravatar_col');
function rt_add_gravatar_col($cols) {
	$cols['thumbnail'] = __('Thumbnail');
	return $cols;
}

add_action( 'manage_posts_custom_column', 'rt_get_author_gravatar');
function rt_get_author_gravatar($column_name ) {
	if ( $column_name  == 'thumbnail'  ) {
		echo get_the_post_thumbnail(get_the_ID(), array(100, 100));
	}
}

/*
	Begin creating custom fields
*/

$args = array(
    'numberposts' => -1,
    'post_type' => array('gallery'),
);

$galleries_arr = get_posts($args);
$galleries_select = array();
$galleries_select['(display featured image instead)'] = '';

foreach($galleries_arr as $gallery)
{
	$galleries_select[$gallery->post_title] = $gallery->ID;
}


$pp_seo_enable = get_option('pp_seo_enable');
if(!empty($pp_seo_enable))
{
	$postmetas = 
		array (
			
			'post' => array(
				
				/*
				    Begin Post custom fields
				*/
				array("section" => "SEO Option", "id" => "post_seo_title", "title" => "SEO Post Title", "description" => "Enter custom SEO title for this post"),
				array("section" => "SEO Option", "id" => "post_seo_keyword", "type" => "textarea", "title" => "SEO Meta Keyword", "description" => "Enter custom SEO meta keyword for this post"),
				array("section" => "SEO Option", "id" => "post_seo_desc", "type" => "textarea", "title" => "SEO Meta Description", "description" => "Enter custom SEO meta description for this post"),
		
				/*
				    End Post custom fields
				*/
			),
			'slides' => array(
			
				/*
				    Begin Slide Source custom fields
				*/
				
				array("section" => "Content Type", "id" => "slide_type", "type" => "select", "title" => "Content Type", "description" => "Select content type for this portfolio item", 
				"items" => array(
					"(no content type selected)" => "",
					"Image" => "Image", 
					"Youtube Video" => "Youtube Video", 
					"Vimeo Video" => "Vimeo Video", 
					"Self-Hosted Video" => "Self-Hosted Video",
				)),
				
				array("section" => "Content Type", "id" => "slide_video_id", "hide" => TRUE, "title" => "Video ID", "description" => "Enter your Youtube or Vimeo Video ID ex. OOr6dB8jnvE (Youtube), 37157187 (Vimeo)"),
				
				array("section" => "Content Type", "id" => "slide_mp4_url", "hide" => TRUE, "title" => "Video URL", "description" => "If you select Self-Hosted. Enter your video URL (.mp4 or .flv file format):"),
				
				array("section" => "Slide's link", "id" => "gallery_link_url", "hide" => TRUE, "title" => "Hyperlink URL", "description" => "Enter site, page, post URL when user click on slide. It will direct to this URL"),
				
				array("section" => "Display slide title and description", "hide" => TRUE, "id" => "slide_display_content", "type" => "select", "title" => "Display slide title and description", "description" => "Select how to display slide's title and description, or hide its title and description", 
				"items" => array(
					"(hide title and description)" => "",
					"Display Left" => "Display Left", 
					"Display Right" => "Display Right", 
				)),
				
				array("section" => "Slide image alt", "id" => "slide_img_alt", "hide" => TRUE, "title" => "SEO image alt tag", "description" => "Enter slide image alt tag to optimize SEO on your homepage"),
			
				/*
				    End Slide Source custom fields
				*/
			),
			
			'portfolios' => array(
				
				array("section" => "Content Type", "id" => "portfolio_type", "type" => "select", "title" => "Portfolio Content Type", "description" => "Select content type for this portfolio item", 
				"items" => array(
					"(no content type selected)" => "",
					"Image" => "Image", 
					"Youtube Video" => "Youtube Video", 
					"Vimeo Video" => "Vimeo Video", 
					"Self-Hosted Video" => "Self-Hosted Video",
					"Portfolio Content" => "Portfolio Content",
					"AJAX Portfolio Content" => "AJAX Portfolio Content",
					"External Link" => "External Link",
				)),
				
				array("section" => "Content Type", "id" => "portfolio_video_id", "title" => "Video ID (for Youtube or Vimeo video content type only)", "description" => "Enter your Youtube or Vimeo Video ID ex. OOr6dB8jnvE (Youtube), 37157187 (Vimeo)"),
				
				array("section" => "Content Type", "id" => "portfolio_mp4_url", "title" => "Video URL (for Self-Hosted video content type only)", "description" => "If you select Self-Hosted. Enter your video URL (.mp4 or .flv file format):"),
				
				array("section" => "Content Type", "id" => "portfolio_link_url", "title" => "Link URL (for external link content type only)", "description" => "Portfolio item will link to this URL instead of its content"),
				
				array("section" => "Content Type", "id" => "portfolio_gallery_id", "type" => "select", "title" => "Image Gallery (for portfolio content type only)", "description" => "If you select \"Portfolio Content\" you can select image gallery to display on single portfolio page or display featured image instead", "items" => $galleries_select),
			),
			
	);		
}
else
{
	$postmetas = 
		array (
			
			'post' => array(),
			
			'slides' => array(
			
				/*
				    Begin Slide Source custom fields
				*/
				
				array("section" => "Content Type", "id" => "slide_type", "type" => "select", "title" => "Content Type", "description" => "Select content type for this portfolio item", 
				"items" => array(
					"(no content type selected)" => "",
					"Image" => "Image", 
					"Youtube Video" => "Youtube Video", 
					"Vimeo Video" => "Vimeo Video", 
					"Self-Hosted Video" => "Self-Hosted Video",
				)),
				
				array("section" => "Content Type", "id" => "slide_video_id", "hide" => TRUE, "title" => "Video ID", "description" => "Enter your Youtube or Vimeo Video ID ex. OOr6dB8jnvE (Youtube), 37157187 (Vimeo)"),
				
				array("section" => "Content Type", "id" => "slide_mp4_url", "hide" => TRUE, "title" => "Video URL", "description" => "If you select Self-Hosted. Enter your video URL (.mp4 or .flv file format):"),
				
				array("section" => "Slide's link", "id" => "gallery_link_url", "hide" => TRUE, "title" => "Hyperlink URL", "description" => "Enter site, page, post URL when user click on slide. It will direct to this URL"),
				
				array("section" => "Display slide title and description", "hide" => TRUE, "id" => "slide_display_content", "type" => "select", "title" => "Display slide title and description", "description" => "Select how to display slide's title and description, or hide its title and description", 
				"items" => array(
					"(hide title and description)" => "",
					"Display Left" => "Display Left", 
					"Display Right" => "Display Right", 
				)),
				
				array("section" => "Slide image alt", "id" => "slide_img_alt", "hide" => TRUE, "title" => "SEO image alt tag", "description" => "Enter slide image alt tag to optimize SEO on your homepage"),
			
				/*
				    End Slide Source custom fields
				*/
			),
			
			'portfolios' => array(
				
				array("section" => "Content Type", "id" => "portfolio_type", "type" => "select", "title" => "Portfolio Content Type", "description" => "Select content type for this portfolio item", 
				"items" => array(
					"(no content type selected)" => "",
					"Image" => "Image", 
					"Youtube Video" => "Youtube Video", 
					"Vimeo Video" => "Vimeo Video", 
					"Self-Hosted Video" => "Self-Hosted Video",
					"Portfolio Content" => "Portfolio Content",
					"AJAX Portfolio Content" => "AJAX Portfolio Content",
					"External Link" => "External Link",
				)),
				
				array("section" => "Content Type", "id" => "portfolio_video_id", "hide" => TRUE, "title" => "Video ID", "description" => "Enter your Youtube or Vimeo Video ID ex. OOr6dB8jnvE (Youtube), 37157187 (Vimeo)"),
				
				array("section" => "Content Type", "id" => "portfolio_mp4_url", "hide" => TRUE, "title" => "Video URL", "description" => "If you select Self-Hosted. Enter your video URL (.mp4 or .flv file format):"),
				
				array("section" => "Content Type", "id" => "portfolio_link_url", "hide" => TRUE, "title" => "Link URL", "description" => "Portfolio item will link to this URL instead of its content"),
				
				array("section" => "Content Type", "id" => "portfolio_gallery_id", "hide" => TRUE, "type" => "select", "title" => "Image Gallery", "description" => "If you select \"Portfolio Content\" you can select image gallery to display on single portfolio page or display featured image instead", "items" => $galleries_select),
			),
	);
}

/*print '<pre>';
print_r($post_obj);
print '</pre>';*/

function create_meta_box() {

	global $postmetas;
	
	if(!isset($_GET['post_type']) OR empty($_GET['post_type']))
	{
		if(isset($_GET['post']) && !empty($_GET['post']))
		{
			$post_obj = get_post($_GET['post']);
			$_GET['post_type'] = $post_obj->post_type;
		}
		else
		{
			$_GET['post_type'] = 'post';
		}
	}
	
	if ( function_exists('add_meta_box') && isset($postmetas) && count($postmetas) > 0 ) {  
		foreach($postmetas as $key => $postmeta)
		{
			if($_GET['post_type']==$key && !empty($postmeta))
			{
				add_meta_box( 'metabox', ucfirst($key).' Options', 'new_meta_box', $key, 'side', 'high' );  
			}
		}
	}

}  

function new_meta_box() {
	global $post, $postmetas;
	
	if(!isset($_GET['post_type']) OR empty($_GET['post_type']))
	{
		if(isset($_GET['post']) && !empty($_GET['post']))
		{
			$post_obj = get_post($_GET['post']);
			$_GET['post_type'] = $post_obj->post_type;
		}
		else
		{
			$_GET['post_type'] = 'post';
		}
	}

	echo '<input type="hidden" name="myplugin_noncename" id="myplugin_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	$meta_section = '';

	foreach ( $postmetas as $key => $postmeta ) {
	
		if($_GET['post_type'] == $key)
		{
		
			foreach ( $postmeta as $each_meta ) {
		
				$meta_id = $each_meta['id'];
				$meta_title = $each_meta['title'];
				$meta_description = $each_meta['description'];
				$meta_section = $postmeta['section'];
				$meta_hide = $each_meta['hide'];
				
				$meta_style = '';
				if($meta_hide)
				{
					$meta_style = 'style="display:none" class="meta_wrapper"';
				}
				
				$meta_type = '';
				if(isset($each_meta['type']))
				{
					$meta_type = $each_meta['type'];
				}
				
				echo '<div id="'.$meta_id.'_wrapper" '.$meta_style.'>';
				echo "<br/><strong>".$meta_title."</strong><hr class='pp_widget_hr'/>";
				echo "<div class='pp_widget_description'>$meta_description</div>";
				
				if ($meta_type == 'checkbox') {
					$checked = get_post_meta($post->ID, $meta_id, true) == '1' ? "checked" : "";
					echo "<input type='checkbox' name='$meta_id' id='$meta_id' value='1' $checked /></p>";
				}
				else if ($meta_type == 'select') {
					echo "<p><select name='$meta_id' id='$meta_id'>";
					
					if(!empty($each_meta['items']))
					{
						foreach ($each_meta['items'] as $key => $item)
						{
							echo '<option value="'.$item.'"';
							
							if($item == get_post_meta($post->ID, $meta_id, true))
							{
								echo ' selected ';
							}
							
							echo '>'.$key.'</option>';
						}
					}
					
					echo "</select></p>";
					echo "<script>";
					echo "jQuery(document).ready(function(){";
					echo "jQuery('#".$meta_id."').change();";
					echo "});";
					echo "</script>";
				}
				else if ($meta_type == 'textarea') {
					echo "<p><textarea name='$meta_id' id='$meta_id' class='code' style='width:100%' rows='7'>".get_post_meta($post->ID, $meta_id, true)."</textarea></p>";
				}			
				else {
					echo "<p><input type='text' name='$meta_id' id='$meta_id' class='code' value='".get_post_meta($post->ID, $meta_id, true)."' style='width:99%' /></p>";
				}
				
				echo '</div>';
			}
		}
	}

}

function save_postdata( $post_id ) {

	global $postmetas;

	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times

	if ( isset($_POST['myplugin_noncename']) && !wp_verify_nonce( $_POST['myplugin_noncename'], plugin_basename(__FILE__) )) {
		return $post_id;
	}

	// verify if this is an auto save routine. If it is our form has not been submitted, so we dont want to do anything

	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;

	// Check permissions

	if ( isset($_POST['post_type']) && 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) )
			return $post_id;
		} else {
		if ( !current_user_can( 'edit_post', $post_id ) )
			return $post_id;
	}

	// OK, we're authenticated

	if ( $parent_id = wp_is_post_revision($post_id) )
	{
		$post_id = $parent_id;
	}
	
	foreach ( $postmetas as $postmeta ) {
		foreach ( $postmeta as $each_meta ) {
	
			if ($_POST[$each_meta['id']]) {
				update_custom_meta($post_id, $_POST[$each_meta['id']], $each_meta['id']);
			}
			
			if ($_POST[$each_meta['id']] == "") {
				delete_post_meta($post_id, $each_meta['id']);
			}
		
		}
	}

}

function update_custom_meta($postID, $newvalue, $field_name) {

	if (!get_post_meta($postID, $field_name)) {
		add_post_meta($postID, $field_name, $newvalue);
	} else {
		update_post_meta($postID, $field_name, $newvalue);
	}

}

//init

add_action('admin_menu', 'create_meta_box'); 
add_action('save_post', 'save_postdata'); 

/*
	End creating custom fields
*/

?>