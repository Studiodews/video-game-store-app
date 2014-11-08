<?php
class TradingCardGamesController extends AppController {
	public $helpers = array("Html", "Form");
	public $components = array('Session');
	public $uses = array("TcgBrand", "TradingCardGame",'TcgExpansion', 'Product');

	public function index() {
		$this->set("brands", $this->TcgBrand->get_all_brands());
		$this->set('title_for_layout', 'TCG');
		$this->set('expansion_list', $this->TcgExpansion->get_all_expansions());

		/*if (isset($_GET['Category']))
		{
			$this->set('tcg_list', $this->TradingCardGame->find('all', array('conditions' =>array('TradingCardGame.tcg_brand_id'=>$_GET['Category']))));
			
		}
		else {
			$this->set('tcg_list', $this->TradingCardGame->find('all'));
		}*/
		$this->set('tcg_list', $this->TradingCardGame->find('all'));
	}

	public function view($id = null) {
		if ($id != null) {
			$item_exists = $this->TradingCardGame->findById($id);
			
			if(isset($item_exists['TradingCardGame']))
			{
				/*$view_count = (int)$item_exists['TradingCardGame']['views'];
				$view_count++;*/
				//print_r($item_exists['VideoGame']);
				$this->set('item', $item_exists);
				/*$this->TradingCardGame->id = $id;
				$this->TradingCardGame->saveField('views',$view_count);*/
			}
			//$this->set('video_game', $this->VideoGame->findById($id));
			
		}
	}
	
	public function add() {
		/*if(!$this->check_user()) {
			$this->Session->setFlash(__('only administrators can add/edit/delete items'));
			return $this->redirect($this->referer(array('action'=>'index'), true));
		}*/
		//  set title for this page
		$this->set('title_for_layout', 'Add New Trading Card(s)');
		//  if request is a POST method
		if ($this->request->is('post')) {
			//$this->TradingCardGame->create();
			//$trading_card_game_data['TradingCardGame']['tcg_brand_id'] = $this->request->data['TradingCardGame']['tcg_brand_id'];
			$this->Product->create();
			$this->request->data['Product']['description'] = nl2br($this->request->data['Product']['description']);
			//  tips for improving uploading files
			//  if file already exists then we can append the id of this item
			if (is_uploaded_file($this->request->data['Product']['main_image_url']['tmp_name'])) {
				//$this->Session->setFlash('a file was chosen');
				move_uploaded_file(
        			$this->request->data['Product']['main_image_url']['tmp_name'],
        			WWW_ROOT . '/img/tcg/'. $this->request->data['Product']['main_image_url']['name']
    			);

    			$this->request->data['Product']['main_image_url'] = 'tcg/'.$this->request->data['Product']['main_image_url']['name'];	
			}
				print_r($this->request->data);
				if ($this->Product->saveAssociated($this->request->data, array('deep'=>true, 'validate'=>'first'))) {
					$this->Session->setFlash(__('A new trading card game was added'));
					//return $this->redirect(array('action'=>'index'));
				}
				else {
					$this->Session->setFlash(__('Unable to add item'));
				}
			
			//print_r($this->Product->invalidFields);
			//print_r($this->Product->validates($this->request->data['Product']));
		
		}	
		$this->set('tcg_brands', $this->TcgBrand->get_all_brands());
		$this->set('expansion_list', $this->TcgExpansion->get_all_expansions());
	}

	public function edit($id=null) {
		/*if(!$this->check_user()) {
			$this->Session->setFlash(__('only administrators can add/edit/delete items'));
			return $this->redirect($this->referer(array('action'=>'index'), true));
		}*/
		
		$this->set('tcg_brands', $this->TcgBrand->get_all_brands());
		if (!$id) {
			throw new NotFoundException(('invalid id'));
		}
		//$product = $this->Product->find('all', array('conditions'=>array('TradingCardGame.id'=>$id)));
		//print_r($product);
		$card = $this->TradingCardGame->findById($id);

		if(!$card) {
			throw new NotFoundException(('Invalid item'));
		}
		//  for updating a row
		if ($this->request->is(array('post', 'put'))) {
			$this->Product->clear();
			$this->request->data['Product']['id'] = $card["TradingCardGame"]['product_id'];
			$this->request->data['TradingCardGame']['id'] = $id;
			//$this->request->data['Product']['id']=$card['TradingCardGame']['product_id'];
			$this->request->data['Product']['description'] = nl2br($this->request->data['Product']['description']);
			//  a new file is chosen so upload it to the website, else keep name of old image file
			if (is_uploaded_file($this->request->data['Product']['main_image_url']['tmp_name'])) {
					//$this->Session->setFlash('a file was chosen');
					move_uploaded_file(
	        			$this->request->data['Product']['main_image_url']['tmp_name'],
	        			WWW_ROOT . '/img/tcg/'. $this->request->data['Product']['main_image_url']['name']
	    			);
	    			$this->request->data['Product']['main_image_url'] = 'tcg/'.$this->request->data['Product']['main_image_url']['name'];
	    			
				}
				else {
					unset($this->request->data['Product']['main_image_url']);
				}
			
			if ($this->Product->saveAssociated($this->request->data)) {
				$this->Session->setFlash(__("card information updated."));
					//return $this->redirect(array("action"=>"index"));
			}
			else {
				$this->Session->setFlash(__('unable to update card information.'));
			}
			//$this->request->data = null;
		}
		//  if no data was posted, then we are going to edit an item
		if (!$this->request->data) {
			$this->set('title_for_layout', 'Edit Card(s)');
			$this->request->data = $card;
			//$this->set('video_game', $video_game);		
		}
	}
	

	public function details($id=null) {
		if($id==null) {
			$this->redirect(array('controller'=>'backend', 'action'=>'tcg_index'));
		}
		$tcg = $this->TradingCardGame->find('first',
			array(
				'contain'=>array('Product', 'TcgBrand', 'TcgExpansionMembership'=>array('TcgExpansion')),
				'conditions'=>array('TradingCardGame.id'=>$id)
				)
			);
		$this->set('tcg', $tcg); 

	}
}
?>