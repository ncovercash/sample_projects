<?php

function getFactors($in): array {
	$factors = Array(1);
	$limit = ceil(sqrt($in));
	for ($i=2; $i <= $limit; $i++) { 
		if ($in % $i == 0) {
			array_push($factors, $i);
			array_push($factors, $in/$i);
		}
	}
	$factors = array_unique($factors);
	return $factors;
}

function isAbundant($in) {
	return array_sum(getFactors($in)) > $in;
}

$abundant = Array();

for ($i=12; $i<=28123; $i++) {
	if (isAbundant($i)) {
		$abundant[] = $i;
	}
}

$canBeSummed = array_map(function($n) { return false; }, range(1, 28123) );;

for ($val1=0; $val1 < count($abundant); $val1++) { 
	for ($val2=$val1; $val2 < count($abundant) && $abundant[$val1]+$abundant[$val2] <= 28123; $val2++) {
		$canBeSummed[$abundant[$val1]+$abundant[$val2]] = true;
	}
}

$total=0;

for ($i=1; $i<=28123; $i++) {
	if ($canBeSummed[$i] != true) {
		$total += $i;
	}
}

var_dump($total);
