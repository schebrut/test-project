<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){ 
    require ('../db/company.php');
    $addnewCompany =  new company();
    
    if (trim($_POST['nameCompany'])==''){
        echo "isNull";
    }
else {
    $addnewCompany->setNameCompany(trim($_POST['nameCompany']));
    
    
    if ($addnewCompany->checkExistCompany()==true){
        $addnewCompany->saveCompany();
        echo "true";
    }  
       else {
           echo "false";
       }
    }
}
?>