<?php
class Console extends AppModel {
	public $BelongsTo = array(
		'Platform' => array('className' => 'Platform', 'foreignKey' => 'platform_id')
	);
	
	public $validate = array(
		'name' => array(
				'rule' => 'notEmpty',
				'message' => 'please include a name for the product'
		),
		'price' => array(
				'rule' => array('money', 'left'),
				'message' => 'must be a valid price number'
		),
		'description' => array(
			'rule' => 'notEmpty',
			'message' => 'enter a description of the product'
		),
		'platform_id' => array (
			'rule' => 'numeric'
		),
		'main_image_url' => array(
			'rule' => 'notEmpty'
		)
		
	);
}


?>