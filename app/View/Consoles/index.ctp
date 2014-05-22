<?php
echo $this->Html->link('add a console', array('controller' => 'Consoles', 'action' => 'add'));
?>

<div id='console-nav-bar'>
	<a href='./consoles'>All</a>
	<?php foreach ($platforms as $platform): ?>
		<a href='?Category=<?php echo $platform['Platform']['id']; ?>'><?php echo $platform['Platform']['name']; ?></a>
	<?php endforeach; ?>

</div>

<div class="consoles_row">
<?php
$counter = 0;
foreach ($consoles as $console):
if ($counter == 6) {
	echo "</div><div class='consoles_row'>";
	$counter = 0;
}
$counter += 1;
?>

	<div class="console_items" style="float:left; width: 200px;margin-left:10px; vertical-align:bottom">
		<div><?php echo $this->Html->image($console['Console']['main_image_url']); ?></div>
		<span><?php echo $this->Html->link($console['Console']['name'], array('action' => 'view/'.$console['Console']['id'])); ?></span><br />
		<span>Price: <?php echo $console['Console']['price']; ?></span>
	</div>
<?php endforeach; ?>
</div>