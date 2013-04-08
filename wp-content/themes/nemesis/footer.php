<?php
/**
 * The template for displaying the footer.
 *
 * @package WordPress
 */
?>
	
	</div>
		
		</div>
		
		<!-- Begin footer -->
		<div id="footer">
			<?php
				$pp_footer_display_sidebar = get_option('pp_footer_display_sidebar');
			
				if(!empty($pp_footer_display_sidebar))
				{
					$pp_footer_style = get_option('pp_footer_style');
					$footer_class = '';
					
					switch($pp_footer_style)
					{
						case 1:
							$footer_class = 'one';
						break;
						case 2:
							$footer_class = 'two';
						break;
						case 3:
							$footer_class = 'three';
						break;
						case 4:
							$footer_class = 'four';
						break;
						default:
							$footer_class = 'four';
						break;
					}
					
			?>
			<ul class="sidebar_widget <?php echo $footer_class; ?>">
				<?php dynamic_sidebar('Footer Sidebar'); ?>
			</ul>
			
			<br class="clear"/>
			<?php
				}
			?>
			
		</div>
		<!-- End footer -->
		<div>
		<div>
		
		<div id="copyright" <?php if(empty($pp_footer_display_sidebar)) { echo 'style="border-top:0"'; } ?>>
			<div class="copyright_wrapper">
				<div class="left_wrapper">
				<?php
					/**
					 * Get footer left text
					 */
	
					$pp_footer_text = get_option('pp_footer_text');
	
					if(empty($pp_footer_text))
					{
						$pp_footer_text = 'Copyright © 2012 Nemesis Theme. Powered by <a href="http://wordpress.org/">Wordpress</a>.<br/>Wordpress theme by <a href="http://themeforest.net/user/peerapong/portfolio" target="_blank">Peerapong</a>';
					}
					
					echo nl2br(stripslashes(html_entity_decode($pp_footer_text)));
				?>
				</div>
				
				<div class="right_wrapper">
				<?php
					/**
					 * Get footer right text
					 */
	
					$pp_footer_right_text = get_option('pp_footer_right_text');
	
					if(empty($pp_footer_right_text))
					{
						$pp_footer_right_text = 'All images are copyrighted to their respective owners.';
					}
					
					echo nl2br(stripslashes(html_entity_decode($pp_footer_right_text)));
				?>
				</div>
				<br class="clear"/>
			</div>
			</div>
		
		</div>
	
	</div>
	
		

<?php
		/**
    	*	Setup Google Analyric Code
    	**/
    	include (TEMPLATEPATH . "/google-analytic.php");
?>

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>

<?php
$pp_blog_share = get_option('pp_blog_share');
					    	
if(!empty($pp_blog_share))
{
?>
<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
<?php
}
?>
</body>
</html>
