<?php

class VgGenre extends AppModel {
	public $hasMany = array(
		'VgGenreMembership' => array(
			'className'=>'VgGenreMembership',
			'foreignKey'=>'genre_id',
			'dependent'=>true
		)
	);	

	public function get_all_genres($conditions=null) {
		$all_genres = $this->find('all', array('recursive'=>-1, 'conditions'=>$conditions));
		$genre_options = array();
		foreach ($all_genres as $genre) {
			foreach ($genre as $row) {
				$genre_options[$row['id']] = $row['name'];
			}
		}

		return $genre_options;
	}
}
?>