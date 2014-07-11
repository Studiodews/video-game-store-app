<?php
/*
need to insert a new order with all the items into the database
display all the orders for a certain user
*/
class OrdersController extends AppController{
	//  implement functionality
	//  will need to add order to table and all all order items to their respective tables.
	public function orders($user_id=null) {

	}

	

	public function buy() {
		if($this->request->is('post')) {
			$this->request->data['Order']['total'] = $this->Session->get('Cart.total');
			$vgs = $this->Session->read('Cart.vg');
			foreach($vgs as $key => $value) {
				$this->VgOrderItem->create();
				$this->VgOrderItem->set(array(
					'quantity'=>$value['quantity'],
					'video_game_id' => $key
					));
				$this->VgOrderItem->save();
			}
		}
	}

	public function success() {

	}

}
?>