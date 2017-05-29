<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:login.php");
}

include_once '../DAO/Registro/Schedule.php';
//include_once '../DAO/Registro/Usuario.php';
$privilegios = $_SESSION['array_menus'];

if (isset($_SESSION['accion_schedule']) && $_SESSION['accion_schedule'] != '') {

    if ($_SESSION['accion_schedule'] == 'detalle_schedule') {
        $actividades = $_SESSION['arreglo_actividad_por_schedule'];
    } 
    if ($_SESSION['accion_schedule'] == 'filtro_schedule_activo') {
        $actividades = $_SESSION['arreglo_filtro_schedule'];
    }
} 

?>
<!DOCTYPE html>
<html lang="en">
    <head>
<!--        <META HTTP-EQUIV="REFRESH" CONTENT="300;URL=DetalleScheduleOpe.php">-->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Dashboard">
        <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

        <title>SISTEMA DE GENERACIÓN DE SCHEDULE</title>

        <!-- Bootstrap core CSS -->
        <link href="../Recursos/../Recursos/assets/css/bootstrap.css" rel="stylesheet">
         <link rel="stylesheet" type="text/css" href="../Recursos/assets/js/gritter/css/jquery.gritter.css" />
        <!--external css-->
        <link href="../Recursos/../Recursos/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

        <!-- Custom styles for this template -->
        <link href="../Recursos/../Recursos/assets/css/style.css" rel="stylesheet">
        <link href="../Recursos/css/StyleGeneral.css" rel="stylesheet">
        <link href="../Recursos/../Recursos/assets/css/style-responsive.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css">

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
            <!--sidebar start-->
           <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
                  <p class="centered"><a href="profile.html"><img src="../Controles/Fotos/<?php echo $_SESSION['foto']; ?>" class="img-circle" width="60"></a></p>
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
                      <a href="javascript:;" >
                          <i class="fa fa-tasks"></i>
                          <span>Actividad</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="MantenerActividad.php">Consultar Actividades</a></li>
                          <li><a  href="GuardarActividad.php">Registrar Actividad</a></li>
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
                      <a href="javascript:;" class="active">
                          <i class="fa fa-fax"></i>
                          <span>Ejecutar Schedule</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="SeleccionarSchedule.php">Seleccionar Schedule</a></li>
                          <li><a  href="MisSchedules.php">Mis Schedules</a></li>
                          <li class="active"><a  href="SchedulesActivos.php">Schedules Activos</a></li>
                          <li><a  href="SchedulesFinalizados.php">Schedules Finalizados</a></li>
                          <li><a  href="TareasPendientes.php">Tareas Pendientes</a></li>
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
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-clock-o"></i>
                          <span>Tareas Pendientes</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="TareasPendientes.php">Tareas Pendientes</a></li>
                      </ul>
                  </li>
                  
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
                    <h3><i class="fa fa-angle-right"></i> VER SCHEDULE ACTIVO</h3>
                    
                    <div class="row mt">
                        <div class="col-md-12">
                            <div class="content-panel">
                                <table id="example1" class="table table-striped table-advance table-hover">
                                    <h4><i class="fa fa-angle-right"></i> DETALLE DE ACTIVIDADES DEL SCHEDULE</h4>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="background-color:#68FF7E;font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;&nbsp;&nbsp;TAREAS OBLIGATORIA
                                    <hr>

