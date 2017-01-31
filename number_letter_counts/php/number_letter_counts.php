<?php

/*
 * Precondition: 1 ≤ $num ≤ 1000
 */
function getWordVal($num) {
	$str="";
	if ($num == 1000) {
		$num -= 1000;
		return "One thousand";
	}
	if ($num / 100 >= 1) {
		$str .= getDigitVal(floor($num/100))." hundred ";
		$num -= floor($num/100)*100;
	}
	if (strlen($str) > 0 && $num > 0) {
		$str .= "and ";
	}
	if ($num / 10 >= 1) {
		if ($num < 20 && $num >= 10) {
			switch ($num) {
				case 10:
					$str .= "Ten";
					break;
				case 11:
					$str .= "Eleven";
					break;
				case 12:
					$str .= "Twelve";
					break;
				case 13:
					$str .= "Thirteen";
					break;
				case 14:
					$str .= "Fourteen";
					break;
				case 15:
					$str .= "Fifteen";
					break;
				case 16:
					$str .= "Sixteen";
					break;
				case 17:
					$str .= "Seventeen";
					break;
				case 18:
					$str .= "Eighteen";
					break;
				case 19:
					$str .= "Nineteen";
					break;
			}
			$num -= $num;
		} else {
			$str .= getTensDigitVal(floor($num/10))."";
			$num -= floor($num/10)*10;
		}
	}
	if ($num > 0) {
		$str .= getDigitVal($num);
	}
	return $str;
}

/*
 * Precondition: 2 ≤ $num ≤ 9
 */
function getTensDigitVal($num) {
	switch ($num) {
		case 2:
			return "Twenty-";
			break;
		case 3:
			return "Thirty-";
			break;
		case 4:
			return "Forty-";
			break;
		case 5:
			return "Fifty-";
			break;
		case 6:
			return "Sixty-";
			break;
		case 7:
			return "Seventy-";
			break;
		case 8:
			return "Eighty-";
			break;
		case 9:
			return "Ninety-";
			break;
		default:
			return "INVALID";
			break;
	}
}

/*
 * Precondition: 1 ≤ $num ≤ 9
 */
function getDigitVal($num) {
	switch ($num) {
		case 1:
			return "One";
			break;
		case 2:
			return "Two";
			break;
		case 3:
			return "Three";
			break;
		case 4:
			return "Four";
			break;
		case 5:
			return "Five";
			break;
		case 6:
			return "Six";
			break;
		case 7:
			return "Seven";
			break;
		case 8:
			return "Eight";
			break;
		case 9:
			return "Nine";
			break;
		default:
			return "INVALID";
			break;
	}
}

$total=0;
for ($i=1; $i <= 1000; $i++) {
	echo $i." ".getWordVal($i)." ".strlen(str_replace(Array(" ", "-"), Array("", ""), getWordVal($i)))."\n";
	$total += strlen(str_replace(Array(" ", "-"), Array("", ""), getWordVal($i)));
}
echo $total;
