<?
class UnionFind {
	protected $nodes;
	protected $size;
	public function __construct(int $n) {
		for ($i=0; $i < $n; $i++) { 
			$this->nodes[$i] = $i;
			$this->size[$i] = 1;
		}
	}

	public function __toString() : string {
		return var_export($this->nodes, true);
	}

	public function connected(int $a, int $b) : bool {
		if ($a >= count($this->nodes) || $b >= count($this->nodes)) {
			throw new Exception("Invalid arguments given to UnionFind::connected.");
		}
		return $this->getRoot($a) == $this->getRoot($b);
	}

	public function count() : int {
		$components = Array();
		foreach ($this->nodes as $index => $component) {
			$components[$component] = true;
		}
		return count($components);
	}

	public function getParentId(int $n) : int {
		if (!isset($this->nodes[$n])) {
			throw new Exception("Invalid argument ({$n}) given to UnionFind::getParentId.");
		}
		return $this->nodes[$n];
	}

	public function getRoot(int $n) : int {
		while ($this->getParentId($n) != $n) {
			$this->nodes[$n] = $this->getParentId($this->getParentId($n));
			$n = $this->getParentId($n);
		}
		return $n;
	}

	public function union(int $a, int $b) : void {
		if ($a >= count($this->nodes) || $b >= count($this->nodes)) {
			throw new Exception("Invalid arguments given to UnionFind::union.");
		}
		if ($this->connected($a,$b)) {
			return;
		}
		$i = $this->getRoot($a);
		$j = $this->getRoot($b);
		// smaller trees, weighting
		if ($this->sz[$i] < $this->sz[$j]) {
			$this->nodes[$i] = $j;
			$this->sz[$i]+=$this->sz[$j];
		} else {
			$this->nodes[$j] = $i;
			$this->sz[$j]+=$this->sz[$i];
		}
	}
}

class MonteCarlo extends UnionFind {
	protected $open = Array();
	protected $length = 0;

	public function __construct(int $n) {
		$this->length = $n;
		$nsquared = $n**2;
		for ($i=0; $i < $nsquared; $i++) { 
			$this->nodes[$i] = $i;
			$this->size[$i] = 1;
			$this->open[$i] = false;
		}
	}

	public function testPercolation() : bool {
		for ($i=0; $i<$this->length; $i++) { 
			for ($j=($this->length**2)-$this->length; $j<$this->length**2; $j++) { 
				if ($this->connected($i,$j)) {
					return true;
				}
			}
		}
		return false;
	}

	private function openSquare() : void {
		$squareToOpen = random_int(0, count($this->nodes)-1);
		while ($this->open[$squareToOpen]) {
			$squareToOpen = random_int(0, count($this->nodes)-1);
		}
		$this->open[$squareToOpen] = true;
		if ($squareToOpen >= $this->length) {
			$this->union($squareToOpen, $squareToOpen-$this->length);
		}
		if ($squareToOpen % $this->length != 0) {
			$this->union($squareToOpen, $squareToOpen-1);
		}
		if ($squareToOpen % $this->length != $this->length-1) {
			$this->union($squareToOpen, $squareToOpen+1);
		}
		if ($squareToOpen < ($this->length**2)-$this->length) {
			$this->union($squareToOpen, $squareToOpen+$this->length);
		}
	}

	public function percolate() : float {
		while (!$this->testPercolation()) {
			$this->openSquare();
		}
		$totalOpen=0;
		$totalClosed=0;
		foreach ($this->open as $key => $isOpen) {
			$totalOpen += $isOpen * 1;
			$totalClosed += !$isOpen * 1;
		}
		return $totalOpen/($this->length**2);
	}

	public function __toString() : string {
		$str = "––";
		for ($col=0; $col < $this->length; $col++) {
			$str .= "–";
		}
		$str .= "\n";
		for ($row=0; $row < $this->length; $row++) { 
			$str .= "|";
			for ($col=0; $col < $this->length; $col++) { 
				if ($this->open[$row*$this->length+$col]) {
					$str .= "X";
				} else {
					$str .= " ";
				}
			}
			$str .= "|\n";
		}
		$str .= "––";
		for ($col=0; $col < $this->length; $col++) {
			$str .= "–";
		}
		return $str;
	}
}

$test = new MonteCarlo(5);
echo $test->percolate()."\n";
echo $test;
