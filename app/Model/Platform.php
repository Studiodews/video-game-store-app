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


	public function get_all_platforms() {
		$all_platforms = $this->find('all', array('recursive'=>-1));
		$platform_options = array();
		foreach($all_platforms as $platform) {
			foreach ($platform as $row) {
				$platform_options[$row['id']] = $row['name'];
			}
		}

		return $platform_options;
	}
}

?>