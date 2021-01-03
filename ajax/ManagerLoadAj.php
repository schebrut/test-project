<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){ 
    require ('../db/project.php');
   $project =  new project();
   $maxload = 40;
   $maxDopusk = 0;    
   $idCompany=  $_POST['idCompany'];
   $idmanageradd=  $_POST['idmanageradd'];   
   $project->setNameCompany($idCompany);
   $project->setnameManager($idmanageradd);
  
   

   $kolManagerProjects = $project-> checkManagerTotalProjects();
   //$totalLoadInProject = $project-> checkManagerTotalLoadInAllProjects();
  
   $totalLoadInProject = $project-> checkManagerTotalLoad();
  
   
   $maxDopusk = $maxload-$totalLoadInProject;
   $project->setMaxLoadInProject($maxDopusk);


 //  Текущая вовлеченность по всем проектам <b>' . $totalLoadInProject . '</b>
//echo $kolManagerProjects;
// echo 'Менеджер <b>'. $idmanageradd . '</b> Максимальный уровень вовлеченность в компани. <b>' . $maxload . '</b>';
   
if ($kolManagerProjects< 1) {
      echo '<input type="hidden" id="kolvoprojects" value="0">';
      echo 'Выбран менеджер <b>'. $idmanageradd . '</b>';
   }

   if ($kolManagerProjects== 1) {    
    
    $caomanyArraycheck = $project->checkInWhatCompaniesManager();
 
    echo '
    <input type="hidden" id="kolvoprojects" value="1"> 
    <p> Менеджер <b>' . $idmanageradd . '</b> будет задействован в двух копаниях. Необходимо установить уровень вовлеченности по компаниям. Максимальная вовлеченность<b> '.$maxDopusk.'</b></p>
     <p class="font-weight-bold">'.$caomanyArraycheck[0]['company'].'
     <input type="text" class="form-control nagruzka2" id="'.$caomanyArraycheck[0]['company'].'" placeholder=""></p>
    <p class="font-weight-bold">Текущая компания
    <input type="text" class="form-control nagruzka1" id="'.$idCompany.'" placeholder="">     
     </p>   
    ';

    
}
    
    if ($kolManagerProjects>=2) {
       
      echo '
      <input type="hidden" id="kolvoprojects" value="2">
      <p>Менеджер <b>' . $idmanageradd . '</b> будет задействован более чем в двух копаниях. Необходимо установить уровень вовлеченности в текущую компанию. <br>
       Максимальная вовлеченность для текущей компании  - <b>'.$maxDopusk.'</b>      
      </p>
      <input type="text" class="form-control nagruzka1" id="'.$idCompany.'" placeholder="">';
    }
   



   
 // echo 'Компания - ' . $idCompany  . ' Менеджер ' . $idmanageradd; 
}
?>