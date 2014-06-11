<?php
	echo $this->Form->create('User');
	echo $this->Form->input('User.email');
	echo $this->Form->input('User.password');
	echo $this->Form->end('Login');
?>
