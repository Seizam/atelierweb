<?php
/*
	Begin creating admin options
*/

$themename = THEMENAME;
$shortname = SHORTNAME;

$pp_slider_items = get_option('pp_slider_items');
if(empty($pp_slider_items))
{
	$pp_slider_items = 5;
}

$slides = get_posts(array(
	'post_type' => 'slides',
	'numberposts' => $pp_slider_items,
));
$wp_slides = array(
	0		=> "Choose a slide"
);
foreach ($slides as $slide_list ) {
       $wp_slides[$slide_list->ID] = $slide_list->post_title;
}

$categories = get_categories('hide_empty=0&orderby=name');
$wp_cats = array(
	0		=> "Choose a category"
);
foreach ($categories as $category_list ) {
       $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
}

$pages = get_pages(array('parent' => -1));
$wp_pages = array(
	0		=> "Choose a page",
);
foreach ($pages as $page_list ) {
	$template_name = get_post_meta( $page_list->ID, '_wp_page_template', true );
	
	//exclude contact template
	if($template_name != 'contact.php')
	{
       $wp_pages[$page_list->ID] = $page_list->post_title;
    }
}

$pp_handle = opendir(TEMPLATEPATH.'/fonts');
$pp_font_arr = array();

while (false!==($pp_file = readdir($pp_handle))) {
	if ($pp_file != "." && $pp_file != ".." && $pp_file != ".DS_Store") {
		$pp_file_name = basename($pp_file, '.js');
		
		if($pp_file_name != 'Quicksand_300.font')
		{
			$pp_name = explode('_', $pp_file_name);
		
			$pp_font_arr[$pp_file_name] = $pp_file_name;
		}
	}
}
closedir($pp_handle);
asort($pp_font_arr);


$api_url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];


