<?php
//echo $this->Html->css(array('video_game_index'));
?>
<?php
echo $this->Form->create('VideoGame',array('action'=>'index', 'default'=>false));
?>
<!--<input type="hidden" name="paultest" value="testing form" />-->
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
    <div id="display_filters">FILTERS<i id="angle-icon" class="fa fa-angle-down"></i><!--<div class="arrow-down"></div>--></div>
<script type="text/javascript">
    var site_url = '<?php echo SITE_URL; ?>';
    	function show_filters() {
    		var hidden = true;
    		return function() {
    			if (hidden) {
                            
					$("#hidden_filters").css("display", "inline-block");
                                        
                                        //this changes the angle icon
					$("#display_filters i").removeClass();
					$("#display_filters i").addClass('fa fa-angle-up angle-icon');
					//navigation.style.display = "inline-block";
					hidden = false;
				}
				else {
					//navigation.style.display = "none";
					$("#hidden_filters").css("display", "none");
					$("#display_filters i").removeClass();
					$("#display_filters i").addClass('fa fa-angle-down angle-icon');
					hidden = true;
				}
    		}
    	}

    	var filter_function = show_filters();
    	var filter_button = document.getElementById('display_filters');
    	if (filter_button.addEventListener) {
    		filter_button.addEventListener('click', filter_function, false);
    	} else {
    		filter_button.attachEvent('onclick', filter_function);
    	}
</script>
</li>
</ul>
<div id="hidden_filters">
<?php
//echo $this->Form->label('action');
echo $this->Form->input('genres',
	array(
		//'class'=>'checkbox_options',
		'type'=>'select',
		'multiple'=>'checkbox',
		'options'=> $genre_options
		)	
	);

echo $this->Form->input('platforms',
	array(
		//'class'=>'checkbox_options',
		'type'=>'select',
		'multiple'=>'checkbox',
		'options'=> $platform_options
		)	
	); 

?>
</div>
<?php
echo $this->Form->end('Search');
?>
<script type="text/javascript">
    
$('#VideoGameIndexForm').submit(function(e){
    console.log($(this).serialize());
    var data_serialize = $(this).serialize();
    var mydata = {};
    mydata['data[VideoGame][keywords]'] = $('#VideoGameKeywords').val();
    mydata['data[VideoGame][genres]'] = new Array();
    mydata['data[VideoGame][platforms]'] = new Array();
    
    var genre_pattern = /VideoGameGenres[0-9]+/;
    var platform_pattern = /VideoGamePlatforms[0-9]+/;
    $('#VideoGameIndexForm input[type=checkbox]').each(
        function() {
            curr_elem_id = $(this).attr('id');
            if (genre_pattern.test(curr_elem_id)) {
                element = document.getElementById(curr_elem_id);
                if(element.checked) {
                    mydata['data[VideoGame][genres]'].push($(this).attr('value'));
                }
            } 
            else if(platform_pattern.test(curr_elem_id)) {
              element = document.getElementById(curr_elem_id);
                if(element.checked) {
                    mydata['data[VideoGame][platforms]'].push($(this).attr('value'));
                }  
            } 
        }
    );
    console.log(mydata);
$.ajax({
    url: '/game-store/video_games/get_video_games',
    cache: false,
    type: 'POST',
    data: data_serialize,//mydata,
    dataType: 'json',
    success: function (data) {
        //console.log(data);
        //console.log(data.length);
        $(".item_row").fadeOut({complete: function() {
                $(".item_row").html("");
        $.each(data, function (i, e) {
            //console.log(e);
            var li_e = $("<li />");
            var img = $("<img />", {src: site_url+'img/<?php echo VG_IMAGES_FOLDER; ?>/'+e.Product.main_image_url});
            var a_e = $("<a />", {href: site_url+'video_games/view/'+e.VideoGame.id});
            var game_title = $("<span />", {class: 'game_title', text: e.Product.name});
            a_e.append(img);
            a_e.append(game_title);
            li_e.append(a_e);
            li_e.append("<br />");
            li_e.append("<span>"+e.Product.price+"</span>");
            $(".item_row").append(li_e);
        });
        $(".item_row").fadeIn();
        }});
        
    }
});
/*
$.ajax({
    url: '/game-store/video_games/ajax_test',
    cache: false,
    type: 'POST',
    data: mydata,
    dataType: 'text',
    success: function (data) {
        if (data.error) {
            console.log(data.error);
        } else {
            $('.item_row').html('');
            xmlDoc = $.parseXML(data);
            $xml = $(xmlDoc);
            $test = $xml.find('VideoGame');
            console.log('success');
            $test.each(function() {
                image_url = $(this).find('main_image_url').text();
                $('.item_row')
                .append(
                    '<li>' +
                    '<a href="/game-store/video_games/view/'+$(this).find('id').text()+'">'+
                    '<img src="/game-store/img/<?php echo VG_IMAGES_FOLDER; ?>/'+image_url+'" class="img-responsive" />'+
                    '<span class="game_title">'+
                    $(this).find('name').text()+'</a></span><br />'+
                    '<span>'+$(this).find('price').text()+'</span>'+
                    '</li>'
                    ).hide().fadeIn(500);
            });         
        }
    },
    error: function() {
        $('.item_row').html('test');
    }
});*/

});
</script>


<br />

<div class="row">
    <?php foreach ($video_games as $video_game): ?>
    <!--<div class="col-xs-2">
    <div>
            <?php echo $this->Html->image($video_game['Product']['main_image_url'], array("class"=>"img-responsive")); ?>
        </div>
        <span class="game_title"><?php echo $this->Html->link($video_game['Product']['name'], array('action' => 'view/'.$video_game['VideoGame']['id'])); ?></span><br />
        <span>Price: <?php echo $video_game['Product']['price']; ?></span>
    </div>
    <?php endforeach; ?>
</div>-->
		
	<ul class="item_row">
	<?php
	$counter = 0;
	foreach ($video_games as $video_game):

	?>
	<li>
	
			<?php echo $this->Html->image( VG_IMAGES_FOLDER. '/'. $video_game['Product']['main_image_url'], array("class"=>"img-responsive")); ?>
		<br />
		<span class="game_title"><?php echo $this->Html->link($video_game['Product']['name'], array('action' => 'view/'.$video_game['VideoGame']['id'])); ?></span><br />
		<span>Price: <?php echo $video_game['Product']['price']; ?></span>
	</li>
	<?php endforeach; ?>
	</ul>
    
    
    <script type="text/javascript">
        //  $(".item_row").hide();
        /*function get_set_max_li_height() {
            var max_product_height = 0;
            $(".item_row li").each(function(i, e) {
                console.log($(e).height());
                if($(e).height() > max_product_height) {
                    max_product_height = $(e).height();
                }
            });
            //  console.log("max_height "+max_product_height);
            $(".item_row li").each(function(i, e) {
                $(e).height(max_product_height*2.1);

            });
        }
        $(document).ready(function() {
            get_set_max_li_height();
        });*/
    </script>