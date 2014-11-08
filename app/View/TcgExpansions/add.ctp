<?php echo $this->element('backend_menu'); ?>

<section id="backend_content">
<?php
echo $this->Form->create('TcgExpansion');
echo $this->Form->input('name');
echo $this->Form->input(
		'tcg_brand_id',
		array('options' => $tcg_brands)
	);
echo $this->Form->end('Add Expansion');
?>
</section>

