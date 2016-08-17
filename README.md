# Simple-Text-Slider

A simple text slider plugin for Wordpress Cms.

This plugin adds a simple shortcode to your wordpress installation. With the [simple-text-slider] shortcode you can output multiple vertical text slider.

![screenshot1](http://i.epvpimg.com/N1pze.png)

## Installation

- Copy the plugin contents into a folder named simple-text-tlider in your plugin directory of your wordpress installation.
- jQuery is required! You can install jQuery via <https://de.wordpress.org/plugins/jquery-updater/>
- Activate plugin.
- Place the shortcode wherever you want.

## Example

    [simple-text-slider before="I do" slides="This,That,Everything" after="and it's fun!" speed="3" tag="h3" bcolor="#000" tcolor="#fff" style="border-radius: 6px;"]
    
- before: The text before the slider.
- after: The text after the slider.
- slides: The slides, seperated by ","

*optional:*

- speed: The animation speed in seconds. Default: slide count + 1
- tag: Your slider container custom tag. Default: div
- bcolor: Custom background color for single slider.
- tcolor: Custom text color for single slider.
- style: Custom css style, seperated by ",". Example: style="border-radius: 6px;"