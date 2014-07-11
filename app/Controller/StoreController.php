<?php
class StoreController extends AppController {
	public $helpers = array("Html", "Form");
	public $components = array('Session');
	public $uses = array('Platform', 'VideoGame', 'TradingCardGame', 'Console');

	public function index() {
		$this->set("video_game", "super mario 3d land");
		$this->set("card", "pokemon");
		$this->set('video_games', $this->VideoGame->find('all', array('order' => 'VideoGame.views DESC', 'limit'=>5)));
	}
	
	
}
?>