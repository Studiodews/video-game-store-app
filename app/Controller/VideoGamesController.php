<?php
class VideoGamesController extends AppController {
	public $helpers = array("Html", "Form");
	public $components = array('Session');
	public $uses = array('Platform', 'VideoGame', 'User', 'VgReview');

	
	
	public function index() {
		//  the title for this page
		$this->set('title_for_layout', 'Video Games');
		//  if a certain category is selected
		if (isset($_GET['Category']))
		{
			//  get all items from that certain category
			$this->set('video_games', $this->VideoGame->find('all', 
				array('conditions' =>array('VideoGame.platform_id'=>$_GET['Category']))));
			
		}
		else {
			//  get every item from every category
			$this->set('video_games', $this->VideoGame->find('all'));
			$test = $this->VideoGame->find('all');
			//print_r(count($test[0]));
		}
		//print_r($this->VideoGame->find('first', array('recursive'=>-1)));
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

					if (is_uploaded_file($this->request->data['VideoGame']['main_image_url']['tmp_name'])) {
					//$this->Session->setFlash('a file was chosen');
					move_uploaded_file(
	        			$this->request->data['VideoGame']['main_image_url']['tmp_name'],
	        			WWW_ROOT . '/img/'. $this->request->data['VideoGame']['main_image_url']['name']
	    			);
	    			$this->request->data['VideoGame']['main_image_url'] = $this->request->data['VideoGame']['main_image_url']['name'];
	    			
				}
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
			//  this will return every type of associated model with it
			//  in order to return specific associated models, will need to use find with
			//  the contain parameter to specify the models
			$item_exists = $this->VideoGame->findById($id);
			
			if(isset($item_exists['VideoGame']))
			{
				//  increases counter every time item gets accessed.
				//  might break if being accessed at same time
				$view_count = (int)$item_exists['VideoGame']['views'];
				$view_count++;
				
				$this->set('video_game', $item_exists);
				$this->VideoGame->id = $id;
				$this->VideoGame->saveField('views',$view_count);
				

				
			}
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
			print_r($this->request->data);
			$this->request->data['VideoGame']['description'] = nl2br($this->request->data['VideoGame']['description']);
			if (is_uploaded_file($this->request->data['VideoGame']['main_image_url']['tmp_name'])) {
					//$this->Session->setFlash('a file was chosen');
					move_uploaded_file(
	        			$this->request->data['VideoGame']['main_image_url']['tmp_name'],
	        			WWW_ROOT . '/img/'. $this->request->data['VideoGame']['main_image_url']['name']
	    			);
	    			$this->request->data['VideoGame']['main_image_url'] = $this->request->data['VideoGame']['main_image_url']['name'];
	    			
				}
				else {
					unset($this->request->data['VideoGame']['main_image_url']);
				}
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