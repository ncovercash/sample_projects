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

	public function millerRabinIsPrime(int $in) : bool {
		return gmp_prob_prime($in) >= 1;
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

function getCornersOfSpiralLayer(int $layer) : array {
	if ($layer == 1) {
		return Array(1);
	}
	return Array(($layer+$layer-1)**2,
		(($layer+$layer-1)**2)- (2*($layer-1)),
		(($layer+$layer-1)**2) - (4*($layer-1)),
		(($layer+$layer-1)**2) - (6*($layer-1)));
}

function getDiagonalsOfSpiral(int $layers, array &$spiralPrimesCache) : array {
	if (!isset($spiralPrimesCache[$layers])) {
		generateSPC($layers, $spiralPrimesCache);
	}
	return $spiralPrimesCache[$layers];
}

function generateSPC(int $max, array &$spiralPrimesCache) {
	while (count($spiralPrimesCache) < $max) {
		$spiralPrimesCache[count($spiralPrimesCache)+1] = array_merge((array)$spiralPrimesCache[count($spiralPrimesCache)], getCornersOfSpiralLayer(count($spiralPrimesCache)+1));
	}
}

function getPercentPrimes(array $test, PrimeNumbers &$primes) : float {
	return getNumPrimes($test, $primes, $spiralPrimesCache)/count($test);
}

function getNumPrimes(array $test, PrimeNumbers &$primes) : float {
	$prime = 0;
	foreach ($test as $num) {
		if ($primes->millerRabinIsPrime($num)) {
			$prime++;
		}
	}
	return $prime;
}

function getPercentPrimesOfSpiral(int $layers, PrimeNumbers &$primes, array &$primeCache) : float {
	return getPercentPrimes(getDiagonalsOfSpiral($layers, $primeCache), $primes);
}

function getSideLengthFromNumLayers(int $layers) : int {
	return (($layers-1)*2)+1;
}

$primes = new PrimeNumbers();
$primeCache = Array(1=>0);

$layers = 2;

ini_set("memory_limit", -1);

getDiagonalsOfSpiral(5, $primeCache);
var_dump($primeCache);

while (getPercentPrimesOfSpiral($layers, $primes, $primeCache) >= 0.1) {
	$nprimes = getNumPrimes(getDiagonalsOfSpiral($layers, $primeCache), $primes);
	$numDiagonal = ((4*($layers-1))+1);
	if (($nprimes)/($numDiagonal+25600) >= 0.1) {
		$layers += 6400;
	} else if (($nprimes)/($numDiagonal+12800) >= 0.1) {
		$layers += 3200;
	} else if (($nprimes)/($numDiagonal+6400) >= 0.1) {
		$layers += 1600;
	} else if (($nprimes)/($numDiagonal+3200) >= 0.1) {
		$layers += 800;
	} else if (($nprimes)/($numDiagonal+1600) >= 0.1) {
		$layers += 400;
	} else if (($nprimes)/($numDiagonal+800) >= 0.1) {
		$layers += 200;
	} else if (($nprimes)/($numDiagonal+400) >= 0.1) {
		$layers += 100;
	} else if (($nprimes)/($numDiagonal+200) >= 0.1) {
		$layers += 50;
	} else if (($nprimes)/($numDiagonal+100) >= 0.1) {
		$layers += 25;
	} else if (($nprimes)/($numDiagonal+40) >= 0.1) {
		$layers += 10;
	} else if (($nprimes)/($numDiagonal+20) >= 0.1) {
		$layers += 5;
	} else {
		$layers++;
	}
	echo $layers."\n"; 
}

var_dump(getSideLengthFromNumLayers($layers));
