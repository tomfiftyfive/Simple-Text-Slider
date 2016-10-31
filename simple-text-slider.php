<?php
defined( 'ABSPATH' ) or die( 'Nope!' );

/*
    Plugin Name: Simple Text Slider
    Plugin URI: http://tom-henneken.de
    Version: 1.0.5
    Author: Tom Henneken
    Author URI: http://tom-henneken.de
    Description: Adds a simple shortcode to output serveral vertical text slider wherever you want.
    License: GPL
*/

add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'simpleTextSlider_action_links' );
include("inc/interface.php");

// TODO: add style css version and prefix
add_action( 'wp_enqueue_scripts', 'simpleTextSlider_files' );

function simpleTextSlider_files() {
    
    // Respects SSL, Style.css is relative to the current file
    wp_register_style( 'simpleTs-basic', plugins_url('css/simpleTs_style.css', __FILE__) );
    wp_enqueue_style( 'simpleTs-basic' );
    
    wp_register_script( 'jquery-keyframes', plugins_url('js/jquery.keyframes.min.js', __FILE__) );
    wp_enqueue_script( 'jquery-keyframes' );
    
    wp_register_script( 'simpleTs-main', plugins_url('js/simpleTs_scripts.js', __FILE__) );
    wp_enqueue_script( 'simpleTs-main' );
}

// shortcode function
function simpleTextSlider($atts) {
    $options = get_option( 'simpleTextSlider_settings' );
    $delimiter = $options['simpleTextSlider_text_field_2'];
    if(!($delimiter)) {
        $delimiter = ',';
    }
    
    extract(shortcode_atts(array(
        "before" => 'I like',
        "slides" => 'Simple, Text, Slider',
        "after" => 'very much.',
        "speed" => '',
        "bcolor" => '',
        "tcolor" => '',
        "style" => '',
        "tag" => 'div'
        ), $atts));
    
    // split slides
    $slideList = explode($delimiter, $slides);
    
    // count slides
    $slideListOutput = "";
    $slideListCount = count($slideList);
    
    $slideListPosition = 0;
    // loop through slides and generate them
    foreach ($slideList as $singleSlide) {
        $slideListPosition++;
        
        if($slideListPosition == $slideListCount) {
            $slideListOutput .= $singleSlide;
        } else {
            $slideListOutput .= '<span class="simpleTs_item">' . $singleSlide . '</span><br>';
        }
        
    }
    
    // set bg and text color
    if($bcolor) {
        // background color via shortcode
        $customBackgroundColor = $bcolor;
    } else {
        // background color via options
        $customBackgroundColor = $options['simpleTextSlider_text_field_0'];
        
    }
    if($tcolor) {
        // text color via shortcode
        $customTextColor = $tcolor;
    } else {
        // text color via options
        $customTextColor = $options['simpleTextSlider_text_field_1'];
    }
    $customBackgroundColor = 'background-color: ' . $customBackgroundColor . ';';
    $customTextColor = 'color: ' . $customTextColor . ';';
    
    // html return/output
    return 
        '<' . $tag . ' class="simpleTs_Container" style="visibility: visible;">
            <div class="simpleTs_before">' . $before . '</div>
            <div class="simpleTs_outer" style="' . $customBackgroundColor . $customTextColor . $style . '">
                <div class="simpleTs_inner" data-simpleTs-speed="' . $speed . '">
                    ' . $slideListOutput . '
                </div>
            </div>
            <div class="simpleTs_after">' . $after . '</div>
        </' . $tag . '>'
    ;

}

add_shortcode("simple-text-slider", "simpleTextSlider");

?>