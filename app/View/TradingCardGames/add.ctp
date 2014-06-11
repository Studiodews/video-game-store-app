<?php
	echo $this->Form->create('TradingCardGame', array('type' => 'file'));
	echo $this->Form->input('TradingCardGame.name');
	echo $this->Form->input('TradingCardGame.price');
	echo $this->Form->input('TradingCardGame.main_image_url', array('type'=>'file'));
	echo $this->Form->input('TradingCardGame.description', array('rows' => 3));
	$tcg_brand = null;
	foreach ($tcg_brands as $brand)
	{
		$tcg_brand[$brand['TcgBrand']['id']] = $brand['TcgBrand']['name'];
	}


	echo $this->Form->input(
		'TradingCardGame.tcg_brand_id',
		array('options' => $tcg_brand)
	);
	
	echo $this->form->end('ADD CARD(S)');
?>