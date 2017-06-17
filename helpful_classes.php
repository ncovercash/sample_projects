<?php

// Class which generates prime numbers as needed using the Miller Rabin algo
//  or by checking for factors
class PrimeNumbers implements Countable {
	// start with odd number in order to avoid ugly if-elses in initializer
	private $primes = Array(2,3);
	// if false, use the millerRabinIsProbablyPrime method
	private $strict = true;

	/** ProjectEuler\PrimeNumbers([ int $size = 10 ][, bool $strict = true ])
	 *   Creates an instance of the PrimeNumberClass, which caches primes
	 *   in order to speed up prime generation
	 *  @param optional int $size=10
	 *   initial size for the cached array
	 *  @param optional bool $strict=true
	 *   if $strict === true, output of miller rabin's test must be certain
	 *   for a prime to be confirmed.  if $strict === false, then "probable"
	 *   primes are accepted
	 *  @precondition $size >= 2
	 */
	public function __construct(int $size=10, bool $strict=true) {
		for ($i=2; $i < $size; $i++) { 
			$this->genNextPrime();
		}
		$this->strict = $strict;
	}

	/** bool searchPrime( int $key )
	 *   Performs a binary search of the cached primes list
	 *   If $key is above the highest cached prime, generate more primes
	 *  @param int $key
	 *   number to determine primality using cache
	 *  @return bool
	 *   true if the number is prime according to the cache, false if not
	 */
	public function searchPrime(int $key) : bool {
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

	/** static bool millerRabinIsCertainPrime( int $in )
	 *   Using GMP's gmp_prob_prime function, checks if $in is certainly prime
	 *   according to Miller-Rabin's probalistic test
	 *  @param int $in
	 *   number to determine if it is certainly prime
	 *  @return bool
	 *   true if the number is certainly prime according to the test,
	 *   false if not
	 */
	public static function millerRabinIsCertainPrime(int $in) : bool {
		// per gmp_prob_prime documentation, return 2 is certain prime
		return gmp_prob_prime($in) == 2;
	}

	/** static bool millerRabinIsProbablyPrime( int $in )
	 *   Using GMP's gmp_prob_prime function, checks if $in is probably prime
	 *   according to Miller-Rabin's probalistic test
	 *  @param int $in
	 *   number to determine if it is probably prime
	 *  @return bool
	 *   true if the number is probably prime according to the test,
	 *   false if not
	 */
	public static function millerRabinIsProbablyPrime(int $in) : bool {
		// per gmp_prob_prime documentation, return 2 is certain prime and
		// 1 is probably prime
		return gmp_prob_prime($in) >= 1;
	}

	/** void genNextPrime( void )
	 *   Generates the next prime number, using the last element in the cache
	 *   as a starting point.
	 *   Increments by 2 can be used, as we ensure that the last element will
	 *   be odd by starting with the initial array(2,3)
	 *   Depending on the value of $strict, will attempt use of the faster
	 *   Miller-Rabin test instead of the slower factor method
	 *  @postcondition the prime cache contains one more prime
	 */
	public function genNextPrime() {
		for ($i=$this->primes[count($this->primes)-1]+2; $i < PHP_INT_MAX; $i+=2) { 
			if ($this->strict) {
				if (self::millerRabinIsCertainPrime($i)) {
					$this->primes[] = $i;
					return;
				}
			} else {
				// if $strict is not set, check if probably prime
				// and use the result conclusively
				// this can be done because all primes are at least probably
				// prime in the test
				if (self::millerRabinIsProbablyPrime($i)) {
					$this->primes[] = $i;
					return;
				} else {
					continue;
				}
			}
			// if strict is set, and miller rabin's test not certain
			// use the old factorization method
			if (self::isPrimeNumber($i)) {
				$this->primes[] = $i;
				return;
			}
		}
	}

	/** static bool certainPrimeWithFallback( int $in )
	 *   Uses miller rabin's test to check if $in is certainly prime
	 *   If inconclusive, use normal checking method
	 *  @param int $in
	 *   number to determine if it is probably prime
	 *  @return bool
	 *   true if the number is prime, false if not
	 */
	public static function certainPrimeWithFallback(int $in) : bool {
		if (self::millerRabinIsProbablyPrime($in)) {
			if (self::millerRabinIsCertainlyPrime($in)) {
				return true;
			}
			return self::isPrimeNumber($in);
		}
	}

	/** static bool isPrimeNumber( int $a )
	 *   Uses the extensive factorization method to determine primality
	 *   Checks for extraneous cases ($a == 1 || $a == 2)
	 *   Checks if even, then checks even divisibility by odd numbers
	 *  @param int $in
	 *   number to determine if it is probably prime
	 *  @return bool
	 *   true if the number is prime, false if not
	 */
	public static function isPrimeNumber(int $a) : bool {
		// 2 is prime, however will fail % 2 test
		if ($a == 2) {
			return true;
		}
		// 1 is not prime according to scientific consensus
		// also, 1 will pas the for loop test below
		if ($a == 1) {
			return false;
		}
		// check if even
		if ($a % 2 == 0) {
			return false;
		}
		// precalculate upper bound
		$maxSearch = ceil(sqrt($a));
		for ($i=3; $i <= $maxSearch; $i+=2) { // already searched factors of 2
			if ($a%$i==0) {
				return false;
			}
		}
		return true;
	}

	/** string __toString( void )
	 *   returns a string representation of the internal cache array
	 *  @return string
	 *   string representation of internal cache array using var_export
	 */
	public function __toString() : string {
		return var_export($this->primes, true);
	}

	/** int count( void )
	 *   inherited from Countable inteface
	 *   returns the size of the internal prime cache
	 *  @return int
	 *   size of internal cache
	 */
	public function count() : int {
		return count($this->primes);
	}

	/** static bool isCircularPrime( int $a )
	 *   Checks if all "rotations" of $a are prime
	 *  @return int
	 *   size of internal cache
	 */
	public static function isCircularPrime(int $a) : bool {
		if (DigitOps::containsEvenDigit($a)) {
			return false;
		}
		$i = 0;
		while ($i < strlen($a)) {
			if (!self::certainPrimeWithFallback((int)substr($a, $i).substr($a, 0, $i))) {
				return false;
			}
			$i++;
		}
		return true;
	}
}

/**
 * Basic math operations, such as permutations, combinatorics, etc
 */
class Math {
	/** static int numPermutations( int $a )
	 *   Wrapper for Math::factorial( int $a ) function
	 *  @param int $in
	 *   number to calculate the number of permutations
	 *  @return int
	 *   number of permutations of $in
	 */
	public static function numPermutations(int $in) : int {
		return self::factorial($in);
	}

