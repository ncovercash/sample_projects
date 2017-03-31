<?php

function getSumOfDigits(string $in) : int {
	return array_sum(str_split($in));
}

$max = gmp_init(0);
$maxA = $maxB = 0;

for ($a=1; $a < 100; $a++) { 
	for ($b=1; $b < 100; $b++) {
		$powered = gmp_init($a);
		$powered = gmp_pow($powered, $b);
		$powered = gmp_init(getSumOfDigits(gmp_strval($powered)));

		$diff = gmp_intval(gmp_sub($max, $powered)); // if < 0, then powered is highes
		if ($diff < 0) {
			$max = $powered;
			$maxA = $a;
			$maxB = $b;
		}
	}
}

var_dump(gmp_strval($max));
