<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<title>Prueba ssl socket</title>

<link href="<?php echo BASE_PUBLIC?>/DataTables/style.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo BASE_PUBLIC?>/DataTables/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo BASE_PUBLIC?>/DataTables/bootstrap.css">
<!-- <link rel="stylesheet" type="text/css" href="<?php echo BASE_PUBLIC?>/DataTables/bootstrap.min.css"> -->
<script type="text/javascript" src="<?php echo BASE_PUBLIC?>/DataTables/bootstrap.min.js"></script>

<script type="text/javascript" src="<?php echo BASE_PUBLIC?>/js/util.js"></script>

<script type="text/javascript" src="<?php echo BASE_PUBLIC?>/DataTables/DataTables-1.10.16/js/jquery.dataTables.min.es.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo BASE_PUBLIC?>/DataTables/DataTables-1.10.16/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo BASE_PUBLIC?>/DataTables/Bootstrap-4-4.0.0/css/fontawesome-all.css">


<script type="text/javascript" src="<?php echo BASE_PUBLIC?>/air-datepicker/js/datepicker.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_PUBLIC?>/air-datepicker/js/datepicker.es.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo BASE_PUBLIC?>/air-datepicker/css/datepicker.min.css">
<script type="text/javascript" src="<?php echo BASE_PUBLIC?>/toast/jquery.toast.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_PUBLIC?>/js/jquery.form.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo BASE_PUBLIC?>/toast/jquery.toast.min.css">
<script type="text/javascript" src="<?php echo BASE_PUBLIC?>/js/jquery.fileDownload.js"></script>

<link href="<?php echo BASE_PUBLIC?>/css/login.css" rel="stylesheet">
<!--<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>-->
</head>
<body>
<div class="container">
  
  <div class="row" id="pwd-container">
  <div class="col-md-4"></div>

  <div class="col-md-4">
    <section class="login-form">
    <form method="post" id="frm_login" action="<?php echo (N_PATH<=0 ?  '/'.NAME_PROYECT : '');?>/main/main_controller/userLogin" role="login">
      <img src="<?php echo BASE_PUBLIC?>/img/company.png" class="img-responsive" alt="" />
      <input type="text" name="usuario" placeholder="Usuario" required class="form-control input-lg" />
      <input type="password" class="form-control input-lg" name="password" id="password" placeholder="Contraseña" required="" />
      <div class="pwstrength_viewport_progress"></div>
      <button type="button" id="btn_login" class="btn btn-lg btn-primary btn-block">Ingresar</button>
      <div class="a-blue">
        <a href="#">Registrarse</a> o <a href="#">recuperar contraseña</a>
      </div>

    </form>

    <div class="form-links">
      <a href="#">www.website.com</a>
    </div>
    </section>  
  </div>
  <div class="col-md-4"></div>
</div>   
  
  
</div>
</body>
<footer>
	<!-- <h3>Soy el footer</h3> -->
</footer>
</html>
<script type="text/javascript">
  $(document).ready(function(){

    $("#btn_login").click(function(e){
        e.preventDefault();
        $('#frm_login').submit();
    });

    $('#frm_login').ajaxForm({
        dataType: 'json',
        async: true,
        beforeSubmit: function(formData, jqForm, options){

        },
        success: function(json, statusText, xhr, $form){
          var data = json.data;
          if(data.status == 2){
            window.location.reload();
          }else{
            toastInfo("error",3000,"Usuario o contraseña incorrecto");
          }
        },
    });




  });
</script>