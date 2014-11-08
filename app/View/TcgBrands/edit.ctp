<?php
echo $this->element('backend_menu');
?>
<section id="backend_content">
<?php
echo $this->Form->create('TcgBrand');
echo $this->Form->input('TcgBrand.name');
echo $this->Form->end('Save Brand');
?>
</section>