<?
class UnionFind {
	protected $nodes;
	protected $size;
	public function __construct(int $n) {
		$this->nodes = Array();
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
		if ($n >= count($this->nodes)) {
			throw new Exception("Invalid arguments given to UnionFind::getParentId.");
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

$test = new UnionFind(10);
echo $test->union(1,2);
echo $test->union(3,2);
echo $test->union(1,3);
echo $test->union(9,6);
echo $test->union(9,4);
echo $test->union(6,7);
echo $test->union(8,7);
echo $test->union(7,8);
echo $test->union(0,8);
echo $test->union(4,1);
echo $test;
echo $test->connected(0,1);
