<?php

class TcgOrderItem extends AppModel {
	/*
	vg_order_items database table:
	id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT
	quantity INT
	product_id INT UNSGINED REFERNCES video_games(id)
	order_id INT UNSIGNED REFERENCES orders(id) //TODO: need to add this

	*/
	//public $actsAs = array('Containable');
	public $belongsTo = array(
		/*'Order' => array(
			'className'=>'Order',
			'foreignKey' => 'order_id'
			),*/
		'TradingCardGame' =>array(
			//'className' => 'TradingCardGame',
			'foreignKey' => 'product_id'
			)

		);

}

?>