<!DOCTYPE html>
<html>
<head>
  <title>Prueba socket SSL</title>
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

	<link href="<?php echo BASE_PUBLIC?>/css/menu.css" rel="stylesheet">
  <link href="<?php echo BASE_PUBLIC?>/css/chat.css" rel="stylesheet">
  <script type="text/javascript" src="<?php echo BASE_PUBLIC?>/js/menu.js"></script>
  <script type="text/javascript" src="<?php echo BASE_PUBLIC?>/scrollintoview/jquery.scrollintoview.min.js"></script>
</head>
<body>
<nav class="navbar navbar-default sidebar" role="navigation">
    <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>      
    </div>
    <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="m-li active"><a href="#">Home<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-home"></span></a></li>
        <li class="m-li dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Usuarios <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span></a>
          <ul class="dropdown-menu forAnimate" role="menu">
            <li><a href="#">Crear</a></li>
            <li><a href="#">Modificar</a></li>
            <li><a href="#">Reportar</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">Informes</a></li>
          </ul>
        </li>          
        <li class="m-li"><a href="#">Libros<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-th-list"></span></a></li>        
        <li class="m-li"><a href="#">Tags<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-tags"></span></a></li>
      </ul>
    </div>
  </div>
</nav>
<div id="control_menu" class="control_menu"></div>
<nav class="nav-top navbar navbar-default header-content vertical-center">  
  <div class="container">
    <div class="row">
      <div class="col-md-10">
        <div class="tit_sup">CHAT</div>
      </div>
      <div class="col-md-2">
        <div class="login">
        <div href="#"><?php echo $_SESSION[SESSION_NAME_USER]->usu_nombre;?></div>
        </div>
      </div>
    </div>
  </div>
</nav>

<div class="container" id="body_cont">
  <div class="row">
