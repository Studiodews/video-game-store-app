<?php echo $this->element('backend_menu'); ?>

<section id="backend_content">
<?php
echo $this->Form->create('Platform');
echo $this->Form->input('name');
echo $this->Form->end('Save Platform');
?>
</section>