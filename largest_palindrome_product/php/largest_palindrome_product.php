<?php
class LargestPalindromeProduct {
	public static function getLargestProduct() {
		$largestPalindrome=0;
		for ($a = 100; $a < 1000; $a++) {
			for ($b = 100; $b < 1000; $b++) {
				if (self::isPalindrome(strval($a*$b))) {
					if ($largestPalindrome<($a*$b)) {
						$largestPalindrome = $a*$b;
					}
				}
			}
		}
		return $largestPalindrome;
	}

	public static function isPalindrome($word) {
		// taken from some previous code of mine
		$word = strtolower($word);
        for ($i=0; $i<round(strlen($word)/2, 0, PHP_ROUND_HALF_UP); $i++) {
            if(substr($word, $i, 1) != substr($word, strlen($word)-1-$i, 1)) {
            	return false;
            }
        }
        return true;
	}
}

var_dump(LargestPalindromeProduct::getLargestProduct());
