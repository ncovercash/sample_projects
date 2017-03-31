<?php

function isBasicPalandronic(string $in) : bool {
	return $in == strrev($in);
}

function isLychrelNumber(int $in) : bool {
	$num = gmp_init($in);
	$count = 1;
	do {
		$reversedString = strrev(gmp_strval($num));
		while ($reversedString[0] == "0") {
			$reversedString = substr($reversedString, 1);
		}
		$reversedNum = gmp_init($reversedString);
		$num = gmp_add($num, $reversedNum);
		$count++;
	} while (!isBasicPalandronic(gmp_strval($num)) && $count < 50);
	return !isBasicPalandronic(gmp_strval($num));
}

$numLychrel = 0;

for ($i=0; $i < 10000; $i++) { // we can start at 10 as all basic digits are palindronic
	$numLychrel += isLychrelNumber($i);
}

var_dump($numLychrel);
