<?php
/* Plugin name: Post Thumbnail Editor
   Plugin URI: http://wordpress.org/extend/plugins/post-thumbnail-editor/
   Author: sewpafly
   Author URI: http://sewpafly.github.com/post-thumbnail-editor
   Version: 2.0.1
   Description: Individually manage your post thumbnails

    LICENSE
     =======

    Copyright 2013  (email : sewpafly@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

     CREDITS
     =======
 */

/* 
 * Useful constants  
 */
define( 'PTE_PLUGINURL', plugins_url(basename( dirname(__FILE__))) . "/");
define( 'PTE_PLUGINPATH', dirname(__FILE__) . "/");
define( 'PTE_DOMAIN', "post-thumbnail-editor");
define( 'PTE_VERSION', "2.0.1");

/*
 * Option Functionality
 */
function pte_get_option_name(){
    global $current_user;
    if ( ! isset( $current_user ) ){
        get_currentuserinfo();
    }
    return "pte-option-{$current_user->ID}";
}

function pte_get_user_options(){
    $pte_options = get_option( pte_get_option_name() );
    if ( !is_array( $pte_options ) ){
        $pte_options = array();
    }
    $defaults = array( 'pte_debug' => false
        , 'pte_crop_save' => false
    );

    // WORDPRESS DEBUG overrides user setting...
    return array_merge( $defaults, $pte_options );
}

function pte_get_site_options(){
	$pte_site_options = get_option( 'pte-site-options' );
	if ( !is_array( $pte_site_options ) ){
		$pte_site_options = array();
	}
	$defaults = array( 'pte_hidden_sizes' => array(),
		'cache_buster' => true
	);
	return array_merge( $defaults, $pte_site_options );
}

function pte_get_options(){
    global $pte_options, $current_user;
    if ( isset( $pte_options ) ){
        return $pte_options;
    }

    $pte_options = array_merge( pte_get_user_options(), pte_get_site_options() );

    if ( WP_DEBUG )
            $pte_options['pte_debug'] = true;

    if ( !isset( $pte_options['pte_jpeg_compression'] ) ){
            $pte_options['pte_jpeg_compression'] = apply_filters( 'jpeg_quality', 90, 'pte_options' );
    }

    return $pte_options;
}

function pte_update_user_options(){
	require_once( PTE_PLUGINPATH . 'php/options.php' );
	$options = pte_get_user_options();

	if ( isset( $_REQUEST['pte_crop_save'] )
			&& strtolower( $_REQUEST['pte_crop_save'] ) === "true" )
		$options['pte_crop_save'] = true;
	else
		$options['pte_crop_save'] = false;

	//print_r $options
	update_option( pte_get_option_name(), $options );
}

/*
 * Put Hooks and immediate hook functions in this file
 */

/* Hook into the Edit Image page */
function pte_admin_media_scripts($post_type){
	$options = pte_get_options();
	wp_enqueue_script( 'pte'
		, PTE_PLUGINURL . 'apps/coffee-script.js'
		, array('underscore')
		, PTE_VERSION
	);
	wp_localize_script('pte'
		, 'pteL10n'
		, array('PTE' => __('Post Thumbnail Editor', PTE_DOMAIN)
			, 'url' => pte_url( "<%= id %>" )
		)
	);
	if ($post_type == "attachment") {
		add_action("admin_print_footer_scripts","pte_enable_admin_js",100);
	}
	else {
		add_action( 'admin_print_footer_scripts', 'pte_enable_media_js', 100);
	}
}
// Add the PTE link to the featured image in the post screen
// Called in wp-admin/includes/post.php
add_filter( 'admin_post_thumbnail_html', 'pte_admin_post_thumbnail_html', 10, 2 );

function pte_enable_admin_js(){
   injectCoffeeScript( PTE_PLUGINPATH . "js/snippets/admin.coffee" );
}

function pte_enable_media_js(){
   injectCoffeeScript( PTE_PLUGINPATH . "js/snippets/media.coffee" );
}


function pte_url( $id ){
	$pte_url = admin_url('upload.php') 
		. "?page=pte-edit&pte-id=" 
		. $id;

	return $pte_url;
}


function pte_admin_post_thumbnail_html( $content, $post_id ){
	$thumbnail_id = get_post_thumbnail_id( $post_id );
	if ( $thumbnail_id == null )
		return $content;

	return $content .= '<p id="pte-link" class="hide-if-no-js"><a target="_blank" href="' 
		. pte_url( $thumbnail_id )
		. '">' 
		. esc_html__( 'Post Thumbnail Editor', PTE_DOMAIN ) 
		. '</a></p>';
}


function injectCoffeeScript($coffeeFile){
    $coffee = @file_get_contents( $coffeeFile );
    //$options = json_encode( pte_get_options() );
    echo <<<EOT
<script type="text/coffeescript">
$coffee
</script>
EOT;
}

// Base url/function.  All pte interactions go through here
function pte_ajax(){
   // Move all adjuntant functions to a separate file and include that here
   require_once(PTE_PLUGINPATH . 'php/functions.php');
   $logger = PteLogger::singleton();
   $logger->debug( "PARAMETERS: " . print_r( $_REQUEST, true ) );

   switch ($_GET['pte-action'])
   {
      case "test":
            pte_test();
            break;
      case "resize-images":
            pte_resize_images();
            break;
      case "confirm-images":
            pte_confirm_images();
            break;
      case "delete-images":
            pte_delete_images();
            break;
      case "get-thumbnail-info":
            $id = pte_check_id((int) $_GET['id']);
            print( json_encode( pte_get_all_alternate_size_information( $id ) ) );
            break;
		case "change-options":
				pte_update_user_options();
            break;
   }
   die();
}

