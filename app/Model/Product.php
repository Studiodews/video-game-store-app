<?php
class Product extends AppModel {
		public $hasOne = array(
			'VideoGame'=>array('className'=>'VideoGame', 'foreignKey'=>'product_id', 'dependent'=>true),
			'TradingCardGame'=>array('className'=>'TradingCardGame', 'foreignKey'=>'product_id','dependent'=>true),
			'Console'=>array('className'=>'Console', 'foreignKey'=>'product_id','dependent'=>true)
		);

		public $validate = array(
		'name' => array(
			'rule' => 'notEmpty',
			'message' => 'must have a title'
		),
		'description' => array(
			'rule' => 'notEmpty',
			'message' => 'give the item a description'
		),
		'price' =>array(
			'rule' => array('money', 'left', 'decimal', 2),
			'message' => 'price is not in the correct format (xx.xx)'
		),
		
		'main_image_url' => array(
			'required'=>array(
				'on'=>'create',
				'rule' => 'notEmpty'
			)
		),
	);
	
	/*public function beforeSave($options=array()) {
		if (is_uploaded_file($this->data['Product']['main_image_url']['tmp_name'])) {
					//$this->Session->setFlash('a file was chosen');
					move_uploaded_file(
	        			$this->data['Product']['main_image_url']['tmp_name'],
	        			WWW_ROOT . '/img/tcg/'. $this->data['Product']['main_image_url']['name']
	    			);
	    			$this->data['Product']['main_image_url'] = 'tcg/'.$this->data['Product']['main_image_url']['name'];
	    			
				}
		return true;
	}*/

}

?>