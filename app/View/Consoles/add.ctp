<?php

	$select_platform = null;
	foreach ($platforms as $platform) 
	{
		$select_platform[$platform['Platform']['id']] = $platform['Platform']['name'];
	}
	
	echo $this->Form->create('Console');
	echo $this->Form->input('Console.name');
	echo $this->Form->input('Console.price');
	echo $this->Form->input('Console.main_image_url');
	echo $this->Form->textarea('Console.description', array('rows'=>'5', 'label'=>'description'));
	echo $this->Form->input('Console.platform_id', array('options' => $select_platform));
	echo $this->Form->end('add console');

?>