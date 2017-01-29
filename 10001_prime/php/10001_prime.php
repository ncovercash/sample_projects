<?php

$primeNumsSoFar=0;
$latestPrime=0;
$current=2;

function checkPrime($a) {
	foreach (range(2,$a-1) as $x) {
		if ($a%$x==0) {
			return false;
		}
	}
	return true;
}

while ($primeNums != 10000) {
	if (checkPrime($current)) {
		$primeNums++;
		$latestPrime = $current;
		echo $latestPrime."\n";
	}
	$current++;
}

echo $latestPrime;
