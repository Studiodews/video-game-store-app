<?php
class ConsoleOrderItem extends AppModel {
	/*
	console_order_items database table:
	id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT
	quantity INT
	product_id INT UNSGINED REFERNCES video_games(id)
	order_id INT UNSIGNED REFERENCES orders(id)

	*/

	//public $actsAs = array('Containable');
	public $belongsTo = array(
		/*'Order' => array(
			'className'=>'Order',
			'foreignKey' => 'order_id'
			),*/
		'Console' =>array(
			'className' => 'Console',
			'foreignKey' => 'product_id'
			)

		);

}
}

?>