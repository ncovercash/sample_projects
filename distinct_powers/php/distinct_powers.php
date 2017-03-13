<?php

$max = 100;

$primes = Array();

for ($a=2; $a <= $max; $a++) { 
	for ($b=2; $b <= $max; $b++) { 
		$primes[] = $a**$b;
	}
}

$primes = array_unique($primes);

echo count($primes);

