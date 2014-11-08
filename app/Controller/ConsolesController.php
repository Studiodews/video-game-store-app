<?php
class ConsolesController extends AppController {
	public $helpers = array("Html", "Form");
	public $components = array('Session');
	public $uses = array('Platform', 'Console', 'User', 'Product');
	
	public function index() {
		$this->set('title_for_layout', 'List of Consoles');
		if(isset($_GET['Category'])) {
			$this->set('consoles', $this->Console->find('all', array('conditions' =>array('Console.platform_id'=>$_GET['Category']))));
		}
		else {
			$this->set('consoles', $this->Console->find('all', array('contain'=>array('Product'))));
		}
		$this->set('platforms', $this->Platform->find('all'));
		
	}
	
	public function add() {
		/*if(!$this->check_user()) {
			$this->Session->setFlash(__('only administrators can add/edit/delete items'));
			return $this->redirect($this->referer(array('action'=>'index'), true));
		}*/

		if($this->request->is('post'))
		{
			$this->Product->create();
			if($this->Product->validates($this->request->data)) {
				$this->request->data['Product']['description'] = nl2br($this->request->data['Product']['description']);
				if (is_uploaded_file($this->request->data['Product']['main_image_url']['tmp_name'])) {
					//$this->Session->setFlash('a file was chosen');
					move_uploaded_file(
	        			$this->request->data['Product']['main_image_url']['tmp_name'],
	        			WWW_ROOT . '/img/consoles/'. $this->request->data['Product']['main_image_url']['name']
	    			);
	    			$this->request->data['Product']['main_image_url'] = 'consoles/'.$this->request->data['Product']['main_image_url']['name'];
	    			
				}
				//print_r($this->request->data);
				if($this->Product->saveAssociated($this->request->data)) {
					$this->Session->setFlash(__('Your console has been saved'));
					//return $this->redirect(array('action'=>'index'));
				}
			}
				//$this->Session->setFlash(__('Unable to add your console'));
		}
		$this->set('platforms', $this->Platform->find('all'));
	}

	public function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('this item does not exist'));
			$this->redirect(array('action'=>'index'));
		}
		else {
			$item = $this->Console->findById($id);
			$this->set('item', $item);
		}

	}




	public function edit($id=null) {
		if(!$this->check_user()) {
			$this->Session->setFlash(__('only administrators can add/edit/delete items'));
			return $this->redirect($this->referer(array('action'=>'index'), true));
		}
		
		$this->set('platorms', $this->Platform->find('all'));
		if (!$id) {
			throw new NotFoundException(__('invalid id'));
		}
		$console = $this->Console->findById($id);
		if(!$console) {
			throw new NotFoundException(('Invalid item'));
		}
		//  for updating a row
		if ($this->request->is(array('post', 'put'))) {
			$this->Console->id = $id;
			print_r($this->request->data);
			$this->request->data['Console']['description'] = nl2br($this->request->data['Console']['description']);
			//  a new file is chosen so upload it to the website, else keep name of old image file
			if (is_uploaded_file($this->request->data['Console']['main_image_url']['tmp_name'])) {
					//$this->Session->setFlash('a file was chosen');
					move_uploaded_file(
	        			$this->request->data['Console']['main_image_url']['tmp_name'],
	        			WWW_ROOT . '/img/consoles/'. $this->request->data['Console']['main_image_url']['name']
	    			);
	    			$this->request->data['Console']['main_image_url'] = 'consoles/'.$this->request->data['Console']['main_image_url']['name'];
	    			
				}
				else {
					unset($this->request->data['Console']['main_image_url']);
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
			$this->set('title_for_layout', 'Edit Console(s)');
			$this->request->data = $console;
			//$this->set('video_game', $video_game);
		}
		
	}
}
?>