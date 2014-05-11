<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		echo $this->Html->css('paul-nav-bar.css');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	
	<script type="text/javascript">
	window.onload = function() {
		
	}
	</script>
</head>
<body>

	<div id="container">
		<div id="header">
			<div id="logo"><h1>Game Addict</h1></div>
			<nav id="nav_bar">
				
				<?php
					echo $this->Html->link(
						'Video Games',
						array('controller' => 'video_games', 'action' => 'index'));
						echo $this->Html->link(
						'Trading Card Games',
						array('controller' => 'trading_card_games', 'action' => 'index'));
					echo $this->Html->link(
						'Consoles',
						array('controller' => 'consoles', 'action' => 'index'));
				?>
				
			</nav>

		</div>
		
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			
		</div>
	</div>
	
</body>
</html>
