<?php
echo $this->element('backend_menu');
?>

<section id="backend_content">
<?php
echo $this->Form->create('VideoGame', array('action'=>'save_genres'));
echo $this->Form->input('VideoGame.video_game_id', array('type'=>'hidden', 'value'=>$video_game['VideoGame']['id']));
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

echo $this->Form->end('Edit Genres');

?>
</section>
<script>
$("#VgGenreMembershipGenreRemoveId").chosen().change(function(e) {
    console.log("remove id changed"+$(this).val());
});
$("#VgGenreMembershipGenreId").chosen();
</script>