<div class="tab-pane fade" id="v-tabs-manager" role="tabpanel" aria-labelledby="v-tabs-manager-tab">
       Управление менеджерами
       <div class="add_manager pt-2"><button type="button" class="btn btn-primary"  data-mdb-toggle="modal" id="new-manager-btn"  data-mdb-target="#addmanagerModal">Создать нового менеджера <i class="fas fa-plus-circle"></i></button></div>
<hr>

<div class="companycontrol  mt-4">
<?php $managerArr =  $manager->showManagerList();?>
    <?php foreach ($managerArr as  $managerItem):?>

      <?php 
      $listproject->setnameManager($managerItem['name_manager']);
      $loaddMan = $listproject->checkManagerTotalLoadInAllProjects();
      $kolproj = $listproject->checkManagerTotalProjects();
      
      ?>
        <div class="row  bg-light mt-4">
     
      <div class="col-6"><b><?php echo $managerItem['name_manager']?>.</b>  Общая загруженность <b><?php echo $loaddMan;?>.</b> Кол-во участия в компаниях  <b><?php echo $kolproj;?></b></div> 
             
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