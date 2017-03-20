<?php

// using solution from euler #9 (special_pythagorean_triplets)
$maxSum = 1000;

$numPossibilities = Array();

// can be simplified with the following proof
//    { a + b + c = p	,	aa + bb = cc			}
//    { c = p - a - b	,							}
//    aa + bb = (p - a - b)^2
//    aa + bb = pp + aa + bb - 2pa - 2pb - 2ab
//    0 = pp - 2pa - 2pb + 2ab
//    2pa + 2pb = pp + 2ab
//    2pb - 2ab = pp - 2pa
//    2b(p - a) = p(p - 2a)
//    b = [ (p(p - 2a)) / (2 * (p - a)) ]


// bruteforce
for ($p=0; $p <= $maxSum; $p++) { 
	for ($a=1; $a < $p/3; $a++) { 
		for ($b=$a+1; $b < $p/2; $b++) { 
			$c = $p-$a-$b;
			if ($c > 0 && (($a*$a) + ($b*$b)) == ($c*$c)) {
				$total = $c+$a+$b;
				if (!isset($numPossibilities[$total])) {
					$numPossibilities[$total] = 0;
				}
				$numPossibilities[$total]++;
			}
		}
	}
}

$maxIndex = 1;
for ($i=1; $i <= $maxSum; $i++) { 
	if ($numPossibilities[$i] > $numPossibilities[$maxIndex]) {
		$maxIndex = $i;
	}
}

echo $numPossibilities[$maxIndex]," possibilities for p = ",$maxIndex;
