<?php

// add plugin list menu links
function simpleTextSlider_action_links( $links ) {
   $links[] = '<a href="'. esc_url( get_admin_url(null, 'options-general.php?page=simpleTextSlider') ) .'">Settings</a>';
   //$links[] = '<a href="http://tom-henneken.de" target="_blank">...</a>';
   return $links;
}

// add backend menu item
add_action( 'admin_menu', 'simpleTextSlider_menu' );

function simpleTextSlider_menu() {
	add_options_page( 'Simple Text Slider Options', 'Simple Text Slider', 'manage_options', 'simpleTextSlider', 'simpleTextSlider_options' );
}

// backend content
function simpleTextSlider_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	echo '<div class="wrap">';
	echo '<h2>Simple Text Slider</h2>';
    echo '<p>Content.</p>';
	echo '</div>';
}


?>