<h1>Edit Video Game: <?php echo $this->request->data['VideoGame']['title']?></h1>

<?php
$remove_break_lines = preg_replace('#<br\s*/?>#i', "", $this->request->data['VideoGame']['description']);
/*
echo $this->request->data['VideoGame']['title'];
echo $this->request->data['VideoGame']['price'];
echo $this->request->data['VideoGame']['description'];
*/
echo $this->Form->create('VideoGame');
echo $this->Form->input("id", array("type"=>"hidden"));
echo $this->Form->input('VideoGame.title');
echo $this->Form->input('VideoGame.price');
echo $this->Form->input('VideoGame.main_image_url');
echo $this->Form->textarea('VideoGame.description', array('rows'=>'5', 'label' =>'description', 'value'=>$remove_break_lines));

$select_platform = null;
foreach ($platforms as $platform)
{
	$select_platform[$platform['Platform']['id']] = $platform['Platform']['name'];
}


echo $this->Form->input(
    'VideoGame.platform_id',
    array('options' => $select_platform, 'selected' => $this->request->data['VideoGame']['platform_id'])
);

echo $this->Form->end('Save Game');



?>