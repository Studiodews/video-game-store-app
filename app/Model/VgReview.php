<?php

class VgReview extends AppModel {
	
	// remove if need to return the reviews with the video game info
	/*public $belongsTo = array(
		'VideoGame' => array('className' => 'VideoGame', 'foreignKey' => 'video_game_id')
	);*/

	public $validate = array(
		'comment' => array(
			'exists_rule'=>array(
				'rule' => 'notEmpty',
				'message' => 'you must enter a comment'
			),

			'length_rule' => array(
				'rule' => array('maxLength', 200),
				'message' => 'comment must be less than 200 characters'
			)
		)
	);

}

?>