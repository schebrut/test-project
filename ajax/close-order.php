<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){ 
    require ('../db/zapros.php');
    $zapros =  new zapros();
    $id=  $_POST['id'];
    $zapros->setId($id);
    $zapros->closeZapros();   
echo "удален";
  

}
  
?>
