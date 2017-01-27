<?php
$divisible = false;
$testing = 0;
while (!$divisible) {
	$testing+=20;
	$divisible = true;
	for ($i=1; $i <= 20 && $divisible; $i++) { 
		if ($testing % $i != 0) {
			$divisible = false;
		}
	}
}

echo $testing;
