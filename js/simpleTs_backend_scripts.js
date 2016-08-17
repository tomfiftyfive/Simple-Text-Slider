jQuery( document ).ready( function( $ ) {
    $( 'input.alpha-color-picker' ).alphaColorPicker();
    
    var alphaColorZindex = 100;
    $('.wp-picker-container').each(function() {
        alphaColorZindex--;
        $(this).css('z-index', alphaColorZindex);
    });
});