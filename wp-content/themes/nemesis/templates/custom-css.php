<style>
<?php
	$pp_body_font = get_option('pp_body_font');
	
	if(!empty($pp_body_font))
	{
?>
body, input[type=submit], input[type=button], a.button, input[type=submit].medium, input[type=button].medium, a.button.medium, input[type=submit].large, input[type=button].large, a.button.large { font-family:<?php echo $pp_body_font; ?>; }
<?php
	}
	
?>

<?php
	$pp_body_font_size = get_option('pp_body_font_size');
	
	if(!empty($pp_body_font_size))
	{
?>
body { font-size:<?php echo $pp_body_font_size; ?>px; }
<?php
	}
?>

<?php
	$pp_blog_title_font_color = get_option('pp_blog_title_font_color');
	
	if(!empty($pp_blog_title_font_color))
	{
?>
.post_header h3 a { color:<?php echo $pp_blog_title_font_color; ?>; }
<?php
	}
?>

<?php
	$pp_blog_date_bg_color = get_option('pp_blog_date_bg_color');
	
	if(!empty($pp_blog_date_bg_color))
	{
?>
.post_date { background:<?php echo $pp_blog_date_bg_color; ?>; }
<?php
	}
?>

<?php
	$pp_blog_date_font_color = get_option('pp_blog_date_font_color');
	
	if(!empty($pp_blog_date_font_color))
	{
?>
.post_date { color:<?php echo $pp_blog_date_font_color; ?>; }
<?php
	}
?>

<?php
	$pp_widget_bg_color = get_option('pp_widget_bg_color');
	
	if(!empty($pp_widget_bg_color))
	{
?>
.sidebar_widget li { background:<?php echo $pp_widget_bg_color; ?>; }
<?php
	}
?>

<?php
	$pp_widget_border_color = get_option('pp_widget_border_color');
	
	if(!empty($pp_widget_border_color))
	{
?>
.sidebar_widget li { border-bottom:1px solid <?php echo $pp_widget_border_color; ?>; }
#content_wrapper .sidebar .content .posts.blog li img, #content_wrapper .posts.blog li img { border:1px solid <?php echo $pp_widget_border_color; ?>; }
<?php
	}
?>

<?php
	$pp_widget_title_border_color = get_option('pp_widget_title_border_color');
	
	if(!empty($pp_widget_title_border_color))
	{
?>
#content_wrapper .sidebar .content .sidebar_widget li .widgettitle, h2.widgettitle, #footer ul li.widget .widgettitle { border-color: <?php echo $pp_widget_title_border_color; ?>; }
<?php
	}
?>

<?php
	$pp_dropcap_bg_color = get_option('pp_dropcap_bg_color');
	
	if(!empty($pp_dropcap_bg_color))
	{
?>
.dropcap1 { background:<?php echo $pp_dropcap_bg_color; ?>; }
<?php
	}
?>

<?php
	$pp_pricing_active_bg_color = get_option('pp_pricing_active_bg_color');
	
	if(!empty($pp_pricing_active_bg_color))
	{
?>
.pricing_box.large .header { background:<?php echo $pp_pricing_active_bg_color; ?>; }
<?php
	}
?>

<?php
	$pp_pricing_default_bg_color = get_option('pp_pricing_default_bg_color');
	
	if(!empty($pp_pricing_default_bg_color))
	{
?>
.pricing_box .header { background:<?php echo $pp_pricing_default_bg_color; ?>; }
<?php
	}
?>

<?php
	$pp_pricing_border_color = get_option('pp_pricing_border_color');
	
	if(!empty($pp_pricing_border_color))
	{
?>
.pricing_box .header, #content_wrapper .pricing_box ul li { border-bottom:1px solid <?php echo $pp_pricing_border_color; ?>; }
.pricing_box { border:1px solid <?php echo $pp_pricing_border_color; ?>; }
<?php
	}
?>

<?php
	$pp_footer_header_font_size = get_option('pp_footer_header_font_size');
	
	if(!empty($pp_footer_header_font_size))
	{
?>
#footer ul li.widget .widgettitle { font-size:<?php echo $pp_footer_header_font_size; ?>px; }
<?php
	}
	
?>

<?php
	$pp_sidebar_header_font_size = get_option('pp_sidebar_header_font_size');
	
	if(!empty($pp_sidebar_header_font_size))
	{
?>
#content_wrapper .sidebar .content .sidebar_widget li .widgettitle, h2.widgettitle { font-size:<?php echo $pp_sidebar_header_font_size; ?>px; }
<?php
	}
	
?>

