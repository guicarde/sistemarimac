<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:login.php");
}

include_once '../DAO/Registro/Schedule.php';
include_once '../DAO/Registro/Usuario.php';
$privilegios = $_SESSION['array_menus'];

$idusu = $_SESSION['id_username'];
$usuario = new Usuario();
$usuario->setId($idusu);
$usuarios=$usuario->listar_conectado($usuario);

$actividad = new Schedule();
$actividad->setIdusu($_SESSION['id_username']);
$actividades = $actividad->act_asig_para_usuario($actividad);
  

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
        <link href="../Recursos/../Recursos/assets/css/bootstrap.css" rel="stylesheet">
         <link rel="stylesheet" type="text/css" href="../Recursos/assets/js/gritter/css/jquery.gritter.css" />
        <!--external css-->
        <link href="../Recursos/../Recursos/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

        <!-- Custom styles for this template -->
        <link href="../Recursos/../Recursos/assets/css/style.css" rel="stylesheet">
        <link href="../Recursos/css/StyleGeneral.css" rel="stylesheet">
        <link href="../Recursos/../Recursos/assets/css/style-responsive.css" rel="stylesheet">

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
                    <h3><i class="fa fa-angle-right"></i> TAREAS ASIGNADAS </h3>
                    


                    <div class="row mt">
                        <div class="col-md-12">
                            <div class="content-panel">
                                <table class="table table-striped table-advance table-hover">
                                    <h4><i class="fa fa-angle-right"></i> DETALLE DE TAREAS ASIGNADAS</h4>
                                    <hr>

