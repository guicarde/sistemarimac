<?php

session_start();

include_once '../../DAO/Conexion.php';
include_once '../../DAO/Registro/Turno.php';
include_once '../../DAO/Registro/Actividad.php';


$direccionInicio = "location:../../Vistas/index.php";
$direccionMantener = "location: ../../Vistas/MantenerActividad.php";
$direccionGuardar = "location: ../../Vistas/GuardarActividad.php";
 
if (isset($_POST['hidden_actividad'])) {
    $idturnob = null;
    $accion = $_POST['hidden_actividad'];
//    var_dump($accion);
//    exit();
     
    if ($accion == 'save') {

        if (isset($_SESSION['accion_actividad']))  {
            if ($_SESSION['accion_actividad'] == 'editar') {
              $id = $_POST['idactividad'];
              $idturnob=$_POST['c_turnob'];  
              $idturno=$_POST['c_turno'];              
              $pte= $_POST['c_pte'];      
              $horaejec= $_POST['t_hora'];
              $idprocedimiento=$_POST['c_procedimiento'];
              $idperiodo=$_POST['c_periodo'];
              $descripcion=trim($_POST['ta_descripcion']);
              $obligatoria=$_POST['c_obligatoria'];
              
            $Actividad = new Actividad();
            $Actividad->setId($id);
            $Actividad->setPte($pte);
            $Actividad->setHoraejec($horaejec);
            $Actividad->setDescripcion($descripcion);          
            $Actividad->setIdprocedimiento($idprocedimiento);
            $Actividad->setIdperiodo($idperiodo);
            $Actividad->setObligatoria($obligatoria);
            $resul=$Actividad->actualizar($Actividad);
            
            $ob_act_tur = new Actividad();
            $ob_act_tur->setId($resul);
            $ob_act_tur->setIdturno($idturno);
            $valor = $ob_act_tur->grabar_turno($ob_act_tur);
            
            if($idturnob!=null){
            $ob_act_tur = new Actividad();
            $ob_act_tur->setId($resul);
            $ob_act_tur->setIdturno($idturnob);
            $valor = $ob_act_tur->grabar_turno($ob_act_tur);    
            }
            
            if(!empty($_POST['check_list'])) {
                    foreach($_POST['check_list'] as $selected) {
                    $ob_actividad = new Actividad();
                    
                    $ob_actividad->setId($resul);
                    $ob_actividad->setIddia($selected);                
                    $valor = $ob_actividad->grabar_dia($ob_actividad);
                    }
                    }
            header("location: ../../Vistas/MantenerActividad.php");
            } else {
              $idturnob=$_POST['c_turnob'];  
              $idturno=$_POST['c_turno'];              
              $pte= $_POST['c_pte'];      
              $horaejec= $_POST['t_hora'];
              $idprocedimiento=$_POST['c_procedimiento'];
              $idperiodo=$_POST['c_periodo'];
              $descripcion=trim($_POST['ta_descripcion']);
              $obligatoria=$_POST['c_obligatoria'];
              
                                
                      
            $Actividad = new Actividad();
          
            $Actividad->setPte($pte);
            $Actividad->setHoraejec($horaejec);
            $Actividad->setDescripcion($descripcion);          
            $Actividad->setIdprocedimiento($idprocedimiento);
            $Actividad->setIdperiodo($idperiodo);
            $Actividad->setObligatoria($obligatoria);
            $resul=$Actividad->grabar($Actividad);
            
            $ob_act_tur = new Actividad();
            $ob_act_tur->setId($resul);
            $ob_act_tur->setIdturno($idturno);
            $valor = $ob_act_tur->grabar_turno($ob_act_tur);
            
            if($idturnob!=null){
            $ob_act_tur = new Actividad();
            $ob_act_tur->setId($resul);
            $ob_act_tur->setIdturno($idturnob);
            $valor = $ob_act_tur->grabar_turno($ob_act_tur);    
            }
            
            if(!empty($_POST['check_list'])) {
                    foreach($_POST['check_list'] as $selected) {
                    $ob_actividad = new Actividad();
                    
                    $ob_actividad->setId($resul);
                    $ob_actividad->setIddia($selected);                
                    $valor = $ob_actividad->grabar_dia($ob_actividad);
                    }
                    }
            header("location: ../../Vistas/MantenerActividad.php");
            }
        } else {
             $idturnob=$_POST['c_turnob'];  
              $idturno=$_POST['c_turno'];              
              $pte= $_POST['c_pte'];      
              $horaejec= $_POST['t_hora'];
              $idprocedimiento=$_POST['c_procedimiento'];
              $idperiodo=$_POST['c_periodo'];
              $descripcion=trim($_POST['ta_descripcion']);
              $obligatoria=$_POST['c_obligatoria'];
              
                                
                      
            $Actividad = new Actividad();
          
            $Actividad->setPte($pte);
            $Actividad->setHoraejec($horaejec);
            $Actividad->setDescripcion($descripcion);          
            $Actividad->setIdprocedimiento($idprocedimiento);
            $Actividad->setIdperiodo($idperiodo);
            $Actividad->setObligatoria($obligatoria);
            $resul=$Actividad->grabar($Actividad);
            
            $ob_act_tur = new Actividad();
            $ob_act_tur->setId($resul);
            $ob_act_tur->setIdturno($idturno);
            $valor = $ob_act_tur->grabar_turno($ob_act_tur);
            
            if($idturnob!=null){
            $ob_act_tur = new Actividad();
            $ob_act_tur->setId($resul);
            $ob_act_tur->setIdturno($idturnob);
            $valor = $ob_act_tur->grabar_turno($ob_act_tur);    
            }
            
            if(!empty($_POST['check_list'])) {
                    foreach($_POST['check_list'] as $selected) {
                    $ob_actividad = new Actividad();
                    
                    $ob_actividad->setId($resul);
                    $ob_actividad->setIddia($selected);                
                    $valor = $ob_actividad->grabar_dia($ob_actividad);
                    }
                    }
            header("location: ../../Vistas/MantenerActividad.php");
        }
    } 
    
         else if($accion=='buscar')
    {
           
        $descripcion=trim(strtoupper($_POST['t_actividad']));   
        $pte= $_POST['c_pte']; 
        $idperiodo=$_POST['c_periodo'];
        
        $ob_actividad = new Actividad();
        $ob_actividad->setDescripcion($descripcion);
        $ob_actividad->setPte($pte);
        $ob_actividad->setIdperiodo($idperiodo);
         
        $arreglo = $ob_actividad->buscar($ob_actividad);
        
        $_SESSION['arreglo_buscado_actividad'] = $arreglo;
        $_SESSION['accion_actividad'] = 'busqueda';
        header("location: ../../Vistas/MantenerActividad.php");
    }
         else if($accion=='buscarid')
     {
        $id_actividad = $_POST['idactividad'];
        $actividad = new Actividad();
        $actividad->setId($id_actividad ); 
        $actividad->buscarPorId($actividad);
        
        $turno = new Actividad();
        $turno->setId($id_actividad); 
        $turnos = $turno->turno_por_actividad($turno); 
        
        $dia= new Actividad();
        $dia->setId($id_actividad);
        $dias= $dia->dias_por_actividad($dia);
        
//        var_dump($dias);
//        exit();
        
        unset($_SESSION['arreglo_buscado_actividad']);
        $_SESSION['arreglo_turnos'] = $turnos;
        $_SESSION['arreglo_dias'] = $dias;
        $_SESSION['accion_actividad']='editar';  
        header("location: ../../Vistas/GuardarActividad.php");
     }
     
         else if($accion == 'anular'){
        $id_actividad_eliminar = $_POST['id_hidden_eliminar'];
        $id_actividad_estado = $_POST['hidden_estado'];
        $ob_actividad= new Actividad();
        $ob_actividad->setId($id_actividad_eliminar);
        $ob_actividad->setEstado($id_actividad_estado);
        $ob_actividad->anular($ob_actividad);
        
        $arreglo=$ob_actividad->listar();
        $_SESSION['arreglo_buscado_actividad'] = $arreglo;
        header("location: ../../Vistas/MantenerActividad.php");
         }
     
        
       
    
 
} else {
    header("location: ../../Vistas/Registros/MantenerActividad.php");
}

