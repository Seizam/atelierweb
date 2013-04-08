<?php
session_start();

if(isset($_GET['reset']) && $_GET['reset'])
{
	session_destroy();
	header( 'Location: '.$_SERVER['HTTP_REFERER'] ) ;
}
else
{
	if(isset($_GET['pp_font']))
	{
		$_SESSION['pp_font'] = $_GET['pp_font'];
	}
	
	if(isset($_GET['pp_font_family']))
	{
		$_SESSION['pp_font_family'] = $_GET['pp_font_family'];
	}
	
	if(isset($_GET['pp_skin_color']))
	{
		$_SESSION['pp_skin_color'] = $_GET['pp_skin_color'];
	}
}

?>