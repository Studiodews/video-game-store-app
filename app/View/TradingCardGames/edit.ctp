<?php echo $this->element('backend_menu');?>
<section id="backend_content">
<?php
	//echo $this->Html->link('back to details', array('action'=>'details'));
	$remove_break_lines = preg_replace('#<br\s*/?>#i', "", $this->request->data['Product']['description']);
	echo $this->Form->create('TradingCardGame', array('type'=>'file'));
	echo $this->Form->input('Product.name');
	echo $this->Form->input('Product.price');
	echo $this->Form->input('Product.main_image_url', array('type'=>'file'));
	echo $this->Form->input('Product.description', array('rows'=>'5', 'label' =>'description', 'value'=>$remove_break_lines));
	/*$tcg_brand = null;
	foreach ($tcg_brands as $brand)
	{
		$tcg_brand[$brand['TcgBrand']['id']] = $brand['TcgBrand']['name'];
	}*/


	echo $this->Form->input(
		'TradingCardGame.tcg_brand_id',
		array('options' => $tcg_brands)
	);
	
	echo $this->form->end('Save Item');

?>
</section>