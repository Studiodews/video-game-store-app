<?php
echo $this->Form->create('Order', array('action'=>'get_order'));
echo $this->Form->input('id', array('type'=>'text'));
echo $this->Form->end('Get Order Info');
if(isset($order)): 
?>
	<table>
		<caption>Order number: <?php echo $order['Order']['id']; ?></caption>
		<thead>
			<tr>
				<th>name</th>
				<th>quantity</th>
				<th>price (each)</th>
			</tr>
		</thead>
		<tbody>
<?php
	foreach($products as $product=>$item_type):
		foreach ($order[$item_type] as $key => $value):
?>
	<tr>
		<td><?php echo $value[$product]['name']; ?></td>
		<td><?php echo $value['quantity']; ?></td>
		<td><?php echo $value[$product]['price']; ?></td>
	</tr>			
		
<?php
endforeach;
endforeach;

?>
<tr>
	<td colspan='2' style="text-align:right">Total:</td>
	<td><?php echo $order['Order']['total']; ?></td>
</tr>
</tbody>

</table>
<?php endif; ?>