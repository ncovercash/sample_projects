<?php
function sumSquares($max) {
	$total=0;
	for ($i=1; $i<=$max; $i++) {
		$total += $i**2;
	}
	return $total;
}

function squaresSum($max) {
	$total=0;
	for ($i=1; $i<=$max; $i++) {
		$total += $i;
	}
	return $total**2;
}

echo squaresSum(100) - sumSquares(100);
