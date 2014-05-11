<?php
class TradingCardGamesController extends AppController {
	public $helpers = array("Html", "Form");
	public $components = array('Session');

	public function index() {
		$this->set("video_game", "super mario 3d land");
		$this->set("card", "pokemon");
	}
	public function view($id = null) {
		if($id != null)
		{
			$this->set('video_game', 'test');
		}
	}
	
	
}
?>