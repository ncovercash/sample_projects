<?php

define("DIGIT_FACTORIALS", Array(
	1 => 1,
	2 => 2,
	3 => 6,
	4 => 24,
	5 => 120,
	6 => 720,
	7 => 5040,
	8 => 40320,
	9 => 362880,
	0 => 1	));

function sumOfDigitFactorials(int $in) : int {
	$string = (string)$in;
	$sum = 0;
	$strlen = strlen($string);
	for ($i=0; $i < $strlen; $i++) { 
		$sum += DIGIT_FACTORIALS[$string[$i]];
	}
	return $sum;
}

$valid = array();

// nice deduction by some online sources, including from mathblog and jasonbhill
//   shows that you can use 2540161, however in reality there are only 4 according to OEIS
for ($i=3; $i <= 40586; $i++) { 
	if ($i == sumOfDigitFactorials($i)) {
		$valid[] = $i;
	}
}

echo array_sum($valid);

