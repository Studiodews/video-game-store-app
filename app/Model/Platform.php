<?php
class Platform extends AppModel {
	/*
	table model corresponds to
	platforms database table:
	id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT
	name varchar(40)
	*/

	/*public $hasMany = array(
		'Console' => array('className' => 'Console', 'foreignKey' => 'platform_id'),
		'VideoGame' => array('className' => 'VideoGame', 'foreignKey' => 'platform_id')
	);*/
	
	public $validate = array(
	'name' => array('rule'=>'notEmpty')
	);
}

?>