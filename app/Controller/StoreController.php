<?php
class StoreController extends AppController {
	public $helpers = array("Html", "Form");
	public $components = array('Session');
	public $uses = array('Platform', 'VideoGame', 'TradingCardGame', 'Console');

	public function index() {
		/*$this->set("video_game", "super mario 3d land");
		$this->set("card", "pokemon");*/
		$this->set('video_games', $this->VideoGame->find('all', array(
			'contain'=>array('Product'),
			)));
		/*$test = $this->VideoGame->find('all', array(
			'contain'=>array('VgGenreMembership'=>array('VgGenre')),
			));*/
		/*print_r($test);
		print_r('<br /><br />');
		$log = $this->VideoGame->getDataSource()->getLog(false, false);
		print_r($log);*/
	}

	public function disclaimer() {
		
	}
	
	
}
?>