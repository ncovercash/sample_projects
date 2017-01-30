<?php


$curVal=0;
$curAdd=0;

$found=false;

function getFactors($in) {
	$factors = Array();
	$limit = ceil(sqrt($in));
	for ($i=1; $i <= $limit; $i++) { 
		if ($in % $i == 0) {
			array_push($factors, $i);
			array_push($factors, $in/$i);
		}
	}
	$factors = array_unique($factors);
	return count($factors);
}

while ($curVal >= 0 && !$found) { // overflow detection
	$curAdd++;
	$curVal+=$curAdd;
	echo $curVal." ".getFactors($curVal)."\n";
	if (getFactors($curVal) >= 500) {
		$found = true;
	}
}

echo $curVal."\n";
