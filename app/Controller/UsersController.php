<?php
class UsersController extends AppController {
	public $helpers = array("Html", "Form");
	public $components = array('Session');
	public $uses = array('User');
	
	//  this works fine
	public function register() {
		if ($this->request->is('post')) {
			$this->User->set($this->request->data);
			if ($this->User->validates()) {
			//if ($this->User->validates($this->data)) {
				if($this->User->save($this->request->data)) {
						$this->Session->setFlash(__('You have registered with game addict'));
						
						//return $this->redirect(array('action'=>'register'));
			
				}
			}
			else {
				$errors = $this->User->validationErrors;
			}
		}
	}
	
	//  this will display the information of the user, and allow to view their orders
	public function account() {
		$user = null;
		//  if session is set, get user info, otherwise redirect
		if($this->Session->check('User.username')) {
			$user = $this->User->find('first', array('conditions'=>array('User.username'=>$this->Session->read('User.username'))));
			if(count($user) <= 0) {
			   $this->Session->setFlash(__('no account exists for this username'));
				return $this->redirect($this->referer(array('action'=>'index'), true));
			}
			//  if account is good, then we should get to where
			$this->set('user_info', $user);
		}
		else {
			$this->Session->setFlash(__('you must be logged in to access this page'));
			return $this->redirect($this->referer(array('action'=>'index'), true));
		}
	}
	//  need to write this
	public function login() {
		if ($this->request->is('post')) {
			$temp_user = $this->User->find('first', array('conditions'=>array('User.email'=>$this->request->data['User']['email'], 'User.password' => $this->request->data['User']['password'])));
			if (sizeof($temp_user) > 0) {
				$this->Session->setFlash(__('you have logged in'));
				$this->Session->write('User.username', $temp_user['User']['username']);
				return $this->redirect(array('controller'=>'video_games', 'action' => 'index'));
			}
			$this->Session->setFlash(__('Invalid username or password, try again'));
		}
	}
	
	public function logout() {
		$this->Session->delete('User.username');
		return $this->redirect(array('controller'=>'store', 'action'=>'index'));
	}

}

?>