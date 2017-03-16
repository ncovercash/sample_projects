<?php

function containsEvenDigit(int $num) : bool {
	$str = (string)$num;
	for ($i=0; $i < strlen($str); $i++) { 
		if ((int)$str[$i] % 2 == 0) {
			return true;
		}
	}
	return false;
}

function isCircularPrime(int $a) : bool {
	$i = 0;
	while ($i < strlen($a)) {
		if (!checkPrime((int)substr($a, $i).substr($a, 0, $i))) {
			return false;
		}
		$i++;
	}
	return true;
}

function checkPrime(int $a) : bool {
	foreach (range(2,ceil(sqrt($a))) as $x) {
		if ($a%$x==0) {
			return false;
		}
	}
	return true;
}

$valid = Array(2);

for ($i=3; $i < 1000000; $i+=2) { 
	if (!containsEvenDigit($i)) {
		if (isCircularPrime($i)) {
			$valid[] = $i;
		}
	}
}

var_dump(count($valid));
