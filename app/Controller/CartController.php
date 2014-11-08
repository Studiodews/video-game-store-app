<?php
/*
what the cart needs to do:
add items to cart
empty the cart
update qunatities
*/
class CartController extends AppController {
	public $components = array('Session', 'AuthorizeNetAIM');
	public $uses = array('VgOrderItem', 'VideoGame', 'TradingCardGame', 'Console', 'Product');
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
		//print_r(count($this->Session->read('Cart')));
		//print_r($this->Session->read('Cart'));
		$this->set('show_checkout', false);
		if(count($this->Session->read('Cart')) >= 1) {
			$this->set('show_checkout', true);
		}
		$this->set('cart_items', $this->Session->read('Cart'));
	}

	public function paypal_redirect() {
		//$this->set('cart_items', $this->Session->read('Cart'));
		$final_items = [];
		$cart_items = $this->Session->read('Cart');
		foreach($cart_items as $category => $items) {
			foreach($items as $id=>$item) {
				$final_items[$id.$category]['price'] = $item['price'];
				$final_items[$id.$category]['name'] = $item['name'];
			}

		}
	

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
                        $product = $this->Product->findById($item['id']);
                        print_r($product);
                        $cart_session_name = 'Cart.Products.'.$product['Product']['id'];
                        $this->Session->write($cart_session_name);
                        $this->Session->write($cart_session_name.'.quantity',$quantity);
			$this->Session->write($cart_session_name.'.name', $product['Product']['name']);
			$this->Session->write($cart_session_name.'.price', $product['Product']['price']);
			/*$cart_session_name = 'Cart.'.$item['item_type']. '.'.$item['id'];
			$this->Session->write($cart_session_name, $item['id']);
			$this->Session->write($cart_session_name.'.quantity',$quantity);
			$this->Session->write($cart_session_name.'.name', $item['name']);
			$this->Session->write($cart_session_name.'.price', $item['price']);
			//print_r($this->Session->read('Cart'));	
                        */
			$this->redirect(array('action' => 'index'));
		}
	}

	
	public function remove_item() {
		if($this->request->is('post')) {
			$data = $this->request->data;
			//print_r($this->Session->read('Cart'.$data['prodtype'].$data['id']));
			$this->Session->delete('Cart.' . $data['prodtype'].'.'.$data['id']);

			//  if no more items exist in this category, then delete the category from cart
			if(count($this->Session->read('Cart.'.$data['prodtype'])) == 0) {
				$this->Session->delete('Cart.'.$data['prodtype']);
			}
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


	public function authorizenet() {
		$billing = array("x_first_name"=>'paul', "x_last_name"=>'rodriguez', "x_address"=>'9617 refern ave',
			"x_city"=>'inglewood',"x_state"=>'california',"x_zip"=>'90301',"x_country"=>'united states',
            "email"=>'laxpaul17@gmail.com');
		$shipping = array("x_ship_to_first_name"=>'paul',"x_ship_to_last_name"=>'rodriguez',
			"x_ship_to_address"=>'9617 refern ave',
			"x_ship_to_city"=>'inglewood',"x_ship_to_state"=>'california',"x_ship_to_zip"=>'90301',
            "x_ship_to_country"=>'united states');
		$cardInfo = array("x_card_code"=>'123',"x_card_num"=>'4111111111111111',"x_exp_date"=>'12/18');
		$this->AuthorizeNetAIM->useSandbox(true);
		$this->AuthorizeNetAIM->set_credentials(API_LOGIN_ID, TRANSACTION_KEY);
		$this->AuthorizeNetAIM->set_fields($billing);
		$this->AuthorizeNetAIM->set_fields($shipping);
		$this->AuthorizeNetAIM->set_fields($cardInfo);
		$response = $this->AuthorizeNetAIM->authorizeAndCapture("15.00");
		print_r($response);
	}
}

?>