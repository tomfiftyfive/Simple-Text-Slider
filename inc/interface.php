<?php
defined( 'ABSPATH' ) or die( 'Nope!' );

// add plugin list menu links
function simpleTextSlider_action_links( $links ) {
   $links[] = '<a href="'. esc_url( get_admin_url(null, 'options-general.php?page=simple_text_slider') ) .'">Settings</a>';
   //$links[] = '<a href="http://tom-henneken.de" target="_blank">...</a>';
   return $links;
}

// backend scripts and styles
add_action( 'admin_enqueue_scripts', 'simpleTextSlider_backend_files' );

function simpleTextSlider_backend_files( $hook ) { 
    if( is_admin() ) {
        
        // color picker js and css
        wp_enqueue_script( 'alpha-color-picker', plugins_url( '../js/alpha-color-picker.js', __FILE__ ), array( 'wp-color-picker' ), null, true );
        
        wp_enqueue_style( 'alpha-color-picker', plugins_url( '../css/alpha-color-picker.css', __FILE__ ), array( 'wp-color-picker' ));
 
        // interface js
        wp_enqueue_script( 'custom-script-handle', plugins_url( '../js/simpleTs_backend_scripts.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
    }
}

// init menu and settings
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

// render interface output
function simpleTextSlider_text_field_0_render(  ) { 

	$options = get_option( 'simpleTextSlider_settings' );
	?>
	<input type="text" class="alpha-color-picker" name='simpleTextSlider_settings[simpleTextSlider_text_field_0]'  value='<?php echo $options['simpleTextSlider_text_field_0']; ?>' data-default-color="#222" data-show-opacity="true" />
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