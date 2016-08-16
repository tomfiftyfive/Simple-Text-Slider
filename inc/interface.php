<?php
defined( 'ABSPATH' ) or die( 'Nope!' );

// add plugin list menu links
function simpleTextSlider_action_links( $links ) {
   $links[] = '<a href="'. esc_url( get_admin_url(null, 'options-general.php?page=simple_text_slider') ) .'">Settings</a>';
   //$links[] = '<a href="http://tom-henneken.de" target="_blank">...</a>';
   return $links;
}

add_action( 'admin_menu', 'simpleTextSlider_add_admin_menu' );
add_action( 'admin_init', 'simpleTextSlider_settings_init' );

function simpleTextSlider_add_admin_menu(  ) { 

	add_options_page( 'Simple Text Slider', 'Simple Text Slider', 'manage_options', 'simple_text_slider', 'simpleTextSlider_options_page' );
}

function simpleTextSlider_settings_init(  ) { 

	register_setting( 'pluginPage', 'simpleTextSlider_settings' );

	add_settings_section(
		'simpleTextSlider_pluginPage_section', 
		__( 'Settings', 'wordpress' ), 
		'simpleTextSlider_settings_section_callback', 
		'pluginPage'
	);

	add_settings_field( 
		'simpleTextSlider_text_field_0', 
		__( 'Slider background color:', 'wordpress' ), 
		'simpleTextSlider_text_field_0_render', 
		'pluginPage', 
		'simpleTextSlider_pluginPage_section' 
	);

//	add_settings_field( 
//		'simpleTextSlider_textarea_field_1', 
//		__( 'Settings field description', 'wordpress' ), 
//		'simpleTextSlider_textarea_field_1_render', 
//		'pluginPage', 
//		'simpleTextSlider_pluginPage_section' 
//	);
}


function simpleTextSlider_text_field_0_render(  ) { 

	$options = get_option( 'simpleTextSlider_settings' );
	?>
	<input type='text' name='simpleTextSlider_settings[simpleTextSlider_text_field_0]' value='<?php echo $options['simpleTextSlider_text_field_0']; ?>'>
	<?php
}


function simpleTextSlider_textarea_field_1_render(  ) { 

	$options = get_option( 'simpleTextSlider_settings' );
	?>
	<textarea cols='40' rows='5' name='simpleTextSlider_settings[simpleTextSlider_textarea_field_1]'> 
		<?php echo $options['simpleTextSlider_textarea_field_1']; ?>
 	</textarea>
	<?php
}


function simpleTextSlider_settings_section_callback(  ) { 

	echo __( 'How to use:', 'wordpress' );
    ?>
    <p>placeholder</p>
    <?php
}

function simpleTextSlider_options_page(  ) { 

	?>
	<form action='options.php' method='post'>
		<h2>Simple Text Slider</h2>
		<?php
		settings_fields( 'pluginPage' );
		do_settings_sections( 'pluginPage' );
		submit_button();
		?>
	</form>
	<?php
}
?>