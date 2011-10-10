<?php
/*
 Plugin Name: Wiki
 Plugin URI: http://premium.wpmudev.org/project/wiki
 Description: Add a wiki to your blog
 Author: Mahibul Hasan(Edited) and orignal by inscub
 WDP ID: 168
 Version: 1.0.9
 Author URI: http://premium.wpmudev.org
*/
/**
 * @global	object	$wiki	Convenient access to the chat object
 */
global $wiki;

if ( function_exists('is_supporter') && !is_supporter()) {
    function wiki_non_supporter_page() {
	?>
	<h3><?php _e('Pro Only...', 'incsub_wiki'); ?></h3>
	<script type="text/javascript">
	window.location = '<?php echo get_admin_url(); ?>supporter.php';
	</script>
	<?php
    }
    
    function wiki_non_suppporter_admin_menu() {
	add_menu_page(__('Wiki', 'incsub_wiki'), __('Wiki', 'incsub_wiki'), 'edit_posts', 'incsub_wiki', 'wiki_non_supporter_page', null, 30);
    }
    
    add_action('admin_menu', 'wiki_non_suppporter_admin_menu');
} else {
    include_once 'wiki-include.php';
}

if ( !function_exists( 'wdp_un_check' ) ) {
  //  add_action( 'admin_notices', 'wdp_un_check', 5 );
    add_action( 'network_admin_notices', 'wdp_un_check', 5 );

    function wdp_un_check() {
        if ( !class_exists( 'WPMUDEV_Update_Notifications' ) && current_user_can( 'edit_users' ) )
	    echo '<div class="error fade"><p>' . __('Please install the latest version of <a href="http://premium.wpmudev.org/project/update-notifications/" title="Download Now &raquo;">our free Update Notifications plugin</a> which helps you stay up-to-date with the most stable, secure versions of WPMU DEV themes and plugins. <a href="http://premium.wpmudev.org/wpmu-dev/update-notifications-plugin-information/">More information &raquo;</a>', 'wpmudev') . '</a></p></div>';
    }
}
