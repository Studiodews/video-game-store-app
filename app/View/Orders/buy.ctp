<?php

$this->Form->create('Order');
$this->Form->input('Order.address');
$this->Form->input('Order.city');
$this->Form->input('state');
$this->Form->input('country');
$this->Form->input('credit_card');
$this->Form->input('credit_card_code');
$this->Form->end('Place Order');

?>