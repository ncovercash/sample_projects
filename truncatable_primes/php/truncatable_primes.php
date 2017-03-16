<?php

// yes, this is nearly the same code as for circular primes
// its mostly the same underlying work

function containsEvenDigit(int $num) : bool {
	$str = (string)$num;
	for ($i=1; $i < strlen($str)-1; $i++) { // ignore first and last digit, there may be a 2 there!
		if ((int)$str[$i] % 2 == 0) {
			return true;
		}
	}
	return false;
}

function isTruncatablePrime(int $a) : bool {
	$i = 1;
	while ($i < strlen($a)) {
		if (!isPrime((int)substr($a, $i))) {
			return false;
		}
		if (!isPrime((int)substr($a, 0, $i))) {
			return false;
		}
		$i++;
	}
	return true;
}

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

$valid = Array();
$i=23;

while (count($valid) < 11) { 
	if (!containsEvenDigit($i) && isPrime($i)) {
		if (isTruncatablePrime($i)) {
			$valid[] = $i;
		}
	}
	$i+=2;
}

var_dump(array_sum($valid));
