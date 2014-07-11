<?php

	$remove_break_lines = preg_replace('#<br\s*/?>#i', "", $this->request->data['TradingCardGame']['description']);
	echo $this->Form->create('TradingCardGame', array('type'=>'file'));
	echo $this->Form->input('TradingCardGame.name');
	echo $this->Form->input('TradingCardGame.price');
	echo $this->Form->input('TradingCardGame.main_image_url', array('type'=>'file'));
	echo $this->Form->input('TradingCardGame.description', array('rows'=>'5', 'label' =>'description', 'value'=>$remove_break_lines));
	$tcg_brand = null;
	foreach ($tcg_brands as $brand)
	{
		$tcg_brand[$brand['TcgBrand']['id']] = $brand['TcgBrand']['name'];
	}


	echo $this->Form->input(
		'TradingCardGame.tcg_brand_id',
		array('options' => $tcg_brand)
	);
	
	echo $this->form->end('Save Item');

?>