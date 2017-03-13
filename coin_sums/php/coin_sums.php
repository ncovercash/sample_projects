<?php

define("COINS", Array(1, 2, 5, 10, 20, 50, 100, 200));

function getPossibleCoinSums(int $cents): int {
	$sum = 0;
	$solutions = Array(1);

	// interesting solution i found
	// not original, i tried brute force
	// for each coin
	foreach (COINS as $value) {
		// add the number of ways to get to $j-coin to $j
		// say you knew 3 ways to get to #3, and you had the 2p coin, you can get to #5 3 ways additionally now
	    for ($j = $value; $j <= $cents; $j++) {
	        $solutions[$j] += $solutions[$j - $value];
	    }
	}
	return $solutions[$cents];
}

var_dump(getPossibleCoinSums(200));
