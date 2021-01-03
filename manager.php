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
    <title>Заказы. Менеджер <?php echo $nameManager =  $_GET['name'];?></title>
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script> 
    <script src="/js/manager.js"></script>   
    <link rel="icon" href="/img/mdb-favicon.ico" type="image/x-icon" />   
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap"/>  
    <link rel="stylesheet" href="/css/mdb.min.css" />   
    <link rel="stylesheet" href="/css/styles.css">
    
  </head>
  <body>
  <div class="container-fluid">
<div class="row">
<?php include 'blocks/managerMaenu.php';?>

<div class="col-9">
<h5 class="mt-3">Управление заказами. Менеджер <span class="name-manager"><?php echo $nameManager =  $_GET['name'];?></span>.</h5>

<div class="block-manager">
    <?php  $allDatazapros = $zapros->setmanager($nameManager);?>
    <?php  $allDatazapros = $zapros->managerZaprosList();?>
  
  <table class="table table-striped">
 <thead>
    <tr>
      <th scope="col">Номер</th>
      <th scope="col">Сложность</th>
      <th scope="col">Компания</th>     
      <th scope="col">Текст запроса</th>
      <th scope="col">Закрытие заказа</th>      
    </tr>
  </thead>
  <tbody>
  <?php $i=1;?>
  <?php foreach ($allDatazapros as $allDatazaprosItem):?>
    <tr> 
    <th scope="row"><?php echo $i++?></th>
    <td><?php echo $allDatazaprosItem['level_zapros']?></td>
    <td><?php echo $allDatazaprosItem['kompany']?></td>    
    <td><?php echo $allDatazaprosItem['message']?></td>
    <td><button type="button" class="btn btn-primary clase-order" id="<?php echo $allDatazaprosItem['id']?>"> Закрыть заказ</button></td>
    

        </tr>      
<?php endforeach;?>
   
</tbody>
</table>
</div><!-- row -->

</div>

</div><!-- row -->
</div>

  </body>

  <!-- MDB -->
  <script type="text/javascript" src="/js/mdb.min.js"></script>
  <!-- Custom scripts -->
  <script type="text/javascript"></script>
</html>
