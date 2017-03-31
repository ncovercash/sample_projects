<?php

// adapted from rosetta code's task
// returns array, [0] = numerator, [1] = denominator
function asRational($val, $tolerance=1.e-6) : array {
    if ($val == (int)$val) {
        // integer
        return Array($val,1);
    }
    $h1=1;
    $h2=0;
    $k1=0;
    $k2=1;
    $b = 1 / $val;
    do {
        $b = 1 / $b;
        $a = floor($b);
        $aux = $h1;
        $h1 = $a * $h1 + $h2;
        $h2 = $aux;
        $aux = $k1;
        $k1 = $a * $k1 + $k2;
        $k2 = $aux;
        $b = $b - $a;
    } while (abs($val-$h1/$k1) > $val * $tolerance);
    return array($h1,$k1);
}

// returns the denominator after x iterations, x=1 returns 2
function getDenominatorTimes1000(int $iterations) : float {
	if ($iterations == 1) {
		return 2000;
	}
	return (2000+(1000000/getDenominatorTimes1000($iterations-1)));
}

$total = 0;

// for ($i=1; $i <= 10000; $i++) { 
	// $rational = asRational(1000+(1000000/getDenominator($i)));
	// if (strlen((string)$ratonal[0]) > strlen((string)$ratonal[1])) {
// 		$total++;
// 	}
// }
// var_dump(getDenominatorTimes1000(2));
var_dump(asRational((1000+(1000000/getDenominatorTimes1000(99)))/1000, 0));
