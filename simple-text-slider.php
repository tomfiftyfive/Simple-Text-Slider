<?php

/*
    Plugin Name: Simple Text Slider
    Plugin URI: http://tom-henneken.de
    Version: 1.0
    Author: Tom Henneken
    Author URI: http://tom-henneken.de
    Description: Adds a simple shortcode to output a vertical text slider.
    License: GPL
*/

/* 
    Shortcode
    [simple-text-slider before="text" slides="1,2,3" after="text" speed="3"]
*/


// TODO: add style css version and prefix
add_action( 'wp_enqueue_scripts', 'simpleTextSlider_css' );

function simpleTextSlider_css() {
    // Respects SSL, Style.css is relative to the current file
    wp_register_style( 'simpleTs-basic', plugins_url('css/simpleTs_style.css', __FILE__) );
    wp_enqueue_style( 'simpleTs-basic' );
    
    wp_register_script( 'jquery-keyframes', plugins_url('js/jquery.keyframes.min.js', __FILE__) );
    wp_enqueue_script( 'jquery-keyframes' );
    
    wp_register_script( 'simpleTs-main', plugins_url('js/simpleTs_scripts.js', __FILE__) );
    wp_enqueue_script( 'simpleTs-main' );
}

function simpleTextSlider($atts) {
    extract(shortcode_atts(array(
        "before" => 'I like',
        "slides" => 'Apples, Bananas, Kartoffelz',
        "after" => 'very much.',
        "speed" => ''
        ), $atts));
    
    $slideList = explode( ',', $slides );
    
    // TODO: make tag dynamic
    $tag = "h3";
    
    $slideListOutput = "";
    $slideListCount = count($slideList);
    $slideListPosition = 0;
    
    foreach ($slideList as $singleSlide) {
        $slideListPosition++;
        
        if($slideListPosition == $slideListCount) {
            $slideListOutput .= $singleSlide;
        } else {
            $slideListOutput .= '<span class="simpleTs_item">' . $singleSlide . '</span><br>';
        }
        
    }
    
    return 
        '<' . $tag . ' class="simpleTs_Container" style="visibility: visible;">
            <p class="before">' . $before . '</p>
            <div class="outer">
                <div class="inner" data-simpleTs-speed="' . $speed . '">
                    ' . $slideListOutput . '
                </div>
            </div>
            <p class="after">' . $after . '</p>
        </' . $tag . '>'
    ;

}

add_shortcode("simple-text-slider", "simpleTextSlider");

?>