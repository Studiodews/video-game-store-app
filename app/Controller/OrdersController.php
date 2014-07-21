<?php
/*

can only access the checkout page through the checkout link in the carts controller.
implement functionality to make sure you can only checkout if you are logged in.

might change confirm() to not create order yet until user confirms, and then redirect to function that actually 
inserts order to database.
*/
class OrdersController extends AppController{
	//  implement functionality
	//  will need to add order to table and all all order items to their respective tables.
	public $uses = array('VideoGame', 'TradingCardGame', 'Console', 'Order');


	public function buy() {
		if($this->request->is('post')) {
			if($this->Session->check('Cart')) {
				$this->set('cart_items', $this->Session->read('Cart'));
			}
			else {
				$this->redirect(array('controller'=>'cart'));
			}
		}
		else {
			
			$this->redirect(array('controller'=>'cart'));
		}
	}

	


		//  need to show user information 
	public function confirm() {
		//  needs to get here from post request, with items in cart, and order data filled out
		if($this->request->is('post')) {
			if(count($this->Session->read('Cart')) >= 1) {
				if(isset($this->request->data['Order'])) {
					//  make sure to get all the info from database to make sure prices are correct
					//  want to create arrays of items to insert all of them at once in the database
					$cart_items = array();
					$total = 0.0;
					$session_cart = $this->Session->read('Cart');
					foreach($session_cart as $category=>$items) {
						$cart_items[$this->products[$category]] = array();

						foreach($items as $id=>$item) {
							//  this is to get the price from the database
							eval('$cat_item=$this->'.$category.'->find(\'first\', array(\'recursive\'=>-1, \'conditions\'=>array(\'id\'=>'.$id.')));');
					
							array_push($cart_items[$this->products[$category]], array('quantity'=>$item['quantity'], 'product_id'=>$id));

							$total += $cat_item[$category]['price']*$item['quantity'];
						}
						$this->request->data[$this->products[$category]]= $cart_items[$this->products[$category]];
					}
					$this->request->data['Order']['total'] = $total;
					$this->Session->write('FinalOrder', $this->request->data);
					$this->set('cart_items', $this->Session->read('Cart'));
					//print_r($this->request->data);
					//print_r($cart_items);
					//print_r($this->request->data);
					/*$this->Order->create();
					if ($this->Order->validates($this->request->data)) {
						if ($this->Order->saveAssociated($this->request->data)) {
							$this->Session->write('OrderSuccess', true);
							$this->redirect(array('action'=>'success'));
						}
						else {
							$this->redirect(array('action'=>'buy'));
						}
					}*/ 
				}
			}
		}
	}

	// should get here by post request only
	public function success() {
		if($this->request->is('post') && $this->Session->check('FinalOrder')) {
			$this->Order->create();
			if($this->Order->validates($this->Session->read('FinalOrder'))) {
				if($this->Order->saveAssociated($this->Session->read('FinalOrder'))) {
					$this->set('orderid', $this->Order->id);
					//$this->set('final_order', $this->Session->read('FinalOrder'));
					$this->Session->delete('Cart');
					$this->Session->delete('FinalOrder');
				}
				else {
					$this->Session->setFlash(__('order could not be saved'));
					$this->redirect(array('action'=>'buy'));
				}
			}			
		} else {
			$this->redirect(array('action'=>'buy'));
		}
	}

}
?>