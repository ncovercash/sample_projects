<?php
$amicable = [];

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

for ($i=1; $i <= 10000; $i++) { 
	$sum = array_sum(getFactors($i));
	if ($sum != $i) {
		if (array_sum(getFactors($sum)) == $i) {
			array_push($amicable, $i);
		}
	}
}

echo array_sum($amicable);
