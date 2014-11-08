<?php
class OrderItem extends AppModel {
	public $belongsTo = array(
		
            'Order'=>array(
                'className'=>'Order',
                'foreignKey'=>'order_id'
            ),

	);
}
?>