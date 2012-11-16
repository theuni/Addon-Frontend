// Image Preload
$(document).ready(function(){
    $("#portfolio2, #portfolio3, #portfolio4").preloader({
         delay:500,
         preload_parent:"a",
         check_timer:300,
         ondone: init_pretty,
         oneachload:function(image){  },
         fadein:800
    });
});

// PrttyPhoto
function init_pretty(){
      $("a[rel^='prettyPhoto']").prettyPhoto({
            animationSpeed: 'normal', /* fast/slow/normal */
            opacity: 0.70, /* Value between 0 and 1 */
            showTitle: false, /* true/false */
            allowresize: true, /* true/false */
            counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
            theme: 'dark_rounded' /* light_rounded / dark_rounded / light_square / dark_square / facebook */
      });
};