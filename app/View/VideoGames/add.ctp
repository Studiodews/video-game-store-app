<?php echo $this->element('backend_menu'); ?>
<section id="backend_content">
<h1>Add New Video Game</h1>

<?php

echo $this->Form->create('VideoGame', array('action' => 'add', 'type'=>'file'));
echo $this->Form->input('Product.name');
echo $this->Form->input('Product.price');
echo $this->Form->input('Product.main_image_url', array('type'=>'file'));
echo $this->Form->textarea('Product.description', array('rows'=>'5', 'label' =>'description', 'class'=>'ckeditor'));

echo $this->Form->input('VgGenreMembership.genre_id',
	array(
		//'class'=>'checkbox_options',
		'type'=>'select',
		'multiple'=>'checkbox',
		'options'=> $genre_options
		)	
	);
/*foreach ($genre_options as $key=>$value) {

	echo $this->Form->input('VgGenreMembership.'.$key.'.genre_id',
		array(
			'label' => $value,
			'type'=>'checkbox',
			//'multiple'=>'checkbox',
			'value'=>$key

			)
		);
}*/
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
</section>