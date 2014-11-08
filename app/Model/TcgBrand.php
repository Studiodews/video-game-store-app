<?php

class TcgBrand extends AppModel
{
	// this class has many expansions
	public $hasMany = array(
		'TradingCardGame'=>array('className'=>'TradingCardGame', 'foreignKey'=>'tcg_brand_id'),
		'TcgExpansion'=>array('className'=>'TcgExpansion', 'foreignKey'=>'tcg_brand_id'),
		);

	public $validate = array(
		'name'=>array(
			'rule'=> 'notEmpty',
			'message'=>'need a new name for a tcg game brand',
			),
		);	

	public function get_all_brands() {
		$all_brands = $this->find('all', array('recursive'=>-1));
		$brand_list = array();
		foreach ($all_brands as $brand) {
			foreach ($brand as $row) {
				$brand_list[$row['id']] = $row['name'];
			}
		}

		return $brand_list;
	}

	public function get_ids() {
		$all_brands = $this->find('all', array('recursive'=>-1));
		$brand_ids = array();
		foreach ($all_brands as $brand) {
			foreach ($brand as $row) {
				$brand_ids[] = $row['id'];
			}
		}

		return $brand_ids;	
	}
}
?>