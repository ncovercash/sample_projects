<?php

function isPalindrome(string $in) : bool {
    return $in == strrev($in);
}

$valid = Array();

for ($i=1; $i < 1000000; $i++) { 
	if (isPalindrome($i) && isPalindrome(base_convert($i, 10, 2))) {
		$valid[] = $i;
	}
}

var_dump(array_sum($valid));
