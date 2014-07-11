
<div id='tcg-nav-bar'>
	<a href='./trading_card_games'>All</a>
	<?php foreach ($brands as $brand): ?>
		<a href='?Category=<?php echo $brand['TcgBrand']['id']; ?>'><?php echo $brand['TcgBrand']['name']; ?></a>
	<?php endforeach; ?>
</div>

<div class="tcg-items">
	<ul class="item_row">
		<?php
			foreach($tcg_list as $tcg_item):
		?>
		<li>
			<div style="display:block">
				<?php echo $this->Html->image($tcg_item['TradingCardGame']['main_image_url'], array("class"=>"img-responsive")); ?>
			</div>
			<div>
				<span style="display:block"><?php echo $this->Html->link($tcg_item['TradingCardGame']['name'], array('action' => 'view/'.$tcg_item['TradingCardGame']['id'])); ?></span>
				<span>Price: <?php echo $tcg_item['TradingCardGame']['price']; ?></span>
			</div>
		</li>
	<?php endforeach; ?>
	</ul>
</div>
