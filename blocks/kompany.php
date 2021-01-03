<div class="tab-pane fade show active" id="v-tabs-profile" role="tabpanel" aria-labelledby="v-tabs-profile-tab">
       Управление компаниями      
 <div class="add_company pt-2"><button type="button" class="btn btn-primary"  data-mdb-toggle="modal" id="new-company-btn"  data-mdb-target="#addCompanyModal">Создать новую компанию <i class="fas fa-plus-circle"></i></button></div>
<hr>

<div class="companycontrol  mt-4">
<?php $companyArr =  $company->showCompaliList();?>
    <?php foreach ($companyArr as  $companyItem):?>
       <div class="row  bg-light ">     
      <div class="col-2 font-weight-bold"><?php echo $companyItem['name_company']?></div>
      <div class="col-10"><button type="button" class="btn btn-sm btn-primary setManager"  data-mdb-toggle="modal" id="<?php echo $companyItem['name_company']?>"  data-mdb-target="#addManagerModal">Добавить менеджера в компанию <i class="fas fa-plus-circle"></i></button></div>              
             </div><!-- row --> 
            
             <?php $listproject->setNameCompany($companyItem['name_company']);?>
             <?php $projectArray =  $listproject->showProjectList();?> 

             <div class="row mt-2"> 
            
             <?php foreach ($projectArray as  $projectArrayItem):?>      
              
              <div class="col-12 mt-2"><button type="button" class="btn btn-info  btn-rounded btn-sm delete-manager" id="<?php echo $projectArrayItem['id']?>"  data-mdb-toggle="modal" data-mdb-target="#deleteCmanager"><i class="far fa-trash-alt"> </i></button> <b>&nbsp;&nbsp; <?php echo $projectArrayItem['manager']?>.</b> Вовлеченность: <b><?php echo $projectArrayItem['projectt_load']?></b></div>
              
              <?php endforeach; ?> 
              
             </div><!-- row -->
             <hr>
   <?php endforeach; ?> 
    
</div>   <!-- companycontrol -->



<!-- Modal -->
<div class="modal fade" id="addManagerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Добавление менеджера в <span class="namecompmodal"></span></h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="error-add-man mb-2 text-danger"></div>
        <p>Список доступных менеджеров</p> 
        <div class="add-manager-btn-group"></div> 
          <div class="add-manager-info"></div>

          <div class="add-load-info pt-3"></div>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="close-modal-add-manager-to-company" data-mdb-dismiss="modal">Закрыть</button>
        <button type="button" class="btn btn-primary" id="add-manager-company-btn">Добавить</button>
      </div>
    </div>
  </div>
</div>
<!--  Modal -->



      
<!-- Modal -->
<div class="modal fade" id="addCompanyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Добавление новой компании</h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">          
      <div class="error-add-bd mb-2 text-danger"></div>
          <div class="form-outline" id="add-new-company">
            <input type="text" id="add-company-text" class="form-control" />
            
            <label class="form-label" for="form1">Введите имя компании</label>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="close-modal-add-company" data-mdb-dismiss="modal">Закрыть</button>
        <button type="button" class="btn btn-primary" id="add-company-btn">Добавить</button>
      </div>
    </div>
  </div>
</div>
<!--  Modal -->


<!-- Modal -->
<div class="modal fade" id="deleteCmanager" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Удаление менеджера из компании</h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">          
      <div class="delete-man mb-2"></div>          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="close-modal-delete" data-mdb-dismiss="modal">Отмена</button>
        <button type="button" class="btn btn-primary" id="delete-manager-btn">Убрать</button>
      </div>
    </div>
  </div>
</div>
<!--  Modal -->



      </div>