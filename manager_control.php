<?php require ('db/company.php');
    $company =  new company(); 
  //  require ('db/manager.php');
  //  $manager =  new manager();
    require ('db/project.php');
    $listproject =  new project();
    
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
    
        
<div class="add_manager pt-2"><button type="button" class="btn btn-primary"  data-mdb-toggle="modal" id="new-manager-btn"  data-mdb-target="#addmanagerModal">Создать нового менеджера <i class="fas fa-plus-circle"></i></button></div>
<hr>

<div class="companycontrol  mt-4">
<?php $managerArr =  $manager->showManagerList();?>
    <?php foreach ($managerArr as  $managerItem):?>

      <?php 
      $listproject->setnameManager($managerItem['name_manager']);
      $loaddMan = $listproject->checkManagerTotalLoadInAllProjects();
      $kolproj = $listproject->checkManagerTotalProjects();
      $totalLoad = $listproject->checkManagerTotalLoad();
      ?>
        <div class="row  bg-light mt-4">
     
      <div class="col-10"><b><a href="manager.php/?name=<?php echo $managerItem['name_manager']?>" target="_blank"><?php echo $managerItem['name_manager']?></a>.</b>  Загруженность по компаниям <b><?php echo $loaddMan;?>.</b> Кол-во участия в компаниях  <b><?php echo $kolproj;?></b>.</b> Общая загруженность  <b><?php echo $totalLoad;?></b></div> 
             
      </div><!-- row --> 
    <?php endforeach; ?> 
    
</div>   <!-- companycontrol -->


<!-- Modal -->
<div class="modal fade" id="addmanagerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Добавление менеджера</h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">          
      <div class="error-add-bd-man mb-2 text-danger"></div>
          <div class="form-outline" id="add-new-company-manager">
            <input type="text" id="add-manager-text" class="form-control" />
            
            <label class="form-label" for="form1">Введите имя менеджера</label>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="close-modal-add-manager" data-mdb-dismiss="modal">Закрыть</button>
        <button type="button" class="btn btn-primary" id="add-manager-btn">Добавить</button>
      </div>
    </div>
  </div>
</div>
<!--  Modal -->
    

    </div>

</div><!-- row -->
</div>

  </body>

  <!-- MDB -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Custom scripts -->
  <script type="text/javascript"></script>
</html>
