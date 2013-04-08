<?php if ('open' == $post->comment_status) : ?>

	<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
		<p>You must be <a href="<?php echo wp_login_url( get_permalink() ); ?>">logged in</a> to post a comment.</p><br/>
	<?php else : ?>

	<!-- Start of form --> 
	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" class="comment_form"> 
		<fieldset> 

		<h5><?php echo _e("Leave a Reply", THEMEDOMAIN); ?></h5>
		    
		<?php if ( is_user_logged_in() ) : ?>
		    

		<?php else : ?>
			<br/>
		   	<input class="round m input" name="author" type="text" id="author" value="" tabindex="1" style="width:50%" /> 
		   	<label for="author"><?php echo _e( 'Name', THEMEDOMAIN ); ?>*</label>
		    <br/><br/>
		    
		    <input class="round m input" name="email" type="text" id="email" value="" tabindex="2" style="width:50%" /> 
		    <label for="email"><?php echo _e( 'Email', THEMEDOMAIN ); ?>*</label>
		    <br/><br/>
		    
		    <input class="round m input" name="url" type="text" id="url" value="" tabindex="3" style="width:50%" />
		    <label for="url"><?php echo _e( 'Website', THEMEDOMAIN ); ?>*</label>
		    <br/>

		<?php endif; ?>
		    
		    <br/>
		    <textarea name="comment" cols="40" rows="7" id="comment" tabindex="4" style="width:82%"></textarea>
		    <label for="comment"><?php echo _e( 'Message', THEMEDOMAIN ); ?>*</label>
		    
		   	<br class="clear"/><br/>
		    <input name="submit" type="submit" id="submit" value="<?php echo _e( 'Submit', THEMEDOMAIN ); ?>" tabindex="5" />&nbsp;
		    <?php cancel_comment_reply_link(__( 'Cancel Reply', THEMEDOMAIN )); ?> 

		    <?php comment_id_fields(); ?> 
		    <?php do_action('comment_form', $post->ID); ?>
		    
		<?php endif; // If registration required and not logged in ?>		   

		</fieldset> 
	</form> 
	<!-- End of form --> 

<?php endif; // if comment is open ?>
