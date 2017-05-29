<?php
include_once '../DAO/Conexion.php';

if(!isset($_SESSION)){
session_start();
}

class Actividad {
    
    private $id;
    private $pte;
    private $horaejec;
    private $descripcion;
    private $estado;
    private $idprocedimiento;
    private $idperiodo;
    private $idturno;
    private $iddia;
    private $obligatoria;
    
        
    function __construct() {}
function getId() {
    return $this->id;
}

function getPte() {
    return $this->pte;
}

function getHoraejec() {
    return $this->horaejec;
}

function getDescripcion() {
    return $this->descripcion;
}

function getEstado() {
    return $this->estado;
}

function getIdprocedimiento() {
    return $this->idprocedimiento;
}

function getIdperiodo() {
    return $this->idperiodo;
}

function getIdturno() {
    return $this->idturno;
}

function getIddia() {
    return $this->iddia;
}

function getObligatoria() {
    return $this->obligatoria;
}

function setId($id) {
    $this->id = $id;
}

function setPte($pte) {
    $this->pte = $pte;
}

function setHoraejec($horaejec) {
    $this->horaejec = $horaejec;
}

function setDescripcion($descripcion) {
    $this->descripcion = $descripcion;
}

function setEstado($estado) {
    $this->estado = $estado;
}

function setIdprocedimiento($idprocedimiento) {
    $this->idprocedimiento = $idprocedimiento;
}

function setIdperiodo($idperiodo) {
    $this->idperiodo = $idperiodo;
}

function setIdturno($idturno) {
    $this->idturno = $idturno;
}

function setIddia($iddia) {
    $this->iddia = $iddia;
}

function setObligatoria($obligatoria) {
    $this->obligatoria = $obligatoria;
}

    
//------------------------------------------------------------------------------
    function grabar(Actividad $a){
        
        $con =  Conectar();
        $sql = "SELECT * FROM actividad_insertar('$a->pte','$a->horaejec','$a->descripcion',$a->idprocedimiento,$a->idperiodo,'$a->obligatoria')";
//        var_dump($sql);
//        exit();       
        $res = pg_query($con,$sql);
        $val = pg_fetch_result($res,0,0);
        if($val=='0'){
            $_SESSION['mensaje_actividad']="Error al registrar periodo"; 
            return 0;
        }
        else{
            $_SESSION['mensaje_actividad']="Los datos se registraron satisfactoriamente";
            return $val;
        }
        }
        function actualizar(Actividad $a){
        
        $con =  Conectar();
        $sql = "SELECT * FROM actividad_editar('$a->pte','$a->horaejec','$a->descripcion',$a->idprocedimiento,$a->idperiodo,'$a->obligatoria',$a->id)";
//        var_dump($sql);
//        exit();       
        $res = pg_query($con,$sql);
        $val = pg_fetch_result($res,0,0);
        if($val=='0'){
            $_SESSION['mensaje_actividad']="Error al registrar Actividad"; 
            return 0;
        }
        else{
            $_SESSION['mensaje_actividad']="Los datos se registraron satisfactoriamente";
            return $val;
        }
        }
     function listar(){
       
        $con = Conectar();
        $sql = "SELECT * FROM actividad_listar()";
        $res = pg_query($con,$sql);
        $array=null;
        while($fila = pg_fetch_assoc($res))
        {
                   $array[] = $fila;
        }
       
        if(count($array)!=0){
            return $array; 
        }
        else{
            return null;
        }
    }
         function dias_por_actividad(Actividad $a){
       
        $con = Conectar();
        $sql = "SELECT * FROM dias_por_actividad($a->id)";
        $res = pg_query($con,$sql);
        $array=null;
        while($fila = pg_fetch_assoc($res))
        {
                   $array[] = $fila;
        }
       
        if(count($array)!=0){
            return $array; 
        }
        else{
            return null;
        }
    }
          function buscar(Actividad $a)
    {
         $con = Conectar();
         $sql = "SELECT * FROM actividad_buscar('%$a->descripcion%','$a->pte',$a->idperiodo)";
//         var_dump($sql);
//         exit();   
         $res = pg_query($con,$sql);
         $array=null;
         
         while($fila = pg_fetch_assoc($res))
         {
               $array[] = $fila;
         }
         if(count($array)!=0){
             return $array; 
         }
         else{
         return null;
         }
    }
    
