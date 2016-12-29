<?php

// toggle a boolean
function toggle(bool &$item) {
	if ($item) { // do not need to check if bool due to arg
		$item = false;
	} else {
		$item = true;
	}
}

// iterate through array
function iterate(array &$input, array $steps) {
	for ($i=0; $i < count($input); $i++) { // starting at 0th pos, go to ent
		foreach ($steps as $step) { // for each step amount (1, 2, and 3)
			if ((($i+1) % $step) == 0) { // if door is divisible by the step, it will be hit on the pass
				echo $step . " " . $i . "\r\n";
				toggle($input[$i]);
			}
		}
	}
}

// initialize array of 100 doors, all closed or false
$doors = array_fill(0, 100, false);

iterate($doors, range(1, 100));

// print full array
echo "Raw array contents\r\n";
print_r($doors);

// loop through, find closed (false) indecies
echo "\r\nClosed doors:\r\n";
echo "[ ";
for ($i=0; $i < count($doors); $i++) { 
	if ($doors[$i] === false) {
		echo ($i+1)." ";
	}
}
echo "]\r\n"; // close it

// loop through, find open (true) indecies
echo "\r\nOpen doors:\r\n";
echo "[ ";
for ($i=0; $i < count($doors); $i++) { 
	if ($doors[$i] === true) {
		echo ($i+1)." ";
	}
}
echo "]\r\n"; // close it

