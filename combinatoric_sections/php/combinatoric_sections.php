<?php

function permute(int $in) : GMP {
	$total=gmp_init(1);
	for ($i=1; $i <= $in; $i++) {
		$total = gmp_mul($total, gmp_init($i));
	}
	return $total;
}

function combinatoric(int $n, int $r) : string {
	$top = permute($n);
	$bottom = permute($r);
	$bottom = gmp_mul(permute($n-$r), $bottom);
	return gmp_strval(gmp_div_q($top, $bottom));
}

$total = 0;
for ($n=23; $n <= 100; $n++) { 
	for ($r=2; $r <= $n; $r++) { 
		if (strlen(combinatoric($n,$r)) >= 7) { // above 1000000
			$total++;
		}
	}
}
var_dump($total);
