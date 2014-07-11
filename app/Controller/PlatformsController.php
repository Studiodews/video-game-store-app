<?php
class PlatformsController extends AppController {

	public $helpers = array("Html", "Form");
	public $components = array('Session');
	
	public function index()
	 {
	 	
		$this->set('platforms', $this->Platform->find("all"));
	 }
}

?>