<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){ 
   require ('../db/project.php');
   $project =  new project();
   $maxload = 40;   
   $maxDopusk = 0; 

   $idCompany= trim( $_POST['idCompany']);
   $idmanageradd= trim( $_POST['idmanageradd']);

   $nagruzka1 = trim( $_POST['nagruzka1']);
   $nagruzka2 = trim( $_POST['nagruzka2']);


   $kolvoprojects = trim( $_POST['kolvoprojects']);
  
   $kompanyLast = trim( $_POST['kompanyLast']);  

   $project->setNameCompany($idCompany);
   $project->setnameManager($idmanageradd);

   $totalLoadInProject =  $project-> checkManagerTotalLoadInAllProjects();

  $totalAllrojects =  $project-> checkManagerTotalLoad();
   $maxDopusk = $maxload-$totalAllrojects;




 if (trim($idmanageradd)==''){
    echo "managerError";
 }
 else if 
        ($project->checkExistManager() == false){
            echo "managerExist";
        }

        else if ( ! preg_match('/^\d+$/', $nagruzka1) ) {
            echo "NotINT";
          }
       
          else if ( ! preg_match('/^\d+$/', $nagruzka2) ) {
            echo "NotINT";
          }

        
else {

        if ($kolvoprojects == 0){
            $project->setprojectLoad(0);
            $project->saveProjects();
            echo "managerADD";

        }

        if ($kolvoprojects == 1){
           // echo "2 нагрузки";
           if ($nagruzka1 == 0 ){
            echo "NullData";
           }
           elseif ($nagruzka2 == 0){
            echo "NullData";
           }
           elseif (($nagruzka1+$nagruzka2)>$maxDopusk){
            echo "MaxLoad";
           }

           else{
            $project->setprojectLoad($nagruzka1);
            $project->setManagerLastLoad($nagruzka2);
            $project->setLastCompany($kompanyLast);
            $project->updateLastLoad();
            $project->saveProjects();        
            echo "managerADD";
        }
        }
        
        if ($kolvoprojects == 2){
            
           if ($nagruzka1 == 0){
            echo "NullData";
           }
           elseif ($nagruzka1 > $maxDopusk){
            echo "MaxLoad";
           }

           else{
            $project->setprojectLoad($nagruzka1);
            $project->saveProjects();
            echo "managerADD";
        }
        }
        
         
}


   


}
?>