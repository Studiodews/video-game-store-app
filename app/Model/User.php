<?php
class User extends AppModel {
	public $validate = array(
		'username' =>array(
			'exists_rule' => array(
			'rule' =>'notEmpty',
			'required'=>true,
			'message' => 'you must choose a user name'
			),
			
			'unique_rule' => array(
				'rule' => 'isUnique',
				'message' => 'this username is already taken'
			),
			
			'length_rule' => array(
				'rule' => array('maxLength', 20),
				'message' => 'username must be no more than 20 characters'
			)
		),
		
		'email' => array(
			'valid_email' => array(
				'rule'=>array('email', true),
				'message'=> 'please supply a valid email address'
			),
			'unique_email' =>array(
				'rule'=> 'isUnique',
				'message'=>'an account with this email already exists'
			)
		),
		
		'password' => array(
			'min_length_rule' => array(
				'rule' => array('minLength',  8),
				'message' => 'password length is between 8 to 20 characters'
			),
			'max_length_rule' =>array(
				'rule' => array('maxLength', 20),
				'message' => 'password length is between 8 to 20 characters'
			),
			'value_rule' => array(
				'rule' => 'notEmpty',
				'message' => 'password cannot be empty'
			)
			
		),
		
		'first' =>array(
			'rule'=>'notEmpty'
		),
		'last' =>array(
			'rule'=>'notEmpty'
		),
		
		'address' =>array(
			'rule'=>'notEmpty'
		)
		
	);
}

?>