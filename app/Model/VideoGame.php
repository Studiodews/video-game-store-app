<?php
class VideoGame extends AppModel {
	public $belongsTo = array(
		'Platform' => array('className' => 'Platform', 'foreignKey' => 'platform_id')
	);
	
	public $validate = array(
		'title' => array(
			'rule' => 'notEmpty',
			'message' => 'must have a title'
		),
		'description' => array(
			'rule' => 'notEmpty',
			'message' => 'give the item a description'
		),
		'price' =>array(
			'rule' => array('money', 'left', 'decimal', 2),
			'message' => 'message is not in the correct format (xx.xx)'
		),
		
		'platform_id' => array(
			'rule' => array('notEmpty', true, 'numeric', true)
		),
		
		'main_image_url' => array(
			'rule' => 'notEmpty'
		)
	);
}

?>