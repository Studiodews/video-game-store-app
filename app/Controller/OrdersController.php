<?php
/*
need to insert a new order with all the items into the database
display all the orders for a certain user
*/
class OrdersController extends AppController{
	//  implement functionality
	//  will need to add order to table and all all order items to their respective tables.
	public $uses = array('VideoGame', 'TradingCardGame', 'Console', 'Order');
	public function orders($user_id=null) {

	}

	

	public function buy() {
		//$this->redirect(array('action'=>'success'));
		if($this->request->is('post')) {
			
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
			
			print_r($this->request->data);
			//print_r($cart_items);

			$this->Order->create();
			if ($this->Order->validates($this->request->data)) {
				if ($this->Order->saveAssociated($this->request->data)) {
					$this->Session->write('OrderSuccess', true);
					$this->redirect(array('action'=>'success'));
				}
			}
		}
	}

	public function success() {
		if(!$this->Session->read('OrderSuccess')) {
			$this->redirect(array('action'=>'buy'));
		}
			
	}

}
?>