<?php

class Mults_of_3_and_5 {
	public static function getSum($max) {
		return self::get3Sum($max) + self::get5Sum($max);
	}
	private static function get3Sum($max) {
		$sum=0;
		for ($i=0; $i < $max; $i+=3) { 
			$sum+=$i;
		}
		return $sum;
	}
	private static function get5Sum($max) {
		$sum=0;
		for ($i=0; $i < $max; $i+=5) { 
			if ($i % 3 != 0) {
				$sum+=$i;
			}
		}
		return $sum;
	}
}

var_dump(Mults_of_3_and_5::getSum(1000));
