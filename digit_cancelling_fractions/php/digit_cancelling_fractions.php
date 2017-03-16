<?php

function canCancel(string $num, string $denom) {
	if ($num % 10 == 0 || $denom % 10 == 0) {
		return false;
	}

	if ($num[0] == $denom[0]) {
		if ($denom[1] != 0) {
			if ($num[1]/$denom[1] == $num/$denom) {
				return $denom[1];
			}
		}
	}
	if ($num[1] == $denom[1]) {
		if ($denom[0] != 0) {
			if ($num[0]/$denom[0] == $num/$denom) {
				return $denom[0];
			}
		}
	}
	if ($num[0] == $denom[1]) {
		if ($denom[0] != 0) {
			if ($num[1]/$denom[0] == $num/$denom) {
				return $denom[0];
			}
		}
	}
	if ($num[1] == $denom[0]) {
		if ($denom[1] != 0) {
			if ($num[0]/$denom[1] == $num/$denom) {
				return $denom[1];
			}
		}
	}
	return false;
}

$cancellable = Array();

for ($num=10; $num < 100; $num++) { 
	for ($denom=$num+1; $denom < 100; $denom++) { 
		if (canCancel($num, $denom) != false) {
			$cancellable[] = canCancel($num, $denom);
		}
	}
}

foreach ($cancellable as &$denom) {
	for ($i=2; $i <= sqrt($denom); $i++) { 
		if ($denom/$i == floor($denom/$i)) {
			$denom /= $i;
			$i=1;
		}
	}
}

var_export($cancellable);

$product = 1;

for ($i=0; $i < count($cancellable); $i++) { 
	$product *= $cancellable[$i];
}

echo $product;
