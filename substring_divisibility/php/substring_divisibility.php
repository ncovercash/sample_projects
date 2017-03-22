<?php

// Using the following logic, we can apply the following rules:
//   d2d3d4=406 is divisible by 2
//     d4 % 2 == 0
//   d3d4d5=063 is divisible by 3
//     d3+d4+d5 % 3 == 0
//   d4d5d6=635 is divisible by 5
//     d6 % 5 == 0

// get pandigitals 0-9

function permute(string $input) : array {
	if (strlen($input) == 2) {
		$permutations = Array();
		$permutations[0] = $input;
		$permutations[1] = strrev($input);
		return $permutations;
	}

	$permutations = Array();

	$curIndex = 0;

	for ($i=0; $i<strlen($input); $i++) {
		$tmp = permute(substr($input, 0, $i).substr($input, $i+1));
		foreach ($tmp as $value) {
			// d2 . d3 . d4 = 406 is divisible by 2
			// d3 . d4 . d5 = 063 is divisible by 3 // done
			// d4 . d5 . d6 = 635 is divisible by 5 // done
			// d5 . d6 . d7 = 357 is divisible by 7
			// d6 . d7 . d8 = 572 is divisible by 11
			// d7 . d8 . d9 = 728 is divisible by 13
			// d8 . d9 . d10 = 289 is divisible by 17
			if (strlen($value) == 3) {
				if (($value[0].$value[1].$value[2]) % 17 == 0) {
					$permutations[$curIndex++] = $input[$i].$value;
				}
			} else if (strlen($value) == 4) {
				if (($value[0].$value[1].$value[2]) % 13 == 0) {
					$permutations[$curIndex++] = $input[$i].$value;
				}
			} else if (strlen($value) == 5) {
				if (($value[0].$value[1].$value[2]) % 11 == 0) {
					$permutations[$curIndex++] = $input[$i].$value;
				}
			} else if (strlen($value) == 6) {
				if (($value[0].$value[1].$value[2]) % 7 == 0) {
					$permutations[$curIndex++] = $input[$i].$value;
				}
			} else if (strlen($value) == 7) {
				if (($value[0].$value[1].$value[2]) % 5 == 0) {
					$permutations[$curIndex++] = $input[$i].$value;
				}
			} else if (strlen($value) == 8) {
				if (($value[0].$value[1].$value[2]) % 3 == 0) {
					$permutations[$curIndex++] = $input[$i].$value;
				}
			} else if (strlen($value) == 9) {
				if (($value[0].$value[1].$value[2]) % 2 == 0) {
					$permutations[$curIndex++] = $input[$i].$value;
				}
			} else {
				$permutations[$curIndex++] = $input[$i].$value;
			}
		}
	}
	return $permutations;
}

function factorial(int $in) : int {
	if ($in == 1) {
		return 1;
	}
	return $in * factorial($in - 1);
}

$permutations = (permute("0123456789"));

var_export($permutations);

var_export(array_sum($permutations));