<?php
	$pp_post_title_font_size = get_option('pp_post_title_font_size');
	
	if(!empty($pp_post_title_font_size))
	{
?>
.post_header h3 { font-size:<?php echo $pp_post_title_font_size; ?>px; }
<?php
	}
?>

<?php
	$pp_footer_widget_title_border_color = get_option('pp_footer_widget_title_border_color');
	
	if(!empty($pp_footer_widget_title_border_color))
	{
?>
#footer ul li.widget .widgettitle { border-color: <?php echo $pp_footer_widget_title_border_color; ?>; }
<?php
	}
?>

<?php
	$pp_h1_font_color = get_option('pp_h1_font_color');
	
	if(!empty($pp_h1_font_color))
	{
?>
h1,h2,h3,h4,h5,h6 { color:<?php echo $pp_h1_font_color; ?>; }
<?php
	}
?>

<?php
	$pp_header_bg = get_option('pp_header_bg');
	
	if(!empty($pp_header_bg))
	{
?>
#top_wrapper { background:<?php echo $pp_header_bg; ?>; }
<?php
	}
?>

<?php
	$pp_h1_size = get_option('pp_h1_size');
	
	if(!empty($pp_h1_size))
	{
?>
h1 { font-size:<?php echo $pp_h1_size; ?>px; }
<?php
	}
?>

<?php
	$pp_h2_size = get_option('pp_h2_size');
	
	if(!empty($pp_h2_size))
	{
?>
h2 { font-size:<?php echo $pp_h2_size; ?>px; }
<?php
	}
	
?>

<?php
	$pp_h3_size = get_option('pp_h3_size');
	
	if(!empty($pp_h3_size))
	{
?>
h3 { font-size:<?php echo $pp_h3_size; ?>px; }
<?php
	}
	
?>

<?php
	$pp_h4_size = get_option('pp_h4_size');
	
	if(!empty($pp_h4_size))
	{
?>
h4 { font-size:<?php echo $pp_h4_size; ?>px; }
<?php
	}
	
?>

<?php
	$pp_h5_size = get_option('pp_h5_size');
	
	if(!empty($pp_h5_size))
	{
?>
h5 { font-size:<?php echo $pp_h5_size; ?>px; }
<?php
	}
?>

<?php
	$pp_h6_size = get_option('pp_h6_size');
	
	if(!empty($pp_h6_size))
	{
?>
h6 { font-size:<?php echo $pp_h6_size; ?>px; }
<?php
	}	
?>

<?php
	$pp_page_header_font_size = get_option('pp_page_header_font_size');
	
	if(!empty($pp_page_header_font_size))
	{
?>
.caption_header h1 { font-size:<?php echo $pp_page_header_font_size; ?>px; }
<?php
	}
	if($pp_page_header_font_size < 48)
	{
?>
.caption_header h1 { letter-spacing: 0; }
<?php
	}
?>

<?php
	$pp_page_desc_font_size = get_option('pp_page_desc_font_size');
	
	if(!empty($pp_page_desc_font_size))
	{
?>
.caption_header { font-size:<?php echo $pp_page_desc_font_size; ?>px; }
<?php
	}
	if($pp_page_desc_font_size != 18)
	{
?>
.caption_header { line-height: auto; }
<?php
	}
?>

<?php
	$pp_font_color = get_option('pp_font_color');
	
	if(!empty($pp_font_color))
	{
?>
body { color:<?php echo $pp_font_color; ?>; }
<?php
	}
	
?>

<?php
	$pp_link_color = get_option('pp_link_color');
	
	if(!empty($pp_link_color))
	{
?>
a, .tagline_text { color:<?php echo $pp_link_color; ?>; }
::selection { background:<?php echo $pp_link_color; ?>; }
<?php
	}
	
?>

<?php
	$pp_hover_link_color = get_option('pp_hover_link_color');
	
	if(!empty($pp_hover_link_color))
	{
?>
a:hover, .top_info a:hover, .tagline_text span.highlight { color:<?php echo $pp_hover_link_color; ?>; }
.top_info a { background-color:<?php echo $pp_hover_link_color; ?>; }
<?php
	}	
?>

<?php
	$pp_active_link_color = get_option('pp_active_link_color');
	
	if(!empty($pp_active_link_color))
	{
?>
a:active, .top_info a:active { color:<?php echo $pp_active_link_color; ?>; }
.filter li a.active, .filter li a:hover { border-bottom: 3px solid <?php echo $pp_active_link_color; ?>; }
<?php
	}	
?>

