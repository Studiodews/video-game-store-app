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
		if($id != null)
		{
			$this->set('video_game', 'test');
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
				//  tips for improving uploading files
				//  if file already exists then we can append the id of this item
				if (is_uploaded_file($this->request->data['TradingCardGame']['main_image_url']['tmp_name'])) {
					move_uploaded_file(
	        			$this->request->data['TradingCardGame']['main_image_url']['tmp_name'],
	        			WWW_ROOT . '/img/tcg/'. $this->request->data['TradingCardGame']['main_image_url']['name']
	    			);
	    			$this->request->data['TradingCardGame']['main_image_url'] = 'tcg/'.$this->request->data['TradingCardGame']['main_image_url']['name'];
				}
				if ($this->TradingCardGame->save($this->request->data)) {
					$this->Session->setFlash(__('A new trading card game was added'));
					return $this->redirect(array('action'=>'index'));
				}
				$this->Session->setFlash(__('Unable to add video game'));
			}
		
		}	
		$this->set('tcg_brands', $this->TcgBrand->find('all'));
	}

	public function edit($id=null) {
		$this->check_user();
		$this->set('tcg_brands', $this->TcgBrand->find('all'));
	}
	
}
?>