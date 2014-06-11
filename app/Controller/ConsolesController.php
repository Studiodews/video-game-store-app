<?php
class ConsolesController extends AppController {
	public $helpers = array("Html", "Form");
	public $components = array('Session');
	public $uses = array('Platform', 'Console', 'User');
	
	public function index() {
		$this->set('title_for_layout', 'List of Consoles');
		if(isset($_GET['Category'])) {
			$this->set('consoles', $this->Console->find('all', array('conditions' =>array('Console.platform_id'=>$_GET['Category']))));
		}
		else {
			$this->set('consoles', $this->Console->find('all'));
		}
		$this->set('platforms', $this->Platform->find('all'));
		
	}
	
	public function add() {
		$this->check_user();
		if($this->request->is('post'))
		{
			$this->Console->create();
			if($this->Console->validates($this->data)) {
				$this->request->data['console']['description'] = nl2br($this->request->data['Console']['description']);
				if($this->Console->save($this->request->data)) {
					$this->Session->setFlash(__('Your console has been saved'));
					return $this->redirect(array('action'=>'index'));
				}
			}
				$this->Session->setFlash(__('Unable to add your console'));
		}
		$this->set('platforms', $this->Platform->find('all'));
	}
}
?>