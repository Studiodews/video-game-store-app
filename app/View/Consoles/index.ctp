<?php
echo $this->Html->link('add a console', array('controller' => 'Consoles', 'action' => 'add'));
?>
<div id="list_of_consoles">
<?php
foreach ($consoles as $console):

?>
<div>
	<?php echo $console['Console']['name']; ?>
</div>
<?php endforeach; ?>
</div>