<?php
	$pp_button_bg_color = get_option('pp_button_bg_color');
	
	if(!empty($pp_button_bg_color))
	{
?>
input[type=submit], input[type=button], a.button, input[type=submit]:active, input[type=button]:active, a.button:active { 
	background-color: <?php echo $pp_button_bg_color; ?>;
}

<?php
	}
	
?>

<?php
	$pp_button_font_color = get_option('pp_button_font_color');
	
	if(!empty($pp_button_font_color))
	{
?>
input[type=submit], input[type=button], a.button{ 
	color: <?php echo $pp_button_font_color; ?>;
}
input[type=submit]:hover, input[type=button]:hover, a.button:hover
{
	color: <?php echo $pp_button_font_color; ?>;
}
<?php
	}
	
?>

<?php
	$pp_button_border_color = get_option('pp_button_border_color');
	
	if(!empty($pp_button_border_color))
	{
?>
input[type=submit], input[type=button], a.button { 
	border: 1px solid <?php echo $pp_button_border_color; ?>;
}
<?php
	}
	
?>

<?php
    $pp_footer_display_sidebar = get_option('pp_footer_display_sidebar');
    
    if(empty($pp_footer_display_sidebar))
    {
?>
#footer { background-image: none; }
<?php
    }
?>

<?php
	$pp_font_family = get_option('pp_font_family');
    
    if(!empty($pp_font_family))
    {
?>
h1, h2, h3, h4, h5, h6, .caption_desc, #slider_desc, .post_date { font-family: '<?php echo $pp_font_family; ?>'; }
<?php
	}
?>

<?php
    $pp_logo_margin_top = get_option('pp_logo_margin_top');
    
    if(!empty($pp_logo_margin_top))
    {
?>
.logo { margin-top: <?php echo $pp_logo_margin_top; ?>px; }
<?php
    }
?>

<?php
    $pp_tagline_margin_top = get_option('pp_tagline_margin_top');
    
    if(!empty($pp_tagline_margin_top))
    {
?>
.logo_tagline { margin-top: <?php echo $pp_tagline_margin_top; ?>px; }
<?php
    }
?>

<?php
    $pp_menu_margin_top = get_option('pp_menu_margin_top');
    
    if(!empty($pp_menu_margin_top))
    {
?>
#menu_border_wrapper { margin-top: <?php echo $pp_menu_margin_top; ?>px; }
<?php
    }
?>

<?php
    $pp_menu_font_size = get_option('pp_menu_font_size');
    $pp_menu_uppercase = get_option('pp_menu_uppercase');
    
    if(!empty($pp_menu_uppercase))
    {
    	$pp_menu_uppercase = 'uppercase';
    }
    else
    {
    	$pp_menu_uppercase = 'none';
    }
    
    if(!empty($pp_menu_font_size))
    {
?>
#menu_wrapper .nav ul li a, #menu_wrapper div .nav li a { font-size: <?php echo $pp_menu_font_size; ?>px;text-transform: <?php echo $pp_menu_uppercase; ?> }
<?php
    }
?>

<?php
    $pp_submenu_font_size = get_option('pp_submenu_font_size');
    
    if(!empty($pp_submenu_font_size))
    {
?>
#menu_wrapper .nav ul li ul, #menu_wrapper div .nav li ul { font-size: <?php echo $pp_submenu_font_size; ?>px; }
<?php
    }
?>

<?php
    $pp_menu_link_color = get_option('pp_menu_link_color');
    
    if(!empty($pp_menu_link_color))
    {
?>
#menu_wrapper .nav ul li a, #menu_wrapper div .nav li a { color: <?php echo $pp_menu_link_color; ?>; }
<?php
    }
?>

<?php
    $pp_menu_link_hover_color = get_option('pp_menu_link_hover_color');
    
    if(!empty($pp_menu_link_hover_color))
    {
?>
#menu_wrapper .nav ul li a.hover, #menu_wrapper .nav ul li a:hover, #menu_wrapper div .nav li a.hover, #menu_wrapper div .nav li a:hover, #menu_wrapper .nav ul li ul li a:hover, #menu_wrapper .nav ul li ul li a:hover, #menu_wrapper div .nav li ul li a:hover, #menu_wrapper div .nav li ul li a:hover, #menu_wrapper div .nav li.current-menu-item ul li a:hover, #menu_wrapper div .nav li.current-menu-parent ul li a:hover { color: <?php echo $pp_menu_link_hover_color; ?>; }
<?php
    }
?>

