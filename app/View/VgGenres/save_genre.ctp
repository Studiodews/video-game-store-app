<?php

echo $this->Form->create('VgGenre', array('action'=>'save_genre', 'default'=>false, 'class'=>'save-genre-form one-line-form'));
	echo $this->Form->input('id', array('value'=>$genre['VgGenre']['id'], 'type'=>'hidden'));
	echo $this->form->input('name', array('value'=>$genre['VgGenre']['name']));
	echo $this->Form->end('Save');
	
?>