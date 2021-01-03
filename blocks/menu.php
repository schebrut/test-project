<?php 
require ('db/manager.php');
$manager =  new manager();

$url = $_SERVER['REQUEST_URI'];
$url = str_replace("/", "",$url);
$url = trim($url);
?>

<div class="col-3">
  <ul class="nav nav-tabs flex-sm-column">
  <li class="nav-item">
    <a class="nav-link <?php if ($url == 'index.php') echo "active"; ?>" href="index.php">Текущие заказы</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php if ($url == 'companies_control.php') echo "active"; ?>" href="companies_control.php">Управление компаниями</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php if ($url == 'manager_control.php') echo "active"; ?>" href="manager_control.php">Управление менеджерами</a>
  </li>
 <br> <hr>

 <li class="nav-item">
    <a class="nav-link" href="/client.php" target="_blank">Оформление заявки</a>
  </li>
  <br> <hr>
  <li class="nav-item">
    <a class="nav-link"><b>Менеджеры:</b></a>
  </li>

  <?php $managerArr =  $manager->showManagerList();?>
    <?php foreach ($managerArr as  $managerItem):?>
      <li class="nav-item">
    <a class="nav-link" href="/manager.php/?name=<?php echo $managerItem['name_manager']?>" target="_blank"><?php echo $managerItem['name_manager']?></a>
  </li>
      
    <?php endforeach; ?> 


</ul>
</div><!-- col-2 -->


