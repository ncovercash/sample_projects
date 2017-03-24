<?php

// n^2 + an + b
// deduction #1: b must be prime, as we need it to be prime when n = 0
// detuction #2: if n = 1, we have 1 + a + b, which must be prime
// 					if b = 2, then a must also be even as even + even + odd = odd
// 					else a must be odd, as odd + odd + odd = odd


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

$primesUnder1000 = Array(2);
$primes = Array(2); // 2nd array, as we may generate primes > 1000
// generate array of primes to look through
for ($i=3; $i < 1000; $i+=2) { 
	if (isPrime($i)) {
		$primesUnder1000[] = $i;
		$primes[] = $i;
	}
}

function genNextPrime(array &$primes) {
	for ($i=$primes[count($primes)-1]+2; $i < 2147000000; $i+=2) { 
		if (isPrime($i)) {
			$primes[] = $i;
			return;
		}
	}
}

function isPrimeLookup(int $n, array &$primes) {
	while ($n > $primes[count($primes)-1]) {
		genNextPrime($primes);
	}
	return in_array($n, $primes);
}

$maxConsecutive = 0;
$maxA = $maxB = 0;

foreach ($primesUnder1000 as $b) { // deduction 1
	if ($b == 2) {
		for ($a=-998; $a < 999; $a+=2) { 
			$numConsecutive=0;
			$n = 0;
			while (isPrimeLookup($n*$n + $a*$n + $b, $primesUnder1000)) {
				$n++;
				$numConsecutive++;
			}
			if ($numConsecutive > $maxConsecutive) {
				$maxConsecutive = $numConsecutive;
			}
		}
	} else {
		for ($a=-999; $a < 1000; $a+=2) { 
			$numConsecutive=0;
			$n = 0;
			while (isPrimeLookup($n*$n + $a*$n + $b, $primesUnder1000)) {
				$n++;
				$numConsecutive++;
			}
			if ($numConsecutive > $maxConsecutive) {
				$maxA = $a;
				$maxB = $b;
				$maxConsecutive = $numConsecutive;
			}
		}
	}
}

echo "n^2 + ",$maxA,"n + ",$maxB," has ",$maxConsecutive," primes\n";
var_dump($maxA*$maxB);
