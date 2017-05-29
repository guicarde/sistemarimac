<?php

session_start();
include_once '../../DAO/Registro/Schedule.php';


if(isset($_POST['hidden_documento']))
{
    $accion = $_POST['hidden_documento'];
  
            if($accion=='generar_reporte_schedule')
    {   
       $idschedule= $_POST['id_schedule'];
       
     
                $ob = new Schedule();
                $ob->setId($idschedule);
                $lista = $ob->reporte($ob);
//                var_dump($lista);
//                exit();
                $lista2 = $ob->buscarPorId($ob);
                $_SESSION['Schedule']=$lista;
                $_SESSION['Schedule_cabecera']=$lista2;
                $_SESSION['id_schedule']=$idschedule;

                 header("location: ../../Vistas/ReporteSchedule.php");
           
       

    }
           if($accion=='generar_reporte_cierre_schedule')
    {   
       $idschedule= $_POST['id_schedule'];
       $turno = $_POST['turno'];
       
     
                $ob = new Schedule();
                $ob->setId($idschedule);
                
                if($turno=='19:00:00')
                {
                $lista = $ob->reporte_cierre_tarde_noche($ob);
                }else if ($turno=='23:00:00'){
                $lista = $ob->reporte_cierre_noche($ob);   
                }else{
                $lista = $ob->reporte_cierre_dia($ob); 
                }
                $lista2 = $ob->buscarPorId($ob);
                $_SESSION['Schedule']=$lista;
                $_SESSION['Schedule_cabecera']=$lista2;
                $_SESSION['id_schedule']=$idschedule;

                 header("location: ../../Vistas/ReporteCierreSchedule.php");
           
       

    }
    
    
    
    

}
?>

