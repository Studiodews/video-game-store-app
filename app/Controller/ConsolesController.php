<?php
class ConsolesController extends AppController {
	public $helpers = array("Html", "Form");
	public $components = array('Session');
	public $uses = array('Platform', 'Console');
	
	public function index() {
		$this->set('platforms', $this->Platform->find('all'));
		$this->set('consoles', $this->Console->find('all'));
	}
	
	public function add() {
		if($this->request->is('post'))
		{
			$this->Console->create();
				if($this->Console->save($this->request->data)) {
					$this->Session->setFlash(__('Your post has been saved'));
					return $this->redirect(array('action'=>'index'));
				}
				$this->Session->setFlash(__('Unable to add your post'));
		}
		$this->set('platforms', $this->Platform->find('all'));
	}
}
?>