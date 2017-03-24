<?php

$squareDigitCache = Array();

function getSquareOfDigits(int $in) : int {
	global $squareDigitCache;
	if (isset($squareDigitCache[$in])) {
		return $squareDigitCache[$in];
	}
	$sum = 0;
	for ($i=0; $i < strlen((string)$in); $i++) { 
		$sum += ((string)$in)[$i] ** 2;
	}
	if (strlen((string)$in) <= 4) {
		$squareDigitCache[$in] = $sum;
	}
	return $sum;
}

function getEndNumber(int $in) : int {
	$num = $in;
	while (getSquareOfDigits($num) != 1 && getSquareOfDigits($num) != 89) {
		$num = getSquareOfDigits($num);
	}
	return getSquareOfDigits($num);
}

$total = 0;
for ($i=1; $i < 10000000; $i++) { 
	echo $i."\n";
	if (getEndNumber($i) == 89) {
		$total++;
	}
}

var_dump($total);
