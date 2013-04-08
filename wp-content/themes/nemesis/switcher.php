<?php
session_start();
$pp_url = 'http://themes.themegoods.com/nemesis_wp/';

if(isset($_GET['pp_content_bg_img']))
{
	$_SESSION['pp_content_bg_img'] = $_GET['pp_content_bg_img'];
}

if(isset($_GET['pp_slider_display']))
{
	$_SESSION['pp_slider_display'] = $_GET['pp_slider_display'];
	header( 'Location: '.$pp_url ) ;
}

if(isset($_GET['reset']))
{
	session_destroy();
}

header( 'Location: '.$_SERVER['HTTP_REFERER'] ) ;
?>