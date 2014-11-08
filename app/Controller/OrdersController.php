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
	public $uses = array('VideoGame', 'TradingCardGame', 'Console', 
		'Order', 'VgOrderItem', 'TcgOrderItem', 'Product', 'Cart', 'AuthorizeNetAIM');
        public $components = array('AuthorizeNet');

	public function buy() {
		if($this->request->is('post')) {
			if(!$this->check_user(false)) {
				$this->Session->setFlash(__('first login to make a purchase'));
				return $this->redirect(array('controller'=>'users', 'action'=>'login', 
					'ftn'=>'redirect_to_buy', 'contr'=>'orders'));
			}
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

	public function redirect_to_buy() {

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
                            $session_cart = $this->Session->read('Cart.Products');
                            //print_r($session_cart);
                            
                            $this->request->data['Order']['total'] = $this->Cart->get_cart_total();
                            $this->Session->write('FinalOrder', $this->request->data);
                            $this->Session->write('FinalOrder.Order.user_id', $this->Session->read('User.id'));
                            print_r($this->Session->read('FinalOrder'));
                            $this->set('cart_items', $this->Session->read('Cart.Products'));
                           
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
                    $order = [];
                    $order['Order'] = $this->Session->read('FinalOrder.Order');
                    $this->Order->create();
                    //if($this->Order->validates($this->Session->read('FinalOrder'))) {
                    $order['Order']['total'] = $this->get_cart_total();
                    $order['Order']['Product'] = $this->build_order_items();
                    print_r($order);
                        //$this->Order->total=$this->Cart->get_cart_total();
                        /*if($this->Order->saveAssociated($this->Session->read('FinalOrder'))) {
                                $this->set('orderid', $this->Order->id);
                                //$this->set('final_order', $this->Session->read('FinalOrder'));
                                $this->Session->delete('Cart');
                                $this->Session->delete('FinalOrder');
                        }
                        else {
                                $this->Session->setFlash(__('order could not be saved'));
                                $this->redirect(array('action'=>'buy'));
                        }*/
                    //}			
		} else {
                    $this->redirect(array('action'=>'buy'));
		}
	}

	public function get_order() {
            if ($this->request->is('post')) {
                    /*print_r($this->VideoGame->find('first',
                            array(
                                    'contain' =>array('VgReviews'=>array('User')),
                                    'conditions'=>array('VideoGame.id'=>1)
                                    )

                            ));*/
                    /*print_r($this->VgOrderItem->find('first',
                            array(
                                    'contain' => array('VideoGame'=>array('Platform', 'VgReviews'=>array('User'=>array(
                                            'fields'=>array('username')
                                            )


                                            ))),
                                    'conditions'=> array(
                                            'VgOrderItem.id'=>2
                                            )
                                    )
                            ));*/
                    /*$this->TcgOrderItem->bindModel(
                            array(
                                    'belongsTo'=>array('TradingCardGame'=>array('foreignKey'=>'product_id'))
                                    )
                            );*/

                    /*print_r(
                            $this->Order->find('first', array(
                                    'contain'=>array(
                                            'VgItems'=>array('VideoGame'=>array(
                                            'fields'=>array('title')
                                            )), 
                                            'TcgItems'

                                    ),

                                    'conditions'=>array(
                                            'Order.id' =>4
                                            )
                                    ))
                            );*/
                    $order = $this->Order->find('first',
                            array(
                                    'contain'=>array(
                                        'OrderItem'
                                            /*'VgOrderItem'=>array('VideoGame'=>array('fields'=>array('title as name', 'VideoGame.price'))),
                                            'TcgOrderItem'=>array('TradingCardGame'=>array('fields'=>array('TradingCardGame.name', 'TradingCardGame..price')))*/

                                    ),
                                    'conditions' =>array(
                                            'Order.id'=> $this->request->data['Order']['id']
                                            )
                                    )
                            );

                    $this->set('products', $this->products);
                    if (isset($order['Order'])) {
                            $this->set('order', $order);
                    }	
            }
                
            
	}
        private function build_order_items() {
            $order_items = array();
           
            foreach($this->Session->read('Cart.Products') as $key=>$value) {
                $product = $this->Product->findById($key);
                $order_items[] = array('product_id'=>$key, 
                    'quantity'=>$value['quantity'], 
                    'cost'=>$product['Product']['price']);
            }
            return $order_items;
        }
        
        private function get_cart_total() {
            $total = 0;
           
            if($this->Session->check("Cart.Products")) {
                foreach($this->Session->read("Cart.Products") as $key=>$value) {
                    $product = $this->Product->findById($key);
                    $total += $value['quantity']*$product['Product']['price'];
                }
            }
            return $total;
        }
        
        function charge_card() { 
        // You would need to add in necessary information here from your data collector 
        $billinginfo = array("fname" => "First", 
                            "lname" => "Last", 
                            "address" => "123 Fake St. Suite 0", 
                            "city" => "City", 
                            "state" => "ST", 
                            "zip" => "90210", 
                            "country" => "USA"); 
     
        $shippinginfo = array("fname" => "First", 
                            "lname" => "Last", 
                            "address" => "123 Fake St. Suite 0", 
                            "city" => "City", 
                            "state" => "ST", 
                            "zip" => "90210", 
                            "country" => "USA"); 
     
        $response = $this->AuthorizeNet->chargeCard(API_LOGIN_ID, TRANSACTION_KEY, 
                '4111111111111111', '01', '2018', '123', true, 
                110, 5, 5, "Purchase of Goods", 
                $billinginfo, "email@email.com", "555-555-5555", $shippinginfo); 
        print_r($response);
    } 

    

        

}
?>