function pte_media_row_actions($actions, $post, $detached){
    // Add capability check
    if ( !current_user_can( 'edit_post', $post->ID ) ){
        return $actions;
    }
    $options = pte_get_options();

	 $pte_url = pte_url( $post->ID );

    $actions['pte'] = "<a href='${pte_url}' title='"
        . __( 'Edit Thumbnails', PTE_DOMAIN )
        . "'>" . __( 'Thumbnails', PTE_DOMAIN ) . "</a>";
    return $actions;
}

// Anonymous function (which apparently some versions of PHP will whine about)
function pte_launch_options_page(){
   require_once( PTE_PLUGINPATH . 'php/options.php' ); pte_options_page();
}
function pte_edit_page(){
   global $post;
   include_once( PTE_PLUGINPATH . "php/functions.php" );
   pte_launch( PTE_PLUGINPATH . "html/pte.php", $post->ID );
}

/**
 * These pages are linked into the hook system of wordpress, this means
 * that almost any wp_admin page will work as long as you append "?page=pte"
 * or "?page=pte-edit".  Try the function `'admin_url("index.php") . '?page=pte';`
 *
 * The function referred to here will output the HTML for the page that you want
 * to display. However if you want to hook into enqueue_scripts or styles you
 * should use the page-suffix that is returned from the function. (e.g.
 * `add_action("load-".$hook, hook_func);`)
 *
 * There is also another hook with the same name as the hook that's returned.
 * I don't remember in which order it is launched, but I believe the pertinent
 * code is in admin-header.php.
 */
function pte_admin_menu(){
    add_options_page( __('Post Thumbnail Editor', PTE_DOMAIN) . "-title",
        __('Post Thumbnail Editor', PTE_DOMAIN),
        'edit_posts',
        'pte',
        'pte_launch_options_page'
    );
   /**
    * This hook depends on which page you use in the admin section
    */
    $hook = add_submenu_page( NULL, __('Post Thumbnail Editor', PTE_DOMAIN) . "-edit",
        __('Post Thumbnail Editor', PTE_DOMAIN),
        'edit_posts',
        'pte-edit',
        'pte_edit_page'
    );
   //print( "HOOK: $hook" );
}

function pte_options(){
    require_once( PTE_PLUGINPATH . 'php/options.php' );
    pte_options_init();
}

/* This is the main admin media page */
/** For the "Edit Image" stuff **/
//add_action('edit_form_advanced', 'pte_admin_media_scripts');
add_action('dbx_post_advanced', 'pte_edit_form_hook_redirect');
/* Slight redirect so this isn't called on all versions of the media upload page */
function pte_edit_form_hook_redirect(){
   add_action('add_meta_boxes', 'pte_admin_media_scripts');
}

/* Adds the Thumbnail option to the media library list */
add_filter('media_row_actions', 'pte_media_row_actions', 10, 3); // priority: 10, args: 3

/* For all purpose needs */
add_action('wp_ajax_pte_ajax', 'pte_ajax');

/* Add SubMenus/Pages */
add_action( 'admin_menu', 'pte_admin_menu' );
/* Add Settings Page */
add_action( 'load-settings_page_pte', 'pte_options' );
/* Add Settings Page -> Submit/Update options */
add_action( 'load-options.php', 'pte_options' );
//add_action( 'admin_init', 'pte_options' );

/* Admin Edit Page: setup*/
/**
 * This hook (load-media_page_pte-edit)
 *    depends on which page you use in the admin section
 * (load-media_page_pte-edit) : wp-admin/upload.php?page=pte-edit
 * (dashboard_page_pte-edit)  : wp-admin/?page=pte-edit
 * (posts_page_pte-edit)      : wp-admin/edit.php?page=pte-edit
 */
add_action( 'load-media_page_pte-edit', 'pte_edit_setup' );
function pte_edit_setup() {
   global $post;
   $post_id = (int) $_GET['pte-id'];
   if ( !isset( $post_id ) || !is_int( $post_id ) || !wp_attachment_is_image( $post_id ) ){
      //die("POST: $post_id IS_INT:" . is_int( $post_id ) . " ATTACHMENT: " . wp_attachment_is_image( $post_id ));
      wp_redirect( admin_url( "upload.php" ) );
      exit();
   }
   $post = get_post( $post_id );

   // Enqueue Scripts
   // Would do jquery here, but looks to be default enqueued out of the box
   wp_localize_script( 'jquery', // Called on every admin page :)
      'pteI18n',
      array( 'no_t_selected' => __( 'No thumbnails selected', PTE_DOMAIN )
         , 'no_c_selected' => __( 'No crop selected', PTE_DOMAIN )
         , 'crop_problems' => __( 'Cropping will likely result in skewed imagery', PTE_DOMAIN )
         , 'save_crop_problem' => __( 'There was a problem saving the crop...', PTE_DOMAIN )
         , 'cropSave' => __( 'Crop and Save', PTE_DOMAIN )
         , 'crop' => __( 'Crop', PTE_DOMAIN )
      )
   );
}

/** End Settings Hooks **/

    load_plugin_textdomain( PTE_DOMAIN
        , false
        , basename( PTE_PLUGINPATH ) . DIRECTORY_SEPARATOR . "i18n" );


/** Test Settings **/
//add_image_size( 'pte test 1', 100, 0 );
//add_image_size( 'pte test 2', 100, 150, true );

?>
