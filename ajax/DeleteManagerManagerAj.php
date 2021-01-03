<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){ 
    require ('../db/project.php');
    $project =  new project();
    $idDelete=  $_POST['idDelete'];
    $project->setId($idDelete);
    $data = $project->showProjectListbyID();   

    $name = $data['manager'];
    $company = $data['company'];
    

  echo "Менеджер <b>$name</b>  будет убран из компании <b>$company</b>" ; 

}
  
?>
