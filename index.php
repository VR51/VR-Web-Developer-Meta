<?php
/*
Plugin Name: VR Web Developer Meta
Plugin URI: http://journalxtra.com/wordpress/plugins-wordpress/wordpress-plugin-to-add-developer-meta-tag-and-footer-credit/
Description: Adds web developer details to WordPress frontend page source code. Adds web developer's details to the site's footer. Plugin hides itself after plugin activation. YOU must edit the configs in the plugin index.php file. There are 3 sets of configs to edit. Click the "edit" button before activation.
Version: 1.0.1
Author: Lee Hodson
Author URI: http://vizred.com/
*/

    /* Ensure file cannot be called directly */
    defined('ABSPATH') or die("Direct file access denied");
    
      /* START CONFIGURATION 1 */
  
            $show_footer='show'; // Set to 'show' to display the footer. Leave empty to hide the footer.
    
      /* END CONFIGURATION 1 */

    /* Add meta data to site head */
    function VR51_DEV_META() {
    
      /* START CONFIGURATION 2 */
  
            $company='VizRED LLC';
            $website='http://vizred.com/';
            $signature='UNIQUE SITE SIGNATURE REFERENCE';
    
      /* END CONFIGURATION 2 */
      
      echo "<!-- Site designed and built by $company. -->",PHP_EOL; // HTML Comment
      echo "<meta name='designer' content='$company'>",PHP_EOL; // Official Tag - Site Designer
      echo "<meta name='designer_url' content='$website'>",PHP_EOL; // Unofficial Tag
      echo "<meta name='web_author' content='$company'>",PHP_EOL; // Official Tag - Site Developer
      echo "<meta name='web_author_url' content='$website'>",PHP_EOL; // Unofficial Tag
      echo "<meta name='site_ref_sig' content='$signature'>",PHP_EOL; // Unofficial Tag - Use this to search for site duplication
      echo "<!-- Site designed and built by $company. -->",PHP_EOL; // HTML Comment

    }
    add_action('wp_head','VR51_DEV_META',1,1);

    if ($show_footer=='show') {
    
	/* Add developer signature to site footer */
	function VR51_DEV_FOOTER() {
    
	  /* START CONFIGURATION 3 */
      
		$company='VizRED LLC';
			    $website='http://vizred.com';
			    $message_pre='Site designed and developed by ';
			    $message_post='';
	
		$style_des='
		    font-weight:normal;
		    text-decoration:none;
		    text-align:center;
		    display:block;
		';
		  
		$style_color='
		    background-color:#000;
		    color:#ddd!important;
		';
		
		$style_dims='
		    font-size:10px;
		    margin:0 auto 0 auto;
		    padding:none;
		    width:100%;
		';
	  
	  /* END CONFIGURATION 3 */
	  
	  echo "
		<div id='developer-info' style='$style_des $style_color $style_dims'>
		<p style='$style_dims'>$message_pre<a style='$style_color' href='$website' alt='$message_pre $company $message_post' target='_blank'>$company</a>$message_post</p>
		</div>";
	  
	}
	add_action('wp_footer','VR51_DEV_FOOTER',9999);
    }

    /* Hide plugin from view in plugin list by site admins. This function runs only for those viewing the dashboard */
    if (is_admin()) {
	function vr51_hide_meta_plugin() {
	  global $wp_list_table;
	  $hidearr = array(plugin_basename(__FILE__));
	  $myplugins = $wp_list_table->items;
	  foreach ($myplugins as $key => $val) {
	    if (in_array($key,$hidearr)) {
	      unset($wp_list_table->items[$key]);
	    }
	  }
	}
	add_action( 'pre_current_active_plugins', 'vr51_hide_meta_plugin' );
    }

?>