<?php echo $this->element('backend_menu'); ?>
<section id="backend_content">
<table>
	<thead><tr>
		<th>ID</th>
		<th>Name</th>
		<th></th>
	</tr></thead>
	<tbody>
		<?php foreach($platform_list as $platform): ?>
		<tr>
			<td><?php echo $platform['Platform']['id']; ?></td>
			<td><?php echo $platform['Platform']['name']; ?></td>
			<td><?php echo $this->Html->link('Edit', array('controller'=>'platforms', 'action'=>'edit/'.$platform['Platform']['id'])); ?></td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
</section>