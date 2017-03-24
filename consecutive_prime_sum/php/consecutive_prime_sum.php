<?php

function isPrime(int $a) : bool {
	if ($a == 2) {
		return true;
	}
	if ($a == 1) {
		return false;
	}
	foreach (range(2,ceil(sqrt($a))) as $x) {
		if ($a%$x==0) {
			return false;
		}
	}
	return true;
}

$primes = Array(2);

for ($i=3; $i < 1000000; $i+=2) { 
	if (isPrime($i)) {
		$primes[] = $i;
	}
}

$max = $maxRun = 0;

for ($i=0; $i < count($primes); $i++) { 
	$sum = 0;
	$run = 0;
	for ($j=$i; $j < count($primes) && $sum + $primes[$j] < 1000000; $j++) { 
		$sum += $primes[$j];
		$run++;
	}
	if ($sum > $max &&
		$run > $maxRun &&
		isPrime($sum)) {
		$max = $sum;
		$maxRun = $run;
	}
}

var_dump($max);
