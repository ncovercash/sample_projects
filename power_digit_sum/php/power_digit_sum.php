<?php

// requires GMP

$powered = gmp_init(2);
$powered = pow($powered, 1000);

$sum = 0;

for ($i=0; $i < strlen(gmp_strval($powered)); $i++) { 
	$sum += substr(gmp_strval($powered), $i, 1);
}

echo $sum."\n";
