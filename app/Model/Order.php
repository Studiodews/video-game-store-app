<?php
class Order extends AppModel {
	/*
	TODO
	orders database table:
	id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	user_id INT UNSIGNED
	address varchar(100)
	city varchar(15)
	state varchar(15)
	country varchar(15)
	credit_card INT
	credit_card_code INT
	total DECIMAL(8,2)
	created DATETIME
	*/

	//public $actsAs = array('Containable');
	public $hasMany = array(
		
            'OrderItem'=>array(
                'className'=>'OrderItem',
                'foreignKey'=>'order_id'
            ),

	);

	public $validate = array(
		'address' => array(
			'rule' => '/^[0-9]+.*[a-zA-Z]+.*$/'
			),
		'city' => array(
			'rule' =>'notEmpty'
			),
		'state' => array(
			'rule' => 'notEmpty'
			),
		'country' => array(
			'rule' => 'notEmpty'
			),
		'credit_card' =>array(
			'rule' => 'numeric'
			),
		'credit_card_code' => array(
			'rule' => 'numeric'
			),
		'total' => array(
			'rule' => array('money', 'left', 'decimal', 2)
			)
		);
	//public $belongsTo = array('User');
}
?>