    function RestarHoras($horaini,$horafin)

{

	$horai=substr($horaini,0,2);

	$mini=substr($horaini,3,2);

	$segi=substr($horaini,6,2);

 

	$horaf=substr($horafin,0,2);

	$minf=substr($horafin,3,2);

	$segf=substr($horafin,6,2);

 

	$ini=((($horai*60)*60)+($mini*60)+$segi);

	$fin=((($horaf*60)*60)+($minf*60)+$segf);

 

	$dif=$fin-$ini;

 

	$difh=floor($dif/3600);

	$difm=floor(($dif-($difh*3600))/60);

	$difs=$dif-($difm*60)-($difh*3600);

	return date("H:i:s",mktime($difh,$difm,$difs));

}

function anular(Actividad $a){
        $con = Conectar();
        $sql = "SELECT * FROM actividad_anular('$a->estado',$a->id)";  
        pg_query($con,$sql); 
    }

    
function buscarPorId(Actividad $a){
        $con = Conectar();
        $sql = "SELECT * FROM actividad_buscar_por_id($a->id)";
//        var_dump($sql);
//        exit();
        $res = pg_query($con,$sql);
        $array = null;
        while($fila = pg_fetch_assoc($res))
        {
            $array[]=$fila;
        }
         if(count($array)!=0)
         {
            
          foreach($array as $a)
            {
                $_SESSION['actividad_idactividad'] = $a['actividad_idactividad'] ;
                $_SESSION['actividad_pte'] = $a['actividad_pte'] ;
                $_SESSION['actividad_horaejecucion'] = $a['actividad_horaejecucion'];
                $_SESSION['procedimiento_idprocedimiento'] = $a['procedimiento_idprocedimiento'];
                $_SESSION['periodo_idperiodo'] = $a['periodo_idperiodo'];
                $_SESSION['actividad_descripcion'] = $a['actividad_descripcion'];
                $_SESSION['actividad_obligatoria'] = $a['actividad_obligatoria'];
                $_SESSION['accion_actividad'] = 'editar';
                
            } 
         }
         else{
         return null;
         }
    }
      function turno_por_actividad(Actividad $a){
       
        $con = Conectar();
        $sql = "SELECT * FROM turno_por_actividad($a->id)";
        $res = pg_query($con,$sql);
        $array=null;
        while($fila = pg_fetch_assoc($res))
        {
                   $array[] = $fila;
        }
       
        if(count($array)!=0){
            return $array; 
        }
        else{
            return null;
        }
    }
    
       function grabar_turno(Actividad $a){
        
        $con =  Conectar();
        $sql = "SELECT * FROM actividad_turno_insertar($a->id,$a->idturno)";
//        var_dump($sql);
//        exit();       
        $res = pg_query($con,$sql);
        $val = pg_fetch_result($res,0,0);
        if($val=='0'){
            return 0;
        }
        else{
            return $val;
        }
        }
        
         function grabar_dia(Actividad $a){
        
        $con =  Conectar();
        $sql = "SELECT * FROM actividad_dia_insertar($a->id,$a->iddia)";
//        var_dump($sql);
//        exit();       
        $res = pg_query($con,$sql);
        $val = pg_fetch_result($res,0,0);
        if($val=='0'){
            return 0;
        }
        else{
            return $val;
        }
        }
        
            function grabarExcel($a,$b,$c,$l,$m,$n,$o,$p)
    {
   //     $duracion = $this->RestarHoras($e,$k);
        
        $con = Conectar();
        $sql = "SELECT * FROM actividad_insertar_excel('$a','$l','$m','$n','$o','$p') ";
//        var_dump($sql);
//        exit();
        $res = pg_query($con,$sql);
        return pg_fetch_result($res,0,0);
    }

        }
