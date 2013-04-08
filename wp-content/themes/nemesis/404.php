<?php
/**
 * The main template file for display error page.
 *
 * @package WordPress
*/

get_header(); 

?>
		
</div>

<div id="content_wrapper">

    <div class="page_caption">
    	<div class="caption_inner">
    		<div class="caption_header">
    			<h1 class="cufon"><span><?php _e( 'Page Not Found', THEMEDOMAIN ); ?></span></h1>
    		</div>
    	</div>
    </div>
    <br class="clear"/>
    
    <div class="inner">
    
    	<!-- Begin main content -->
    	<div class="inner_wrapper">
    	
    	<div class="standard_wrapper">
    			<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', THEMEDOMAIN ); ?></p>
    	</div>	
    	</div>
    	<!-- End main content -->
    	
    	<br class="clear"/>
    </div>
</div>
    
<!-- End content -->

<?php get_footer(); ?>