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

<div id='model-container'>

</div>

	<!--<div class='container'>
		<?php //foreach($vg_genres as $genre) { ?>
		<!--<div class='form-container'>-->

		<?php 
		//echo $this->Form->create('VgGenre', array('action'=>'save_genre', 'default'=>false, 'class'=>'save-genre-form one-line-form', 'id'=>false));?>
		<!--<div>ID: <?php //echo $genre['VgGenre']['id']; ?></div>-->
		<?php
		/*echo $this->Form->input('id', array('value'=>$genre['VgGenre']['id'], 'type'=>'hidden', 'id'=>false));
		echo $this->Form->input('name', array('value'=>$genre['VgGenre']['name'], 'id'=>false));
		//echo $this->Form->end('Save');
		echo $this->Form->button('', array('type' => 'submit', 'class'=>'edit'));
		echo $this->Form->end();*/
		?>
	<!--</div>-->
		<?php //} ?>

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

<script id="vg-genre-Template" type='text/x-handlebars-template'>

	{{#each collection}}
	{{>vg_genre}}
	{{/each}}
</script>

<script id="vg-genre-partial" type="text/x-handlebars-template">
	<div class="form-container">
		<form action="<?php echo $save_edit_url; ?>" class="save-genre-form one-line-form" onsubmit="event.returnValue = false; return false;" method="post" accept-charset="utf-8">
			<div style="display:none;">
				<input type="hidden" name="_method" value="POST">
			</div>
			<div>ID {{this.id}}</div>
			<input type="hidden" name="data[VgGenre][id]" value="{{this.id}}">
			<div class="input text">
				<label for="VgGenreName">Name</label><input name="data[VgGenre][name]" value="{{this.name}}" maxlength="50" type="text">
			</div>
			<button type="submit" class="edit"></button>
		</form>
	</div>
</script>

<script type='text/javascript'>
	var site_url = '<?php echo $save_edit_url; ?>';
	var delete_genre_url = '<?php echo $delete_genre_url; ?>';
	var genres = <?php echo json_encode($vg_genres); ?>;
	//var src_template = $("#vg-genre-Template").html();
	//var template = Handlebars.compile(src_template);
	Handlebars.registerPartial('vg_genre',$("#vg-genre-partial").html());

	Handlebars.registerHelper("log", function(something) {
	  console.log(something);
	});
	var Genre = Backbone.Model.extend({
		initialize: function() {

		},
		defaults: {
			id: 0,
			name: ''
		}
	});
	var GenreCollection = Backbone.Collection.extend({
		Model: Genre,
		set_models: function(list) {
			var oThis = this;
			//console.log(list);
			$.each(list, function(i,e) {
				//var genre = new Genre({id:e['VgGenre']['id'],name: e['VgGenre']['name']});
				var genre = new Genre(e['VgGenre']);
				console.log(genre);
				//console.log(genre);
				oThis.add(genre);
				//console.log(this.model({id:e['VgGenre']['id'], name: e['VgGenre']['name']}));
			});
		}
	});

	var GenreView = Backbone.View.extend({
		el: "#model-container",
		template: Handlebars.compile($("#vg-genre-partial").html()),
		initialize: function(options) {
			var oThis = this;
			this.model = options.model;
			this.render();
		},
		render: function() {
			var oThis = this;
			console.log(this.model);
			this.$el.prepend(oThis.template(this.model));
		}
	});

	var GenreCollectionView = Backbone.View.extend({
		el: '#model-container',
		template: Handlebars.compile($("#vg-genre-Template").html()),
		initialize: function(options) {
			//console.log(options);
			var oThis = this;
			this.collection = options.collection;
			this.site_url = options.site_url;
			this.render();
		},
		render: function() {
			var oThis = this;
			//console.log(this.collection);
			
			//console.log(oThis.template({'collection': oThis.collection}));

			this.$el.html(oThis.template({'collection': oThis.collection,'site_url':oThis.site_url}));
	
		}
	});

	var genre_collection  = new GenreCollection();
	genre_collection.set_models(genres);
	var genre_collection_view = new GenreCollectionView({site_url:site_url,collection:genre_collection.toJSON()});
	//console.log(JSON.stringify(genre_collection));


	$("#model-container").on("keyup", "input[name='data[VgGenre][name]']", function(e) {
		//console.log("tetgrdfdgdf");
		var form = $(this).closest("form.save-genre-form");
		if(form.length) {
			//console.log("form exists");
			var form_fields = form.serializeArray();
			//console.log(form_fields);
			
			$.post(form.attr("action"), form_fields, function(data) {
				var response = $.parseJSON(data);
			
				if(response.status) {
					
				}
			}, 'json');
		}
	});

	$('.save-genre-form').on("submit", function(e) {
		e.preventDefault();
		console.log("test");
		var oThis = $(this);
		var form_fields = $(this).serializeArray();
		//var id = $(this).find('input[name="data[VgGenre][name]"] ').val();
		$.post(delete_genre_url, form_fields, function(data) {
			var data = $.parseJSON(data);
			if(data.success) {
				oThis.closest('.form-container').remove();
			}
		});
	});

$(document).ready(function() {
	$(document).on("submit", "#save-genre-form", function(e) {
		//console.log("tesfjsdflsdjf");
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
					var form_container = $('<div class="form-container">'+
						'<form action="'+site_url+'" class="save-genre-form one-line-form" onsubmit="event.returnValue = false; return false;" method="post" accept-charset="utf-8">'+
						'<div style="display:none;">'+
							'<input type="hidden" name="_method" value="POST">'+
						'</div>'+
						'<div>ID '+response.genre['VgGenre'].id+'</div>'+
						'<input type="hidden" name="data[VgGenre][id]" value="'+response.genre['VgGenre'].id+'">'+
						'<div class="input text">'+
						'<label for="VgGenreName">Name</label><input name="data[VgGenre][name]" value="'+response.genre['VgGenre'].name+'" maxlength="50" type="text"></div><button type="submit" class="edit"></button></form></div>');
					$("div.container").prepend(form_container);
				}
			}
		});
	
	});


});

</script>

