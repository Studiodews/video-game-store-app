<h1>Add new Video Game</h1>

<?php
echo $this->Form->create('VideoGame', array('action' => 'add'));
echo $this->Form->input('VideoGame.title');
echo $this->Form->input('VideoGame.price');
echo $this->Form->input('VideoGame.main_image_url', array('type'=>'file'));
echo $this->Form->textarea('VideoGame.description', array('rows'=>'5', 'label' =>'description'));

$select_platform = null;
foreach ($platforms as $platform)
{
	$select_platform[$platform['Platform']['id']] = $platform['Platform']['name'];
}


echo $this->Form->input(
    'VideoGame.platform_id',
    array('options' => $select_platform)
);

echo $this->Form->end('Add Game');



?>