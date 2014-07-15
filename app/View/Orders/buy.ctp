<?php

echo $this->Form->create('Order', array('action'=>'buy'));
echo $this->Form->input('Order.address');
echo $this->Form->input('Order.city');
echo $this->Form->input('state');
echo $this->Form->input('country');
echo $this->Form->input('credit_card');
echo $this->Form->input('credit_card_code');
echo $this->Form->end('Place Order');

?>