<?php

function arePermutations(string $a, string $b) : bool {
	$aExploded = str_split($a);
	$bExploded = str_split($b);
	sort($aExploded);
	sort($bExploded);
	return $aExploded == $bExploded;
}

// we know that x and 6x must contain the same number of digits
// therefore we can limit bounds to, say 6 digits, 999999/6

$digits = 2;
while (true) { 
	$upperLimit = (double)str_repeat("9", $digits);
	$upperLimit /= 6.0;
	$upperLimit = ceil($upperLimit);
	$lowerLimit = "1".str_repeat("0", $digits-1);
	for ($i=$lowerLimit; $i < $upperLimit; $i++) { 
		if (arePermutations($i, $i*2) &&
			arePermutations($i*2, $i*3) &&
			arePermutations($i*3, $i*4) &&
			arePermutations($i*4, $i*5) &&
			arePermutations($i*5, $i*6)) {
			var_dump($i);
			break 2;
		}
	}
	$digits++;
}
