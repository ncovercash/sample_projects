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

function shuffle(r){for(var f,n,o=r.length;0!==o;)n=Math.floor(Math.random()*o),o-=1,f=r[o],r[o]=r[n],r[n]=f;return r};

$(document).ready(function() {
	$("td").fitText(0.25);
	init();
});

var nums;

// holds where the tile is
// [index, row, col, obj]
var blankTile;

// put `nums` into table
function refreshTable() {
	for (var i = 0; i < $("td").length; i++) {
		$($("td")[i]).text(nums[i]);
		if (nums[i] == 0) {
			$($("td")[i]).css({"backgroundColor": "#fff"}).text("");
			blankTile = [i, Math.floor(i/4)+1, i%4+1, $($("td")[i])]
		} else {
			$($("td")[i]).css({"backgroundColor": "#ddd"});
		}
	}
};

function init() {
	// create array 0-15
	nums = Array.apply(null, Array(16)).map(function (_, i) {return i;});

	// shuffle
	// nums = shuffle(nums);
	refreshTable();
}


function swapWithBlank(obj) {
		// swap
		nums[blankTile[0]] = nums[parseInt($(obj).attr("index"))];
		$(blankTile[3]).text(nums[blankTile[0]]).css({"backgroundColor": "#ddd"});
		nums[parseInt($(obj).attr("index"))] = 0;
		$(obj).text("").css({"backgroundColor": "#fff"});
		
		// update blankTile
		blankTile = [parseInt($(obj).attr("index")), parseInt($(obj).attr("row")), parseInt($(obj).attr("col")), $(obj)];
}

function checkWinner() {
	for (var i = 0; i < nums.length-1; i++) {
		if (nums[i] != i+1) {
			return false;
		}
	}
	alert("You win!");
	init();
	return true;
}

$("td").click(function() {
	if (parseInt($(this).attr("row")) == blankTile[1] && parseInt($(this).attr("col")) == blankTile[2]-1) { // left
		swapWithBlank(this);
	} else if (parseInt($(this).attr("row")) == blankTile[1] && parseInt($(this).attr("col")) == blankTile[2]+1) { // right
		swapWithBlank(this);
		checkWinner();
	} else if (parseInt($(this).attr("col")) == blankTile[2] && parseInt($(this).attr("row")) == blankTile[1]-1) { // up
		swapWithBlank(this);
	} else if (parseInt($(this).attr("col")) == blankTile[2] && parseInt($(this).attr("row")) == blankTile[1]+1) { // down
		swapWithBlank(this);
		checkWinner();
	}
});