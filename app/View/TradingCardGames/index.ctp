

<?php
echo $this->Form->create('VideoGame',array('action'=>'index'));
?>
<ul style="float:left; list-style:none outside none">
	<li style="float:left;">
<?php
echo $this->Form->input('keywords', 
	array('type'=>'text', 
		'class'=>'searchbox', 
		'placeholder'=>'Search for title',
		'label'=>false
	)
); 
?>
</li>
<li style="float:left;">
<div id="display_filters">FILTERS<div class="arrow-down"></div></div>
<script type="text/javascript">
    	function show_filters() {
    		var hidden = true;
    		return function() {
    			if (hidden) {
					$("#hidden_filters").css("display", "inline-block");
					$("#display_filters div").removeClass();
					$("#display_filters div").addClass('arrow-up');
					//navigation.style.display = "inline-block";
					hidden = false;
				}
				else {
					//navigation.style.display = "none";
					$("#hidden_filters").css("display", "none");
					$("#display_filters div").removeClass();
					$("#display_filters div").addClass('arrow-down');
					hidden = true;
				}
    		}
    	}

    	var filter_function = show_filters();
    	var filter_button = document.getElementById('display_filters');
    	if (filter_button.addEventListener) {
    		filter_button.addEventListener('click', filter_function, false);
    	} else {
    		filter_button.attachEven('onclick', filter_function);
    	}
</script>
</li>
</ul>
<div id="hidden_filters">
<?php
//echo $this->Form->label('action');
echo $this->Form->input('expansions',
	array(
		//'class'=>'checkbox_options',
		'type'=>'select',
		'multiple'=>'checkbox',
		'options'=> $expansion_list
		)	
	);

echo $this->Form->input('brands',
	array(
		//'class'=>'checkbox_options',
		'type'=>'select',
		'multiple'=>'checkbox',
		'options'=> $brands,
		)	
	); 

?>
</div>
<?php
echo $this->Form->end('Search');
?>

<div class="tcg-items">
	<ul class="item_row">
		<?php
			foreach($tcg_list as $tcg_item):
		?>
		<li>
			<div style="display:block">
				<?php echo $this->Html->image($tcg_item['Product']['main_image_url'], array("class"=>"img-responsive")); ?>
			</div>
			<div>
				<span style="display:block"><?php echo $this->Html->link($tcg_item['Product']['name'], array('action' => 'view/'.$tcg_item['TradingCardGame']['id'])); ?></span>
				<span>Price: <?php echo $tcg_item['Product']['price']; ?></span>
			</div>
		</li>
	<?php endforeach; ?>
	</ul>
</div>
