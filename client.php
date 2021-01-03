<?php require ('db/company.php');
    $company =  new company();
    $companyArray = $company ->showCompaliList();   
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Управление распределиниями заказов</title>
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script> 
    <script src="/js/client.js"></script>     
    <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />   
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap"/>  
    <link rel="stylesheet" href="css/mdb.min.css" />   
    <link rel="stylesheet" href="css/styles.css">
    
  </head>
  <body>
     
<div class="container-fluid">
<div class="row">
<div class="col-2">
  
</div><!-- col-2 -->
<div class="col-6">
    
<h1 class="h5">Добрый день уважаемый клиент, на этой странице вы можете отправить запрос менеджеру.</h1>
<hr>
<div class="errors text-danger"></div>
<div class="select-level mt-3">
 <b> Выберете уровень сложности запроса:</b>
<select class="form-control select-level">   
  <option selected>Выберете уровень сложности запроса</option>
  <option value="1">Легкий</option>
  <option value="2">Средний</option>
  <option value="3">Сложный</option>
  <option value="4">Очень сложный</option>
  <option value="5">Уровень эксперта</option>
</select>
</div>

<div class="company mt-4">
<b> Выберете компанию в кторою хотите  отправить запрос:</b>

<?php foreach($companyArray as $companyItem): ?>
<div class="form-check">
  <input    class="form-check-input check-companies" type="checkbox"  value="" id="<?php echo $companyItem['name_company'];?>"/>
  <label class="form-check-label" for="flexCheckDefault">
  <?php echo $companyItem['name_company'];?>
  </label>
</div>
<?php endforeach?>
</div>
<div class="zapros mt-4">
<b>Введите запрос:</b>
<div class="form-outline">    
  <input type="text" id="form1" class="form-control zapros-text" />
  <label class="form-label" for="form1">Введите текст  запроса</label>
</div>
</div>
<button type="button" class="btn btn-primary mt-3" id="client-btn">Отправить запрос на рассмотрение </button>
<br><br>
<div class="status-zapros"></div>
</div>



</div><!-- row -->
</div>

  </body>

  <!-- MDB -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Custom scripts -->
  <script type="text/javascript"></script>
</html>
