<div>
	<?php 
	echo $this->Html->image($video_game['VideoGame']['main_image_url'], array('class'=>'img-responsive')); ?>
	<span class="item-title"><?php echo $video_game['VideoGame']['title']; ?></span>
</div>
<div class="description">
	<h3>Description</h3>
<?php
echo $video_game['VideoGame']['description'];

echo $this->Form->create(false, array('url' => array('controller' => 'cart', 'action' => 'add'))); 
echo $this->Form->input('id', array('type' => 'hidden', 'value' => $video_game['VideoGame']['id']));
echo $this->Form->input('name', array('type'=>'hidden', 'value'=>$video_game['VideoGame']['title']));
echo $this->Form->input('quantity', array('value'=>'1', 'class'=>'item-quantity'));
echo $this->Form->input('price', array('value'=>$video_game['VideoGame']['price'], 'type'=>'hidden'));
echo $this->Form->input('item_type', array('type'=>'hidden' ,'value'=>'VideoGame'));
echo $this->Form->end('Add To Cart');
?>

</div>
<br />
<div id="reviews">
	<h1>Reviews</h1>
	<?php
	foreach ($video_game['Reviews'] as $review):
		?>
		<div style="border-top:solid 1px">
			<p>product review by: <?php echo $review['name']; ?></p>
			<p>
				<?php echo $review['comment']; ?>
			</p>
		</div>
	<?php
	endforeach;
	?>
</div>