<?php

	$select_platform = null;
	foreach ($platforms as $platform) 
	{
		$select_platform[$platform['Platform']['id']] = $platform['Platform']['name'];
	}
	
	echo $this->Form->create('Console', array('type' => 'file', 'action'=>'add'));
	echo $this->Form->input('Product.name');
	echo $this->Form->input('Product.price');
	echo $this->Form->input('Product.main_image_url',array('type'=>'file'));
	echo $this->Form->textarea('Product.description', array('rows'=>'5', 'label'=>'description'));
	echo $this->Form->input('Console.platform_id', array('options' => $select_platform));
	echo $this->Form->end('add console');

?>