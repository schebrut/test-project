<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){ 
    require ('../db/project.php');
    $project =  new project();
    $idCompany=  $_POST['idCompany'];
    $project->setNameCompany($idCompany);
  
    
    
    $managernametoModal =  $project->checkManagerInProject(); 
    if(empty($managernametoModal)) {
       echo "Нет доступных менеджеров для компании! Для исправления ошибки необходимо нанять на работу еще одного менеджера или освободить менеджера из другой компании." ;               
    }
   
   }


  
?>
<?php foreach ($managernametoModal as $managernametoModalitem):?>
<button type="button" class="btn btn-primary mt-2 mr-3 check-manager" id="<?php echo  $managernametoModalitem;?>"><?php echo  $managernametoModalitem; ?></button>
<?php endforeach;?>