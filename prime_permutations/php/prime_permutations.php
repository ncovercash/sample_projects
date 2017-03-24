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

function isPermutation(string $a, string $b) : bool { // doesn't consider duplicate numbers
	$aArray = Array();
	for ($i=0; $i < strlen($a); $i++) { 
		if (!isset($aArray[$a[$i]])) {
			$aArray[$a[$i]] = 0;
		}
		$aArray[$a[$i]]++;
	}
	$bArray = Array();
	for ($i=0; $i < strlen($b); $i++) { 
		if (!isset($bArray[$b[$i]])) {
			$bArray[$b[$i]] = 0;
		}
		$bArray[$b[$i]]++;
	}
	foreach ($aArray as $key => $value) {
		if ($bArray[$key] != $value) {
			return false;
		}
	}
	foreach ($bArray as $key => $value) {
		if ($aArray[$key] != $value) {
			return false;
		}
	}
	return true;
}

$fourDigitPrimes = Array();

// generate array of primes to look through
for ($i=1001; $i < 10000; $i+=2) { 
	if (isPrime($i)) {
		$fourDigitPrimes[] = $i;
	}
}

for ($i=0; $i < count($fourDigitPrimes)-2; $i++) { // we know there must be 2 higher than one at [$i]
	for ($j=$i+1; $j < count($fourDigitPrimes); $j++) { // only go up to half range
		if (isPermutation($fourDigitPrimes[$i], $fourDigitPrimes[$j])) {
			// we found a permutation of $i, which is in $j
			$next = $fourDigitPrimes[$j]+($fourDigitPrimes[$j]-$fourDigitPrimes[$i]);
			if (in_array($next, $fourDigitPrimes) && isPermutation($next, $fourDigitPrimes[$j])) { // if next increase is also prime and permutation
				if ($fourDigitPrimes[$i] != 1487) {
					var_dump($fourDigitPrimes[$i].$fourDigitPrimes[$j].$next);
					break 2;
				}
			}
		}
	}
}

