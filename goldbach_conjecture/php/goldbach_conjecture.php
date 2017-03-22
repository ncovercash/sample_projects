<?php

function isPrime(int $a) : bool {
	if ($a == 2) {
		return true;
	}
	if ($a == 1) {
		return false;
	}
	foreach (range(2,ceil(sqrt($a))) as $x) {
		if ($a%$x==0) {
			return false;
		}
	}
	return true;
}

function isPerfectSquare(float $in) : bool {
	return $in == ((int)sqrt($in))**2;
}

for ($i=15; $i < 10000; $i+=2) { // odd only, reasonable? bound
	if (!isPrime($i)) {
		$conjecture = false;
		foreach (Array(1,2) as $j) {
			if (isPerfectSquare(($i-$j)/2)) {
				$conjecture = true;
			}
		}
		for ($j=3; $j < $i; $j++) { 
			if (isPrime($j)) {
				if (isPerfectSquare(($i-$j)/2)) {
					$conjecture = true;
				}
			}
		}
		if ($conjecture === false) {
			var_dump($i);
			break;
		}
	}
}
