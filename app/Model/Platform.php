<?php
class Platform extends AppModel {
	public $hasMany = array(
		'Console' => array('className' => 'Console', 'foreignKey' => 'platform_id'),
		'VideoGame' => array('className' => 'VideoGame', 'foreignKey' => 'platform_id')
	);
	
	public $validate = array(
	'name' => array('rule'=>'notEmpty')
	);
}

?>