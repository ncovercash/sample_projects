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

function getPrimeFactors(int $in) : array {
	$factors = Array();
	while (!isPrime($in)) {
		for ($i=2; $i <= ceil(sqrt($in)); $i++) { 
			if ($in % $i == 0) {
				$factors[] = $i;
				$in /= $i;
				break;
			}
		}
	}
	$factors[] = $in;
	return $factors;
}

function numUniquePrimeFactors(int $in) : int {
	return count(array_unique(getPrimeFactors($in)));
}

$targetDigits = 4;

$consecutive = 0;

for ($i=2*3*5*7; true; $i++) { // $i is lowest with 4 prime factors
	if (numUniquePrimeFactors($i) == $targetDigits) {
		$consecutive++;
	} else {
		$consecutive = 0;
	}
	if ($consecutive == $targetDigits) {
		echo $i - $targetDigits + 1;
		break;
	}
}
