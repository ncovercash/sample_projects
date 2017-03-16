<?php

function isPandigital(string $input) : bool {
	if (strlen($input) != 9) {
		return false;
	}
	for ($i=1; $i < 10; $i++) { 
		if (preg_match("/{$i}/", $input) == false) {
			return false;
		}
	}
	return true;
}

// using some analysis
// largest number must start with 9
// if the fixed number is 2 digit we wont be able to generate a 9 digit number
//   since n = 3 yields an 8 digit number and n=4 yields an 11 digit number
// same with 3 digit, we get either 7 or 11 digits in result
// must be < 5 digits, as n has to be > 1

$max = 0;

for ($i=9123; $i < 9876; $i++) { 
	$n = 2; // we do n = 1 below
	$curString = (string)$i;
	while (!isPandigital($curString) && strlen($curString) <= 9) {
		$curString .= $i*$n++;
	}
	if (isPandigital($curString)) {
		$max = max((int)$curString, (int)$max);
	}
}

echo $max;
