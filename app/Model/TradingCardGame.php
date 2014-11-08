<?php
class TradingCardGame extends AppModel {
	public $hasMany = array(
		'TcgReviews' => array('className'=>'TcgReview', 'foreignKey'=>'tcg_id', 'dependent'=>true)
	);
	public $hasOne = array(
		'TcgExpansionMembership' => array(
				'className'=>'TcgExpansionMembership', 
				'foreignKey'=>'tcg_id',
				'dependent'=>true,
			),
	);
	public $belongsTo = array(
		'TcgBrand' => array('className' => 'TcgBrand', 'foreignKey' => 'tcg_brand_id'),
		'Product' => array('className'=>'Product', 'foreignKey' => 'product_id')
	);

	public $validate = array(
		'tcg_brand_id' => array(
			//'required'=>array(
				//'on'=>'create',
				'rule' =>'validate_tcg_brand',
				'message'=>'invalid tcg brand',
			//),
		),
	);

	public function validate_tcg_brand($check) {
		$brand_ids = $this->TcgBrand->get_ids();

		if(!in_array($check['tcg_brand_id'], $brand_ids)) {
			return false;
		}
		return true;
	}

	public function get_ids() {
	
		$all_tcgs = $this->find('all', array('recursive'=>-1));
		$tcg_ids = array();
		foreach($all_tcgs as $tcg) {
			foreach($tcg as $row) {
				$tcg_ids[] = $row['id'];
			}
		}

		return $tcg_ids;
	}
	
}

?>