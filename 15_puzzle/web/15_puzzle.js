/*
 * fittext.js
 * fittextjs.com
 */
(function( $ ){

	$.fn.fitText = function( kompressor, options ) {

		// Setup options
		var compressor = kompressor || 1,
				settings = $.extend({
					'minFontSize' : Number.NEGATIVE_INFINITY,
					'maxFontSize' : Number.POSITIVE_INFINITY
				}, options);

		return this.each(function(){

			// Store the object
			var $this = $(this);

			// Resizer() resizes items based on the object width divided by the compressor * 10
			var resizer = function () {
				$this.css('font-size', Math.max(Math.min($this.width() / (compressor*10), parseFloat(settings.maxFontSize)), parseFloat(settings.minFontSize)));
			};

			// Call once to set.
			resizer();

			// Call on resize. Opera debounces their resize by default.
			$(window).on('resize.fittext orientationchange.fittext', resizer);

		});

	};

})(jQuery);

function shuffle(r){for(var f,n,o=r.length;0!==o;)n=Math.floor(Math.random()*o),o-=1,f=r[o],r[o]=r[n],r[n]=f;return r}

$(document).ready(function() {
	$("td").fitText(0.25);
})

// create array 0-15
var nums = Array.apply(null, Array(16)).map(function (_, i) {return i;});

// shuffle
nums = shuffle(nums);

function refreshTable() {
	for (var i = 0; i < $("td").length; i++) {
		console.log(i);
		$($("td")[i]).text(nums[i]);
		if (nums[i] == 0) {
			$($("td")[i]).css({"backgroundColor": "#fff"});
		} else {
			$($("td")[i]).css({"backgroundColor": "#ddd"});
		}
	}
}
refreshTable();
