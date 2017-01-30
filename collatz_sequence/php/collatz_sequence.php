<?php

$max = Array(0,0);

for ($i=1; $i < 1000000; $i++) {
	$new = $i;
	$steps = Array($new);
	while ($new != 1) {
		switch ($new % 2) {
			case 0:
				array_push($steps, $new/2);
				$new /= 2;
				break;
			case 1:
				array_push($steps, (3*$new)+1);
				$new *= 3;
				$new++;
				break;
		}
	}
	if (count($steps) > $max[0]) {
		$max[0] = count($steps);
		$max[1] = $i;
	}
}

var_dump($max);
