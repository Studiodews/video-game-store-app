<?php
class TcgExpansionMembership extends AppModel {
	public $belongsTo = array(
		'TcgExpansion' => array(
			'className'=>'TcgExpansion',
			'foreignKey'=>'expansion_id',
			),
		'TradingCardGame'=>array(
			'className'=>'TradingCardGame',
			'foreignKey'=>'tcg_id',
			),
	);

	public $validate = array(
		'expansion_id' => array(
			'rule'=>'check_expansion_exists',
			'message'=>'invalid tcg expansion.'
		),
		'tcg_id' =>array(
			'rule'=>'check_valid_tcg_id',
			'message'=>'invalid id for a tcg item',
		)
	);

	public function check_expansion_exists($check) {
		$expansion_ids = $this->TcgExpansion->get_ids();
		if(!in_array($check['expansion_id'], $expansion_ids)) {
			return false;
		}
		return true;
	}

	public function check_valid_tcg_id($check) {
		$tcg_ids = $this->TradingCardGame->get_ids();
		if(!in_array($check['tcg_id'], $tcg_ids)) {
			return false;
		}
		//print_r('tcg_id validation');
		return true;
	}

	/*public function	beforeValidate() {
		//print_r($this->data);
		//$this->data['TcgExpansionMembership']['tcg_id'] = 3;
		return true;
	}*/
}

?>