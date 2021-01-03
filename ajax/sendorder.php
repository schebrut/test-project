<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){ 
    require ('../db/zapros.php');
    $zapros =  new zapros();
    require ('../db/project.php');
    $project =  new project();
    $html = '<p><b>Ваш запрос отправлен:</b></p>';
  
    $message=  trim($_POST['message']);
    $selectedLevel=  trim($_POST['selectedLevel']);
    
    $checkedcompanies_json = $_POST['checkedcompanies'];  
    $checkedcompanies = json_decode($checkedcompanies_json, true);


if ($selectedLevel == 'Выберете уровень сложности запроса'){
 echo "selectError";
}
else if(empty($checkedcompanies)) {
  echo "ChoosCompanyError";              
}
 
else if($message == '') {
  echo "MessageError";              
}

else {
 
$zapros->setclientId(1);
  
$zapros->setlevelZapros($selectedLevel);

 $zapros->setmessage($message);

 $status = 'Отправлен';
 
 $zapros->setstatus($status);
 $zapros->setanswer('');
 
 foreach ($checkedcompanies as $checkedcompaniestem){
         $project->setNameCompany($checkedcompaniestem);
         $zapros->setNameCompany($checkedcompaniestem);
         
         

         // echo $freeManager['name'] . $freeManager['load'];

         if( $project->checkExistaManagerInProject()== true) {
           
          $html =   ' ' . $checkedcompaniestem . ' - <b>Нет назначенных менеджеров. </b><br>';

        }
        
        else {
          $freeManager = $project->checkMostFreeManager();
       
          if (($freeManager['load']+$selectedLevel)>40){
            $html =  ' ' . $checkedcompaniestem . ' - <b>Нет свободных менеджеров</b> <br>';
          }
         
          else { 
            $manager = $freeManager['name'];
            $zapros->setmanager($freeManager['name']);
            $zapros->savezapros();
            //echo "ok";
            $html =  $checkedcompaniestem .'. '. 'Назначен менеджер - <b>' . $manager . '</b><br>';
          }
  
         
        

}
echo  $html;
 }

}


 // print_r ($checkedcompanies);


 


   }


  
?>
