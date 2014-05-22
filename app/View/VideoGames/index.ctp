<?php
echo $this->Html->css(array('video_game_index'));
?>
<!--<h1 class="video_game">Buy some Video games</h1>-->
<div id='console-nav-bar'>
	<a href='./video_games'>All</a>
	<?php foreach ($platforms as $platform): ?>
		<a href='?Category=<?php echo $platform['Platform']['id']; ?>'><?php echo $platform['Platform']['name']; ?></a>
	<?php endforeach; ?>
	

</div>

<br />

		
	<div class="video_game_row">
	<?php
	$counter = 0;
	foreach ($video_games as $video_game):
	if ($counter % 6 == 0)
	{
		echo "</div><div class='video_game_row'>";
		
	}
	$counter += 1;
	?>
	<div class="vg-items" style="float:left; width: 200px;margin-left:10px; vertical-align:bottom">
		<div><?php echo $this->Html->image($video_game['VideoGame']['main_image_url']); ?></div>
	<span><?php echo $this->Html->link($video_game['VideoGame']['title'], array('action' => 'view/'.$video_game['VideoGame']['id'])); ?></span><br />
	<span>Price: <?php echo $video_game['VideoGame']['price']; ?></span>
	</div>
	<?php endforeach; ?>
	</tr>
</table>