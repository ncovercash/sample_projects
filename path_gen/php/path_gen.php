<?php

// flow puzzle like generator

// copied off github, open source ANSI implementation
class Color
{
    public static $ANSI_CODES = array(
        "off"        => 0,
        "bold"       => 1,
        "italic"     => 3,
        "underline"  => 4,
        "blink"      => 5,
        "inverse"    => 7,
        "hidden"     => 8,
        "black"      => 30,
        "red"        => 31,
        "green"      => 32,
        "yellow"     => 33,
        "blue"       => 34,
        "magenta"    => 35,
        "cyan"       => 36,
        "white"      => 37,
        "black_bg"   => 40,
        "red_bg"     => 41,
        "green_bg"   => 42,
        "yellow_bg"  => 43,
        "blue_bg"    => 44,
        "magenta_bg" => 45,
        "cyan_bg"    => 46,
        "white_bg"   => 47
    );
    public static function set($str, $color)
    {
        $color_attrs = explode("+", $color);
        $ansi_str = "";
        foreach ($color_attrs as $attr) {
            $ansi_str .= "\033[" . self::$ANSI_CODES[$attr] . "m";
        }
        $ansi_str .= $str . "\033[" . self::$ANSI_CODES["off"] . "m";
        return $ansi_str;
    }
    public static function log($message, $color)
    {
        error_log(self::set($message, $color));
    }
    public static function replace($full_text, $search_regexp, $color)
    {
        $new_text = preg_replace_callback(
            "/($search_regexp)/",
            function ($matches) use ($color) {
                return Color::set($matches[1], $color);
            },
            $full_text
        );
        return is_null($new_text) ? $full_text : $new_text;
    }
}

$colors = Array(
	"","red",
	"green",
	"yellow",
	"blue",
	"magenta",
	"cyan",
	"white",
	"black_bg",
	"red_bg",
	"green_bg",
	"yellow_bg",
	"blue_bg",
	"magenta_bg",
	"cyan_bg",
	"white_bg");

define("ALPHATONUM", Array(
	"a" => 1,
	"b" => 2,
	"c" => 3,
	"d" => 4,
	"e" => 5,
	"f" => 6,
	"g" => 7,
	"h" => 8,
	"i" => 9,
	"j" => 10,
	"k" => 11,
	"l" => 12,
	"m" => 13,
	"n" => 14,
	"o" => 15,
	"p" => 16,
	"q" => 17,
	"r" => 18,
	"s" => 19,
	"t" => 20,
	"u" => 21,
	"v" => 22,
	"w" => 23,
	"x" => 24,
	"y" => 25,
	"z" => 26	));

define("NUMTOALPHA", Array(
	1 => "a",
	2 => "b",
	3 => "c",
	4 => "d",
	5 => "e",
	6 => "f",
	7 => "g",
	8 => "h",
	9 => "i",
	10 => "j",
	11 => "k",
	12 => "l",
	13 => "m",
	14 => "n",
	15 => "o",
	16 => "p",
	17 => "q",
	18 => "r",
	19 => "s",
	20 => "t",
	21 => "u",
	22 => "v",
	23 => "w",
	24 => "x",
	25 => "y",
	26 => "z"	));

function display2DArray(array $arr) {
	for ($i=0; $i < count($arr); $i++) {
		for ($j=0; $j < count($arr[$i]); $j++) {
			if ($arr[$i][$j]) {
				echo "   ";
			}
			if (isHead($i, $j, $arr)) {
				echo "\033[".(40+ALPHATONUM[$arr[$i][$j][0]])."m"."\033[1m"."\033[4m".$arr[$i][$j]."\033[0m"."\033[0m"."\033[0m ";
			} else {
				echo "\033[".(40+ALPHATONUM[$arr[$i][$j][0]])."m".$arr[$i][$j]."\033[0m ";
			}
		}
		echo "\n";
	}
	echo "\n";
}

