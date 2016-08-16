/**
 * Keyframes by https://github.com/Keyframes/jQuery.Keyframes
 * Thanks for this very nice jquery plugin.
 */

$(document).ready(function() {
    var supportedFlag = $.keyframe.isSupported();
    
    var simpleTs_total = 0;
    
    // create a slider for each class: .simpleTs_Container .inner
    $(".simpleTs_Container .inner").each(function() {
        // total
        simpleTs_total++;
        
        var simpleTs_dataSpeed = $(this).attr("data-simplets-speed");
        
        // count slides
        var simpleTs_slideItemCount = 0;
        $(this).find(".simpleTs_item").each(function() {
            simpleTs_slideItemCount++;
        });
        
        // init slider object
        var simpleTs_aniSetup = [{
            name: 'sldie-ani' + simpleTs_total
        }];
        
        // slider start keyframe
        simpleTs_aniSetup[0]['0%'] = {'top': '0px'};
        
        // animate the first 90%, generate keyframe count
        var simpleTs_aniPercent = 90 / simpleTs_slideItemCount;
        
        // loop through count
        for (i = 1; i <= simpleTs_slideItemCount; i++) { 
            console.log("for i: " + i);
                        
            var simpleTs_aniPercentItem = (simpleTs_aniPercent * i) + '%';
            simpleTs_aniSetup[0][simpleTs_aniPercentItem] = {'top': (-50 * i) + 'px'};
        }
        
        // final keyframe = reset 
        simpleTs_aniSetup[0]['100%'] = {'top': '0px'};
        
        console.log(simpleTs_aniSetup);
        
        // define keyframe
        $.keyframe.define(simpleTs_aniSetup);
        
        // calc animation speed
        var simpleTs_aniSpeed;
        if(simpleTs_dataSpeed > 0) {
            simpleTs_aniSpeed = simpleTs_dataSpeed;
        } else {
            simpleTs_aniSpeed = (simpleTs_slideItemCount + 1);
        }
        
        console.log("speed " + simpleTs_aniSpeed);
        
        // play keyframe
        $(this).playKeyframe({
            name: 'sldie-ani' + simpleTs_total, // name of the keyframe you want to bind to the selected element
            duration: simpleTs_aniSpeed + 's', // [optional, default: 0, in ms] how long you want it to last in milliseconds
            timingFunction: 'ease', // [optional, default: ease] specifies the speed curve of the animation
            delay: '1s', //[optional, default: 0s]  how long you want to wait before the animation starts
            iterationCount: 'infinite', //[optional, default:1]  how many times you want the animation to repeat
            direction: 'normal', //[optional, default: 'normal']  which direction you want the frames to flow
            fillMode: 'forwards', //[optional, default: 'forward']  how to apply the styles outside the animation time, default value is forwards
            complete: function(){} //[optional] Function fired after the animation is complete. If repeat is infinite, the function will be fired every time the animation is restarted.
        });
    });
    
    
});