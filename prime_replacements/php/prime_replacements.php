<?php

class PrimeNumbers {
	private $primes = Array(2,3); // start with odd num

	public function __construct(int $size=10) {
		for ($i=2; $i < $size; $i++) { 
			$this->genNextPrime();
		}
	}

	public function searchPrime(int $key) {
		while ($this->primes[count($this->primes)-1] < $key) {
			$this->genNextPrime();
		}

	    $low = 0;
	    $hig = count($this->primes) - 1;
	    while($low <= $hig) {
	        $mid = floor($low + ($hig - $low) / 2);
	        if ($key < $this->primes[$mid]) {
	            $hig = $mid - 1;
	        } else if ($key > $this->primes[$mid]) { 
	            $low = $mid + 1;
	        } else {
	            return true;
	        }
	    }
	    return false;
	}

	public function genNextPrime() {
		for ($i=$this->primes[count($this->primes)-1]+2; $i < PHP_INT_MAX; $i+=2) { 
			if ($this->isPrimeNumber($i)) {
				$this->primes[] = $i;
				return;
			}
		}
	}

	public static function isPrimeNumber(int $a) : bool {
		if ($a == 2) {
			return true;
		}
		if ($a == 1) {
			return false;
		}
		if ($a % 2 == 0) {
			return false;
		}
		$maxSearch = ceil(sqrt($a));
		for ($i=3; $i <= $maxSearch; $i+=2) { // already searched factors of 2
			if ($a%$i==0) {
				return false;
			}
		}
		return true;
	}

	public function __toString() : string {
		return var_export($this->primes, true);
	}
}

$primes = new PrimeNumbers(); // use OOP to cache primes

/*

Analysis:

We need 8 digits, so the first number of the family must be 0, 1,or 2

Using analysis with divisibility rules of 3, we can cut down the solution set

We must have a 3 digit number in order to have the correct number of primes

*/

function get3DigitPossibilities(int $digits) : array { // 1 designates what to replace, can remove things with 1 at the end
	switch ($digits) {
		case 5:
			return Array("01110");
		case 6:
			return Array("110100", "110010", "101100", "101010", "100110", "011100", "011010", "010110", "001110");
	}
	return Array();
}

function get012Families(int $in, PrimeNumbers &$primes) : array {
	$result = Array();
	$possibilities = get3DigitPossibilities(strlen($in));
	foreach ($possibilities as $test) {
		$start = 0;
		if (((string)$test)[0] == "1") {
			$start = 1;
		}
		for ($n=0; $n < 3; $n++) { 
			if (isFamily($in, $test, $n, $primes)) {
				$result[] = $test;
				break 1;
			}
		}
	}
	return $result;
}

function isFamily(int $in, string $test, int $digit, PrimeNumbers &$primes) : bool {

	$inStr = (string)$in;
	for ($i=0; $i < strlen($test); $i++) { 
		if ($test[$i] == "1") {
			$inStr[$i] = $digit;
		}
	}
	if ($primes->searchPrime($inStr)) {
		return true;
	}
	return false;
}

function isValid(int $in, PrimeNumbers &$primes) : bool {
	$families = get012Families($in, $primes);
	if (count($families) == 0) {
		return false;
	}
	foreach ($families as $family) {
		$total = 0;
		$start = 0;
		if (($family)[0] == 1) {
			$start = 1;
		}
		for ($i=0; $i < 10; $i++) { 
			$total += isFamily($in, $family, $i, $primes);
		}
		if ($total >= 8) {
			return true;
		}
	}
	return false;
}


for ($i=10001; $i <= 999999; $i+=2) { 
	if (isValid($i, $primes)) {
		var_dump($i);
		break 1;
	}
}

