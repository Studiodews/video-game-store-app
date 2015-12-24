
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

		echo $this->Html->css('cake.generic');
		echo $this->Html->css('max-width-649px');
		echo $this->Html->css('paul-nav-bar.css');
        echo $this->Html->css('font-awesome-4.2.0/css/font-awesome.css');
        echo $this->Html->css('jquery-ui-1.11.1.custom/jquery-ui.min.css');
        echo $this->Html->css('chosen/chosen.min.css');
        echo $this->Html->css('iCheck/all.css');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		echo $this->Html->script("jquery-2.1.1.min");
		echo $this->Html->script('ckeditor/ckeditor.js');
		echo $this->Html->script('chosen/chosen.jquery.min.js');
        echo $this->Html->script('jquery-ui-1.11.1.custom/jquery-ui.min.js');
        echo $this->Html->script('iCheck/icheck.min.js');
	?>
	
	<script type="text/javascript">
	window.onload = function() {
		//  this function returns a function that shows 
		//  the menu when icon is clicked or hides it depending on visibility
		function show_menu() {
			//var navigation = document.getElementById('nav_bar');
			
			var hidden = true;
			return function() {
				console.log("clicked");
				if (hidden) {
					$("#nav_bar").css("display", "inline-block");
					//navigation.style.display = "inline-block";
					hidden = false;
				}
				else {
					//navigation.style.display = "none";
					$("#nav_bar").css("display", "none");
					hidden = true;
				}
			}
		}

		// when window resizes make sure to show navigation bar in case it was hidden
		$(window).resize(function() {
			//var navigation = document.getElementById('nav_bar');
			if($(window).width() >= 650) {
				$("#nav_bar").css("display", "inline-block");
				//navigation.style.display = "inline-block";
			}
			else {
				$("#nav_bar").css("display", "none");
				//navigation.style.display = "none";
			}
		});

		var menu_function = show_menu();  //  get instance of function above
		var el = document.getElementById("three_stripe_menu");
		//  attach event to element when clicked
		if (el.addEventListener) {
        	el.addEventListener("click", menu_function, false);
    	} else {
      	  el.attachEvent('onclick', menu_function);
    	} 
	}
	</script>
</head>
<body>

	<div id="container">
		<div id="header">
			<!--<div id="logo"><?php echo $this->Html->image('logo.png'); ?></div>
			-->
			<h1>Game Geek</h1>
			<div class='username'><?php echo $this->Session->read('User.username')?></div>
			<div id="three_stripe_menu">
				<div class="first_line"></div>
				<div></div>
				<div></div>
			</div>
			<nav id="nav_bar">
				<div class="menu_screen">
					<span>Menu</span>
				</div>
				<div class="left">
				<?php
					echo $this->Html->link(
						'Video Games',
						array('controller' => 'video_games', 'action' => 'index'));
						echo $this->Html->link(
						'Trading Card Games',
						array('controller' => 'trading_card_games', 'action' => 'index'));
					echo $this->Html->link(
						'Consoles',
						array('controller' => 'consoles', 'action' => 'index'), array('class'=>'right'));
				?>
				</div>
				<div class="right">
				<?php 
				
				
				
				if ($this->Session->check('User.username')) {
				echo $this->Html->link('Profile', array('controller'=>'users', 'action'=>'account'), array('class'=>'left'));
					echo $this->Html->link('Logout', array('controller'=>'users', 'action'=>'logout'));
					
				}
				else {
					echo $this->Html->link('Register', array('controller'=>'users', 'action'=>'register'), array('class'=>'left'));
					echo $this->Html->link('Log in', array('controller'=>'users', 'action'=>'login'));
				}
				?>
				</div>
			</nav>

		</div>
		
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
