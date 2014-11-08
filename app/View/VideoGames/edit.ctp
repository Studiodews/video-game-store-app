<?php echo $this->element('backend_menu'); ?>

<section id="backend_content">
<h1>Edit Video Game: <?php echo $this->request->data['Product']['name']?></h1>

<?php
echo $this->Html->link('back to details', array('controller'=>'video_games','action'=>'details/'.$this->request->data['VideoGame']['id']));

/*
echo $this->request->data['VideoGame']['title'];
echo $this->request->data['VideoGame']['price'];
echo $this->request->data['VideoGame']['description'];
*/
echo $this->Form->create('VideoGame', array('type'=>'file'));
echo $this->Form->input("Product.id", array("type"=>"hidden", 'value'=>$this->request->data['Product']['id']));
echo $this->Form->input('Product.name');
echo $this->Form->input('Product.price');
echo $this->Form->input('Product.main_image_url', array('type'=>'file'));
echo $this->Form->textarea('Product.description', array('rows'=>'5','class'=>'ckeditor', 'label' =>'description'));

$select_platform = null;
foreach ($platforms as $platform)
{
	$select_platform[$platform['Platform']['id']] = $platform['Platform']['name'];
}

echo $this->Form->input('VideoGame.id', array('type'=>'hidden', 'value'=>$this->request->data['VideoGame']['id']));
echo $this->Form->input(
    'VideoGame.platform_id',
    array('options' => $select_platform, 'selected' => $this->request->data['VideoGame']['platform_id'])
);


/*echo $this->Form->input('VideoGame.video_game_id', 
	array('type'=>'hidden', 'value'=>$video_game['VideoGame']['id']));*/
if(isset($genres['IN'])) {
    echo $this->Form->input('VgGenreMembership.genre_remove_id',
        array(
            'class'=>'chosen-select chosen-rt1',
            'type'=>'select',
            'multiple'=>'multiple',
            'options'=>$genres['IN'],
            'label'=>'genres associated to '.$video_game['Product']['name'] . '(selected will be removed)'
        )
    );
}
echo $this->Form->input('VgGenreMembership.genre_id',
	array(
		//'class'=>'checkbox_options',
		'type'=>'select',
		'multiple'=>'multiple',
		'options'=> $genres['NOT'],
                'label'=>'genres not associated to ' . $video_game['Product']['name']. '(selected will be added)'
		)	
	);

echo $this->Form->end('Save Game');

?>
</section>

<script>
$("#VgGenreMembershipGenreRemoveId").chosen().change(function(e) {
    //console.log("remove id changed"+$(this).val());
});
$("#VgGenreMembershipGenreId").chosen();
</script>