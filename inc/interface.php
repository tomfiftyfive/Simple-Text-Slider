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
		__( 'Global Settings', 'wordpress' ), 
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

	add_settings_field( 
		'simpleTextSlider_text_field_1', 
		__( 'Slider text color:', 'wordpress' ), 
		'simpleTextSlider_text_field_1_render', 
		'pluginPage', 
		'simpleTextSlider_pluginPage_section' 
	);
    
    add_settings_field( 
		'simpleTextSlider_text_field_2', 
		__( 'Delimiter:', 'wordpress' ), 
		'simpleTextSlider_text_field_2_render', 
		'pluginPage', 
		'simpleTextSlider_pluginPage_section' 
	);
}

// render interface output
function simpleTextSlider_text_field_0_render(  ) { 

	$options = get_option( 'simpleTextSlider_settings' );
	?>
	<input type="text" class="alpha-color-picker simpleTs" name='simpleTextSlider_settings[simpleTextSlider_text_field_0]'  value='<?php echo $options['simpleTextSlider_text_field_0']; ?>' data-default-color="rgba(0,0,0,0.3)" data-show-opacity="true" />
	<?php
}

function simpleTextSlider_text_field_1_render(  ) { 

	$options = get_option( 'simpleTextSlider_settings' );
	?>
 	<input type="text" class="alpha-color-picker simpleTs" name='simpleTextSlider_settings[simpleTextSlider_text_field_1]'  value='<?php echo $options['simpleTextSlider_text_field_1']; ?>' data-default-color="rgba(255,255,255,1)" data-show-opacity="true" />
	<?php
}

function simpleTextSlider_text_field_2_render(  ) { 

	$options = get_option( 'simpleTextSlider_settings' );
	?>
 	<input type="text" name='simpleTextSlider_settings[simpleTextSlider_text_field_2]'  value='<?php echo $options['simpleTextSlider_text_field_2']; ?>' style="width: 30px" /> Default = ","
 	<p><b>Note: If you set an other delimiter than the default, consider this in your shortcode!</b></p>
	<?php
}

function simpleTextSlider_settings_section_callback(  ) { 

    ?>
    <p><b>Note: <a href="https://de.wordpress.org/plugins/jquery-updater/" target="_blank">jQuery</a> is required!</b></p>
    <?php
}

function simpleTextSlider_options_page(  ) { 
    
    $options = get_option( 'simpleTextSlider_settings' );
    $delimiter = $options['simpleTextSlider_text_field_2'];
    if(!($delimiter)){
        $delimiter = ',';
    }

	?>
	<div class="wrap">
        <h2>Simple Text Slider</h2>
        <p>Adds a simple shortcode to output multiple vertical text slider. <a href="https://tom-henneken.de/simple-text-slider-demos/" target="_blank">Demo</a></p>
        <form action='options.php' method='post'>
            <?php
            settings_fields( 'pluginPage' );
            do_settings_sections( 'pluginPage' );
            submit_button();
            ?>
        </form>
        <hr>
        <h2>How to use</h2>
        <p>Add the following shortcode wherever you want, to display a vertical text slider. You can use the code several times.</p>
        <p><code>[simple-text-slider before="text" slides="1<?php echo $delimiter; ?>2<?php echo $delimiter; ?>3" after="text"]</code></p>
        <h3><b>Example</b></h3>
        <p><code>[simple-text-slider before="I do" slides="This<?php echo $delimiter; ?>That<?php echo $delimiter; ?>Everything" after="and it's fun!" speed="3" tag="h3" bcolor="#000" tcolor="#fff" style="border-radius: 6px;"]</code></p>
        <ul>
            <li><b>before:</b> The text before the slider.</li>
            <li><b>after:</b> The text after the slider.</li>
            <li><b>slides:</b> The slides, seperated by "<?php echo $delimiter; ?>" default = ","</li>
            <li><b>Optional</b></li>
            <li><b>speed:</b> The animation speed in seconds. Default: slide count + 1</li>
            <li><b>tag:</b> Your slider container custom tag. Default: div</li>
            <li><b>bcolor:</b> Custom background color for single slider.</li>
            <li><b>tcolor:</b> Custom text color for single slider.</li>
            <li><b>style:</b> Custom css style, seperated by ";". Example: style="border-radius: 6px;"</li>
        </ul>
        <hr>
        <p>Thank you for downloading.</p>
        <p><span class="dashicons dashicons-admin-comments"></span> <b>Questions or feedback? <a href="https://wordpress.org/support/plugin/simple-text-slider" target="_blank">Here!</a></b><br> <span class="dashicons dashicons-star-filled"></span> <b>Like it? <a href="https://wordpress.org/support/view/plugin-reviews/simple-text-slider" target="_blank">Rate here!</a></b></p>
        <p>Simple Text Slider Wordpress Plugin by <a href="https://tom-henneken.de/?utm_source=wpplugin&utm_medium=link&utm_campaign=backend-stslider" target="_blank">Tom Henneken</a>.</p>
	</div>
	<?php
}
?>