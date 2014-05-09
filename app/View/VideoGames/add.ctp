<h1>Add new Video Game</h1>

<?php
echo $this->Form->create('VideoGame', array('action' => 'add'));
echo $this->Form->input('VideoGame.title');
echo $this->Form->input('VideoGame.rating');
echo $this->Form->input('VideoGame.price');
echo $this->Form->body('VideoGame.description', array('rows'=>'3', 'label' =>'description'));

$select_platform = null;
foreach ($platforms as $platform)
{
	$select_platform[$platform['Platform']['id']] = $platform['Platform']['name'];
}


echo $this->Form->input(
    'VideoGame.platform_id',
    array('options' => $select_platform)
);

echo $this->Form->end('Save Game');



?>