	/** static int factorial( int $a )
	 *   Returns factorial ($a!) = 1 * 2 * 3 ... $a
	 *  @param int $in
	 *   number to calculate the number of permutations
	 *  @return int
	 *   number of permutations of $in
	 */
	public static function factorial(int $in) : int {
		if ($in == 1) {
			return 1;
		}
		return $in * factorial($in-1);
	}

	public static function combinatoric(int $n, int $k) : string {
		$top = factorial($n);
		$bottom = factorial($k);
		$bottom = gmp_mul(factorial($n-$k), $bottom);
		return gmp_strval(gmp_div_q($top, $bottom));
	}
}

class DigitOps {
	public static function containsEvenDigit(int $num) : bool {
		$str = (string)$num;
		for ($i=0; $i < strlen($str); $i++) { 
			if ((int)$str[$i] % 2 == 0) {
				return true;
			}
		}
		return false;
	}
}

class Factors {
	public static function getFactors(int $in) : array {
		$factors = Array(1);
		$limit = ceil(sqrt($in));
		for ($i=2; $i <= $limit; $i++) { 
			if ($in % $i == 0) {
				array_push($factors, $i);
				array_push($factors, $in/$i);
			}
		}
		$factors = array_unique($factors);
		return $factors;
	}
}

class StringOps {
	public static function numLexographicPermutations(int $in) : int {
		return Math::numPermutations(strlen($in));
	}
}
