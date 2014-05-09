<?php

	$select_platform = null;
	foreach ($platforms as $platform) 
	{
		$select_platform[$platform['Platform']['id']] = $platform['Platform']['name'];
	}
	
	echo $this->Form->create('Console');
	echo $this->Form->input('Console.name');
	echo $this->Form->input('Console.price');
	echo $this->Form->body('Console.description', array('rows'=>'3'));
	echo $this->Form->input('Console.platform_id', array('options' => $select_platform));
	echo $this->Form->end('add console');

?>