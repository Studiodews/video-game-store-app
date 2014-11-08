<?php
//TODO: add a create date for each comment int the database
class TcgReview extends AppModel {
	//public $actsAs = array('Containable');
	public $belongsTo = array(
		'TradingCardGame' => array('className' => 'TradingCardGame', 'foreignKey' => 'tcg_id')
	);

}

?>