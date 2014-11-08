
<?php
echo $this->element('backend_menu');
?>

<section style="display:inline-block;vertical-align:top">

<?php echo $this->Html->link('Add new Trading Card Game Item',array('controller'=>'trading_card_games','action'=>'add')); ?>

<table>
<thead>
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th></th>
		<th></th>

	</tr>
</thead>
<?php
foreach ($tcg_list as $item):
?>
<tr>
	<td><?php echo $item['TradingCardGame']['id'] ?></td>
<td><?php echo $item['Product']['name']; ?></td>
<td><?php echo $this->Html->link('Details', array('controller'=>'trading_card_games', 'action'=>'details/'.$item['TradingCardGame']['id'])); ?></td>
<td><?php echo $this->Html->link('Edit', array('controller'=>'trading_card_games', 'action'=>'edit/'.$item['TradingCardGame']['id'])); ?>
</td>
</tr>

<?php
endforeach;
?>
</table>
</section>