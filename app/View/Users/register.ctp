<?php
echo $this->Form->create('User');
echo $this->Form->input('User.username');
echo $this->Form->input('User.email');
echo $this->Form->input('User.password');
echo $this->Form->input('User.first');
echo $this->Form->input('User.last');
echo $this->Form->input('User.address');
echo $this->form->end('Register');

?>