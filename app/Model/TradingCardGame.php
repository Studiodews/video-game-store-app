<?php
class TradingCardGame extends AppModel {
	public $hasMany = array(
		'Reviews' => array('className'=>'TcgReview', 'foreignKey'=>'tcg_id')
		);
	
	public $belongsTo = array(
		'TcgBrand' => array('className' => 'TcgBrand', 'foreignKey' => 'tcg_brand_id')
	);

	public $validate = array(
		'name' => array(
			'rule' => 'notEmpty',
			'message' => 'this product needs a name'
		),
		'price' => array(
			'rule' => array('money', 'left'),
			'message' => 'must be a valid price number'
		),
		'description' => array(
			'rule' => 'notEmpty',
			'message' => 'enter a description of the product'
		),
		'tcg_brand_id' => array(
			'rule' => 'numeric'
		),
		'main_image_url' => array(
			'required' => array(
				'on' => 'create',
				'rule' => 'notEmpty'
				)
		)
	);
}

?>