<?php if ($actividades != null) { ?>
                                        <thead>
                                            <tr style="font-size:6pt;font-weight: bold;">
                                                <th><i></i> N°</th>
                                                <th><i></i> PTE</th>
                                                <th><i></i> FRECUENCIA</th>
                                                <th><i></i> DESCRIPCIÓN</th>
                                                <th><i></i> HORA EJECUCIÓN</th>   
                                                <th><i></i> PROCEDIMIENTO</th>
                                                <th><i></i> PERIODO</th>                                          
                                            </tr>
                                        </thead>
                                        <tbody>
                            <?php
                            $num = 1;
                            foreach ($actividades as $r) {                              
                                ?>
                                                <tr style="font-size:8pt;"  <?php if ($r['actividad_obligatoria'] == '1') echo 'bgcolor="68FF7E"'; ?>>
                                                        <td style="font-size:8pt;font-weight: bold;"><?php
                                                            echo $num;
                                                            $num++;
                                                            ?></td>
                                                        
                                                        <td style="font-size:8pt; font-weight: bold;"><?php
                                                        if ($r['actividad_pte'] == '1') {
                                                            echo 'ACSELX';
                                                        }
                                                        if ($r['actividad_pte'] == '2') {
                                                            echo 'AIX';
                                                        }
                                                        if ($r['actividad_pte'] == '3') {
                                                            echo 'AS400';
                                                        }
                                                        if ($r['actividad_pte'] == '4') {
                                                            echo 'DATA CENTER';
                                                        }
                                                        if ($r['actividad_pte'] == '5') {
                                                            echo 'DATASTAGE';
                                                        }
                                                        if ($r['actividad_pte'] == '6') {
                                                            echo 'LEGATO';
                                                        }
                                                        if ($r['actividad_pte'] == '7') {
                                                            echo 'MOD, WEB';
                                                        }
                                                        if ($r['actividad_pte'] == '8') {
                                                            echo 'NOTES';
                                                        }
                                                        if ($r['actividad_pte'] == '9') {
                                                            echo 'RSALUD';
                                                        }
                                                        if ($r['actividad_pte'] == '10') {
                                                            echo 'SISO';
                                                        }
                                                        if ($r['actividad_pte'] == '11') {
                                                            echo 'SITEDS';
                                                        }
                                                        if ($r['actividad_pte'] == '12') {
                                                            echo 'WINDOWS';
                                                        }
                                                        ?></td>
                                                        <td style="font-size:8pt;color:black; font-weight: bold;"><?php echo $r['periodo_nombre'] ?></td>
                                                        <td style="font-size:10pt;color:black; font-weight: bold;"><?php echo $r['actividad_descripcion'] ?></td>
                                                        <td style="font-size:8pt;color:black; font-weight: bold;"><?php echo $r['actividad_horaejecucion'] ?></td>
                                                         <td align="center">
                                                        <?php if ($r['procedimiento_nombre'] != 'NO TIENE') { ?> 
                                                            <a href="../Controles/Procedimientos/<?php echo $r['procedimiento_archivo'] ?>" target="_new" class="label label-info label-mini"><?php echo $r['procedimiento_nombre'] ?></a>
                                                        <?php
                                                        } else {
                                                            echo '<a class="label label-danger label-mini"> NO TIENE </a>';
                                                        }
                                                        ?>     
                                                        </td>
                                                        <td style="font-size:8pt;color:black; font-weight: bold;"><?php echo $r['periodo_nombre'] ?></td>                                                        
                                                </tr>
                                            <?php } ?>

                                        </tbody>
                                    <?php } else { ?>


<div class="alert alert-danger"><i class="fa fa-warning"></i><b> Error!</b><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Su búsqueda no produjo ningún resultado..!</div> 
<!--                                        <center><label>Su búsqueda no produjo ningún resultado. </label></center>-->


                                    <?php } ?>
                                </table>
                                
                            </div><!-- /content-panel -->
                            <br>
                                <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label"></label>
                              <div class="col-sm-10">                                  
                                  <button type="button" class="btn btn-danger"  onclick="cancelar();"><i class="fa fa-trash-o"></i> CANCELAR</button>
                              </div>
                          </div>
                        </div><!-- /col-md-12 -->
                    </div>
            
                </section><! --/wrapper -->
            </section><!-- /MAIN CONTENT -->

            <!--main content end-->
            <!--footer start-->
            <footer class="site-footer">
                <div class="text-center">
                    2015 - IBM OPERATION SERVICE
                    <a href="VerScheduleActivo.php" class="go-top">
                        <i class="fa fa-angle-up"></i>
                    </a>
                </div>
            </footer>
            <!--footer end-->
        </section>

        <!-- js placed at the end of the document so the pages load faster -->
        <script src="../Recursos/../Recursos/assets/js/jquery.js"></script>
        <script src="../Recursos/../Recursos/assets/js/bootstrap.min.js"></script>
        <script class="include" type="text/javascript" src="../Recursos/../Recursos/assets/js/jquery.dcjqaccordion.2.7.js"></script>
        <script src="../Recursos/../Recursos/assets/js/jquery.scrollTo.min.js"></script>
        <script src="../Recursos/../Recursos/assets/js/jquery.nicescroll.js" type="text/javascript"></script>
        <!-- Unicas Librerias Utiliazabas para subir archivos imagens, audio, etc-->
        <link href="../Recursos/filebootstrap/kartik-v-bootstrap-fileinput-d66e684/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
        <script src="../Recursos/filebootstrap/kartik-v-bootstrap-fileinput-d66e684/js/fileinput.js" type="text/javascript"></script>    
        <!-- fin -->
        <script type="text/javascript" src="../Recursos/js/JSGeneral.js"></script>
        <!--common script for all pages-->
        <script src="../Recursos/../Recursos/assets/js/common-scripts.js"></script>
        <!--script for this page-->
    <!--script for this page-->
    <script type="text/javascript" src="../Recursos/assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="../Recursos/assets/js/gritter-conf.js"></script>
    
            <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
