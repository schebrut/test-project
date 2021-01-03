$( document ).ready(function() {
 var idCompany = '';
 var idmanageradd = '';
 var nagruzka1 = 0;
 var nagruzka2 = 0;
 var kolvoprojects =0;
 var idDelete =0; 
 var kompanyLast = '';

 var managerLast ='';


 
$('#addCompanyModal').on('hidden.bs.modal', function (e) {
    $('.error-add-bd').text('');
    $('#add-company-text').val('');
})

$('#addManagerModal').on('hidden.bs.modal', function (e) {
     $('.error-add-man').html('');
     $('.add-manager-btn-group').html('');
     $('.add-manager-info').html('');
     $('.add-load-info').html('');
     $('.delete-man').html('');
     idCompany = '';
     idmanageradd='';
     nagruzka1 = 0;
     nagruzka2 = 0;
     kolvoprojects =0;
     

})

   $('#add-company-btn').click (function () {        
       nameCompany = $('#add-company-text').val();
               $.ajax({            
            url: 'ajax/addAjCompany.php',        
            method: 'post',            
            dataType: 'html',          
            data: {
                nameCompany: nameCompany,      
                                         
          },        
          success: function(data){ 
            
            if (data=='isNull'){
                $('.error-add-bd').html('Ошибка добавления! Вы ввели пустое значение.');
              }
              if (data=='false'){
                $('.error-add-bd').html('Ошибка добавления! Данная компания уже нахидится в БД.');
              }
              if (data=='true'){            
                $('#close-modal-add-company').click();
                location.reload(); 

              }
            }
         });
   });

  /////////////////////////////////////////////////////////////////

  
  
$('#addmanagerModal').on('hidden.bs.modal', function (e) {
    $('.error-add-bd-man').text('');
    $('#add-manager-text').val('');
})

   $('#add-manager-btn').click (function () {        
    nameManager = $('#add-manager-text').val();
               $.ajax({            
            url: 'ajax/addAjManager.php',        
            method: 'post',            
            dataType: 'html',          
            data: {
                nameManager: nameManager,      
                                         
          },        
          success: function(data){ 
            
            if (data=='isNull'){
                $('.error-add-bd-man').html('Ошибка добавления! Вы ввели пустое значение.');
              }
              if (data=='false'){
                $('.error-add-bd-man').html('Ошибка добавления! Данный менеджер уже нахидится в БД.');
              }
              if (data=='true'){            
                $('#close-modal-add-manager').click();
                location.reload(); 

              }
            }
         });
   });

////////////////////////////////////////////////////////////////////////////////////



$('.setManager').click(function(){   
    $('.namecompmodal').html($(this).attr('id'));
    idCompany= $(this).attr('id');
})

$(document).on('click', '.check-manager', function(){ /////////////////////////////---Проверка нагрузки
    idmanageradd =  $(this).attr('id');
    
    $('.error-add-man').html('');
  //  $('.add-manager-info').html(idmanageradd + idCompany);
  
  $.ajax({            
    url: 'ajax/ManagerLoadAj.php',        
    method: 'post',            
    dataType: 'html',          
    data: {
      idCompany: idCompany,
      idmanageradd: idmanageradd,      
                                
},        
success: function(data){ 
    //alert(data);
    $('.add-load-info').html(data);
    kolvoprojects = $('#kolvoprojects').val(); 
    }
    
});
   
});
//////////////////////////////////////////////////////////////////////////////

$('#add-manager-company-btn').click(function(){//////////////---Добавления менеджера в компанию
   
//alert (kolvoprojects);
  
   $.ajax({            
            url: 'ajax/projectsAj.php',        
            method: 'post',            
            dataType: 'html',          
            data: {
                idCompany: idCompany,
                idmanageradd: idmanageradd,
                
                nagruzka1: nagruzka1,
                nagruzka2: nagruzka2,
                kompanyLast: kompanyLast,
                kolvoprojects: kolvoprojects,
                
                                        
        },        
        success: function(data){ 
         //alert (data);
         
          if (data=='managerError'){
                $('.error-add-man').html('Ошибка добавления! Менеджер не выбран.');
              }
              if (data=='managerExist'){
                $('.error-add-man').html('Ошибка добавления! Менеджер уже находится в БД.');
              }
              if (data=='NotINT'){
                $('.error-add-man').html('Ошибка добавления! Введите корректно данные.');
              }
              if (data=='NullData'){
                $('.error-add-man').html('Ошибка добавления! Вы не ввели данные.');
              }
              if (data=='MaxLoad'){
                $('.error-add-man').html('Ошибка добавления! Вы превысили максимальню нагрузку на менеджера.');
              }
              if (data=='managerADD'){
                $('#close-modal-add-manager-to-company').click();
                location.reload();
              }              
           
            }
            
        });
        
})

////////////////////////////////////////////////////




$('#addManagerModal').on('shown.bs.modal', function (e) { //////////////---Загрузка списка свободных менеджеров
    $.ajax({            
        url: 'ajax/loadFreeManagerAj.php',        
        method: 'post',            
        dataType: 'html',          
        data: {
            idCompany: idCompany,
            idmanageradd: idmanageradd,
                      
                                    
    },        
    success: function(data){ 
 
      $('.add-manager-btn-group').append(data);
      
    }
    
    });
    
})


$(document).on('change', '.nagruzka1', function(){ /////////////////////////////---Проверка нагрузки
   nagruzka1 = $(this).val();
});

$(document).on('change', '.nagruzka2', function(){ /////////////////////////////---Проверка нагрузки
  kompanyLast = $(this).attr('id');
  nagruzka2 = $(this).val();  
 
 });
///////////////////////////////////////////////////////-удаление менеджера из компании
 $('.delete-manager').click(function(){
    idDelete = $(this).attr('id');
    
    $.ajax({            
      url: 'ajax/DeleteManagerManagerAj.php',        
      method: 'post',            
      dataType: 'html',          
      data: {
        idDelete: idDelete,              
                                  
  },        
  success: function(data){ 
  //alert (data);
    $('.delete-man').html(data);
    
  }
  
  });
}); 
/////////////////////////////////////////////////////////////////////////////////////////// 
$('#delete-manager-btn').click(function(){    
  $.ajax({            
    url: 'ajax/DeleteManager.php',        
    method: 'post',            
    dataType: 'html',          
    data: {
      idDelete: idDelete,              
                                
},        
success: function(data){ 
 // alert (data);
  if (data=='ok'){   
   // $('#close-modal-delete').click();    
    location.reload();
  } 
  else{
    $('.errors').html(data);
    $('#close-modal-delete').click();
  }
 
}

});
}); 



$('.select-manager').click(function(){   
  managerLast =  $(this).find('option:selected').text();
 // alert (managerLast);
})

$('.select-manager').change(function(){   
// manager =  $(this).find('option:selected').text();
  manager =  $(this).find('option:selected').attr('name');
  id = $(this).find('option:selected').attr('id');
  kompany  =  $(this).val();
 //alert (id);

 
$.ajax({            
  url: 'ajax/changeloadmanager.php',        
  method: 'post',            
  dataType: 'html',          
  data: {
    managerLast: managerLast,
    manager: manager,
    kompany: kompany, 
    id: id,              
                              
},        
success: function(data){

//alert (data);
if (data=='adderror'){
  location.reload();
  alert ('Невозможно переназначить менеджера, так-как его загруженность превысит 40 пунктов');
  
} 
else
{
location.reload();
} 
}

});
})



});