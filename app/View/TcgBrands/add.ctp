<?php
	echo $this->element('backend_menu');
?>
<section id="backend_content">
	<div>Add a New Trading Card Game Brand</div>
<?php
	echo $this->Form->create('TcgBrand', array('action'=>'add'));
	echo $this->Form->input('name');
	echo $this->Form->end('Add Brand');
?>
</section>
