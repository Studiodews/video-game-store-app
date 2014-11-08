<?php
class UsersController extends AppController {
	public $helpers = array("Html", "Form");
	public $components = array('Session', 'RequestHandler');
	public $uses = array('User');
	
	//  this works fine
	public function register() {
            if($this->check_user(false)) {
                echo "user exists";
                return $this->redirect(array('controller'=>'users','action'=>'account'));
            }
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
		// finish here on how to get redirect parameters
		//print_r($this->request);
		//print_r($this->request->params['named']['ftn']);
		$action = 'index';
		if (isset($this->request->params['named']['ftn'])) {
			$action = $this->request->params['named']['ftn'];
		}
		$controller = 'store';
		if (isset($this->request->params['named']['contr'])) {
			$controller = $this->request->params['named']['contr'];
		}
		//print_r($action);
		if ($this->check_user(false)) {
			return $this->redirect($this->referer());
		}
		if ($this->request->is('post')) {

			$temp_user = $this->User->find('first', array('conditions'=>array('User.email'=>$this->request->data['User']['email'], 'User.password' => $this->request->data['User']['password'])));
			if (sizeof($temp_user) > 0) {
				$this->Session->setFlash(__('you have logged in'));
				$this->Session->write('User.username', $temp_user['User']['username']);
				$this->Session->write('User.id', $temp_user['User']['id']);
				return $this->redirect(array('controller'=>$controller, 'action' => $action));
				//return $this->redirect(array('controller'=>'orders', 'action'=>'buy'));
			}
			$this->Session->setFlash(__('Invalid username or password, try again'));
		}
	}
	
        // TODO: make sure logged in user cannot send a request here again
        public function login_ajax() {
            Configure::write('debug', 0);
            $this->RequestHandler->setContent('json');
            $this->autoRender = false;
            //header("Content-Type: application/json");
            $data = array();
            $data['error_message'] = "";
            $data['status']= false;
           if($this->request->is("post")) {
                //print_r($this->request->data);
                $temp_user = $this->User->find('first', array('conditions'=>
                    array('User.email'=>$this->request->data['User']['email'], 
                     /*   'User.password' => $this->request->data['User']['password'])*/
                    )));
                if (sizeof($temp_user) > 0) {
                    if($temp_user['User']['password']==$this->request->data['User']['password']) {
                        $this->Session->write('User.username', $temp_user['User']['username']);
                        $this->Session->write('User.id', $temp_user['User']['id']);
                        $data['status'] = true;
                    } else {
                        $data['error_message'] = "password is incorrect";
                    }
                    //return $this->redirect(array('controller'=>'store', 'action' => 'index'));
                    //return $this->redirect(array('controller'=>'orders', 'action'=>'buy'));
                } else {
                    $data['error_message'] = "the email '{$this->request->data['User']['email']}' does not exist in our records.";
                    //$data['status'] = false;
                }
                //$data['success'] = true;
            }
            /*else {
                $data['status'] = false;
            }*/
            
            echo json_encode($data);
        }
        
	public function logout() {
		$this->Session->delete('User.username');
		return $this->redirect(array('controller'=>'store', 'action'=>'index'));
	}
        
     
        

}

?>