<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:login.php");
}
//------------------------------------------------
include_once '../DAO/Registro/Turno.php';
include_once '../DAO/Registro/Dia.php';
include_once '../DAO/Registro/Procedimiento.php';
include_once '../DAO/Registro/Periodo.php';

$dia = new Dia();
$dias = $dia->listar();


$turno = new Turno();
$turnos = $turno->listar();

$procedimiento = new Procedimiento();
$procedimientos = $procedimiento->listar();

$periodo = new Periodo();
$periodos = $periodo->listar();

$privilegios = $_SESSION['array_menus'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>SISTEMA DE GENERACIÓN DE SCHEDULE</title>

    <!-- Bootstrap core CSS -->
    <link href="../Recursos/assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="../Recursos/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="../Recursos/assets/js/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="../Recursos/assets/js/bootstrap-daterangepicker/daterangepicker.css" />
    <!-- para calendario -->
    <link href="../Recursos/assets/js/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
    <!-- Aaqui muere -->    
    <!-- Custom styles for this template -->
    <link href="../Recursos/assets/css/style.css" rel="stylesheet">
    <link href="../Recursos/assets/css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body onload="nobackbutton();">

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
     <?php require 'Cabecera.php' ?>
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
                  <p class="centered"><a href="#"><img src="../Controles/Fotos/<?php echo $_SESSION['foto']; ?>" class="img-circle" width="60"></a></p>
              	  <h5 class="centered"><?php echo $_SESSION['user_personal'] ?></h5>              	  
                  <li class="mt">
                      <a href="index.php">
                          <i class="fa fa-dashboard"></i>
                          <span>Resumen</span>
                      </a>
                  </li>
                  
                  <?php if ($privilegios != null) { ?>
                   <?php foreach ($privilegios as $p) {    ?>
                  
                  <?php if ($p['menu_idmenu']==1) {?>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-users"></i>
                          <span>Usuarios</span>
                      </a>
                      <ul class="sub">
                          <li><a href="GuardarUsuario.php">Registrar Usuario</a></li>
                          <li><a  href="MantenerUsuario.php">Administrar Usuarios</a></li>
                          <li><a  href="AsignarPrivilegios.php">Asignar Privilegios</a></li>
                          <li><a  href="MantenerPrivilegios.php">Administrar Privilegios</a></li>
                      </ul>
                  </li>
                  <?php } ?>
                  <?php if ($p['menu_idmenu']==2) {?>
                  <li class="sub-menu">
                      <a href="javascript:;" class="active" >
                          <i class="fa fa-tasks"></i>
                          <span>Actividad</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="MantenerActividad.php">Consultar Actividades</a></li>
                          <li class="active"><a  href="GuardarActividad.php">Registrar Actividad</a></li>
                      </ul>
                  </li>
                  <?php } ?>
                  <?php if ($p['menu_idmenu']==3) {?>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-calendar"></i>
                          <span>Periodo</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="MantenerPeriodo.php">Consultar Periodos</a></li>
                          <li><a  href="GuardarPeriodo.php">Registrar Periodo</a></li>
                      </ul>
                  </li>
                  <?php } ?>
                  
                  <?php if ($p['menu_idmenu']==4) {?>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-barcode"></i>
                          <span>Procedimiento</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="MantenerProcedimiento.php">Consultar Procedimientos</a></li>
                          <li><a  href="GuardarProcedimiento.php">Registrar Procedimiento</a></li>
                      </ul>
                  </li>
                  <?php } ?>
                  
                  
                 <?php if ($p['menu_idmenu']==5) {?>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-fax"></i>
                          <span>Ejecutar Schedule</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="SeleccionarSchedule.php">Seleccionar Schedule</a></li>
                          <li><a  href="MisSchedules.php">Mis Schedules</a></li>
                          <li><a  href="SchedulesActivos.php">Schedules Activos</a></li>
                          <li><a  href="SchedulesFinalizados.php">Schedules Finalizados</a></li>
<!--                          <li><a  href="TareasPendientes.php">Tareas Pendientes</a></li>-->
                      </ul>
                  </li>
                  <?php } ?>                   
                  
                 <?php if ($p['menu_idmenu']==6) {?>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-file-excel-o"></i>
                          <span>Subir Excel</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="GuardarExcel.php">Guardar EXCEL</a></li>
                      </ul>
                  </li>
                  <?php } ?>  
                  
                   <?php } ?>
                  <?php } ?>
<!--                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-clock-o"></i>
                          <span>Tareas Pendientes</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="TareasPendientes.php">Tareas Pendientes</a></li>
                      </ul>
                  </li>-->
                  
                       <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-warning"></i>
                          <span>Cambiar Contraseña</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="CambiarContrasenia.php">Cambiar Contraseña</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-lock"></i>
                          <span>Bloquear Sistema</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="lock_screen.php">Bloquear Sistema</a></li>
                      </ul>
                  </li>
                  </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
          	<h3><i class="fa fa-angle-right"></i> REGISTRAR ACTIVIDAD</h3> 
                
                
                     
                     <!-- Datos del Usuario -->
          	<div class="row mt">
          		<div class="col-lg-12">
                  <div class="form-panel">
                  	  <h4 class="mb"><i class="fa fa-angle-right"></i> DATOS DE LA ACTIVIDAD</h4>
                    
                 <form class="form-horizontal style-form" action="../Controles/Registro/CActividad.php" method="POST" >
                 <input type="hidden" id="hiddenactividad" name="hidden_actividad" value="registrar">  
                 
                 <div class="form-group">
                                        <label for="inputturno" class="col-sm-2 control-label">Turno</label>
                                        <div class="col-sm-10">
                                            <select class="form-control select2" name="c_turno" id="id_turno" >

                                                <option value=""> --SELECCIONE--</option>
                                            <option value="1">Mañana (7:00  a 15:00)</option>
                                            <option value="2">Tarde  (15:00 a 23:00)</option>
                                            <option value="3">Noche  (23:00 a 07:00)</option>

                                                      </select>
                                        </div>
                     </div>
                 <div class="form-group">
                                        <label for="inputturnob" class="col-sm-2 control-label">Turno 2</label>
                                        <div class="col-sm-10">
                                            <select class="form-control select2" name="c_turnob" id="id_turnob">

                                                <option value="">--SELECCIONE--</option>
                                            <option value="4">Mañana - Tarde (7:00  a 19:00)</option>
                                            <option value="5">Tarde - Noche  (19:00 a 07:00)</option>

                                                      </select>
                                        </div>
                     </div>
                 <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Seleccionar Días</label>
                                        <div class="col-sm-10">                                            
                                            <?php foreach ($dias as $d) { 
                                                    
                                                ?>
                                            
                                            <label class="checkbox-inline">
                                                <input type="checkbox" id="inlineCheckbox<?php echo $d['dia_iddia']; ?>" name="check_list[]" value="<?php echo $d['dia_iddia']; ?>"> <?php echo $d['dia_nombre']; ?>
                                            </label>
                                            <br>
                                                    <?php } ?>                                   
                                        </div>
                        </div>
                        <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">PERIODO</label>
                                <div class="col-sm-10">
                                        <select class="form-control" name="c_periodo" id="id_periodo">

                                            <option>--SELECCIONE--</option>
                                                                        <?php foreach ($periodos as $p) {   
                                                                          ?>

                                                                          <option value="<?php echo $p['periodo_idperiodo']; ?>"><?php echo $p['periodo_nombre']; ?></option>
                                                                      <?php } ?>

                                                      </select>
                                    </div>
                          </div>
                 
                          <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">PTE</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="c_pte" required>
                                                <option value="">--SELECCIONE--</option>
                                                <option value="1">ACSELX</option>
                                                <option value="2">AIX</option>
                                                <option value="3">AS400</option>
                                                <option value="4">DATA CENTER</option>
                                                <option value="5">DATASTAGE</option>
                                                <option value="6">LEGATO</option>
                                                <option value="7">MOD, WEB</option>
                                                <option value="8">NOTES</option>
                                                <option value="9">RSALUD</option>
                                                <option value="10">SISO</option>
                                                <option value="11">SITEDS</option>
                                                <option value="12">WINDOWS</option>
                                                <option value="13">VISANET</option>
                                            </select>
                                        </div>
                        </div>
                       
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">DESCRIPCIÓN DE LA ACTIVIDAD</label>
                              <div class="col-sm-10">
                                  <textarea name="ta_descripcion" id="id_descripcion" class="form-control" rows="8" required></textarea>
                              </div>
                          </div>  
                         <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">PROCEDIMIENTOS</label>
                                <div class="col-sm-10">
                                        <select class="form-control" name="c_procedimiento" id="id_procedimiento" >

                                            <option>--SELECCIONE--</option>
                                                                        <?php foreach ($procedimientos as $p) {   
                                                                          ?>

                                                                          <option value="<?php echo $p['procedimiento_idprocedimiento']; ?>" ><?php echo $p['procedimiento_nombre']; ?></option>
                                                                      <?php } ?>

                                                      </select>
                                    </div>
                          </div>
                                  
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">HORA EJECUCIÓN</label>
                              <div class="col-sm-10">
                                  <input type="time" name="t_hora" maxlength="8" class="form-control" required>
                              </div>
                          </div>


                          <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">TAREA OBLIGATORIA</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="c_obligatoria">
                                                <option value="">--SELECCIONE--</option>
                                                <option value="1">SI</option>
                                                <option value="2">NO</option>
                                            </select>
                                        </div>
                        </div>
                        <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label"></label>
                              <div class="col-sm-10">
                                  <button type="submit" class="btn btn-theme"><i class="fa fa-check"></i> GUARDAR</button>
                                  <button type="button" class="btn btn-danger" onclick="cancelar();"><i class="fa fa-trash-o"></i> CANCELAR</button>
                              </div>
                          </div>

                    </form>      
                         
                  </div>
                            
                            
          		</div><!-- col-lg-12-
                ->      	
-->          	</div>
		</section>
      </section><!-- /MAIN CONTENT -->

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              2015 - IBM OPERATION SERVICE
              <a href="GuardarProcedimiento.php" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="../Recursos/assets/js/jquery.js"></script>
    <script src="../Recursos/assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="../Recursos/assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="../Recursos/assets/js/jquery.scrollTo.min.js"></script>
    <script src="../Recursos/assets/js/jquery.nicescroll.js" type="text/javascript"></script>


    <!--common script for all pages-->
    <script src="../Recursos/assets/js/common-scripts.js"></script>

    <!--script for this page-->
    <script src="../Recursos/assets/js/jquery-ui-1.9.2.custom.min.js"></script>

	<!--custom switch-->
	<script src="../Recursos/assets/js/bootstrap-switch.js"></script>
	
	<!--custom tagsinput-->
	<script src="../Recursos/assets/js/jquery.tagsinput.js"></script>
        
        <!-- para calendario -->
        <script src="../Recursos/assets/js/fullcalendar/fullcalendar.min.js"></script>   
        <script src="../Recursos/assets/js/calendar-conf-events.js"></script>   
	<!-- para calendario -->
        
	<!--custom checkbox & radio-->
	
	<script type="text/javascript" src="../Recursos/assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="../Recursos/assets/js/bootstrap-daterangepicker/date.js"></script>
	<script type="text/javascript" src="../Recursos/assets/js/bootstrap-daterangepicker/daterangepicker.js"></script>
	
	<script type="text/javascript" src="../Recursos/assets/js/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
        <script type="text/javascript" src="../Recursos/js/JSGeneral.js"></script>
	
	<script src="../Recursos/assets/js/form-component.js"></script>    
 
    
  <script>
      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

  </script>
  <?php if(isset($_SESSION['accion_actividad'])){ 
     if($_SESSION['accion_actividad']=='editar'){

    ?>
    <script type="text/javascript">
        
   
             cargarTurnosPorSede();
             cargarSubcatPorCat();
    </script>

    <?php }}?>
    

  </body>
</html>