<!--       <script src="cdn.datatables.net/buttons/1.3.1/js/buttons.flash.min.js"></script -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<!--       <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>   -->
<!--       <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>-->
        <script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
<!--        <script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.print.min.js"></script>-->


        <script>
        $(document).ready(function() {
    $('#example1').DataTable( {
        dom: 'Bfrtip',
        buttons : [
								{
								extend : 'pageLength',
								text : '<i class="fa fa-list-ol" aria-hidden="true" style="font-size:8pt;color:black; font-weight: bold;"> &nbsp;&nbsp; MOSTRAR</i>',
							},
							{
								extend : 'excelHtml5',
								text : '<i class="fa fa-file-excel-o" style="font-size:8pt;color:black; font-weight: bold;">&nbsp;&nbsp; DESCARGAR EN EXCEL</i>',
// 								className : 'btn btn-default',
								customize : function(
										xlsx) {
									var sheet = xlsx.xl.worksheets['reporte_schedule.xml'];

									// jQuery selector to add a border
									$('row c[r*="10"]',sheet).attr('s','25');
								}
							} ]
    } );
} );
 </script> 
    <?php if ($ventanas != null) { ?>
                        <?php
                            $num = 1;
                            foreach ($ventanas as $v) {                              
                         ?>
        <script type="text/javascript">
        $(document).ready(function () {
        var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'VENTANA MÁXIMA',
            // (string | mandatory) the text inside the notification
            text: '<marquee direction="up" behavior="alternate">TAREA:<br><?php echo $v['actividad_descripcion'];?> <br><br>Cliente:<?php echo $v['cliente_nombre'];?> <br><br>Hora Máxima de Ventana: <?php echo $v['actividad_ventana_max'];?> <br><br>Accion a Tomar: <?php echo $v['actividad_accion'];?></marquee> ',
            // (string | optional) the image to display on the left
            image: '../Recursos/assets/img/limites.jpg',
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: true,
            // (int | optional) the time you want it to be alive for before fading out
            time: '',
            // (string | optional) the class name you want to apply to that specific message
            class_name: 'my-sticky-class'
        });

        return false;
        });
	</script>
        <?php } ?> 
    <?php } ?>  
        
    </body>
</html>
