<?php
/*
what the cart needs to do:
add items to cart
empty the cart
update qunatities
*/
class CartController extends AppController {
	public $components = array('Session');
	public $uses = array('VgOrderItem', 'VideoGame', 'TradingCardGame', 'Console');
	public function no_items() {
		// dont need this anymore
	}

	public function index() {
		//$vg = 'VideoGame';
		//eval('$test = $this->'.$vg.';');
		//print_r($test->find('first'));
		//print_r($this->Session->read());
		//print_r($this->Session->read('Cart.VideoGame.2')); 
		
		if (!$this->Session->check('Cart')) {
			$this->Session->write('Cart', array());
			//$this->redirect(array('action'=>'no_items'));
		}
		
		$this->set('cart_items', $this->Session->read('Cart'));
	}

	public function add() {
		//$this->Session->destroy();
		if($this->request->is('post')) {
			// in here we need to check that the item is valid and exists in the database,
			// the quantity is a numeric integer
			// if the item is already in our cart then we can increase the quantity
			//print_r($this->request->data);
			$item = $this->request->data;
			//this works
			$quantity = isset($item['quantity']) && is_numeric($item['quantity']) ? 
			(int)$item['quantity'] : 1;

			$cart_session_name = 'Cart.'.$item['item_type']. '.'.$item['id'];
			$this->Session->write($cart_session_name, $item['id']);
			$this->Session->write($cart_session_name.'.quantity',$quantity);
			$this->Session->write($cart_session_name.'.name', $item['name']);
			$this->Session->write($cart_session_name.'.price', $item['price']);
			print_r($this->Session->read('Cart'));	

			$this->redirect(array('action' => 'index'));
		}
	}

	
	public function remove_item() {
		if($this->request->is('post')) {
			$data = $this->request->data;
			//print_r($this->Session->read('Cart'.$data['prodtype'].$data['id']));
			$this->Session->delete('Cart.' . $data['prodtype'].'.'.$data['id']);
			//$this->Session->setFlash(__($data['prodtype'].', '.$data['id'].' '.$this->Session->read('Cart'.$data['prodtype'].$data['id'])));
		}
		$this->redirect(array('action'=>'index'));
	}

	//  destroy the session
	public function destroy() {
		//$this->Session->delete('Cart.VideoGame');
		$this->Session->destroy('Cart');
		$this->redirect(array('action'=>'index'));
	}
}

?>