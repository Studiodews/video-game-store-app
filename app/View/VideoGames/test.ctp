<div>
<?php
    echo $this->Form->create('VideoGame', array('type'=>'post', 'default'=>false));
    echo $this->Form->input('keywords', 
    array('type'=>'text', 
        'class'=>'searchbox', 
        'placeholder'=>'Search for title',
        'label'=>false
    )
); 
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

echo $this->Form->end('get');
?>
</div>

<div onclick="test()">load games</div>
<div id="context">
	<ul class="item_row">

	</ul>
</div>

<script type="text/javascript">
var mydata = {};

var test = function() {

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
    		$('#context ul').html('');
    		xmlDoc = $.parseXML(data);
    		$xml = $(xmlDoc);
    		$test = $xml.find('VideoGame');
    		$test.each(function() {
    			image_url = $(this).find('main_image_url').text();
    			$('#context ul').append(
    				'<li>' +
    				'<img src="/game-store/img/'+image_url+'" class="img-responsive" />'+
    				'<span class="game_title"><a href="/game-store/video_games/view/'+
    				$(this).find('id').text()+'">'+$(this).find('title').text()+'</a></span><br />'+
    				'<span>'+$(this).find('price').text()+'</span>'+
    				'</li>'
    				);

    		});
    			
    	
        	
    	}
    }
});
} // end test function

$('#VideoGameTestForm').submit(function(){
    var mydata = {};
    mydata['data[VideoGame][keywords]'] = $('#VideoGameKeywords').val();
    mydata['data[VideoGame][genres]'] = new Array();
    mydata['data[VideoGame][platforms]'] = new Array();
   // mydata['data[VideoGame][genres]'].push('test');
    //mydata['data[VideoGame][genres]'].push('another');
    //console.log(mydata['data[VideoGame][genres]'][1]);
    //mydata['data[VideoGame][genres]'].push('test'); 
    //console.log($('#VideoGameKeywords').val());
    //console.log(document.getElementById('VideoGameGenres1').checked);
    
    var genre_pattern = /VideoGameGenres[0-9]+/;
    var platform_pattern = /VideoGamePlatforms[0-9]+/;
    $('#VideoGameTestForm input[type=checkbox]').each(
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
            $('#context ul').html('');
            xmlDoc = $.parseXML(data);
            $xml = $(xmlDoc);
            $test = $xml.find('VideoGame');
            $test.each(function() {
                image_url = $(this).find('main_image_url').text();
                $('#context ul').append(
                    '<li>' +
                    '<img src="/game-store/img/'+image_url+'" class="img-responsive" />'+
                    '<span class="game_title"><a href="/game-store/video_games/view/'+
                    $(this).find('id').text()+'">'+$(this).find('title').text()+'</a></span><br />'+
                    '<span>'+$(this).find('price').text()+'</span>'+
                    '</li>'
                    );
            });         
        }
    }
});

});

</script>
