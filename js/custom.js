// Initial of dropdown menu
		ddsmoothmenu.init({
			mainmenuid: "menu", //menu DIV id
			orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
			classname: 'ddsmoothmenu', //class added to menu's outer DIV
			//customtheme: ["#1c5a80", "#18374a"],
			contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
		})
		
// Autoalign
		jQuery(document).ready(function() {
			jQuery(".sb_wrapper").autoAlign(".widget-container", 55);
			jQuery(".featured_boxes").autoAlign(".featured", 50);
			jQuery(".services").autoAlign(".service_box", 50);
			jQuery(".services2").autoAlign(".service_box", 50);
			jQuery(".services3").autoAlign(".service_box", 0);
			jQuery(".services4").autoAlign(".service_box", 0);
		});
		
// watermark plugin
		jQuery(function($){$("#s").Watermark("Search");});
	
// image fading plugin
		$(document).ready(function() { 
			$(".pic").css({
					backgroundColor: "#fff",
					borderColor: "#D5D5D5"
				});
			$(".pic").hover(function() {
				$(this).stop().animate({
					backgroundColor: "#666",
					borderColor: "#333"
					}, 300);
				},function() {
				$(this).stop().animate({
					backgroundColor: "#fff",
					borderColor: "#D5D5D5"
					}, 500);
			});
		});
		
// tabs
		$(document).ready(function() {
		  $("#tabs").tabs({ fx: { height: 'toggle', opacity: 'toggle' } });
		});
		
// Tiny carousel
		$(document).ready(function(){
			$('.carousel_container').tinycarousel({
				start: 1, // where should the carousel start?
				display: 1, // how many blocks do you want to move at a time?
				axis: 'x', // vertical or horizontal scroller? 'x' or 'y' .
				controls: true, // show left and right navigation buttons?
				pager: false, // is there a page number navigation present?
				interval: 10000, // move to the next block on interval.
				intervaltime: 30000, // interval time in milliseconds.
				rewind: true, // If interval is true and rewind is true it will play in reverse if the last slide is reached
				animation: true, // false is instant, true is animate.
				duration: 1200, // how fast must the animation move in milliseconds?
				callback: null // function that executes after every move
			});	
		});
		
// tipsy
		$(function() {
			$('.social a').tipsy(
			{
				gravity: 's', // nw | n | ne | w | e | sw | s | se
				fade: true
			}); 
		});
		
// jquery quicksand
	function reloadPrettyPhoto() {
		jQuery(".pp_pic_holder").remove();
		jQuery(".pp_overlay").remove();
		jQuery(".ppt").remove();
		// edit it with your initialization
		jQuery('#portfolio a[rel^="prettyPhoto"]').prettyPhoto({
			animationSpeed: 'normal', /* fast/slow/normal */
			opacity: 0.70, /* Value between 0 and 1 */
			showTitle: false, /* true/false */
			allowresize: true, /* true/false */
			counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
			theme: 'dark_rounded' /* light_rounded / dark_rounded / light_square / dark_square / facebook */
		});
	}
	jQuery(document).ready(function($) {

		// bind radiobuttons in the form
		var $filterType = $('#filter a');

		// get the first collection
		var $list = $('#portfolio');

		// clone applications to get a second collection
		var $data = $list.clone();

		$filterType.click(function(event) {

			if ($(this).attr('rel') == 'everyone') {
			  var $sortedData = $data.find('li');
			} else {
				var $sortedData = $data.find('.'+ $(this).attr('rel'));
			}

			$('#filter li a').removeClass('current_link');
			$(this).addClass('current_link');

			$list.quicksand($sortedData, {
			  attribute: 'id',
			  duration: 800,
			  easing: 'easeInOutQuad',
			  adjustHeight: 'auto',
			  useScaling: 'false'
			}, function() {
				jQuery(".pic").css({
						backgroundColor: "#fff",
						borderColor: "#D5D5D5"
					});
				jQuery(".pic").hover(function() {
					jQuery(this).stop().animate({
						backgroundColor: "#666",
						borderColor: "#333"
						}, 300);
					},function() {
					jQuery(this).stop().animate({
						backgroundColor: "#fff",
						borderColor: "#D5D5D5"
						}, 500);
				});
				reloadPrettyPhoto();

			});

			return false;
		});

	});
	
// fading & preloading images
$(document).ready(function() {
	// find the div.fade elements and hook the hover event
	$('a.gall').hover(function() {
		// on hovering over find the element we want to fade *up*
		var fade = $('> .hover_img', this);
 
		// if the element is currently being animated (to fadeOut)...
		if (fade.is(':animated')) {
			// ...stop the current animation, and fade it to 1 from current position
			fade.stop().fadeTo(300, 1);
		} else {
			fade.fadeIn(300);
		}
	}, function () {
		var fade = $('> .hover_img', this);
		if (fade.is(':animated')) {
			fade.stop().fadeTo(300, 0);
		} else {
			fade.fadeOut(300);
		}
	});
 
	// get rid of the text
	$('a.gall > .hover_img').empty();
});

$(document).ready(function() {
	// find the div.fade elements and hook the hover event
	$('a.gall').hover(function() {
		// on hovering over find the element we want to fade *up*
		var fade = $('> .hover_vid', this);
 
		// if the element is currently being animated (to fadeOut)...
		if (fade.is(':animated')) {
			// ...stop the current animation, and fade it to 1 from current position
			fade.stop().fadeTo(300, 1);
		} else {
			fade.fadeIn(300);
		}
	}, function () {
		var fade = $('> .hover_vid', this);
		if (fade.is(':animated')) {
			fade.stop().fadeTo(300, 0);
		} else {
			fade.fadeOut(300);
		}
	});
 
	// get rid of the text
	$('a.gall > .hover_vid').empty();
});