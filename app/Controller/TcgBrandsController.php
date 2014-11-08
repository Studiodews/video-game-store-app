<?php
class TcgBrandsController extends AppController {
	public function index()
	{
		$this->set("brands", $this->TcgBrand->find('all'));
	}

	public function add() {
		if($this->request->is('post')) {
			$this->TcgBrand->create();
			if($this->TcgBrand->save($this->request->data)) {
				$this->Session->setFlash(__('the following trading card game brand was added: '.$this->request->data['TcgBrand']['name']));
			} else {
				$this->Session->setflash(__('could not add a new brand'));
			}
		}
	}

	public function edit($id = null) {
		$this->set('tcg_brands', $this->TcgBrand->find('all'));
		if (!$id) {
			throw new NotFoundException(__('invalid id'));
		}
		$brand = $this->TcgBrand->findById($id);
		//print_r($card);
		if(!$brand) {
			throw new NotFoundException(('Invalid item'));
		}
		//  for updating a row
		if ($this->request->is(array('post', 'put'))) {
			$this->TcgBrand->clear();
			$this->TcgBrand->id = $id;
			if($this->TcgBrand->save($this->request->data)) {
				$this->Session->setFlash(__('saved the following: name='.$this->request->data['TcgBrand']['name']. ' , id='.$this->TcgBrand->id));
			}
			else {
				$this->Session->setFlash(__('could not save the brand'));
			}
		}

		if(!$this->request->data) {
			$this->request->data = $brand;
		}
	}


	public function save_brand() {
		Configure::write('debug', 0);
        $this->RequestHandler->setContent('json');

	    $this->autoRender = false;

	    $data = [];
        $data['status'] = false;
        $data['new_brand']  = false;
        //print_r($_POST);
        if($this->request->is('post','ajax')) {
        	$id = $this->request->data['TcgBrand']['id'];
        }
        echo json_encode($data);
	}
}

?>