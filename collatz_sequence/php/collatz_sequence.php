<?php

$start = microtime(1);

$max = Array(0,0);

for ($i=600001; $i < 10000000; $i+=2) {
	$new = $i;
	$totalSteps = 0;
	while ($new != 1) {
		switch ($new % 2) {
			case 0:
				$totalSteps++;
				$new /= 2;
				break;
			case 1:
				$totalSteps++;
				$new *= 3;
				$new++;
				break;
		}
	}
	if ($totalSteps > $max[0]) {
		$max[0] = $totalSteps;
		$max[1] = $i;
	}
}

var_dump($max);
echo microtime(1) - $start;
