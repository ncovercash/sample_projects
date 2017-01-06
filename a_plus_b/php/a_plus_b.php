<?php
function a_plus_b() {
	echo "Enter 2 numbers seperated by spaces: ";
	$input = readline();

	$explodedArr = explode(" ", $input);

	function remove_empty_vals($value) {
		return strlen($value) != 0;
	}

	$filtered_arr = array_values(array_filter($explodedArr, remove_empty_vals));
	
	return (intval($filtered_arr[0])+intval($filtered_arr[1]));
}

if (__MAIN__) {
	echo a_plus_b();
}

