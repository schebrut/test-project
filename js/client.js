$( document ).ready(function() {

    //var conn = new WebSocket('ws://localhost:8080');


    $('#client-btn').click(function(){  
        message  = $('.zapros-text').val();
        $('.errors').html('');
        $('.status-zapros').html('');
        var checkedcompanies = [];
        $('input:checkbox:checked').each(function() {
            checkedcompanies.push($(this).attr('id'));
        });

        selectedLevel = $('.select-level option:selected').val();
       
        $.ajax({            
            url: 'ajax/sendorder.php',        
            method: 'post',            
            dataType: 'html',          
            data: {
                message: message,
                selectedLevel: selectedLevel,
                checkedcompanies: JSON.stringify(checkedcompanies),              
                                        
        },        
        success: function(data){ 
        //alert (data);
        if (data=='selectError'){
          $('.errors').html('Ошибка отправки запроса! Выберете сложность запроса.');
        }
        else if (data=='ChoosCompanyError'){
          $('.errors').html('Ошибка отправки запроса! Выберете компанию для отпрвки запроса.');
        }
        else if (data=='MessageError'){
          $('.errors').html('Ошибка отправки запроса! Введите текст сообщения.');
        } 

        else if (data=='TotalLoadError'){
          $('.errors').html('Ошибка отправки запроса! Нет свободных менеджеров');
        } 
        else if (data=='ManagerError'){
          $('.errors').html('Ошибка отправки запроса! Нет назначенных менеджеров');
        } 
        
        else {
          $('.status-zapros').html(data);
        } 
        
        
        
        //location.reload();
        // conn.send('Пошла информация от заказчика');
        }
        
        });




      //  conn.onmessage = function(e) {
		  //  console.log(e.data);
		 //   var data = (e.data);
		//   alert (data);

		//};
    
        
       
      }); 
      
  

      


    


});