$options = array (
 
//Begin admin header
array( 
		"name" => $themename." Options",
		"type" => "title"
),
//End admin header


//Begin first tab "General"
array( 
		"name" => "General",
		"type" => "section",
		"icon" => "gear.png",
)
,

array( "type" => "open"),

array( "name" => "<h2>Website Identity</h2>Custom Logo",
	"desc" => "Choose an image that you want to use as the logo in header",
	"id" => $shortname."_logo",
	"type" => "image",
	"std" => "",
),

array( "name" => "Logo Position from the Top (in pixels)",
	"desc" => "",
	"id" => $shortname."_logo_margin_top",
	"type" => "jslider",
	"size" => "40px",
	"std" => "0",
	"from" => 0,
	"to" => 200,
	"step" => 1,
),

array( "name" => "Custom Favicon",
	"desc" => "A favicon is a 16x16 pixel icon that represents your site; paste the URL to a .ico image that you want to use as the image",
	"id" => $shortname."_favicon",
	"type" => "image",
	"std" => "",
),

array( "name" => "<h2>Main Menu Settings</h2>Main Menu Position from the Top (in pixels)",
	"desc" => "",
	"id" => $shortname."_menu_margin_top",
	"type" => "jslider",
	"size" => "40px",
	"std" => "40",
	"from" => 0,
	"to" => 200,
	"step" => 1,
),

array( "name" => "<h2>Advanced Settings</h2>Google Analytics Domain ID ",
	"desc" => "Get analytics on your site. Simply give us your Google Analytics code",
	"id" => $shortname."_ga_code",
	"type" => "textarea",
	"std" => ""

),

array( "name" => "Custom CSS",
	"desc" => "You can add your custom CSS here",
	"id" => $shortname."_custom_css",
	"type" => "textarea",
	"std" => ""

),
	
array( "type" => "close"),
//End first tab "General"


//Begin first tab "General"
array( 
		"name" => "Skins",
		"type" => "section",
		"icon" => "color-swatch.png",
),

array( "type" => "open"),

array( "name" => "Save current settings as Skin",
	"desc" => "Skin manager helps you save all settings (except homepage, contact fields and advanced settings) to a skin so you can easily enable it later. Below are your current available skins.",
	"id" => $shortname."_skin",
	"type" => "skin",
	"std" => ""
),
	
array( "type" => "close"),
//End first tab "Skins"


//Begin first tab "Font"
array( 
		"name" => "Font",
		"type" => "section",
		"icon" => "edit.png",
)
,

array( "type" => "open"),

array( "name" => "<h2>Body Font Settings</h2>Body Font Size (in pixels)",
	"desc" => "",
	"id" => $shortname."_body_font_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "12",
	"from" => 12,
	"to" => 24,
	"step" => 1,
),
array( "name" => "<h2>Main Menu Font Settings</h2>Main Menu Font Size (in pixels)",
	"desc" => "",
	"id" => $shortname."_menu_font_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "12",
	"from" => 11,
	"to" => 24,
	"step" => 1,
),
array( "name" => "Sub Main Menu Font Size (in pixels)",
	"desc" => "",
	"id" => $shortname."_submenu_font_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "12",
	"from" => 11,
	"to" => 24,
	"step" => 1,
),
array( "name" => "Enable/disable Main Menu text uppercase",
	"desc" => "",
	"id" => $shortname."_menu_uppercase",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "<h2>Header Font Settings</h2>Header Font (using Google Webfonts API)",
	"desc" => "Select font style your header",
	"id" => $shortname."_font",
	"type" => "font",
	"options" => $pp_font_arr,
	"std" => ''
),
array( "name" => "Page Header Font Size (in pixels)",
	"desc" => "",
	"id" => $shortname."_page_header_font_size",
	"type" => "jslider",
	"size" => "72px",
	"std" => "72",
	"from" => 20,
	"to" => 72,
	"step" => 1,
),
array( "name" => "Page Description Font Size (in pixels)",
	"desc" => "",
	"id" => $shortname."_page_desc_font_size",
	"type" => "jslider",
	"size" => "72px",
	"std" => "18",
	"from" => 18,
	"to" => 24,
	"step" => 1,
),
array( "name" => "Footer Header Font Size (in pixels)",
	"desc" => "",
	"id" => $shortname."_footer_header_font_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "14",
	"from" => 11,
	"to" => 32,
	"step" => 1,
),
array( "name" => "Sidebar Header Font Size (in pixels)",
	"desc" => "",
	"id" => $shortname."_sidebar_header_font_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "14",
	"from" => 11,
	"to" => 32,
	"step" => 1,
),
array( "name" => "Blog post title Font Size (in pixels)",
	"desc" => "",
	"id" => $shortname."_post_title_font_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "26",
	"from" => 12,
	"to" => 32,
	"step" => 1,
),
array( "name" => "H1 Size (in pixels)",
	"desc" => "",
	"id" => $shortname."_h1_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "40",
	"from" => 13,
	"to" => 60,
	"step" => 1,
),
array( "name" => "H2 Size (in pixels)",
	"desc" => "",
	"id" => $shortname."_h2_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "30",
	"from" => 13,
	"to" => 60,
	"step" => 1,
),
array( "name" => "H3 Size (in pixels)",
	"desc" => "",
	"id" => $shortname."_h3_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "26",
	"from" => 13,
	"to" => 60,
	"step" => 1,
),
array( "name" => "H4 Size (in pixels)",
	"desc" => "",
	"id" => $shortname."_h4_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "24",
	"from" => 13,
	"to" => 60,
	"step" => 1,
),
array( "name" => "H5 Size (in pixels)",
	"desc" => "",
	"id" => $shortname."_h5_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "20",
	"from" => 13,
	"to" => 60,
	"step" => 1,
),
array( "name" => "H6 Size (in pixels)",
	"desc" => "",
	"id" => $shortname."_h6_size",
	"type" => "jslider",
	"size" => "40px",
	"std" => "14",
	"from" => 13,
	"to" => 60,
	"step" => 1,
),
	
array( "type" => "close"),
//End first tab "Font"


//Begin first tab "Colors"
array( 
		"name" => "Custom-Colors",
		"type" => "section",
		"icon" => "color.png",
)
,

array( "type" => "open"),

array( "name" => "<h2>General Text and Link Colors</h2>Font Color",
	"desc" => "Select color for the font",
	"id" => $shortname."_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#666666"
),

array( "name" => "Link Color",
	"desc" => "Select color for the link",
	"id" => $shortname."_link_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ef3b24"
),

array( "name" => "Hover Link Color",
	"desc" => "Select color for the hover link",
	"id" => $shortname."_hover_link_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#183243"
),

array( "name" => "Active Link Color",
	"desc" => "Select color for the hover link",
	"id" => $shortname."_active_link_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#183243"
),

array( "name" => "Header Tags Font Color",
	"desc" => "Select color for the H1, H2, H3, H4, H5, H6",
	"id" => $shortname."_h1_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#183243"
),

array( "name" => "<h2>Top Sections Colors</h2>Top Background Color",
	"desc" => "Select color for the Header",
	"id" => $shortname."_header_bg",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#8AB2BA"
),

array( "name" => "Main Menu Link Color",
	"desc" => "Select color for the main menu",
	"id" => $shortname."_menu_link_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#666666"
),

array( "name" => "Main Menu Hover Link Color",
	"desc" => "",
	"id" => $shortname."_menu_link_hover_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "Main Menu Hover Border Color",
	"desc" => "",
	"id" => $shortname."_menu_link_hover_border_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ef3b24"
),

array( "name" => "Main Menu Active Link Color",
	"desc" => "",
	"id" => $shortname."_menu_link_active_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "Sub Menu Background Color",
	"desc" => "Select background color for the submenu",
	"id" => $shortname."_submenu_bg",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "Sub Menu Link Color",
	"desc" => "Select link color for the submenu",
	"id" => $shortname."_submenu_link_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#999999"
),

array( "name" => "Sub Menu Link Hover Color",
	"desc" => "Select link hover state color for the submenu",
	"id" => $shortname."_submenu_hover_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#183243"
),

array( "name" => "Sub Menu Link Border Color",
	"desc" => "Select border color for the submenu",
	"id" => $shortname."_submenu_border_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#EFEFEF"
),

array( "name" => "<h2>Midsections Colors</h2>Slider Caption Header Background Color",
	"desc" => "Select background color for the slide caption header",
	"id" => $shortname."_slider_caption_header_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#8AB2BA"
),

array( "name" => "Slider Caption Header Font Color",
	"desc" => "Select font color for the slide caption header",
	"id" => $shortname."_slider_caption_header_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#8AB2BA"
),

array( "name" => "Portfolio Item Background Color",
	"desc" => "Select color for the portfolio item wrapper background",
	"id" => $shortname."_portfolio_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#EF3B24"
),

array( "name" => "Portfolio Item Font Color",
	"desc" => "Select color for the portfolio item text",
	"id" => $shortname."_portfolio_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "Blog Post Title Font Color",
	"desc" => "Select font color for the blog post title",
	"id" => $shortname."_blog_title_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#000000"
),

array( "name" => "Blog Post Date Background Color",
	"desc" => "Select background color for the blog post date",
	"id" => $shortname."_blog_date_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ef3b24"
),

array( "name" => "Blog Post Date Font Color",
	"desc" => "Select font color for the blog post date",
	"id" => $shortname."_blog_date_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "Widget Background Color",
	"desc" => "Select background color for the widget",
	"id" => $shortname."_widget_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#f9f9f9"
),

array( "name" => "Widget Border Color",
	"desc" => "Select border color for the widget",
	"id" => $shortname."_widget_border_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "Widget Title Border Color",
	"desc" => "Select border color for the widget title",
	"id" => $shortname."_widget_title_border_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#E5E5E5"
),

array( "name" => "Dropcap Background Color",
	"desc" => "Select background color for the dropcap shortcode",
	"id" => $shortname."_dropcap_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#000000"
),

array( "name" => "Pricing Table Active Header Background Color",
	"desc" => "Select background color for the pricing table active header shortcode",
	"id" => $shortname."_pricing_active_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#000000"
),

array( "name" => "Pricing Table Default Header Background Color",
	"desc" => "Select background color for the pricing table default header shortcode",
	"id" => $shortname."_pricing_default_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#F9F9F9"
),

array( "name" => "Pricing Table Border Color",
	"desc" => "Select border color for the pricing table shortcode",
	"id" => $shortname."_pricing_border_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#EBEBEB"
),

array( "name" => "<h2>Footer Sections Colors</h2>Footer Background Color",
	"desc" => "Select background color for the footer area",
	"id" => $shortname."_footer_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#000000"
),

array( "name" => "Footer Widget Title Color",
	"desc" => "Select color for the footer widget title",
	"id" => $shortname."_footer_widget_title_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "Footer Widget Title Border Color",
	"desc" => "Select border color for the footer widget title",
	"id" => $shortname."_footer_widget_title_border_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#E5E5E5"
),

array( "name" => "Footer Font Color",
	"desc" => "Select color for the footer font",
	"id" => $shortname."_footer_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#E5E5E5"
),

array( "name" => "Footer Link Color",
	"desc" => "Select link color for the footer font",
	"id" => $shortname."_footer_link_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),


array( "name" => "Below Footer Font Color",
	"desc" => "Select font color for the below footer area font",
	"id" => $shortname."_below_footer_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#E5E5E5"
),

array( "name" => "Below Footer Background Color",
	"desc" => "Select background color for area below footer",
	"id" => $shortname."_below_footer_background_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#F55D2D"
),

array( "name" => "<h2>Button Colors</h2>Button Background Color",
	"desc" => "Select color for the button background",
	"id" => $shortname."_button_bg_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#e73d26"
),

array( "name" => "Button Font Color",
	"desc" => "Select color for the button font",
	"id" => $shortname."_button_font_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#ffffff"
),

array( "name" => "Button Border Color",
	"desc" => "Select color for the button border",
	"id" => $shortname."_button_border_color",
	"type" => "colorpicker",
	"size" => "60px",
	"std" => "#e73d26"
),

array( "type" => "close"),
//End first tab "Colors"


//Begin first tab "Background"
array( 
		"name" => "Backgrounds",
		"type" => "section",
		"icon" => "image--plus.png",
),
array( "type" => "open"),

array( "name" => "<h2>Custom Background Settings</h2>Main Content Background",
	"desc" => "Select background style for main content area of the theme",
	"id" => $shortname."_content_bg_img",
	"type" => "radio",
	"options" => array(
		'1' => '<div style="float:left;width:40px;height:40px;" class="pp_checkbox_wrapper">White<br/>Color</div>',
		'lightpaperfibers.png' => '<div style="float:left;width:40px;height:40px;background:url('.get_bloginfo( 'stylesheet_directory' ).'/images/patterns/lightpaperfibers.png) repeat;" class="pp_checkbox_wrapper"></div>',
		'furley_bg.png' => '<div style="float:left;width:40px;height:40px;background:url('.get_bloginfo( 'stylesheet_directory' ).'/images/patterns/furley_bg.png) repeat;" class="pp_checkbox_wrapper"></div>',
		'subtlenet2.png' => '<div style="float:left;width:40px;height:40px;background:url('.get_bloginfo( 'stylesheet_directory' ).'/images/patterns/subtlenet2.png) repeat;" class="pp_checkbox_wrapper"></div>',
		'crisp_paper_ruffles.png' => '<div style="float:left;width:40px;height:40px;background:url('.get_bloginfo( 'stylesheet_directory' ).'/images/patterns/crisp_paper_ruffles.png) repeat;" class="pp_checkbox_wrapper"></div>',
		'lil_fiber.png' => '<div style="float:left;width:40px;height:40px;background:url('.get_bloginfo( 'stylesheet_directory' ).'/images/patterns/lil_fiber.png) repeat;" class="pp_checkbox_wrapper"></div>',
		'tex2res3.png' => '<div style="float:left;width:40px;height:40px;background:url('.get_bloginfo( 'stylesheet_directory' ).'/images/patterns/tex2res3.png) repeat;" class="pp_checkbox_wrapper"></div>',
		'arches.png' => '<div style="float:left;width:40px;height:40px;background:url('.get_bloginfo( 'stylesheet_directory' ).'/images/patterns/arches.png) repeat;" class="pp_checkbox_wrapper"></div>',
		'hexellence.png' => '<div style="float:left;width:40px;height:40px;background:url('.get_bloginfo( 'stylesheet_directory' ).'/images/patterns/hexellence.png) repeat;" class="pp_checkbox_wrapper"></div>',
		'frenchstucco.png' => '<div style="float:left;width:40px;height:40px;background:url('.get_bloginfo( 'stylesheet_directory' ).'/images/patterns/frenchstucco.png) repeat;" class="pp_checkbox_wrapper"></div>',
		'gradient_squares.png' => '<div style="float:left;width:40px;height:40px;background:url('.get_bloginfo( 'stylesheet_directory' ).'/images/patterns/gradient_squares.png) repeat;" class="pp_checkbox_wrapper"></div>',
		'diagonal_striped_brick.png' => '<div style="float:left;width:40px;height:40px;background:url('.get_bloginfo( 'stylesheet_directory' ).'/images/patterns/diagonal_striped_brick.png) repeat;" class="pp_checkbox_wrapper"></div>',
		'foggy_birds.png' => '<div style="float:left;width:40px;height:40px;background:url('.get_bloginfo( 'stylesheet_directory' ).'/images/patterns/foggy_birds.png) repeat;" class="pp_checkbox_wrapper"></div>',
		'xv.png' => '<div style="float:left;width:40px;height:40px;background:url('.get_bloginfo( 'stylesheet_directory' ).'/images/patterns/xv.png) repeat;" class="pp_checkbox_wrapper"></div>',
		'square_bg.png' => '<div style="float:left;width:40px;height:40px;background:url('.get_bloginfo( 'stylesheet_directory' ).'/images/patterns/square_bg.png) repeat;" class="pp_checkbox_wrapper"></div>',
		'project_papper.png' => '<div style="float:left;width:40px;height:40px;background:url('.get_bloginfo( 'stylesheet_directory' ).'/images/patterns/project_papper.png) repeat;" class="pp_checkbox_wrapper"></div>',
		'brushed_alu.png' => '<div style="float:left;width:40px;height:40px;background:url('.get_bloginfo( 'stylesheet_directory' ).'/images/patterns/brushed_alu.png) repeat;" class="pp_checkbox_wrapper"></div>',
		'stacked_circles.png' => '<div style="float:left;width:40px;height:40px;background:url('.get_bloginfo( 'stylesheet_directory' ).'/images/patterns/stacked_circles.png) repeat;" class="pp_checkbox_wrapper"></div>',
		
	),
),

array( "name" => "Footer Background Image (.jpg, .png)",
	"desc" => "Image background for footer area of the theme",
	"id" => $shortname."_footer_bg_img",
	"type" => "image",
	"std" => ''
),

array( "name" => "Below Footer Background Image (.jpg, .png)",
	"desc" => "Image background for footer area of the theme",
	"id" => $shortname."_below_footer_bg_img",
	"type" => "image",
	"std" => ''
),

array( "type" => "close"),


//Begin second tab "Homepage"
array( "name" => "Homepage",
	"type" => "section",
	"icon" => "home.png",
),
array( "type" => "open"),

array( "name" => "<h2>Content Settings</h2>Select and sort pages on your homepage.",
	"sort_title" => "Homepage Content Manager",
	"desc" => "",
	"id" => $shortname."_homepage_content",
	"type" => "sortable",
	"options" => $wp_pages,
	"options_disable" => array(1, 2, 3),
	"std" => ''
),

array( "name" => "Homepage Header Title",
	"desc" => "Enter homepage header title",
	"id" => $shortname."_slider_header",
	"type" => "text",
	"std" => "Awesome Theme"
),

array( "name" => "Homepage Header Content",
	"desc" => "Enter homepage header content",
	"id" => $shortname."_slider_content",
	"type" => "textarea",
	"std" => ""
),

array( "name" => "<h2>Slider Settings</h2>Enable/disable Homepage Slider",
	"desc" => "",
	"id" => $shortname."_slider_display",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "Slider items",
	"desc" => "How many items you want display in slider?",
	"id" => $shortname."_slider_items",
	"type" => "jslider",
	"size" => "40px",
	"std" => "5",
	"from" => 1,
	"to" => 10,
	"step" => 1,
),

array( "name" => "Slider timer (in second)",
	"desc" => "Enter number of seconds for slider timer",
	"id" => $shortname."_slider_timer",
	"type" => "jslider",
	"size" => "40px",
	"std" => "5",
	"from" => 1,
	"to" => 10,
	"step" => 1,
),

array( "name" => "Enable/disable Autoplay for Slider",
	"desc" => "",
	"id" => $shortname."_slider_autoplay",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "type" => "close"),
//End second tab "Homepage"


//Begin second tab "Portfolio"
array( "name" => "Portfolio",
	"type" => "section",
	"icon" => "folder-open-image.png",
),

array( "type" => "open"),


array( "name" => "<h2>Portfolio Single Page Slider Settings</h2>Portfolio Slider timer (in second)",
	"desc" => "Enter number of seconds for portfolio slider timer on single portfolio page",
	"id" => $shortname."_portfolio_slider_timer",
	"type" => "jslider",
	"size" => "40px",
	"std" => "5",
	"from" => 1,
	"to" => 10,
	"step" => 1,
),
array( "name" => "Portfolio Slider items",
	"desc" => "How many items you want display in portfolio slider?",
	"id" => $shortname."_portfolio_slider_items",
	"type" => "jslider",
	"size" => "40px",
	"std" => "5",
	"from" => 1,
	"to" => 10,
	"step" => 1,
),
array( "name" => "Enable/disable Autoplay for Portfolio Slider",
	"desc" => "",
	"id" => $shortname."_portfolio_slider_autoplay",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "<h2>Portfolio Single Page Recent Portfolios Settings</h2>Enable/disable Recent portfolios on portfolio single page",
	"desc" => "",
	"id" => $shortname."_portfolio_enable_recent",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Recent Portfolios items",
	"desc" => "How many items you want display in recent portfolios?",
	"id" => $shortname."_portfolio_recent_items",
	"type" => "jslider",
	"size" => "40px",
	"std" => "12",
	"from" => 1,
	"to" => 40,
	"step" => 1,
),

array( "type" => "close"),
//End second tab "Portfolio"


//Begin second tab "Blog"
array( "name" => "Blog",
	"type" => "section",
	"icon" => "book-open-bookmark.png",
),

array( "type" => "open"),

array( "name" => "Display full post content on blog page",
	"desc" => "",
	"id" => $shortname."_blog_display_full",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "Enable/disable post's featured image on single post page",
	"desc" => "",
	"id" => $shortname."_blog_single_img",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "Enable/disable post's social share buttons",
	"desc" => "",
	"id" => $shortname."_blog_share",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "Enable/disable post's meta data",
	"desc" => "",
	"id" => $shortname."_blog_meta",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "type" => "close"),
//End second tab "Blog"


//Begin second tab "Sidebar"
array( "name" => "Sidebar",
	"type" => "section",
	"icon" => "application-sidebar-expand.png",
),

array( "type" => "open"),

array( "name" => "Add a new sidebar",
	"desc" => "Enter sidebar name",
	"id" => $shortname."_sidebar0",
	"type" => "text",
	"std" => "",
),
array( "type" => "close"),
//End second tab "Sidebar"


//Begin first tab "Contact"
array( 
		"name" => "Contact",
		"type" => "section",
		"icon" => "mail-receive.png",
)
,

array( "type" => "open"),

array( "name" => "<h2>Contact form Settings</h2>Your email address",
	"desc" => "Enter which email address will be sent from contact form",
	"id" => $shortname."_contact_email",
	"type" => "text",
	"std" => ""
),

array( "name" => "Select and sort contents on your contact page. Use fields you want to show on your contact form",
	"sort_title" => "Contact Form Manager",
	"desc" => "",
	"id" => $shortname."_contact_form",
	"type" => "sortable",
	"options" => array(
		0 => 'Empty field',
		1 => 'Name',
		2 => 'Email',
		3 => 'Message',
		4 => 'Address',
		5 => 'Phone',
		6 => 'Mobile',
		7 => 'Company Name',
		8 => 'Country',
	),
	"options_disable" => array(1, 2, 3),
	"std" => ''
),

array( "name" => "<h2>Address and Map Settings</h2>Show map in contact page",
	"desc" => "Select display map in contact page",
	"id" => $shortname."_contact_display_map",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Address Latitude",
	"desc" => "<a href=\"http://www.tech-recipes.com/rx/5519/the-easy-way-to-find-latitude-and-longitude-values-in-google-maps/\">Find here</a>",
	"id" => $shortname."_contact_lat",
	"type" => "text",
	"std" => ""
),
array( "name" => "Address Longtitude",
	"desc" => "<a href=\"http://www.tech-recipes.com/rx/5519/the-easy-way-to-find-latitude-and-longitude-values-in-google-maps/\">Find here</a>",
	"id" => $shortname."_contact_long",
	"type" => "text",
	"std" => ""
),
array( "name" => "Map Zoom level",
	"desc" => "",
	"id" => $shortname."_contact_map_zoom",
	"type" => "jslider",
	"size" => "40px",
	"std" => "12",
	"from" => 1,
	"to" => 18,
	"step" => 1,
),

array( "name" => "<h2>Captcha Settings</h2>Enable/disable Captcha",
	"desc" => "",
	"id" => $shortname."_contact_enable_captcha",
	"type" => "iphone_checkboxes",
	"std" => 1
),
	
array( "type" => "close"),
//End first tab "Contact"




//Begin second tab "Footer"
array( "name" => "Footer",
	"type" => "section",
	"icon" => "layout-select-footer.png",
),

array( "type" => "open"),

array( "name" => "<h2>Footer Layouts and Styles Settings</h2>Show Footer Sidebar",
	"desc" => "",
	"id" => $shortname."_footer_display_sidebar",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Footer Sidebar styles",
	"desc" => "Select the style for Footer Sidebar",
	"id" => $shortname."_footer_style",
	"type" => "radio",
	"options" => array(
		'1' => '<div style="float:left;width:50px;height:40px" class="pp_checkbox_wrapper"><img src="'.get_bloginfo( 'stylesheet_directory' ).'/functions/images/1column.png"/></div>',
		'2' => '<div style="float:left;width:50px;height:40px" class="pp_checkbox_wrapper"><img src="'.get_bloginfo( 'stylesheet_directory' ).'/functions/images/2columns.png"/></div>',
		'3' => '<div style="float:left;width:50px;height:40px" class="pp_checkbox_wrapper"><img src="'.get_bloginfo( 'stylesheet_directory' ).'/functions/images/3columns.png"/></div>',
		'4' => '<div style="float:left;width:50px;height:40px" class="pp_checkbox_wrapper"><img src="'.get_bloginfo( 'stylesheet_directory' ).'/functions/images/4columns.png"/></div>',
	),
),

array( "name" => "<h2>Footer Content (Support HTML)</h2>Footer Content",
	"desc" => "You can text and HTML in here",
	"id" => $shortname."_footer_text",
	"type" => "textarea",
	"std" => ""
),

array( "name" => "Footer Right Content",
	"desc" => "You can text and HTML in here",
	"id" => $shortname."_footer_right_text",
	"type" => "textarea",
	"std" => ""
),

//End second tab "Footer"

//Begin fifth tab "Social Profiles"
array( "type" => "close"),
array( 	"name" => "Social-Profiles",
		"type" => "section",
		"icon" => "social.png",
),
array( "type" => "open"),
	
array( "name" => "<h2>Accounts Settings</h2>Facebook Profile ID",
	"desc" => "",
	"id" => $shortname."_facebook_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Twitter Username",
	"desc" => "",
	"id" => $shortname."_twitter_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Google Plus URL",
	"desc" => "",
	"id" => $shortname."_google_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Flickr Username",
	"desc" => "",
	"id" => $shortname."_flickr_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Youtube Username",
	"desc" => "",
	"id" => $shortname."_youtube_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Vimeo Username",
	"desc" => "",
	"id" => $shortname."_vimeo_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Tumblr Username",
	"desc" => "",
	"id" => $shortname."_tumblr_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Digg Username",
	"desc" => "",
	"id" => $shortname."_digg_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Dribbble Username",
	"desc" => "",
	"id" => $shortname."_dribbble_username",
	"type" => "text",
	"std" => ""
),
array( "name" => "Linkedin URL",
	"desc" => "",
	"id" => $shortname."_linkedin_username",
	"type" => "text",
	"std" => ""
),

array( "type" => "close"),
//End fifth tab "Social Profiles"


//Begin second tab "Advance"
array( "name" => "Advance",
	"type" => "section",
	"icon" => "wrench-screwdriver.png",
),

array( "type" => "open"),

array( "name" => "<h2>SEO Settings</h2>Enable Theme SEO plugin",
	"desc" => "Note: if you use another SEO plugin, please turn off theme SEO feature",
	"id" => $shortname."_seo_enable",
	"type" => "iphone_checkboxes",
	"std" => 1
),
array( "name" => "Homepage Title",
	"desc" => "Enter your homepage title",
	"id" => $shortname."_seo_home_title",
	"type" => "text",
	"std" => ""

),

array( "name" => "Meta Keywords",
	"desc" => "Enter your site keywords (separate by comma ,)",
	"id" => $shortname."_seo_meta_key",
	"type" => "textarea",
	"std" => ""

),

array( "name" => "Meta Description",
	"desc" => "Enter your site description",
	"id" => $shortname."_seo_meta_desc",
	"type" => "textarea",
	"std" => ""

),

array( "name" => "<h2>Javascript and CSS Settings</h2>Enable/disable custom colors and fonts",
	"desc" => "If you want to use theme default color and font setting. You can disable this option and it will speed up your site load time",
	"id" => $shortname."_advance_enable_custom",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "Combine and compress theme's javascript files",
	"desc" => "Combine and compress all javascript files to one. Help reduce page load time",
	"id" => $shortname."_advance_combine_js",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "Combine and compress theme's CSS files",
	"desc" => "Combine and compress all CSS files to one. Help reduce page load time",
	"id" => $shortname."_advance_combine_css",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "<h2>Utilities Tools</h2>Restore Default Settings",
	"desc" => "Restore default theme settings. Be careful once you active this, all settings will be changed to default one and it can't be undone.",
	"id" => $shortname."_advance_restore_default",
	"type" => "html",
	"html" => '<br/><input type="submit" id="'.$shortname.'_advance_restore_default" class="button" value="Click here to start restoring settings"><input type="hidden" id="pp_restore_flg" name="pp_restore_flg" value="0"/>',
),

array( "name" => "Enable/disble Responsive Feature",
	"desc" => "You can enable/disable reponsive design for mobile devices",
	"id" => $shortname."_advance_responsive",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "Clear Cache",
	"desc" => "Try to clear cache when you enable javascript and CSS compression and theme went wrong",
	"id" => $shortname."_advance_clear_cache",
	"type" => "html",
	"html" => '<br/><a id="'.$shortname.'_advance_clear_cache" href="'.$api_url.'" class="button">Click here to start clearing cache files</a>',
),

array( "name" => "Enable style switcher",
	"desc" => "Display style switcher like you saw on live demo site",
	"id" => $shortname."_advance_enable_switcher",
	"type" => "iphone_checkboxes",
	"std" => 1
),

/*array( "name" => "Enable style switcher",
	"desc" => "Display style switcher like you saw on live demo site",
	"id" => $shortname."_advance_enable_switcher",
	"type" => "iphone_checkboxes",
	"std" => 1
),*/
array( "type" => "close"),
//End second tab "Advance"

 
array( "type" => "close")
 
);
?>