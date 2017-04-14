<?php

$goalSum=1000;

$start = microtime(true);

for ($a=1; $a < $goalSum/3; $a++) { 
	for ($b=$a+1; $b < $goalSum/2; $b++) { 
		$c = $goalSum-$a-$b;
		if ($c > 0 && (($a*$a) + ($b*$b)) == ($c*$c)) {
			if ($a+$b+$c == $goalSum) {
				$product=$a*$b*$c;
				echo "a={$a} b={$b} c={$c} product={$product}\n";
				echo "Took ".(microtime(true)-$start)." seconds";
				die();
			}
		}
	}
}

