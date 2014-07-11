<div>
	<?php 
	echo $this->Html->image($item['TradingCardGame']['main_image_url'], array('class'=>'img-responsive')); ?>
	<span class="item-title"><?php echo $item['TradingCardGame']['name']; ?></span>
</div>
<div class="description">
	<h3>Description</h3>
<?php
echo $item['TradingCardGame']['description'];


echo $this->Form->create(false, array('url' => array('controller' => 'cart', 'action' => 'add'))); 
echo $this->Form->input('id', array('type' => 'hidden', 'value' => $item['TradingCardGame']['id']));
echo $this->Form->input('name', array('type'=>'hidden', 'value'=>$item['TradingCardGame']['name']));
echo $this->Form->input('quantity', array('value'=>'1', 'class'=>'item-quantity'));
echo $this->Form->input('price', array('value'=>$item['TradingCardGame']['price'], 'type'=>'hidden'));
echo $this->Form->input('item_type', array('type'=>'hidden' ,'value'=>'TradingCardGame'));
echo $this->Form->end('Add To Cart');
?>


</div>
