<h1 class="video_game">Buy some Video games</h1>
<?php
$platform_mapping = null;

foreach ($platforms as $platform) {
	$platform_mapping[$platform['Platform']['id']] = $platform['Platform']['name'];
}
		
echo $this->Html->link('add a new video game', array('controller'=>'VideoGames', 'action'=>'add'));
?>
<br />
<table>
	<tr>
		<th>Game Title</th>
		<th>Platform</th>
		<th>Price</th>
	</tr>
	
	<?php
	foreach ($video_games as $video_game):
	?>
	<tr>
		<td><?php echo $video_game['VideoGame']['title']; ?></td>
		<td><?php echo $platform_mapping[$video_game['VideoGame']['platform_id']]; ?></td>
		<td><?php echo $video_game['VideoGame']['price']; ?></td>
	</tr>
	<?php endforeach; ?>
</table>