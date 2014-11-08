<section>
<?php 
print_r($this->Session->read('Cart'));
	echo $this->element('cart_item_display',

		array('cart_items'=>$cart_items, 'add_remove_button'=>true));
?>
<?php
	if($show_checkout) {
		echo $this->Form->create('Order', array('action'=>'buy'));
		echo $this->Form->end('Checkout');
	}
?>
</section>