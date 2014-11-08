<div class="row error_messages btn-danger">
    
</div>
<?php
	echo $this->Form->create('User', array('default'=>false, 'id'=>'login_form'));
	echo $this->Form->input('User.email');
	echo $this->Form->input('User.password');
        
	echo $this->Form->end('Login');
?>

<script type="text/javascript">
    $('.error_messages').hide();
    function timeout_error() {
        setTimeout(function() {
           
            $(".error_messages").fadeOut(function() {$(this).html("")});
            //$(".error_messages").html("");
        }, 10000);
    }
    $("#login_form").submit(function() {
        var login_data = $(this).serializeArray();//{};
        /*$(this).find("input").each(function(i,e) {
            login_data[$(e).attr('name')] = $(e).val();
        });*/
        //console.log(login_data);
        $.ajax({
            url: "/game-store/users/login_ajax",
            type: "POST",
            data: login_data,
            dataType: "json",
            success: function(data) {
                if(!data.status) {
                    $(".error_messages").html(data.error_message).fadeIn();
                    
                    timeout_error();
                } else {
                    window.location.href = "/game-store/users/account";
                }
                //console.log("test");
                //console.log(data);
            }
        });
       
    });
</script>