<?php 
    require ('db/zapros.php');
    $zapros =  new zapros();
    require ('db/project.php');
    $project =  new project();    
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Управление распределиниями заказов</title>
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script> 
    <script src="/js/company.js"></script>

    <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />   
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap"/>  
    <link rel="stylesheet" href="css/mdb.min.css" />   
    <link rel="stylesheet" href="css/styles.css">
    
  </head>
  <body>
  <div class="container-fluid">
<div class="row">
<?php include 'blocks/menu.php';?>

<div class="col-9">
<h5 class="mt-3">Текущие заказы </h5>
<div class="text-message"></div>

  <?php  $allDatazapros = $zapros->showZaprosList();?>
  
  <table class="table table-striped">
 <thead>
    <tr>
      <th scope="col">Номер</th>
      <th scope="col">Сложность</th>
      <th scope="col">Компания</th>
      <th scope="col">Менеджер</th>
      <th scope="col">Текст запроса</th>      
    </tr>
  </thead>
  <tbody>
  <?php $i=0;?>
  <?php foreach ($allDatazapros as $allDatazaprosItem):?>
    <?php $i=$i+1;?>
    <tr> 
    <th scope="row"><?php echo  $i;?></th>
    <td><?php echo $allDatazaprosItem['level_zapros']?></td>
    <td><?php echo $allDatazaprosItem['kompany']?></td>
    <td>
  <?php $project->setNameCompany($allDatazaprosItem['kompany']);?> 
  <?php $projectArray =  $project->showManagersSortByload();?> 
  <select class="form-control select-manager">  
  <option selected><?php echo $allDatazaprosItem['manager']?></option>
  <?php foreach ($projectArray as  $projectArrayItem):?>
   <option value="<?php echo $allDatazaprosItem['kompany']?>" id="<?php echo $allDatazaprosItem['id']?>" name="<?php echo $projectArrayItem['name']?>"><?php echo $projectArrayItem['name']?> - <?php echo $projectArrayItem['load']?></option>
   <?php endforeach; ?>  
</select>    
    </td>
    <td><?php echo $allDatazaprosItem['message']?></td>   

        </tr>      
<?php endforeach;?>
   
</tbody>
</table>


</div>

</div><!-- row -->
</div>

  </body>

  <!-- MDB -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Custom scripts -->
  <script type="text/javascript"></script>
</html>
