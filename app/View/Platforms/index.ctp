<p>this is the platforms page</p>
<table>
	<tr>
		<th>id</th>
		<th>name</th>
	</tr>
<?php
foreach ($platforms as $platform):
	?>
	<tr>
		<td><?php echo $platform['Platform']['id']; ?></td>
		<td><?php echo $platform['Platform']['name']; ?></td>
	
	</tr>
<?php endforeach; ?>