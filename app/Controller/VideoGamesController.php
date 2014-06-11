<?php
class VideoGamesController extends AppController {
	public $helpers = array("Html", "Form");
	public $components = array('Session');
	public $uses = array('Platform', 'VideoGame', 'User');

	
	
	public function index() {
		$this->set('title_for_layout', 'Video Games');
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
		//  check if someone is logged in, if not redirect to previous page
		$this->check_user();
		//  set title for this page
		$this->set('title_for_layout', 'Add A New Video Game');
		//  if request is a POST method
		if ($this->request->is('post')) {
			$this->VideoGame->create();  //  create a new video game
				//  validate data
				if($this->VideoGame->validates($this->data)) {
					//  escape all new lines with <br /> elements to print them in HTML
					$this->request->data['VideoGame']['description'] = nl2br($this->request->data['VideoGame']['description']);
					//  save video game to database
					if($this->VideoGame->save($this->request->data)) {
						$this->Session->setFlash(__('A new video game was added'));
						
						return $this->redirect(array('action'=>'index'));
					}
				}
				$this->Session->setFlash(__('Unable to add video game'));
		}	
		$this->set('platforms', $this->Platform->find('all'));
	}
	
	public function view($id = null) {
		if ($id != null) {
			$this->set('video_game', $this->VideoGame->findById($id));
		}
	}
	
	public function edit($id = null) {
		$this->check_user();
		if (!$id) {
			throw new NotFoundException(__('invalid id'));
		}
		$video_game = $this->VideoGame->findById($id);
		if(!$video_game) {
			throw new NotFoundException(('Invalid post'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$this->VideoGame->id = $id;
			$this->request->data['VideoGame']['description'] = nl2br($this->request->data['VideoGame']['description']);
			
			if ($this->VideoGame->save($this->request->data)) {
				$this->Session->setFlash(__("video game information updated."));
					return $this->redirect(array("action"=>"index"));
			}
			
			$this->Session->setFlash(__('unable to update video game information.'));
		}
		if (!$this->request->data) {
			$this->set('title_for_layout', 'Edit Video Game');
			$this->request->data = $video_game;
			//$this->set('video_game', $video_game);
			$this->set('platforms', $this->Platform->find('all'));
		}
	}
}
?>