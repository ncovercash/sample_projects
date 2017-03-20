<?php

$decimal = "";

$i = 1;

while (strlen($decimal) < 1000000) {
	$decimal .= $i++;
}

$result = $decimal[1-1] * $decimal[10-1] * $decimal[100-1] * $decimal[1000-1] * $decimal[10000-1] * $decimal[100000-1] * $decimal[1000000-1];
echo $result;

