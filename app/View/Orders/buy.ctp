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
<?php
	echo $this->element('cart_item_display',

		array('cart_items'=>$cart_items, 'add_remove_button'=>false));
?>

<?php
echo $this->Form->end('Place Order');

?>