<?php
class StoreController extends AppController {
	public $helpers = array("Html", "Form");
	public $components = array('Session');
	public $uses = array('Platform');

	public function index() {
		$this->set("video_game", "super mario 3d land");
		$this->set("card", "pokemon");
		$this->set('platforms', $this->Platform->find('all'));
	}
	
	
}
?>