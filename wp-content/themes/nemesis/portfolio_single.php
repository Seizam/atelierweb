<?php
/**
 * The main template file for display single portfolio page.
 *
 * @package WordPress
*/

get_header(); 

/**
*	Get Current page object
**/
$page = get_page($post->ID);

/**
*	Get current page id
**/

if(!isset($current_page_id) && isset($page->ID))
{
    $current_page_id = $page->ID;
}

//Get portfolio gallery ID
$portfolio_gallery_id = get_post_meta($current_page_id, 'portfolio_gallery_id', true);


//Get slider animation
$pp_portfolio_slider_animation = get_option('pp_portfolio_slider_animation');
if(empty($pp_portfolio_slider_animation))
{
    $pp_portfolio_slider_animation = 'fade';
}
?>
		
</div>

<!-- Begin content -->
<div id="content_wrapper">

    <div class="page_caption">
    	<div class="caption_inner">
    		<div class="caption_header">
    			<h1 class="cufon"><span><?php the_title(); ?></span></h1>
    		</div>
    		<?php
				//Include social icons
				include (TEMPLATEPATH . "/templates/socials-icons.php");
			?>
    	</div>
    	<br class="clear"/>
    </div>
    <br class="clear"/>
    
    <div class="inner">
    
    	<!-- Begin main content -->
    	<div class="inner_wrapper">
    	
    	<div class="standard_wrapper">
    	
    		<?php
    			//If display featured image
    			if(empty($portfolio_gallery_id))
    			{
			    	$image_thumb = '';
			    								
			    	if(has_post_thumbnail(get_the_ID(), 'slide'))
			    	{
			    	    $image_id = get_post_thumbnail_id(get_the_ID());
			    	    $image_thumb = wp_get_attachment_image_src($image_id, 'slide', true);
			    	}
			?>
					<img src="<?php echo $image_thumb[0]; ?>" alt="" class="portfolio_single_img img_shadow"/>
			<?php
				}
				//If display image gallery
				else
				{
			?>
			<div id="slider_wrapper" <?php if($pp_portfolio_slider_animation=='slide') { ?>class="slide"<?php } ?>>
				<div id="portfolio_slider" class="flexslider">
				<ul class="slides">
			<?php
					$args = array( 
		    			'post_type' => 'attachment', 
		    			'numberposts' => -1, 
		    			'post_status' => null, 
		    			'post_parent' => $portfolio_gallery_id,
		    			'order' => 'ASC',
		    			'orderby' => 'menu_order',
		    		); 								
		    		$all_photo_arr = get_posts( $args );
		    		
		    		foreach($all_photo_arr as $key => $photo_item)
		    		{
		    			$image_slide = wp_get_attachment_image_src($photo_item->ID, 'slide', true);
			?>
				
						<li>
							<img src="<?php echo $image_slide[0]; ?>" alt="<?php echo $photo_item->post_title; ?>"/>
						</li>
				
			<?php	
					}
			?>
				</ul>
				</div>
			</div>
				
			<?php
				//Get portfolio slider settings
				$pp_portfolio_slider_timer = get_option('pp_portfolio_slider_timer');
				if(empty($pp_portfolio_slider_timer))
				{
					$pp_portfolio_slider_timer = 5;
				}
				
				$pp_portfolio_slider_autoplay = get_option('pp_portfolio_slider_autoplay');
			?>
			<script type="text/javascript"> 
			$j(window).load(function() {
			    $j('#portfolio_slider').flexslider({
			    	animation: "<?php echo $pp_portfolio_slider_animation; ?>",
			    	<?php
					if(empty($pp_portfolio_slider_autoplay))
					{
					?>
					slideshow: false,
					<?php
					}
					?>
					slideshowSpeed: <?php echo $pp_portfolio_slider_timer*1000; ?>
			    });
			});
			</script>
			<?php
				}
			?>
    		
    	</div>
    	<br class="clear"/><br/>
    	
    	<?php

			if (have_posts()) : while (have_posts()) : the_post();
		?>
    	
    		<?php
    		    the_content();
    		?>
   			
   		<?php endwhile; endif; ?>
   		
   		<?php
   			$pp_blog_share = get_option('pp_blog_share');
					    	
	        if(!empty($pp_blog_share))
	        {
	    ?>	
	    
	        <br class="clear"/><hr/>
	    
	        <div class="post_social">
	        
	            <iframe src="//www.facebook.com/plugins/like.php?href=<?php echo urlencode(get_permalink()); ?>&amp;send=false&amp;layout=button_count&amp;width=200&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21&amp;appId=268239076529520" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:110px; height:21px;" allowTransparency="true"></iframe>
	            
	            <!-- Place this tag where you want the +1 button to render -->
	        	<g:plusone size="medium" href="<?php echo get_permalink(); ?>"></g:plusone>
	        	
	        	<!-- Place this render call where appropriate -->
	        	<script type="text/javascript">
	        	  (function() {
	        	    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
	        	    po.src = 'https://apis.google.com/js/plusone.js';
	        	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
	        	  })();
	        	</script>
	    
	            <a href="https://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-text="<?php the_title(); ?>" data-url="<?php echo get_permalink(); ?>">Tweet</a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
	            
	            <a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink()); ?>" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a>
	        
	        </div>
	        
	    <?php
	        }
	    ?>
    	
    	<?php 
    		//If enable recent portfolios
    		$pp_portfolio_enable_recent = get_option('pp_portfolio_enable_recent');
    		$pp_portfolio_recent_items = get_option('pp_portfolio_recent_items');
    		if(empty($pp_portfolio_recent_items))
    		{
    			$pp_portfolio_recent_items = 12;
    		}
    		
    		if(!empty($pp_portfolio_enable_recent))
			{
    			echo '<br class="clear"/><br/><br/>'.do_shortcode('[portfolio2 items="'.$pp_portfolio_recent_items.'" set_id="" pause_time="10"]');
    		}
    	?>
    	<!-- End main content -->
    	
    	<br class="clear"/>
    </div>
</div>
				

<?php get_footer(); ?>