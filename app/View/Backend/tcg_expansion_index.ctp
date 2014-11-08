<?php echo $this->element('backend_menu'); ?>
<section id="backend_content">
	<?php //echo $this->Html->link('Add New Expansion', array('controller'=>'tcg_expansions', 'action'=>'add')); ?>
	<?php
	echo $this->Form->create('TcgExpansion',array('action'=>'save_expansion', 'default'=>false, 'id'=>'save-expansion-form',
		'class'=>'one-line-form save-genre-form new-item-one-line-form'));
	echo $this->Form->input('id', array('value'=>0, 'type'=>'hidden'));
	echo $this->Form->input('name', array("class"=>'input-form'));
	echo $this->Form->button('Add', array('type' => 'submit', 'class'=>'save'));
	echo $this->Form->end();

?>
	<!--<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th></th>
				<th></th>
			</tr>	
		</thead>
		<tbody>-->
			<?php foreach($tcg_expansion_list as $tcg_expansion): ?>
			<div class='form-container'>
				<?php 
		echo $this->Form->create('TcgExpansion', array('action'=>'save_expansion', 'default'=>false, 'class'=>'save-expansion-form one-line-form', 'id'=>false));?>
		<div>ID: <?php echo $tcg_expansion['TcgExpansion']['id']; ?></div>
		<?php
		echo $this->Form->input('id', array('value'=>$tcg_expansion['TcgExpansion']['id'], 'type'=>'hidden', 'id'=>false));
		echo $this->Form->input('name', array('value'=>$tcg_expansion['TcgExpansion']['name'], 'id'=>false));
		//echo $this->Form->end('Save');
		echo $this->Form->button('', array('type' => 'submit', 'class'=>'edit'));
		echo $this->Form->end();
		?>
			</div>
			
		<?php endforeach; ?>
		<!--</tbody>
	</table>-->
</section>