function generateStartingPuzzle(int $size) : array {
	$arr = Array();
	for ($i=0; $i < $size; $i++) {
		$addArr = Array();
		for ($j=1; $j <= $size; $j++) {
			$addArr[$j-1] = NUMTOALPHA[$j].$i;
		}
		$arr[] = $addArr;
	}
	return $arr;
}

function permute($flow, array &$arr) : bool {
	if (getLength($flow, $arr) == 3 || getLength($flow, $arr) >= 9) {
		return false;
	}
	$heads = getHeads($flow, $arr);
	shuffle($heads);
	foreach ($heads as $head) {
		if (count(headsAdjacent($head[0], $head[1], $arr)) != 0) {
			$headToBeExtended = headsAdjacent($head[0], $head[1], $arr)[array_rand(headsAdjacent($head[0], $head[1], $arr))];
			if (getLength($arr[$headToBeExtended[0]][$headToBeExtended[1]][0], $arr) >= 9 ||
				$arr[$headToBeExtended[0]][$headToBeExtended[1]][0] == $flow) {
				return false;
			}
			if ($arr[$head[0]][$head[1]][1] != 0) {
				$arr[$head[0]][$head[1]] = "--";
				addToEndOfFlow($head[0], $head[1], $arr[$headToBeExtended[0]][$headToBeExtended[1]][0], $arr);
			} else {
				decrementFlow($arr[$head[0]][$head[1]][0], $arr);
				$arr[$head[0]][$head[1]] = "--";
				addToEndOfFlow($head[0], $head[1], $arr[$headToBeExtended[0]][$headToBeExtended[1]][0], $arr);
			}
			return true;
		}
	}
}

function addToEndOfFlow(int $row, int $col, $flow, array &$arr) {
	if ($arr[$row][$col] != "--") {
		return;
	}
	$highest = 0;
	foreach ($arr as $r) {
		foreach ($r as $v) {
			if ($v[0] == $flow && $v[1] > $highest) {
				$highest = $v[1];
			}
		}
	}
	if ($row != 0) {
		// moving down
		if (isHeadOfFlow($row-1, $col, $flow, $arr)) {
			if ($arr[$row-1][$col][1] != 0) {
				$arr[$row][$col] = $flow.++$highest;
			} else {
				incrementFlow($flow, $arr);
				$arr[$row][$col] = $flow."0";
			}
			return;
		}
	}
	if ($col != 0) {
		// moving right
		if (isHeadOfFlow($row, $col-1, $flow, $arr)) {
			if ($arr[$row][$col-1][1] != 0) {
				$arr[$row][$col] = $flow.++$highest;
			} else {
				incrementFlow($flow, $arr);
				$arr[$row][$col] = $flow."0";
			}
			return;
		}
	}
	if ($row != count($arr)-1) {
		// moving up
		if (isHeadOfFlow($row+1, $col, $flow, $arr)) {
			if ($arr[$row+1][$col][1] != 0) {
				$arr[$row][$col] = $flow.++$highest;
			} else {
				incrementFlow($flow, $arr);
				$arr[$row][$col] = $flow."0";
			}
			return;
		}
	}
	if ($col != count($arr)-1) {
		// moving right
		if (isHeadOfFlow($row, $col+1, $flow, $arr)) {
			if ($arr[$row][$col+1][1] != 0) {
				$arr[$row][$col] = $flow.++$highest;
			} else {
				incrementFlow($flow, $arr);
				$arr[$row][$col] = $flow."0";
			}
			return;
		}
	}
}

function incrementFlow($flow, array &$arr) {
	$currentVal = getLength($flow, $arr);
	while ($currentVal > 0) {
		for ($row=0; $row < count($arr); $row++) {
			for ($col=0; $col < count($arr[$row]); $col++) {
				if ($arr[$row][$col] == $flow.($currentVal-1)) {
					$arr[$row][$col] = $flow.$currentVal--;
				}
			}
		}
	}
}

