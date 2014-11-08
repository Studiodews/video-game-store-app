<div>Please confirm your information is correct</div>
<table>
	<tr>
		<th>Address</th>
		<th>Credit Card</th>
	</tr>
	<tr>
		<td><?php echo $this->request->data['Order']['address'] . ' ' . $this->request->data['Order']['city'] . ' ' . $this->request->data['Order']['state'] . ' ' . $this->request->data['Order']['country']; ?></td>
		<td><?php echo $this->request->data['Order']['credit_card']; ?></td>
	</tr>

</table>
<div>
	Your Products
</div>
<table>
	<thead>
		<td>Name</td>
		<td>Quantity</td>
		<td>Price(each)</td>
	</thead>
<?php 
//print_r($cart_items);
foreach($cart_items as $category=>$item):
	//echo "a category: ".$category;
	//foreach ($items as $id=>$item):
?>
<tr>
	<td><?php echo $item['name']; ?></td>
	<td><?php echo $item['quantity']; ?></td>
	<td><?php echo $item['price'] ?></td>
</tr>
<?php 
//endforeach;
endforeach; ?>
<tr>
	<td colspan='2' style="text-align:right">total</td>
	<td> <?php echo $this->request->data['Order']['total']; ?> </td>
</tr>
</table>

<?php
echo $this->Form->create('Order', array('action'=>'success'));
echo $this->Form->end('Submit Order');
?>