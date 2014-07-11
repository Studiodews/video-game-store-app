<h1>Welcome to Game Geek!</h1>
<div>
	<p>
		here at Game Geek we have the latest video games, trading card games and consoles from old to new, always ready to be shipped within a day of your purchase.
	</p>
	<p>
		we offer the best prices on used video games for those desparate to start their new adventure.
	</p>
	<p>
		we sell video games ranging from the newest platform consoles so you can be ready to play what is trending right now.
	</p>
</div>

<div id="vg_top_five">
	<p>Our Top Five Popular Video Games</p>
<ul class="item_row">
	<?php
	foreach ($video_games as $video_game):
	?>
	<li>
	
			<?php echo $this->Html->image($video_game['VideoGame']['main_image_url'], array("class"=>"img-responsive")); ?>
		<br />
		<span class="game_title"><?php echo $this->Html->link($video_game['VideoGame']['title'], array('controller'=>'video_games', 'action' => 'view/'.$video_game['VideoGame']['id'])); ?></span><br />
		<span>Price: <?php echo $video_game['VideoGame']['price']; ?></span>
	</li>
	<?php endforeach; ?>
	</ul>
</div>
