<?php

foreach (range(99, 1) as $beer) {
	$nextBeer = $beer-1;
	echo "$beer bottles of beer on the wall
$beer bottles of beer
Take one down, pass it around
$nextBeer bottles of beer on the wall\r\n\r\n";
}
