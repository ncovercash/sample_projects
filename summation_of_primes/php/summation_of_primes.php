<?php

$max = 2000000;

$primes = Array(2);

for ($i=3; $i<$max; $i+=2) {
	$prime = true;
	$limit = ceil(sqrt($i)); // tip from SO
	for ($j=3; $j<=$limit && $prime == true; $j+=2) {
		if ($i % $j == 0) {
			$prime = false;
		}
	}
	if ($prime) {
		array_push($primes, $i);
	}
}

$sum = 0;
foreach ($primes as $prime) {
	$sum += $prime;
}

echo $sum;
