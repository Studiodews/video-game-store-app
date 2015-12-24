
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
		<meta name="viewport" content="initial-scale=1.0,width=device-width" 
	/>

	<title>
		
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		//echo $this->Html->css('bootstrap.min.css');
		
		echo $this->Html->css('max-width-649px');
		echo $this->Html->css('paul-nav-bar.css');
                echo $this->Html->css('font-awesome-4.2.0/css/font-awesome.css');
                echo $this->Html->css('jquery-ui-1.11.1.custom/jquery-ui.min.css');
        echo $this->Html->css('chosen/chosen.min.css');
        echo $this->Html->css('admin');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		;//echo $this->Html->script("jquery-2.1.1.min");
		//echo $this->Html->script("admin");
		echo $this->Html->script("jquery-2.1.1.min");
		echo $this->Html->script('ckeditor/ckeditor.js');
		echo $this->Html->script('chosen/chosen.jquery.min.js');
		echo $this->Html->script('handlebars');
		echo $this->Html->script('underscore-min');
		echo $this->Html->script('backbone-min');
                //echo $this->Html->script('jquery-ui-1.11.1.custom/jquery-ui.min.js');
	?>
	
</head>
<body>

	<div id="container">
		
			

		
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<div>
				<?php echo $this->Html->link('disclaimer', array('cntroller'=>'store', 'action'=>'disclaimer')); ?>
			</div>
			
		</div>
	</div>
	
</body>
</html>
