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

		
	<ul class="item_row">
	<?php
	$counter = 0;
	foreach ($video_games as $video_game):

	?>
	<li>
	
			<?php echo $this->Html->image($video_game['VideoGame']['main_image_url'], array("class"=>"img-responsive")); ?>
		<br />
		<span class="game_title"><?php echo $this->Html->link($video_game['VideoGame']['title'], array('action' => 'view/'.$video_game['VideoGame']['id'])); ?></span><br />
		<span>Price: <?php echo $video_game['VideoGame']['price']; ?></span>
	</li>
	<?php endforeach; ?>
	</ul>