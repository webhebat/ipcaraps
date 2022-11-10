
jQuery(document).ready(function() {
  $('.pass_show').append('<span class="ptxt">Show</span>');  
	
    /*
        Fullscreen background
    */
    $.backstretch([
        "assets/login/img/backgrounds/3.jpg"
      
   ], {duration: 3000, fade: 750});
    
    /*
        Form validation
    */
    $('#formlogin').validate();   
    $(document).on('click','#submit',function(){
      var url = 'Auth/login';    
        if($('#formlogin').valid()){
          $('#logerror').html('<img src="assets/login/img/ajax.gif" align="absmiddle"> Please wait...');  
          $.ajax({
            type: "POST",
              url: url,
               data: $("#formlogin").serialize(), // serializes the form's elements.
                 success: function(data)
                   {
                     if(data==1)
                     window.location.href = 'home';
                     else  $('#logerror').html('Username dan password anda salah');
                           $('#logerror').addClass("error");
                   }
               });
        }
        return false;
       });

    $(document).on('click','.pass_show .ptxt', function(){ 

    $(this).text($(this).text() == "Show" ? "Hide" : "Show"); 

    $(this).prev().attr('type', function(index, attr){return attr == 'password' ? 'text' : 'password'; }); 

    });  
    
});
