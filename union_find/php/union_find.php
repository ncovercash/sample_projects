<?
class UnionFind {
	protected $nodes;

	public function __construct(int $n) {
		$this->nodes = Array();
		for ($i=0; $i < $n; $i++) { 
			$this->nodes[$i] = $i;
		}
	}

	public function __toString() : string {
		return var_export($this->nodes, true);
	}

	public function connected(int $a, int $b) : bool {
		if ($a >= count($this->nodes) || $b >= count($this->nodes)) {
			throw new Exception("Invalid arguments given to UnionFind::connected.");
		}
		return $this->nodes[$a] == $this->nodes[$b];
	}

	public function count() : int {
		$components = Array();
		foreach ($this->nodes as $index => $component) {
			$components[$component] = true;
		}
		return count($components);
	}

	protected function find(int $n) : int {
		if ($n >= count($this->nodes)) {
			throw new Exception("Invalid arguments given to UnionFind::find.");
		}
		return $this->nodes[$n];
	}

	public function getComponentId(int $n) : int {
		if ($n >= count($this->nodes)) {
			throw new Exception("Invalid arguments given to UnionFind::getComponentId.");
		}
		return $this->nodes[$n];
	}

	public function union(int $a, int $b) : void {
		if ($a >= count($this->nodes) || $b >= count($this->nodes)) {
			throw new Exception("Invalid arguments given to UnionFind::union.");
		}
		if ($this->connected($a, $b)) {
			return;
		}
		$newComponent = $this->nodes[$a];
		$mergeComponent = $this->nodes[$b];
		for ($i=0; $i < count($this->nodes); $i++) { 
			if ($this->nodes[$i] == $mergeComponent) {
				$this->nodes[$i] = $newComponent;
			}
		}
	}
}

$test = new UnionFind(10);
echo $test->union(1,2);
echo $test->union(3,2);
echo $test->union(1,3);
echo $test;