<?php
    $pp_menu_link_hover_border_color = get_option('pp_menu_link_hover_border_color');
    
    if(!empty($pp_menu_link_hover_border_color))
    {
?>
#menu_wrapper .nav ul li a.hover, #menu_wrapper .nav ul li a:hover, #menu_wrapper div .nav li a.hover, #menu_wrapper div .nav li a:hover, #menu_wrapper div .nav li.current-menu-item > a, #menu_wrapper div .nav li.current-menu-parent > a, #menu_wrapper div .nav li.current-menu-ancestor > a { border-color: <?php echo $pp_menu_link_hover_border_color; ?>; }
<?php
    }
?>

<?php
    $pp_menu_link_active_color = get_option('pp_menu_link_active_color');
    
    if(!empty($pp_menu_link_active_color))
    {
?>
#menu_wrapper div .nav li.current-menu-item a, #menu_wrapper div .nav li.current-menu-parent a, #menu_wrapper div .nav li.current-menu-ancestor > a { color: <?php echo $pp_menu_link_active_color; ?>; }
<?php
    }
?>

<?php
    $pp_submenu_bg = get_option('pp_submenu_bg');
    
    if(!empty($pp_submenu_bg))
    {
?>
#menu_wrapper .nav ul li ul, #menu_wrapper div .nav li ul { background-color: <?php echo $pp_submenu_bg; ?>; }
<?php
    }
?>

<?php
    $pp_submenu_link_color = get_option('pp_submenu_link_color');
    
    if(!empty($pp_submenu_link_color))
    {
?>
#menu_wrapper div .nav li ul li a, #menu_wrapper div .nav li.current-menu-item ul li a, #menu_wrapper div .nav li ul li.current-menu-item a, #menu_wrapper .nav ul li ul li a, #menu_wrapper .nav ul li.current-menu-item ul li a, #menu_wrapper .nav ul li ul li.current-menu-item a, #menu_wrapper div .nav li.current-menu-parent ul li a, #menu_wrapper div .nav li ul li.current-menu-parent a { color: <?php echo $pp_submenu_link_color; ?>; }
<?php
    }
?>

<?php
    $pp_submenu_hover_color = get_option('pp_submenu_hover_color');
    
    if(!empty($pp_submenu_hover_color))
    {
?>
#menu_wrapper .nav ul li ul li a:hover, #menu_wrapper .nav ul li ul li a:hover, #menu_wrapper div .nav li ul li a:hover, #menu_wrapper div .nav li ul li a:hover { color: <?php echo $pp_submenu_hover_bg_color; ?>; }
<?php
    }
?>

<?php
    $pp_submenu_border_color = get_option('pp_submenu_border_color');
    
    if(!empty($pp_submenu_border_color))
    {
?>
#menu_wrapper .nav ul li ul li a, #menu_wrapper div .nav li ul li a, #menu_wrapper div .nav li.current-menu-parent ul li a { border-color: <?php echo $pp_submenu_border_color; ?>; }
<?php
    }
?>

<?php
    $pp_slider_caption_header_bg_color = get_option('pp_slider_caption_header_bg_color');
    
    if(!empty($pp_slider_caption_header_bg_color))
    {
?>
#slider_wrapper.small .flexslider.small.macbook ul.slides li a .slide_content_right, #slider_wrapper.small .flexslider.small.macbook ul.slides li a .slide_content_left, #slider_wrapper.small .flexslider.small ul.slides li a .slide_content_left, #slider_wrapper.small .flexslider.small ul.slides li a .slide_content_right, #slider_wrapper .flexslider ul.slides li a .slide_content_left, #slider_wrapper .flexslider ul.slides li a .slide_content_right { background-color: <?php echo $pp_slider_caption_header_bg_color; ?>; }
<?php
    }
?>

<?php
    $pp_before_title_border_color = get_option('pp_before_title_border_color');
    
    if(!empty($pp_before_title_border_color))
    {
?>
.page_caption { border-color: <?php echo $pp_before_title_border_color; ?>; }
<?php
    }
?>

<?php
    $pp_footer_bg_color = get_option('pp_footer_bg_color');
    
    if(!empty($pp_footer_bg_color))
    {
?>
#footer, #footer h2.widgettitle span { background-color: <?php echo $pp_footer_bg_color; ?>; }
<?php
    }
?>

<?php
    $pp_footer_widget_title_color = get_option('pp_footer_widget_title_color');
    
    if(!empty($pp_footer_widget_title_color))
    {
?>
#footer ul li.widget .widgettitle { color: <?php echo $pp_footer_widget_title_color; ?>; }
<?php
    }
?>

<?php
    $pp_footer_font_color = get_option('pp_footer_font_color');
    
    if(!empty($pp_footer_font_color))
    {
?>
#footer { color: <?php echo $pp_footer_font_color; ?>; }
<?php
    }
