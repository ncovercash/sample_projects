<?php

/**
 *  bool isPandigital(string ...$numbers)
 * 
 *  @param $number, number to check if pandigital based on num of digits
 *  @return boolean stating whether or not the supplied numbers are pandigital
 *    (containing all the digits from 1-9 only once)
 *
 *  Precondition: $numbers has less than 10 digits and is not 0
 */
function isPandigital(int $number) : bool {
	for ($i=1; $i <= strlen((string)$number); $i++) { 
		if (preg_match("/{$i}/", $number) == false) {
			return false;
		}
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

function isPandigitalPrime(int $in) : bool {
	if (isPandigital($in)) {
		return checkPrime($in);
	}
	return false;
}

function getHighestPandigitalPrime() : int {
	// we know the largest pandigital is 9 digits, and is 987654321
	// as we are checking for prime, so we decrement by 2
	// we start at max and go to highest known, 2143

	// however, further deduction reveals that any pandigital numbers with n digits can be divided by 3:
	// basic division patterns dictate that if digit sum % 3 == 0, the number is divisible by 3
	//   9 : 9 + 8 + 7 + 6 + 5 + 4 + 3 + 2 + 1 = 45 % 3 = 0
	//   8 : 8 + 7 + 6 + 5 + 4 + 3 + 2 + 1     = 36 % 3 = 0
	//   7 : 7 + 6 + 5 + 4 + 3 + 2 + 1         = 28 % 3 = 1
	//   6 : 6 + 5 + 4 + 3 + 2 + 1             = 21 % 3 = 0
	//   5 : 5 + 4 + 3 + 2 + 1                 = 15 % 3 = 0
	//   4 : 4 + 3 + 2 + 1                     = 10 % 3 = 1
	// therefore, we only need to check numbers with 7 digits and 4 digits.

	// 7 digits
	for ($i=7654321; $i >= 1234567; $i-=2) { 
		if (isPandigitalPrime($i)) {
			return $i;
		}
	}

	// 4 digits
	for ($i=4321; $i >= 1234; $i-=2) { 
		echo $i,"\n";
		if (isPandigitalPrime($i)) {
			return $i;
		}
	}
	return 2143; // _should_ be unreachable, as 2143 is 4 digits
}

var_dump(getHighestPandigitalPrime(2143));

