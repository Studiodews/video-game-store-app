<?php
class VideoGamesController extends AppController {
	public $helpers = array("Html", "Form");
	public $components = array('Session');
	public $uses = array('Platform', 'VideoGame');

	public function index() {
		if (isset($_GET['Category']))
		{
			$this->set('video_games', $this->VideoGame->find('all', array('conditions' =>array('VideoGame.platform_id'=>$_GET['Category']))));
			
		}
		else {
			$this->set('video_games', $this->VideoGame->find('all'));
		}
		$this->set('platforms',$this->Platform->find('all'));
		
	}
	
	
	public function add() {
		if ($this->request->is('post')) { 
			$this->VideoGame->create();
				if($this->VideoGame->validates($this->data)) {
					if($this->VideoGame->save($this->request->data)) {
						$this->Session->setFlash(__('Your post has been saved'));
						return $this->redirect(array('action'=>'index'));
					}
				}
				$this->Session->setFlash(__('Unable to add your post'));
		}	
		$this->set('platforms', $this->Platform->find('all'));
	}
	
	public function view($id = null) {
		if ($id != null) {
			$this->set('video_game', $this->VideoGame->findById($id));
		}
	}
}
?>