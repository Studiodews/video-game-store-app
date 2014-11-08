<?php
class MyClass {
	protected $name;

	public function __construct() {
		$this->name= "paul";
	}

	public function name() {
		return $this->name;
	}

}
?>