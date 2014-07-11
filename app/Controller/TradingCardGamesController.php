<?php
class TradingCardGamesController extends AppController {
	public $helpers = array("Html", "Form");
	public $components = array('Session');
	public $uses = array("TcgBrand", "TradingCardGame");

	public function index() {
		$this->set("brands", $this->TcgBrand->find('all'));
		$this->set('title_for_layout', 'TCG');
		if (isset($_GET['Category']))
		{
			$this->set('tcg_list', $this->TradingCardGame->find('all', array('conditions' =>array('TradingCardGame.tcg_brand_id'=>$_GET['Category']))));
			
		}
		else {
			$this->set('tcg_list', $this->TradingCardGame->find('all'));
		}
		
	}

	public function view($id = null) {
		if ($id != null) {
			$item_exists = $this->TradingCardGame->findById($id);
			
			if(isset($item_exists['TradingCardGame']))
			{
				$view_count = (int)$item_exists['TradingCardGame']['views'];
				$view_count++;
				//print_r($item_exists['VideoGame']);
				$this->set('item', $item_exists);
				$this->TradingCardGame->id = $id;
				$this->TradingCardGame->saveField('views',$view_count);
			}
			//$this->set('video_game', $this->VideoGame->findById($id));
			
		}
	}
	
	public function add() {
		$this->check_user();
		//  set title for this page
		$this->set('title_for_layout', 'Add New Trading Card(s)');
		//  if request is a POST method
		if ($this->request->is('post')) {
			$this->TradingCardGame->create();
			if($this->TradingCardGame->validates($this->data)) {
				$this->request->data['TradingCardGame']['description'] = nl2br($this->request->data['TradingCardGame']['description']);
				//  tips for improving uploading files
				//  if file already exists then we can append the id of this item
				if (is_uploaded_file($this->request->data['TradingCardGame']['main_image_url']['tmp_name'])) {
					//$this->Session->setFlash('a file was chosen');
					move_uploaded_file(
	        			$this->request->data['TradingCardGame']['main_image_url']['tmp_name'],
	        			WWW_ROOT . '/img/tcg/'. $this->request->data['TradingCardGame']['main_image_url']['name']
	    			);
	    			$this->request->data['TradingCardGame']['main_image_url'] = 'tcg/'.$this->request->data['TradingCardGame']['main_image_url']['name'];
	    			
				}
				//else {$this->Session->setFlash('no file chosen');}

				if ($this->TradingCardGame->save($this->request->data)) {
					$this->Session->setFlash(__('A new trading card game was added'));
					return $this->redirect(array('action'=>'index'));
				}
				$this->Session->setFlash(__('Unable to add item'));
			}
		
		}	
		$this->set('tcg_brands', $this->TcgBrand->find('all'));
	}

	public function edit($id=null) {
		$this->check_user();
		$this->set('tcg_brands', $this->TcgBrand->find('all'));
		if (!$id) {
			throw new NotFoundException(__('invalid id'));
		}
		$card = $this->TradingCardGame->findById($id);
		if(!$card) {
			throw new NotFoundException(('Invalid item'));
		}
		//  for updating a row
		if ($this->request->is(array('post', 'put'))) {
			$this->TradingCardGame->id = $id;
			print_r($this->request->data);
			$this->request->data['TradingCardGame']['description'] = nl2br($this->request->data['TradingCardGame']['description']);
			//  a new file is chosen so upload it to the website, else keep name of old image file
			if (is_uploaded_file($this->request->data['TradingCardGame']['main_image_url']['tmp_name'])) {
					//$this->Session->setFlash('a file was chosen');
					move_uploaded_file(
	        			$this->request->data['TradingCardGame']['main_image_url']['tmp_name'],
	        			WWW_ROOT . '/img/tcg/'. $this->request->data['TradingCardGame']['main_image_url']['name']
	    			);
	    			$this->request->data['TradingCardGame']['main_image_url'] = 'tcg/'.$this->request->data['TradingCardGame']['main_image_url']['name'];
	    			
				}
				else {
					unset($this->request->data['TradingCardGame']['main_image_url']);
				}
			
			if ($this->TradingCardGame->save($this->request->data)) {
				$this->Session->setFlash(__("card information updated."));
					return $this->redirect(array("action"=>"index"));
			}
			
			$this->Session->setFlash(__('unable to update card information.'));
			$this->request->data = null;
		}
		//  if no data was posted, then we are going to edit an item
		if (!$this->request->data) {
			$this->set('title_for_layout', 'Edit Card(s)');
			$this->request->data = $card;
			//$this->set('video_game', $video_game);
			

		}
		
	}
	
}
?>