<?php echo $this->element('backend_menu');?>
<section id="backend_content">
	<h1>Add New Trading Card Game</h1>
<?php
	echo $this->Form->create('TradingCardGame', array('type' => 'file', 'action'=>'add'));
	echo $this->Form->input('Product.name');
	echo $this->Form->input('Product.price');
	echo $this->Form->input('Product.main_image_url', array('type'=>'file'));
	echo $this->Form->textarea('Product.description', array('rows'=>'5', 'label' =>'description'));


	/*$tcg_brand = array();
	foreach ($tcg_brands as $brand)
	{
		$tcg_brand[$brand['TcgBrand']['id']] = $brand['TcgBrand']['name'];
	}*/
	// if no expansion exists then do not display radio buttons otherwise it creates an entry with null values
	if(count($expansion_list)>=1) {
		echo $this->form->radio('TradingCardGame.TcgExpansionMembership.expansion_id', $expansion_list, array('legend'=>"Choose an expansion for this product"));
	}
	echo $this->Form->input(
		'TradingCardGame.tcg_brand_id',
		array('options' => $tcg_brands)
	);
	
	echo $this->form->end('ADD CARD(S)');
?>
</section>