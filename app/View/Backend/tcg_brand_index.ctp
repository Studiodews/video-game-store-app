<?php
echo $this->element('backend_menu');
?>



<section style="display:inline-block;vertical-align:top;width:75%">
	<?php
	echo $this->Form->create('TcgBrand',array('action'=>'save_brand', 'default'=>false, 'id'=>'save-brand-form',
		'class'=>'one-line-form save-brand-form new-item-one-line-form'));
	echo $this->Form->input('id', array('value'=>0, 'type'=>'hidden','id'=>false));
	echo $this->Form->input('name', array("class"=>'input-form','id'=>false));
	echo $this->Form->button('Add', array('type' => 'submit', 'class'=>'save','id'=>false));
	echo $this->Form->end();

?>

<div class='container'>
		<?php foreach($tcg_brands as $brand) { ?>
		<div class='form-container'>
		<?php 
		echo $this->Form->create('TcgBrand', array('action'=>'save_brand', 'default'=>false, 'class'=>'save-brand-form one-line-form', 'id'=>false));
		echo $this->Form->input('id', array('value'=>$brand['TcgBrand']['id'], 'type'=>'hidden', 'id'=>false));
		echo $this->Form->input('name', array('value'=>$brand['TcgBrand']['name'], 'id'=>false));
		//echo $this->Form->end('Save');
		echo $this->Form->button('', array('type' => 'submit', 'class'=>'edit'));
		echo $this->Form->end();
		?>
	</div>
		<?php } ?>

<div>
<?php
		echo $this->Paginator->prev(
  ' << ',
  array(),
  null,
  array('class' => 'prev disabled')
);
echo $this->Paginator->numbers(array(
    'before' => '<div class="pagination"><ul>',
    'separator' => '',
    'currentClass' => 'active',
    'tag' => 'li',
    'after' => '</ul></div>'
));

	
		echo $this->Paginator->next(
  ' >> ',
  array(),
  null,
  array('class' => 'next disabled')
);


		?>
	</div>
	</div>
</section>

<script type='text/javascript'>
	var save_brand_url = '<?php echo $save_edit_url; ?>';
	
	$(document).ready(function() {
		$("div.container").on("keyup", "input[name='data[TcgBrand][name]'", function(e) {
		
		var form = $(this).closest("form.save-genre-form");
		if(form.length) {
			//console.log("form exists");
			var form_fields = form.serializeArray();
			//console.log(form_fields);
			
			$.post(form.attr("action"), form_fields, function(data) {
				var response = $.parseJSON(data);
			
				if(response.status) {
					//console.log("tess");
					
					if(response.new_item) {
						
						// need to append the new 
						var form_container = $("<div class=\"form-container\">"+
		"<form action=\""+save_brand_url+"\" class=\"save-brand-form one-line-form\" onsubmit=\"event.returnValue = false; return false;\" method=\"post\" accept-charset=\"utf-8\"><div style=\"display:none;\"><input type=\""+hidden\" name=\"_method\" value=\"POST\"></div><input type=\"hidden\" name=\"data[TcgBrand][id]\" value=\"\"><div class=\"input text required\"><label for=\"TcgBrandName\">Name</label><input name=\"data[TcgBrand][name]\" value=\"\" maxlength=\"20\" type=\"text\" required=\"required\"></div><button type=\"submit\" class=\"edit\"></button></form>	</div>");

						

						$("div.container").prepend(form_container);
					}
				}
		});
			
		$(document).on("submit", "#save-brand-form", function(e) {
			console.log("submitted dsfsdfs");
			var oThis = $(this);
			var form_fields = $(this).serializeArray();
			$.post(oThis.attr("action"), form_fields, function(data) {

			}, 'json');	


		});
		
	});
	
</script>