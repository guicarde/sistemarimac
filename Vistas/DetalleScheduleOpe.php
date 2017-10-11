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

if (isset($_SESSION['accion_schedule']) && $_SESSION['accion_schedule'] != '') {

    if ($_SESSION['accion_schedule'] == 'detalle_schedule') {
        $actividades = $_SESSION['arreglo_actividad_por_schedule'];
    }
    if ($_SESSION['accion_schedule'] == 'filtro_schedule') {
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
        <script type="text/javascript" src="../Recursos/js/JSGeneral.js"></script>
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
                          <li><a  href="GuardarUsuario.php">Registrar Usuario</a></li>
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
                      <a href="javascript:;" class="active" >
                          <i class="fa fa-fax"></i>
                          <span>Ejecutar Schedule</span>
                      </a>
                      <ul class="sub">
                          <li class="active"><a  href="DetalleScheduleOpe.php">Detalle de Schedule</a></li>
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
                    <h3><i class="fa fa-angle-right"></i> DETALLE DE SCHEDULE </h3>

                    <form class="form-horizontal style-form" id="form_cerrar_schedule" action="../Controles/Registro/CSchedule.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="hidden_schedule" value="guardarscheduleope" id="hiddenschedule">    
                        <!-- Opciones de Busqueda -->
                        <div class="row mt">
                            <div class="col-lg-12">
                                <div class="form-panel">
                                    <h4 class="mb"><i class="fa fa-angle-right"></i> DATOS DEL SCHEDULE</h4>

                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">INGRESAR FIRMA OPERADOR</label>
                                        <div class="col-sm-6">

                                            <input id="file-xxx" class="file" multiple="true" data-show-upload="false" data-show-caption="true" type="file" name="fileArchivo">

                                        </div>
                                    </div>

                                </div>
                            </div><!-- col-lg-12-->      	
                        </div><!-- /row -->
                    </form>
                    <form class="form-horizontal style-form" id="form_cerrar_schedule" action="../Controles/Registro/CSchedule.php" method="POST">
                        <input type="hidden" name="hidden_schedule" value="filtrarschedule" id="hiddenfiltro">    
                        <!-- Opciones de Busqueda -->
                        <div class="row mt">
                            <div class="col-lg-12">
                                <div class="form-panel">
                                    <h4 class="mb"><i class="fa fa-angle-right"></i> OPCIONES DE FILTRO</h4>

                                    <div class="form-group">                                        
                                        <label class="col-sm-1 col-sm-1 control-label">ESTADO</label>
                                        <div class="col-sm-2">
                                            <select class="form-control select2" style="width: 100%;" name="c_estado">
                                                <option value="">--SELECCIONE--</option>
                                                <option value="2">ATENDIDO</option>
                                                <option value="1">NO ATENDIDO</option>
                                            </select>
                                        </div>

                                        <label class="col-sm-2 col-sm-2 control-label">DESCRIPCIÓN DE TAREA</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="t_descripcion" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group" align="center">
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-theme03"><i class="fa fa-search"></i> FILTRAR</button>
                                        </div>
                                    </div>

                                </div>
                            </div><!-- col-lg-12-->      	
                        </div><!-- /row -->
                    </form>

                    <div class="row mt">
                        <div class="col-md-12">
                            <div class="content-panel">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-responsive table-advance table-hover">
                                        <h4><i class="fa fa-angle-right"></i> DETALLE DE ACTIVIDADES DEL SCHEDULE</h4>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="background-color:#68FF7E;font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;&nbsp;&nbsp;TAREAS OBLIGATORIAS
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
                                                    <th width="5%"><i></i> INICIO</th>
                                                    <th width="5%"><i></i> FINALIZACIÓN</th>
                                                    <th width="5%"><i></i> OBSERVACIÓN</th>
                                                    <th width="10%"><i></i> ASIGNAR</th>
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
                                                        

                                                        <td style="font-size:8pt;color:#050355;font-weight:bold" width="5%">
                                                            <div id="inicio_tar<?php echo $r['schedact_idschedact'] ?>">
        <?php if ($r['schedact_horaini'] == '') { ?>
                                                                    <input type="hidden" name="id_schedule_act" id="id_schedule_act<?php echo $r['schedact_idschedact'] ?>" value="<?php echo $r['schedact_idschedact'] ?>">
                                                                    <input type="hidden" name="hidden_schedule" id="hidden_schedule" value="iniciar_tarea">
                                                                    <button type="submit" class="btn btn-primary btn-xs" onclick="iniciarTarea('<?php echo $r['schedact_idschedact'] ?>');" title="Iniciar Tarea"><i class="fa fa-clock-o"> Iniciar</i></button>

        <?php } else { ?>  
                                                                    <div id="test<?php echo $r['schedact_idschedact'];?>" class="alert alert-warning">
                                                                        <input type="time" id="id_hora_inicio_final<?php echo $r['schedact_idschedact'] ?>" value="<?php echo date('H:i:s', strtotime($r['schedact_horaini'])) ?>" onblur="actualiza_hora_inicio('<?php echo $r['schedact_idschedact'];?>')">
                                                                    </div> 
                                                                    <input type="hidden" id="id_marcado_hora_inicio<?php echo $r['schedact_idschedact'] ?>" value="<?php echo date('H:i:s', strtotime($r['schedact_horaini'])) ?>">
        <?php } ?>
                                                            </div>
                                                        </td>  
                                                        <td style="font-size:8pt;color:#050355;font-weight:bold" width="5%">

                                                            <div id="div_finalizar_tarea<?php echo $r['schedact_idschedact'] ?>">

                                                            </div>
                                                            <?php if ($r['schedact_horaini'] != '') { ?>
            <?php if ($r['schedact_horafin'] == '') { ?>

                                                                    <div id="div_finalizatarea<?php echo $r['schedact_idschedact'] ?>">
                                                                        <button type="button" onclick="finalizar_Tarea('<?php echo $r['schedact_idschedact'] ?>')" 
                                                                                class="btn btn-warning btn-xs"  title="Finalizar Tarea"><i class="fa fa-clock-o"> Finalizar</i></button>
                                                                    </div>

                                                                <?php } ?>
                                                                <?php if ($r['schedact_horafin'] != '') { ?>
                                                                    <div class="alert alert-success">
                                                                        <input type="time" id="id_hora_fin_final<?php echo $r['schedact_idschedact'] ?>" value="<?php echo date('H:i:s', strtotime($r['schedact_horafin'])) ?>" onblur="actualiza_hora_fin('<?php echo $r['schedact_idschedact'];?>')">
                                                                     </div> 
                                                                <?php } ?>
        <?php } ?>

                                                        </td>
                                                        <td style="font-size:8pt;color:#050355;font-weight:bold" width="5%">

                                                            <div id="div_comentario_tarea<?php echo $r['schedact_idschedact']; ?>">

                                                            </div>

        <?php if ($r['schedact_horafin'] != '' && $r['schedact_horaini'] != '') { ?>

                                                                <!--<form method='POST' action="../Controles/Registro/CSchedule.php" >-->
                                                                <textarea name="txt_comentario" id="txt_comentario<?php echo $r['schedact_idschedact'] ?>"><?php
                                                                    if ($r['schedact_comentario'] != '') {
                                                                        echo $r['schedact_comentario'];
                                                                    }
                                                                    ?></textarea>
                                                                <input type="hidden" name="horainicio" id="horainicio<?php echo $r['schedact_idschedact'] ?>" value="<?php echo date('H:i:s', strtotime($r['schedact_horaini'])) ?>">
                                                                <input type="hidden" name="horafinal" id="horafinal<?php echo $r['schedact_idschedact'] ?>" value="<?php echo date('H:i:s', strtotime($r['schedact_horafin'])) ?>">
                                                                <select class="form-control" name="c_estado_tar" id="c_estado_tar<?php echo $r['schedact_idschedact'] ?>" required style="font-size:10pt;">                                                            
                                                                    <option value="1" <?php if ($r['schedact_estado_tar'] == '1') echo 'selected'; ?>>OK</option>
                                                                    <option value="2" <?php if ($r['schedact_estado_tar'] == '2') echo 'selected'; ?>>FALLIDO</option>
                                                                    <option value="3" <?php if ($r['schedact_estado_tar'] == '3') echo 'selected'; ?>>NA</option>
                                                                </select>
                                                                <br>
                                                                <button type="button"
                                                                        onclick="comentario_Tarea('<?php echo $r['schedact_idschedact'] ?>')"
                                                                        class="btn btn-theme03 btn-xs"><i class="fa fa-check-square"></i> GUARDAR</button>

                                                                <!-- </form>-->
        <?php } ?>
                                                        </td>
                                                        <td style="font-size:8pt;color:#050355;font-weight:bold" width="10%">
                                                    
                                                    <?php if ($usuarios != null) { ?>    
                                                   
                                                     <form method='POST' action="../Controles/Registro/CSchedule.php" >
                                                     <input type="hidden" name="hidden_schedule" value="asignar_tarea">    
                                                     <input type="hidden" name="id_schedule_act" value="<?php echo $r['schedact_idschedact'] ?>">
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

                                            <div class="alert alert-danger"><i class="fa fa-warning"></i><b> NO HAY TAREAS!</b><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SE FINALIZARON LAS TAREAS DEL SCHEDULE ..!</div> 
                                            <!--                                        <center><label>Su búsqueda no produjo ningún resultado. </label></center>-->


<?php } ?>
                                    </table>
                                </div>  
                            </div><!-- /content-panel -->
                            <br>

                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label"></label>
                                <div class="col-sm-10">
                                    <button type="button" class="btn btn-theme" onclick="cerrarSchedule();"><i class="fa fa-check"></i> FINALIZAR SCHEDULE</button>
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
                    <a href="MantenerSchedule.php" class="go-top">
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
      
        <!--common script for all pages-->
        <script src="../Recursos/../Recursos/assets/js/common-scripts.js"></script>
        <!--script for this page-->
        <!--script for this page-->
        <script type="text/javascript" src="../Recursos/assets/js/gritter/js/jquery.gritter.js"></script>
        <script type="text/javascript" src="../Recursos/assets/js/gritter-conf.js"></script>
        
        
        
<!--        <script src="code.jquery.com/jquery-1.12.4.js"></script>-->
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
    </body>
</html>
