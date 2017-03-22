<?php

class TriangularNumbers implements Iterator, Countable {
	private $nums = Array();
	private $n = 1;

	private $iteratorPosition = 0;
	private $maxSize;

	// maxSize ONLY applys when iterating
	public function __construct(int $initialSize=10, int $maxSize=-1) {
		for ($i=0; $i < $initialSize; $i++) { 
			$this->genTriangularNumber();
		}
		// setup iterator
		$this->iteratorPosition = 0;
		$this->maxSize = $maxSize;
	}

	public function highestGenNum() : int {
		return $this->nums[count($this->nums)-1];
	}

	public function genTriangularNumber() {
		$this->nums[] = $this->n*(($this->n)+1)/2;
		$this->n++;
	}

	public function currentLength() : int {
		return count($this->nums);
	}

	public function isTriangular(int $in) : bool {
		while ($in >= $this->nums[count($this->nums)-1]) {
			$this->genTriangularNumber();
		}

		return in_array($in, $this->nums);
	}

	public function getArray(int $size=10) : array {
		while (count($this->nums) <= $size) {
			$this->genTriangularNumber();
		}
		return array_slice($this->nums, 0, $size);
	}

	public function getIndex(int $i) : int {
		while ($i >= count($this->nums)) {
			$this->genTriangularNumber();
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

	public function valid() : bool {
		if ($this->maxSize == -1) {
			return true;
		}
		return $this->iteratorPosition < $this->maxSize;
	}

	public function shiftIteratorToValOrHighest(int $i) {
		while ($i > $this->nums[count($this->nums)-1]) {
			$this->genTriangularNumber();
		}

		$this->iteratorPosition = count($this->nums)-1;
	}

	// Countable implementation
	public function count() : int {
		return currentSize();
	}
}

class PentagonalNumbers implements Iterator, Countable {
	private $nums = Array();
	private $n = 1;

	private $iteratorPosition = 0;
	private $maxSize;

	// maxSize ONLY applys when iterating
	public function __construct(int $initialSize=10, int $maxSize=-1) {
		for ($i=0; $i < $initialSize; $i++) { 
			$this->genPentagonalNumber();
		}
		// setup iterator
		$this->iteratorPosition = 0;
		$this->maxSize = $maxSize;
	}

	public function highestGenNum() : int {
		return $this->nums[count($this->nums)-1];
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

	public function valid() : bool {
		if ($this->maxSize == -1) {
			return true;
		}
		return $this->iteratorPosition < $this->maxSize;
	}

	public function shiftIteratorToValOrHighest(int $i) {
		while ($i > $this->nums[count($this->nums)-1]) {
			$this->genPentagonalNumber();
		}

		$this->iteratorPosition = count($this->nums)-1;
	}

	// Countable implementation
	public function count() : int {
		return currentSize();
	}
}

class HexagonalNumbers implements Iterator, Countable {
	private $nums = Array();
	private $n = 1;

	private $iteratorPosition = 0;
	private $maxSize;

	// maxSize ONLY applys when iterating
	public function __construct(int $initialSize=10, int $maxSize=-1) {
		for ($i=0; $i < $initialSize; $i++) { 
			$this->genHexagonalNumber();
		}
		// setup iterator
		$this->iteratorPosition = 0;
		$this->maxSize = $maxSize;
	}

	public function highestGenNum() : int {
		return $this->nums[count($this->nums)-1];
	}

	public function genHexagonalNumber() {
		$this->nums[] = $this->n*((2*$this->n)-1);
		$this->n++;
	}

	public function currentLength() : int {
		return count($this->nums);
	}

	public function isHexagonal(int $in) : bool {
		while ($in >= $this->nums[count($this->nums)-1]) {
			$this->genHexagonalNumber();
		}

		return in_array($in, $this->nums);
	}

	public function getArray(int $size=10) : array {
		while (count($this->nums) <= $size) {
			$this->genHexagonalNumber();
		}
		return array_slice($this->nums, 0, $size);
	}

	public function getIndex(int $i) : int {
		while ($i >= count($this->nums)) {
			$this->genHexagonalNumber();
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

	public function valid() : bool {
		if ($this->maxSize == -1) {
			return true;
		}
		return $this->iteratorPosition < $this->maxSize;
	}

	public function shiftIteratorToValOrHighest(int $i) {
		while ($i > $this->nums[count($this->nums)-1]) {
			$this->genHexagonalNumber();
		}

		$this->iteratorPosition = count($this->nums)-1;
	}

	// Countable implementation
	public function count() : int {
		return currentSize();
	}
}

$tri = new TriangularNumbers();
$pent = new PentagonalNumbers();
$hex = new HexagonalNumbers();

// go ahead and go to that point
$tri->shiftIteratorToValOrHighest(40755+1);
$pent->shiftIteratorToValOrHighest(40755+1);
$hex->shiftIteratorToValOrHighest(40755+1);


foreach ($hex as $hexNum) {
	if ($pent->isPentagonal($hexNum)) {
		if ($tri->isTriangular($hexNum)) {
			var_export($hexNum);
			break;
		}
	}
}
