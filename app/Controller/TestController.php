<?php
App::uses('MyClass', 'Lib');
App::uses('Class2', 'Lib');
class TestController extends AppController {
	//public $uses = array('MyClass');

	public function index() {
		$test = new MyClass();
		echo $test->name();
		$test2 = new Class2();
		echo $test2->test();
	}
}