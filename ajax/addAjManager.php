<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){ 
    require ('../db/manager.php');
    $addnewManager =  new manager();
  
    if (trim($_POST['nameManager'])==''){
        echo "isNull";
    }
else {
    $addnewManager->setNameManager(trim($_POST['nameManager']));
    
    
    if ($addnewManager->checkExistManager()==true){
        $addnewManager->saveManager();
        echo "true";
    }  
       else {
           echo "false";
       }
    }
    
}
?>