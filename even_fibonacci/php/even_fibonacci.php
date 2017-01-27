<?php

class EvenFibonacci {
	public static function getEvenFibonacciSum($max) {
		$sum = 0;
		$a = 0;
		$b = 1;
		while ($a + $b < $max) {
			if (($a + $b)%2 == 0) {
				$sum += $a + $b;
			}
			$tmp = $a;
			$a = $b;
			$b = $a + $tmp;
		}
		return $sum;
	}
}

var_dump(EvenFibonacci::getEvenFibonacciSum(4000000));
