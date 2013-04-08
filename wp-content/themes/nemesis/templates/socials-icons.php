<div class="social_wrapper">
    <ul>
    	<?php
    		$pp_twitter_username = get_option('pp_twitter_username');
    		
    		if(!empty($pp_twitter_username))
    		{
    	?>
    	<li><a title="Twitter" href="http://twitter.com/<?php echo $pp_twitter_username; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/social_dark/twitter.png" alt=""/></a></li>
    	<?php
    		}
    	?>
    	<?php
    		$pp_facebook_username = get_option('pp_facebook_username');
    		
    		if(!empty($pp_facebook_username))
    		{
    	?>
    	<li><a title="Facebook" href="http://facebook.com/<?php echo $pp_facebook_username; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/social_dark/facebook.png" alt=""/></a></li>
    	<?php
    		}
    	?>
    	<?php
    		$pp_flickr_username = get_option('pp_flickr_username');
    		
    		if(!empty($pp_flickr_username))
    		{
    	?>
    	<li><a title="Flickr" href="http://flickr.com/people/<?php echo $pp_flickr_username; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/social_dark/flickr.png" alt=""/></a></li>
    	<?php
    		}
    	?>
    	<?php
    		$pp_youtube_username = get_option('pp_youtube_username');
    		
    		if(!empty($pp_youtube_username))
    		{
    	?>
    	<li><a title="Youtube" href="http://youtube.com/user/<?php echo $pp_youtube_username; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/social_dark/youtube.png" alt=""/></a></li>
    	<?php
    		}
    	?>
    	<?php
    		$pp_vimeo_username = get_option('pp_vimeo_username');
    		
    		if(!empty($pp_vimeo_username))
    		{
    	?>
    	<li><a title="Vimeo" href="http://vimeo.com/<?php echo $pp_vimeo_username; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/social_dark/vimeo.png" alt=""/></a></li>
    	<?php
    		}
    	?>
    	<?php
    		$pp_tumblr_username = get_option('pp_tumblr_username');
    		
    		if(!empty($pp_tumblr_username))
    		{
    	?>
    	<li><a title="Tumblr" href="http://<?php echo $pp_tumblr_username; ?>.tumblr.com"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/social_dark/tumblr.png" alt=""/></a></li>
    	<?php
    		}
    	?>
    	<?php
    		$pp_google_username = get_option('pp_google_username');
    		
    		if(!empty($pp_google_username))
    		{
    	?>
    	<li><a title="Google+" href="<?php echo $pp_google_username; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/social_dark/google.png" alt=""/></a></li>
    	<?php
    		}
    	?>
    	<?php
    		$pp_dribbble_username = get_option('pp_dribbble_username');
    		
    		if(!empty($pp_dribbble_username))
    		{
    	?>
    	<li><a title="Dribbble" href="http://dribbble.com/<?php echo $pp_dribbble_username; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/social_dark/dribbble.png" alt=""/></a></li>
    	<?php
    		}
    	?>
    	<?php
    		$pp_digg_username = get_option('pp_digg_username');
    		
    		if(!empty($pp_digg_username))
    		{
    	?>
    	<li><a title="Digg" href="http://digg.com/<?php echo $pp_digg_username; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/social_dark/digg.png" alt=""/></a></li>
    	<?php
    		}
    	?>
    	<?php
    		$pp_linkedin_username = get_option('pp_linkedin_username');
    		
    		if(!empty($pp_linkedin_username))
    		{
    	?>
    	<li><a title="Linkedin" href="<?php echo $pp_linkedin_username; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/social_dark/linkedin.png" alt=""/></a></li>
    	<?php
    		}
    	?>
    </ul>
</div>