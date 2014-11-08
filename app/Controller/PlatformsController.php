<?php
class PlatformsController extends AppController {

	public $helpers = array("Html", "Form");
	public $components = array('Session');
	
	public function index()
	 {
	 	
		$this->set('platforms', $this->Platform->find("all"));
	 }

	 public function add() {
	 	if($this->request->is('post')) {
	 		$this->Platform->create();
	 		if($this->Platform->save($this->request->data)) {
	 			$this->Session->setFlash(('platform added: id='.$this->Platform->id.', name='.$this->request->data['Platform']['name']));
	 		} else {
 				$this->Session->setFlash(('platform could not be added'));
	 		}
	 	}
	 }

	 public function edit($id=null) {
	 	if (!$id) {
			throw new NotFoundException(('invalid id'));
		}
		$platform = $this->Platform->findById($id);
		if(!$platform) {
			throw new NotFoundException(('invalid Item'));
		}
		if($this->request->is(array('post', 'put'))) {
			$this->Platform->clear();
			$this->Platform->id = $id;
			if($this->Platform->save($this->request->data)) {
				$this->Session->setFlash('Platform was Updated');
			} else {
				$this->Session->setFlash('Could not Update Platform');
			}
		}
		if(!$this->request->data) {
			$this->request->data = $platform;
		}
	 }
}

?>