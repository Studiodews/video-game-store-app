<?php
echo $this->Html->css(array('video_game_index'));
?>
<h1 class="video_game">Buy some Video games</h1>
<?php
$platform_mapping = null;

foreach ($platforms as $platform) {
	$platform_mapping[$platform['Platform']['id']] = $platform['Platform']['name'];
}
		
echo $this->Html->link('add a new video game', array('controller'=>'VideoGames', 'action'=>'add'));
$select_platform = null;
foreach ($platforms as $platform)
{
	$select_platform[$platform['Platform']['id']] = $platform['Platform']['name'];
}

echo $this->Form->create('VideoGame', array('action' => 'index', 'type' => 'get'));
echo $this->Form->input(
    'Category',
    array('options' => $select_platform)
);
echo $this->Form->end('Go');

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
		<td><?php echo $this->Html->link($video_game['VideoGame']['title'], array('action' => 'view/'.$video_game['VideoGame']['id'])); ?></td>
		<td><?php echo $platform_mapping[$video_game['VideoGame']['platform_id']]; ?></td>
		<td><?php echo $video_game['VideoGame']['price']; ?></td>
	</tr>
	<?php endforeach; ?>
</table>