<?php if ($actividades != null) { ?>
                                        <thead>
                                            <tr style="font-size:6pt;font-weight: bold;">
                                                    <th width="5%"><i></i> N°</th>
                                                    <th width="10%"><i></i> PTE</th>
                                                    <th width="10%"><i></i> FRECUENCIA</th>
                                                    <th width="30%"><i></i> DESCRIPCIÓN</th>
                                                    <th width="10%"><i></i> HORA EJECUCIÓN</th>    
                                                    <th width="10%"><i></i> PROCEDIMIENTO</th>
                                                    <th width="10%"><i></i> PERIODO</th>
                                                    <th width="5%"><i></i> INICIO</th>
                                                    <th width="5%"><i></i> FINALIZACIÓN</th>
                                                    <th width="5%"><i></i> OBSERVACIÓN</th>
                                                    <th><i></i> ASIGNAR</th>
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
                                                         if ($r['actividad_pte'] == '13') {
                                                            echo 'VISANET';
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
                                                        
                                                     <td>
                                                         <?php if($r['schedact_horaini'] == '') { ?>
                                                         <form method='POST' action="../Controles/Registro/CSchedule.php" >
                                                            <input type="hidden" name="id_schedule_act" value="<?php echo $r['schedact_idschedact'] ?>">
                                                            <input type="hidden" name="id_schedule_act_asig" value="<?php echo $r['actasig_idactasig'] ?>">
                                                                
                                                            <input type="hidden" name="hidden_schedule" value="iniciar_tarea_asignada">
                                                            <button type="submit" class="btn btn-primary btn-xs"  title="Iniciar Tarea"><i class="fa fa-clock-o"> Iniciar</i></button>
                                                        </form>
                                                         <?php } ?>
                                                         <?php if($r['schedact_horaini'] != '') { ?>
                                                         <div class="alert alert-warning"><?php echo date('H:i:s',strtotime($r['schedact_horaini']))?></div> 
                                                         <?php } ?>
                                                    </td>  
                                                    <td>
                                                         <?php if($r['schedact_horafin'] == '') { ?>
                                                         <form method='POST' action="../Controles/Registro/CSchedule.php" >
                                                            <input type="hidden" name="id_schedule_act" value="<?php echo $r['schedact_idschedact'] ?>">
                                                            <input type="hidden" name="id_schedule_act_asig" value="<?php echo $r['actasig_idactasig'] ?>">
                                                            <input type="hidden" name="hidden_schedule" value="finalizar_tarea_asignada">
                                                            <button type="submit" class="btn btn-warning btn-xs"  title="Finalizar Tarea"><i class="fa fa-clock-o"> Finalizar</i></button>
                                                        </form>  
                                                         <?php } ?>
                                                         <?php if($r['schedact_horafin'] != '') { ?>
                                                         <div class="alert alert-success"><?php echo date('H:i:s',strtotime($r['schedact_horafin']))?></div> 
                                                         <?php } ?>
                                                    </td>
                                                    <td>
                                                        <form method='POST' action="../Controles/Registro/CSchedule.php" >
                                                        <textarea name="txt_comentario"><?php if($r['schedact_comentario']!=''){ echo $r['schedact_comentario']; }?></textarea>
                                                        <input type="hidden" name="id_schedule_act" value="<?php echo $r['schedact_idschedact'] ?>">
                                                        <input type="hidden" name="hidden_schedule" value="insertar_comentario_asignado">
                                                        <input type="hidden" name="horainicio" value="<?php echo date('H:i:s',strtotime($r['schedact_horaini']))?>">
                                                        <input type="hidden" name="horafinal" value="<?php echo date('H:i:s',strtotime($r['schedact_horafin']))?>">
                                                        <input type="hidden" name="id_act_asig" value="<?php echo $r['actasig_idactasig'] ?>">
                                                        
                                                        <button type="submit" class="btn btn-theme03"><i class="fa fa-check-square"></i> GUARDAR</button>
                                                        
                                                        </form>
                                                    </td>      
                                                    <td style="font-size:8pt;color:#050355;font-weight:bold" width="10%">
                                                    
                                                    <?php if ($usuarios != null) { ?>    
                                                   
                                                     <form method='POST' action="../Controles/Registro/CSchedule.php" >
                                                     <input type="hidden" name="hidden_schedule" value="asignar_tarea_asignada">    
                                                     <input type="hidden" name="id_schedule_act_asig" value="<?php echo $r['actasig_idactasig'] ?>">
                                                     <select class="form-control" name="c_usuario">
                                                      <?php foreach ($usuarios as $u) {  ?>
                                                     <option value="<?php echo $u['usu_idusu']; ?>"><?php echo $u['usu_nombres_usuario'].' '.$u['usu_apellidos_usuario']; ?></option>
                                                     <?php } ?>
                                                     </select>
                                                     <button type="submit" class="btn btn-default"><i class="fa fa-check-square"></i> ASIGNAR</button>
                                                     </form>
                                                    
                                                    <?php }else { ?>
                                                    <div class="alert alert-danger"><i class="fa fa-warning"></i><b> Advertencia!</b><br>No hay Operadores</div> 
                                                    <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>

                                        </tbody>
                                    <?php } else { ?>

<!--                                        <div class="alerta">
                                            <table align="left">
                                                <tr><td></td></tr>
                                                <tr>
                                                    <td>&nbsp;&nbsp;&nbsp;</td>
                                                    <td>
                                                        <img class="image-alerta" src="../Recursos/Imagenes/caution.png">
                                                    </td>    
                                                    <td>
                                                        <label class="LText"><b>Aún no se han asignado Documento(s).</b></label>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>-->
<div class="alert alert-danger"><i class="fa fa-warning"></i><b> MENSAJE!</b><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No te han asignando ninguna tarea..!</div> 
<!--                                        <center><label>Su búsqueda no produjo ningún resultado. </label></center>-->


                                    <?php } ?>
                                </table>
                                
                            </div><!-- /content-panel -->
                            <br>
<!--                                <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label"></label>
                              <div class="col-sm-10">
                                  <button type="button" class="btn btn-theme" onclick="cerrarSchedule();"><i class="fa fa-check"></i> GUARDAR</button>
                                  <button type="button" class="btn btn-danger"  onclick="cancelar();"><i class="fa fa-trash-o"></i> CANCELAR</button>
                              </div>
                          </div>-->
                        </div><!-- /col-md-12 -->
                    </div>
            
                </section><! --/wrapper -->
            </section><!-- /MAIN CONTENT -->

            <!--main content end-->
            <!--footer start-->
            <footer class="site-footer">
                <div class="text-center">
                    2015 - IBM OPERATION SERVICE
                    <a href="DetalleTareasAsignadas.php" class="go-top">
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
        <script>
            //custom select box

            $(function() {
                $('select.styled').customSelect();
            });

        </script>

    </body>
</html>
