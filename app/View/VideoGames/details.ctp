<?php
echo $this->element('backend_menu');
?>
<section id="backend_content">
<?php
	$genres=Array();
	foreach($game['VgGenreMembership'] as $key=>$value) {
		$genres[] = $value['VgGenre']['name'];

	}
?>
<div>
    <?php echo $this->Html->link('Edit', array('controller'=>'video_games', 'action'=>'edit/'.$game['VideoGame']['id'])); ?>
    <?php echo $this->Html->link('Edit Genres', array('controller'=>'video_games', 'action'=>'edit_genres/'.$game['VideoGame']['id'])); ?>
</div>
<section class="item_details">
<div>
<b>Name:</b> <?php echo $game['Product']['name']; ?>
</div>
<div>
<b>Price:</b> <?php echo $game['Product']['price']; ?>
</div>
<div>
<b>Image File:</b> <?php echo $game['Product']['main_image_url']; ?>
</div>
<div>
<b>Genres:</b> <?php echo implode(',', $genres); ?>
</div>
<div>
<b>Platform:</b> <?php echo $game['Platform']['name']; ?>
</div>
<div>
<b>Date Entry Created:</b> <?php echo $game['Product']['created']; ?>
</div>
<div>
<b>Last Modified:</b> <?php echo $game['Product']['modified']; ?>
</div>
<div>
<div><b>Description details:</b></div>
<?php echo $game['Product']['description']; ?>
</div>
</section>
</section>