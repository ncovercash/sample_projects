<?php

class PentagonalNumbers implements Iterator, Countable {
	private $nums = Array();
	private $n = 1;

	private $iteratorPosition = 0;
	private $maxSize;

	// maxSize ONLY applys when iterating
	public function __construct(int $initialSize=10, int $maxSize=100) {
		for ($i=0; $i < $initialSize; $i++) { 
			$this->genPentagonalNumber();
		}
		// setup iterator
		$this->iteratorPosition = 0;
		$this->maxSize = $maxSize;
	}

	public function genPentagonalNumber() {
		$this->nums[] = $this->n*((3*$this->n)-1)/2;
		$this->n++;
	}

	public function currentLength() : int {
		return count($this->nums);
	}

	public function isPentagonal(int $in) : bool {
		while ($in >= $this->nums[count($this->nums)-1]) {
			$this->genPentagonalNumber();
		}

		return in_array($in, $this->nums);
	}

	public function getArray(int $size=10) : array {
		while (count($this->nums) <= $size) {
			$this->genPentagonalNumber();
		}
		return array_slice($this->nums, 0, $size);
	}

	public function getIndex(int $i) : int {
		while ($i >= count($this->nums)) {
			$this->genPentagonalNumber();
		}
		return $this->nums[$i];
	}

	public function __toString() : string {
		return var_export($this->nums, true);
	}

	// Iterator implementation
	public function rewind() {
		$this->position = 0;
	}

	public function current() : int {
		return $this->getIndex($this->iteratorPosition);
	}

	public function key() : int {
		return $this->iteratorPosition;
	}

	public function next() {
		$this->iteratorPosition++;
	}

	public function valid(int $i) : bool {
		return $i < $this->maxSize;
	}

	// Countable implementation
	public function count() : int {
		return currentSize();
	}
}

$series = new PentagonalNumbers();

for ($j=0; true; $j++) { 
	$m = $series->getIndex($j);
	for ($k=$j-1; $k >= 0; $k--) {
		$n = $series->getIndex($k); 
		if ($series->isPentagonal($m+$n) &&
			$series->isPentagonal($m-$n)) {
			var_export(abs($m-$n))."\n";
			break 2; // die() could work here too
		}
	}
}

