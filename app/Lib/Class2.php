<?php class Class2 {
	private $test;

	public function __construct() {
		$this->test = "another class in lib";
	}

	public function test() {
		return $this->test;
	}
}

?>