?>

<?php
    $pp_footer_link_color = get_option('pp_footer_link_color');
    
    if(!empty($pp_footer_link_color))
    {
?>
#footer a, #footer a:hover, #footer a:active, #copyright a, #copyright a:hover, #copyright a:active { color: <?php echo $pp_footer_link_color; ?>; }
<?php
    }
?>

<?php
    $pp_below_footer_color = get_option('pp_below_footer_color');
    
    if(!empty($pp_below_footer_color))
    {
?>
#copyright { color: <?php echo $pp_below_footer_color; ?>; }
<?php
    }
?>

<?php
    $pp_below_footer_background_color = get_option('pp_below_footer_background_color');
    
    if(!empty($pp_below_footer_background_color))
    {
?>
#copyright { background: <?php echo $pp_below_footer_background_color; ?>; }
<?php
	}
?>

<?php
	if(isset($_SESSION['pp_content_bg_img']))
	{
		$pp_content_bg_img = $_SESSION['pp_content_bg_img'];
	}
	else
	{
    	$pp_content_bg_img = get_option('pp_content_bg_img');
    }
    
    if(!empty($pp_content_bg_img))
    {
	    if($pp_content_bg_img == 1)
	    {
?>
body { background: #fff; }
<?php
	    }
	    else
	    {
?>
body { background: url(<?php echo get_bloginfo( 'stylesheet_directory' ); ?>/images/patterns/<?php echo $pp_content_bg_img; ?>) repeat top left;}
<?php
	    }
    }
?>

<?php
    $pp_footer_bg_img = get_option('pp_footer_bg_img');
    
    if(!empty($pp_footer_bg_img))
    {
?>
#footer, #footer h2.widgettitle span { background: url(<?php echo $pp_footer_bg_img; ?>) repeat top left; }
<?php
    }
?>

<?php
    $pp_below_footer_bg_img = get_option('pp_below_footer_bg_img');
    
    if(!empty($pp_below_footer_bg_img))
    {
?>
#copyright { background: url(<?php echo $pp_below_footer_bg_img; ?>) repeat top left; }
<?php
    }
?>

<?php
	if($post->post_type == 'page' && has_post_thumbnail($post->ID, 'full'))
	{
		$image_id = get_post_thumbnail_id($post->ID); 
		$image_thumb = wp_get_attachment_image_src($image_id, 'full', true);
		$pp_page_bg = $image_thumb[0];
?>
body, body.custom-background { background: url(<?php echo $pp_page_bg; ?>) repeat top left; }
<?php
	}
	
	if(isset($_SESSION['pp_skin_color']) && !empty($_SESSION['pp_skin_color']))
	{
?>
.flex-control-nav li a.active, .flex-control-nav li a:hover, .top_info a, #menu_wrapper .nav ul li ul li a:hover, #menu_wrapper .nav ul li ul li a:hover, #menu_wrapper div .nav li ul li a:hover, #menu_wrapper div .nav li ul li a:hover, #menu_wrapper div .nav li.current-menu-item ul li a:hover, #menu_wrapper div .nav li.current-menu-parent ul li a:hover { background-color: <?php echo $_SESSION['pp_skin_color']; ?>; }
a:hover, a:active, .top_info a:hover, .tagline_text span.highlight,  { color: <?php echo $_SESSION['pp_skin_color']; ?>; }
#footer, .page_caption { border-color: <?php echo $_SESSION['pp_skin_color']; ?>; }
<?php
	}
?>

<?php
	$pp_portfolio_bg_color = get_option('pp_portfolio_bg_color');
	
	if(!empty($pp_portfolio_bg_color))
	{
?>
.portfolio200_overlay { background:<?php echo $pp_portfolio_bg_color; ?>; }
.flex-control-nav li a.active, .flex-control-nav li a:hover { background-color:<?php echo $pp_portfolio_bg_color; ?>; }
<?php
	}
?>

<?php
	$pp_portfolio_font_color = get_option('pp_portfolio_font_color');
	
	if(!empty($pp_portfolio_font_color))
	{
?>
.portfolio200_overlay_inner, .portfolio200_overlay_inner h5 { color:<?php echo $pp_portfolio_font_color; ?>; }
.portfolio200_overlay_inner hr { border-color:<?php echo $pp_portfolio_font_color; ?>; }
<?php
	}
?>
</style>

<?php
/**
*	Get custom CSS
**/
$pp_custom_css = get_option('pp_custom_css');


if(!empty($pp_custom_css))
{
    echo '<style>';
    echo stripslashes($pp_custom_css);
    echo '</style>';
}
?>