<?php

echo $this->Form->create('Order', array('action'=>'confirm'));
echo $this->Form->input('Order.address');
echo $this->Form->input('Order.city');
echo $this->Form->input('state');
echo $this->Form->input('country');
echo $this->Form->input('credit_card');
echo $this->Form->input('credit_card_code');
?>

<p>your order:</p>
<table>
	<thead>
		<td>Name</td>
		<td>Quantity</td>
		<td>Price</td>
	</thead>
	<tbody>
<?php
$total = 0;
foreach($cart_items as $category=>$items):
	//echo "a category: ".$category;
	foreach ($items as $id=>$item):
?>
<tr>
	<td><?php echo $item['name']; ?></td>
	<td><?php echo $item['quantity']; ?></td>
	<td><?php echo $item['price']*$item['quantity']; ?></td>
</tr>
<?php 
$total += $item['price']*$item['quantity'];
endforeach;
endforeach; ?>
<tr>
	<td colspan='2' style="text-align:right">total</td>
	<td> <?php echo $total; ?> </td>
</tr>
</tbody>
</table>

<?php
echo $this->Form->end('Place Order');

?>