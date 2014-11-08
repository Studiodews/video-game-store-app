<?php
echo $this->element('backend_menu');

?>

<section style="display:inline-block;vertical-align:top;width:75%">
	<!--<div id="save-new-genre-section">-->
<?php
	echo $this->Form->create('VgGenre',array('action'=>'save_genre', 'default'=>false, 'id'=>'save-genre-form',
		'class'=>'one-line-form save-genre-form new-item-one-line-form'));
	echo $this->Form->input('id', array('value'=>0, 'type'=>'hidden'));
	echo $this->Form->input('name', array("class"=>'input-form'));
	echo $this->Form->button('Add', array('type' => 'submit', 'class'=>'save'));
	echo $this->Form->end();

?>

	<div class='container'>
		<?php foreach($vg_genres as $genre) { ?>
		<div class='form-container'>

		<?php 
		echo $this->Form->create('VgGenre', array('action'=>'save_genre', 'default'=>false, 'class'=>'save-genre-form one-line-form', 'id'=>false));?>
		<div>ID: <?php echo $genre['VgGenre']['id']; ?></div>
		<?php
		echo $this->Form->input('id', array('value'=>$genre['VgGenre']['id'], 'type'=>'hidden', 'id'=>false));
		echo $this->Form->input('name', array('value'=>$genre['VgGenre']['name'], 'id'=>false));
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
	var site_url = '<?php echo $save_edit_url; ?>';

	$(".container").on("keyup", "input[name='data[VgGenre][name]']", function(e) {
		//console.log("tetgrdfdgdf");
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
						//.log('data is new');
						// need to append the new genre
						var form_container = $('<div class="form-container"><form action="'+site_url+'" class="save-genre-form one-line-form" onsubmit="event.returnValue = false; return false;" method="post" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="POST"></div><input type="hidden" name="data[VgGenre][id]" value="'+response.genre['VgGenre'].id+'"><div class="input text"><label for="VgGenreName">Name</label><input name="data[VgGenre][name]" value="'+response.genre['VgGenre'].name+'" maxlength="50" type="text"></div><button type="submit" class="edit">Delete</button></form></div>');
						$("div.container").prepend(form_container);
					}
				}
			}, 'json');
		}
	});
/*
	$(document).on("submit", '.save-genre-form', function(e) {
		var oThis = $(this);
		var form_fields = $(this).serializeArray();
		$.post(oThis.attr("action"), form_fields, function(data) {
			var response = $.parseJSON(data);
			
			if(response.status) {
				console.log("tess");
				
				if(response.new_item) {
					//.log('data is new');
					// need to append the new genre
					var form_container = $('<div class="form-container"><form action="'+site_url+'" class="save-genre-form one-line-form" onsubmit="event.returnValue = false; return false;" method="post" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="POST"></div><input type="hidden" name="data[VgGenre][id]" value="'+response.genre['VgGenre'].id+'"><div class="input text"><label for="VgGenreName">Name</label><input name="data[VgGenre][name]" value="'+response.genre['VgGenre'].name+'" maxlength="50" type="text"></div><div class="submit"><input type="submit" value="Save"></div></form>	</div>');
					$("div.container").prepend(form_container);
				}
			}
		});
	});*/

	/*$(document).on("submit", "#save-genre-form", function(e) {
		var oThis = $(this);
		var form_fields = $(this).serializeArray();
		$.post(oThis.attr("action"), form_fields, function(data) {
			console.log(data);
		});
	});*/
	$(document).ready(function(){
		$(document).on("submit", "#save-genre-form", function(e) {
			console.log("tesfjsdflsdjf");
			var form = $(this);
		
			//console.log("form exists");
			var form_fields = form.serializeArray();
			//console.log(form_fields);
			
			$.post(form.attr("action"), form_fields, function(data) {
				var response = $.parseJSON(data);
				console.log(response);
				if(response.status) {
					//console.log("tess");
					
					if(response.new_item) {
						//.log('data is new');
						// need to append the new genre
						var form_container = $('<div class="form-container"><form action="'+site_url+'" class="save-genre-form one-line-form" onsubmit="event.returnValue = false; return false;" method="post" accept-charset="utf-8"><div style="display:none;"><input type="hidden" name="_method" value="POST"></div><input type="hidden" name="data[VgGenre][id]" value="'+response.genre['VgGenre'].id+'"><div class="input text"><label for="VgGenreName">Name</label><input name="data[VgGenre][name]" value="'+response.genre['VgGenre'].name+'" maxlength="50" type="text"></div><button type="submit" class="edit"></button></form></div>');
						$("div.container").prepend(form_container);
					}
				}
			});
		
		});
	});

</script>

