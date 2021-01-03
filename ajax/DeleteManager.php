<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){ 
    require ('../db/project.php');
    $project =  new project();
    $idDelete=  $_POST['idDelete'];
    $project->setId($idDelete);

   $nameManagerArray =  $project->showProjectListbyID();
   
   $nameManager = $nameManagerArray['manager'];
   $nameDeleteCompany = $nameManagerArray['company'];

   $project->setnameManager($nameManager);
  // $nameDeleteCompany

  $inprojectManager =  $project->checkInWhatCompaniesManagerInZapros();

 $isInCompany = false; 
  foreach ($inprojectManager as $inprojectManagerItem){
    if ($nameDeleteCompany==$inprojectManagerItem['kompany']) {$isInCompany = true;};
  }
 
// echo $isInCompany;


if($isInCompany == false) {
    
    $kolProjects = $project->checkManagerTotalProjects();
     $project->deleteManagerFromCompany();
     
     if ($kolProjects ==2) {
      $project-> setprojectLoad(0);
      $project->updateManagerLoadDelete(); 
     }  
     echo "ok";         
}
    else
    {
       
        echo "Невозможно удалить менеджера $nameManager, так как менеджер $nameManager задействован в обработке заказов в компаниях: $nameDeleteCompany";
    } 


 
   
   
   // echo  $nameManager . $kolProjects;



    //   

}
  
?>
