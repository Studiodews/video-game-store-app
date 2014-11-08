<?php
echo $this->element('backend_menu');
?>

<section style="display:inline-block;vertical-align:top">
<?php echo $this->Html->link('Add video game',array('controller'=>'video_games','action'=>'add')); ?>

<table>
<thead>
	<tr>
		<th>ID</th>
		<th>Title</th>
		<th></th>
		<th></th>

	</tr>
</thead>
<?php
foreach ($game_list as $game):
?>
<tr>
	<td><?php echo $game['VideoGame']['id']; ?></td>
<td><?php echo $game['Product']['name']; ?></td>
<td><?php echo $this->Html->link('Details', array('controller'=>'video_games', 'action'=>'details/'.$game['VideoGame']['id'])); ?></td>
<td><?php echo $this->Html->link('Edit', array('controller'=>'video_games', 'action'=>'edit/'.$game['VideoGame']['id'])); ?>
</td>
</tr>

<?php
endforeach;
?>
</table>
</section>