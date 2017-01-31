<?php

function permute($in): string {
	$total=gmp_init(1);
	for ($i=1; $i <= $in; $i++) {
		$total = gmp_mul($total, gmp_init($i));
	}
	return $total;
}

$digits = permute(100);

$total=0;
for ($i=0; $i < strlen($digits); $i++) {
	$total += substr($digits, $i, 1);
}

echo $total;

gmp_init(1);
