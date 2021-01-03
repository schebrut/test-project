<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){ 
    require ('../db/project.php');
    $project =  new project();
    $managerLast=  $_POST['managerLast'];
    $manager=  $_POST['manager'];
    $kompany=  $_POST['kompany'];
    $id=  $_POST['id'];
 
//echo $id;

  $project->setId($id);   

  
  $project->setnameManager($manager);
  $levelZapros =  $project->showLevelZapros()['level_zapros']; 
  $managerLoad =   $project->checkManagerTotalLoad();

  if (($levelZapros+$managerLoad)>40){
      echo 'adderror';
  }
  else{
    
    $project->setnameManager($managerLast);     
    $project->setnameNewManager($manager); 
    $project->setNameCompany($kompany);
    //$load =  $project->checkManagerTotalLoad();  
   $project->changeManagersAndLoad();
}
 
}

  
?>
