<?php 
require ('db/manager.php');
$manager =  new manager(); 
$url = $_GET['name'];
$url = trim($url);
$managerArray = $manager->showManagerList();
?>
<div class="col-3">
<ul class="nav nav-tabs flex-sm-column">
<?php foreach ($managerArray as $managerItem):?>  
  
  <li class="nav-item">
    <a class="nav-link <?php if ($url == $managerItem['name_manager']) echo "active"; ?>" href="/manager.php/?name=<?php echo $managerItem['name_manager'];?>"><?php echo $managerItem['name_manager'];?></a>
  </li>  

<?php endforeach;?>
</ul>
</div><!-- col-2 -->
