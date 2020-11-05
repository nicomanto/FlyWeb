$(document).ready(function(){  
    $('#country').keyup(function(){  
         var query = $(this).val();  
         if(query != '')  
         {  
              $.ajax({  
                   url:"./pages/autocomplete.php",  
                   method:"POST",  
                   data:{query:query},  
                   success:function(data)  
                   {  
                        $('#tag').fadeIn();  
                        $('#tag').html(data);  
                   }  
              });  
         }  
    });  
    $(document).on('click', 'li', function(){  
         $('#tag').val($(this).text());  
         $('#tag').fadeOut();  
    });  
});  
//alert("debug js");