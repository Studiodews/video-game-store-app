<?php
class TcgExpansion extends AppModel {
	//TODO: a tcg expansion belongs to a tcg brand
	//public $actsAs = array('Tree');

	public $hasMany = array(
		'TcgExpansionMembership'=>array(
			'className'=>'TcgExpansionMembership',
			'foreignKey'=>'expansion_id',
		),
		);

	public $belongsTo = array(
		'TcgBrand' => array(
			'className' => 'TcgBrand',
			'foreignKey'=>'tcg_brand_id',
		),
	);

	public $validate = array(
		'tcg_brand_id' => array(
			'required'=>array(
				'on'=>'create',
				'rule' =>'validate_tcg_brand',
				'message'=>'invalid tcg brand',
			),
			
		),
		'name' =>array(
			'rule'=>'notEmpty',
			'message'=>'need a name for a new expansion',
		),
	);

	public function validate_tcg_brand($check) {
		$brand_ids = $this->TcgBrand->get_ids();

		if(!in_array($check['tcg_brand_id'], $brand_ids)) {
			return false;
		}
		return true;
	}
	/*
	get all the expansions and return an array of key-value pairs
	where id is the primary key of expansion in database and the value is the name of the expansion
	*/
	public function get_all_expansions() {
		$all_expansions = $this->find('all', array('recursive'=>-1));
		$expansion_list = array();
		foreach ($all_expansions as $expansion) {
			foreach ($expansion as $row) {
				$expansion_list[$row['id']] = $row['name'];
			}
		}

		return $expansion_list;
	}

	/*
	get primary key ids of all expansions for used in validation
	*/
	public function get_ids() {
		$all_expansions = $this->find('all', array('recursive'=>-1));
		$expansion_ids = array();
		foreach($all_expansions as $expansion) {
			foreach($expansion as $row) {
				$expansion_ids[] = $row['id'];
			}
		}

		return $expansion_ids;
	}
}
?>