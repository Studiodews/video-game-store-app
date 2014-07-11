
<div>
	<?php 
		echo $this->Html->image($item['Console']['main_image_url'], array('class'=>'img-responsive')); 
	?>
	<span class="item-title"><?php echo $item['Console']['name']; ?></span>
</div>
<div class="description">
	<h3>Description</h3>
<?php
echo $item['Console']['description'];
?>