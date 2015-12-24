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
		?>
<ul class='radio-list'>
<?php
$attributes = array(
	'class' => 'radio',
	'label' => false,
	'type' => 'radio',
	'default'=> 0,
	'legend' => false,
	'before' => '<li><label>',
	'after' => '</label></li>',
	'separator' => '</label></li><li><label>',
	'options' => $expansion_list
);

		echo $this->form->input('TradingCardGame.TcgExpansionMembership.expansion_id', 
			$attributes);
				?>
</ul>
<?php
	}
	echo $this->Form->input(
		'TradingCardGame.tcg_brand_id',
		array('options' => $tcg_brands)
	);

	/*$options = array(
           '1' => 'One',
           '2' => 'Two'
           );
$attributes = array(
            'class' => '',
            'label' => false,
            'type' => 'radio',
            'default'=> 0,
            'legend' => false,
            'before' => '<label>',
            'after' => '</label>',
            'separator' => '</label><label>',
            'options' => $options
            );

	echo $this->Form->input('myRadios', $attributes); */
	
	echo $this->form->end('ADD CARD(S)');
?>
</section>

<script type="text/javascript">
$(".radio").iCheck(
 {
 	 checkboxClass: 'icheckbox_futurico',
    radioClass: 'iradio_futurico',
    increaseArea: '20%' // optional
	});
</script>