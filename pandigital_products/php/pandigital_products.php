<?php

/**
 *  bool isPandigital(string ...$numbers)
 * 
 *  @param $numbers, supplied as individual arguments
 *    or as array if exploded in call with ...
 *  @return boolean stating whether or not the supplied numbers are pandigital
 *    (containing all the digits from 1-9 only once)
 */
function isPandigital(...$numbers) : bool {
	$concatString = "";
	foreach ($numbers as $number) {
		$concatString .= $number;
	}
	if (strlen($concatString) != 9) {
		return false;
	}
	for ($i=1; $i < 10; $i++) { 
		if (preg_match("/{$i}/", $concatString) == false) {
			return false;
		}
	}
	return true;
}

function getPandigitalProducts() : array {
	// using logic adapted from mathblog.dk, we can limit the search space
	$getPandigitalProducts = Array();
	for ($i=2; $i < 9876; $i++) { 
		$jbegin = ($i > 9) ? 123 : 1234;
		$jend = 10000 / $i + 1;
		for ($j=$jbegin; $j < $jend; $j++) { 
			if (isPandigital($i, $j, $i*$j)) {
				$getPandigitalProducts[] = $i*$j;
			}
		}
	}
	return $getPandigitalProducts;
}

echo array_sum(array_unique(getPandigitalProducts()));
