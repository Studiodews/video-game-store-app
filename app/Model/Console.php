<?php
class Console extends AppModel {
	public $belongsTo = array(
		'Platform' => array('className' => 'Platform', 'foreignKey' => 'platform_id'),
		'Product' => array('className'=>'Product', 'foreignKey' => 'product_id')
	);
	
	public $validate = array(
		
		'platform_id' => array(
			'rule' => 'numeric'
		),
		
	);
}


?>