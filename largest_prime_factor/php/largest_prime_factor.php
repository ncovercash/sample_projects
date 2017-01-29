<?php

function getLargestPrimeFactor($in) {
	$newVal=$in;
	$primes = [];
	for ($i=2; $i<$newVal+1; $i++) {
		if ($newVal % $i == 0) {
			$newVal /= $i;
			array_push($primes, $i);
			$i--;
		}
	}
	return max($primes);
}

var_dump(getLargestPrimeFactor(600851475143));
