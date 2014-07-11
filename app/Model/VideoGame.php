<?php
class VideoGame extends AppModel {
	/*
	table model corresponds
	video_games database table:
	id INT UNSIGNED PRIMARY KEY
	platform_id INT UNSIGNED REFERENCES platforms(id)
	title varchar(50)
	price decimal(8,2)
	user_rating INT
	description TEXT
	main_image_url VARCHAR(60)
	views INT
	created DATETIME
	modified DATETIME
	*/
	
	public $actsAs = array('Containable');
	public $hasMany = array(
		'Reviews' => array('className' => 'VgReview')
	);

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
			'required'=>array(
				'on'=>'create',
				'rule' => 'notEmpty'
			)
		)
	);
}

?>