function decrementFlow($flow, array &$arr, $start=-1) {
	$currentVal = $start;
	$length = getLength($flow, $arr);
	while ($currentVal < $length-1) {
		for ($row=0; $row < count($arr); $row++) {
			for ($col=0; $col < count($arr[$row]); $col++) {
				if ($arr[$row][$col] == $flow.($currentVal+1)) {
					$arr[$row][$col] = $flow.$currentVal++;
				}
			}
		}
	}
}

function headsAdjacent(int $row, int $col, array $arr) : array {
	$heads = Array();
	if ($row != 0) {
		if (isHead($row-1, $col, $arr)) {
			$heads[] = Array($row-1, $col);
		}
	}
	if ($col != 0) {
		if (isHead($row, $col-1, $arr)) {
			$heads[] = Array($row, $col-1);
		}
	}
	if ($row != count($arr)-1) {
		if (isHead($row+1, $col, $arr)) {
			$heads[] = Array($row+1, $col);
		}
	}
	if ($col != count($arr)-1) {
		if (isHead($row, $col+1, $arr)) {
			$heads[] = Array($row, $col+1);
		}
	}
	return $heads;
}

function isHead(int $row, int $col, array $arr) : bool {
	if ($arr[$row][$col][1] == 0) {
		return true;
	}
	foreach ($arr as $r) {
		foreach ($r as $value) {
			if ($value[0] == $arr[$row][$col][0] && $value[1] > $arr[$row][$col][1]) {
				return false;
			}
		}
	}
	return true;
}

function isHeadOfFlow(int $row, int $col, $flow, array $arr) : bool {
	return isHead($row, $col, $arr) && $arr[$row][$col][0] == $flow;
}

function getHeads(string $letter, array $arr) : array {
	$newArr = Array();
	$highest = 0;
	for ($row=0; $row < count($arr); $row++) {
		for ($col=0; $col < count($arr[$row]); $col++) {
			if ($arr[$row][$col] == $letter."0") {
				$newArr[] = Array($row, $col);
			}
			if ($arr[$row][$col][0] == $letter && $arr[$row][$col][1] > $highest) {
				$highest = $arr[$row][$col][1];
			}
		}
	}
	for ($row=0; $row < count($arr); $row++) {
		for ($col=0; $col < count($arr[$row]); $col++) {
			if ($arr[$row][$col] == $letter.$highest) {
				$newArr[] = Array($row, $col);
			}
		}
	}
	return $newArr;
}

function getLength(string $letter, array $arr) : int {
	$length = 0;

	foreach ($arr as $r) {
		foreach ($r as $value) {
			if ($value[0] == $letter && $value[1] > $length) {
				$length = $value[1];
			}
		}
	}

	return $length+1;
}

function permute_multiple(array &$arr) {
	$num_iterations;
	switch (count($arr)) {
		case 5:
			$num_iterations = 5**5;
			break;
		case 6:
			$num_iterations = (6**5)/2;
			break;
		case 7:
			$num_iterations = (7**5)/3;
			break;
		case 8:
			$num_iterations = 8**4;
			break;
		case 9:
			$num_iterations = 9**4;
			break;
		case 10:
			$num_iterations = 10**4;
			break;
		case 11:
			$num_iterations = (11**4)/2;
			break;
		case 12:
			$num_iterations = (12**4)/2;
			break;
		case 13:
			$num_iterations = (13**4)/2;
			break;
		case 14:
			$num_iterations = (14**4)/2;
			break;
	}
	$puzzle_letters = array_slice(NUMTOALPHA, 0, count($arr));
	for ($i=0; $i < $num_iterations;) { 
		$rand_flow = $puzzle_letters[array_rand($puzzle_letters)];
		// $i += permute($rand_flow, $arr);
		permute($rand_flow, $arr);
		$i++;
		echo $i."\n";
		display2DArray($arr);
	}
}

$puzzle = generateStartingPuzzle(6);
permute_multiple($puzzle);
display2DArray($puzzle);
