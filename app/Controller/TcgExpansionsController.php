<?php
class TcgExpansionsController extends AppController {
	public $uses = array('TcgExpansionMembership', 'TcgExpansion', 'TcgBrand');
	public function index() {

		/*$test = array('TcgExpansionMembership'=>array());
		if($this->TcgExpansionMembership->save($test)) {
			print_r('validation pass');
		} else {
			print_r($this->TcgExpansion->validationErrors);
		}*/
	}

	public function add() {
		$this->set('tcg_brands', $this->TcgBrand->get_all_brands());
		if($this->request->is('post')) {
			$this->TcgExpansion->create();
			if($this->TcgExpansion->save($this->request->data)) {
				$this->Session->setFlash(__('following expansion was saved: name='.$this->request->data['TcgExpansion']['name'].', id='.$this->TcgExpansion->id));
			}
			else {
				$this->Session->setFlash(__('unable to add Expansion'));
			}
		}
	}

	public function edit($id=null) {
		$this->set('tcg_brands', $this->TcgBrand->get_all_brands());
		if(!$id) {
			$this->redirect(array('controller'=>'backend', 'action'=>'tcg_expansion_index'));
		}
		$expansion = $this->TcgExpansion->findById($id);
		if(!$expansion) {
			$this->redirect(array('controller'=>'backend', 'action'=>'tcg_expansion_index'));	
		}
		if($this->request->is(array('post', 'put'))) {
			$this->TcgExpansion->clear();
			$this->request->data['TcgExpansion']['id'] = $id;
			if($this->TcgExpansion->save($this->request->data)) {
				$this->Session->setFlash(__('expansion with id='.$this->TcgExpansion->id.' was updated.'));
			} else {
				$this->Session->setFlash(__('unable to save expansion'));
			}
		}
		if(!$this->request->data) {
			$this->request->data = $expansion;
		}
	}
}
?>