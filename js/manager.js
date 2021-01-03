$( document ).ready(function() {

  //  var conn = new WebSocket('ws://localhost:8080');
  
    $('.clase-order').click (function () {        
        id = $(this).attr('id');
        $.ajax({            
            url: '../ajax/close-order.php',        
            method: 'post',            
            dataType: 'html',          
            data: {
                id: id,                                 
        },        
        success: function(){     
            location.reload();      
        }        
        });
    });


  // conn.onmessage = function(e) {
        // console.log(e.data);
        // var data = (e.data);
         //alert (data);
    //     location.reload();
    // };

    


});