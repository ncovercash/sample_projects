<?php

/**
 * bool isBasicPalindronic(string $in)
 *
 * @param string $in input to be tested for palindrinity
 *          must be a number or string with no spaces
 * @return boolean true if the string is a palindrome
 */
function isBasicPalindronic(string $in) : bool {
	return $in == strrev($in);	// spaces and such will not work with this
								// numbers only
}

/**
 * bool isLychrelNumber(int $in)
 *   Only computes 50 iterations
 *
 * @param int $in input to be tested for lychrel's theory
 * @return boolean true if the number is a lychrel number
 */
function isLychrelNumber(int $in) : bool {
	$num = gmp_init($in); // use GMP as these numbers could overflow
	$count = 1;
	do { // perform initial required iteration before testing for palindroem
		$reversedString = strrev(gmp_strval($num));
		while ($reversedString[0] == "0") { // check for leading zeroes, as GMP will not work with them
			$reversedString = substr($reversedString, 1);
		}
		$reversedNum = gmp_init($reversedString);
		$num = gmp_add($num, $reversedNum);
		$count++;
	} while (!isBasicPalindronic(gmp_strval($num)) && $count < 50);

	return !isBasicPalindronic(gmp_strval($num));
}

$numLychrel = 0;

for ($i=1; $i < 10000; $i++) {
	$numLychrel += isLychrelNumber($i);
}

var_dump($numLychrel);
