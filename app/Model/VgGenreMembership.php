<?php
class VgGenreMembership extends AppModel {
	// intermediate model for a many to many association between video games and genres
	public $belongsTo = array(
		'VideoGame'=>array(
			'className'=>'VideoGame',
			'foreignKey'=>'video_game_id'
		),
		'VgGenre'=>array(
			'className'=>'VgGenre',
			'foreignKey'=>'genre_id',
			'dependent'=>true
		)
	);

}

?>