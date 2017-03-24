<?php

$sum = gmp_init(0);

for ($i=1; $i <= 1000; $i++) { 
	$power = gmp_pow(gmp_init($i), $i);
	$sum = gmp_add($sum, $power);
}

echo substr(gmp_strval($sum), -10);
