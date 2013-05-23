<?php session_start();
$dnidocenteusario=$_SESSION['dni'];
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="icon" href="Css/images/favicon.ico">
<title>LNCC ONLINE--Dirigite al PP.FF</title>
<!----------------------------------BOOTSTRAP--css-------------------------------------------------->
<link href="Css/bootstrap/bootstrap-responsive.css" rel="stylesheet"/>
<link href="Css/bootstrap/bootstrap.css" rel="stylesheet"/>
<link href="Include/data-table/css/demo_page.css" rel="stylesheet"/>
<link href="Include/data-table/css/demo_table.css" rel="stylesheet"/>
</head>
<?php
require_once 'Class/Usuario.php';
if(!isset ($_SESSION['USERLNCCNOTAS']) && !$_SESSION['USERLNCCNOTAS'] instanceof Usuario){
session_destroy();
echo "<script>window.location = 'index.php'</script>";
}else {
?>
<body>
<?php
require_once 'Includes/navegador.php';
include_once 'Class/Conection.php';
include_once 'Class/Docente.php';
$DOCENTE= new Docente();
include_once 'Class/ALUMNO_SECCION.php';
$ALUMNOSECCION= new ALUMNO_SECCION();
include_once 'Class/Alumno_Seccion_Pf.php';
$AlSECIONPF= new Alumno_Seccion_Pf();

$whoisdocente=$DOCENTE->DOCENTE_USUARIO($dnidocenteusario);
if($filasiencuentra=  mysql_fetch_array($whoisdocente)){
    $codigodocentenow=$filasiencuentra[0];
    $apellidosdocentenow=$filasiencuentra[1]." ".$filasiencuentra[2]." ,".$filasiencuentra[3];
}
/*--------------------------------------MANTENIMIENTO-----------------------------------*/
//Listar registros
#BUCLE REPETITIVO
if(isset($_REQUEST['GRABAR'])){ // se envio el formulario?
for($x =1 ; $x <= 35; $x++){//recorremos todos los alumnos,se recuperan cada uno de los datos del form siempre y cuando se hayan enviado, de lo contrario los omite
    $AlSECIONPF->setCODIGO($_REQUEST['txtcodigo'.$x]);
    $AlSECIONPF->setCODIGOAS($_REQUEST['txtcodigo'.$x]);
    $AlSECIONPF->setUPF1($_REQUEST['txtnota1'.$x]);
    $AlSECIONPF->setUPF2($_REQUEST['txtnota2'.$x]);
    $AlSECIONPF->setUPF3($_REQUEST['txtnota3'.$x]);
    $AlSECIONPF->setUPF4($_REQUEST['txtnota4'.$x]);
    $AlSECIONPF->setUPF5($_REQUEST['txtnota5'.$x]);
    $AlSECIONPF->setUPF6($_REQUEST['txtnota6'.$x]);
    $AlSECIONPF->setUPF7($_REQUEST['txtnota7'.$x]);
    $AlSECIONPF->setUPF8($_REQUEST['txtnota8'.$x]);
    $AlSECIONPF->GRABAR();
    #$ALUMNOSECCION->setMSN1(htmlentities($_REQUEST['txtmensaje'.$x],ENT_QUOTES,"UTF-8"));
    #$ALUMNOSECCION->UPDATE($_REQUEST['txtcodigo'.$x]);
}
    echo "<script>window.location = 'regmnsji.php'</script>";
}
/*--------------------------------------------------------------------------------------*/

?>
<div style="margin-left: 5%;margin-right: 5%;" id="primer">
<center><h4 style="color: green">Escriba las observaciones y recomendaciones a los PP.FF.</h4></center>
<article>
<section>1. <i>Asiste puntualmente a las reuniones y entrevistas del aula.</i></section>
<section>2. <i>Se esmera en la presentacion e higiene personal del ni&ntilde;o.</i></section>
<section>3. <i>Apoya permanentemente con las tareas de su ni&ntilde;o.</i></section>
<section>4. <i>Incentiva la participaci&oacute;n de su ni&ntilde;o en las diferentes actividades.</i></section>
<section>5. <i>Se interesa en el avance y progreso de su ni&ntilde;o.</i></section>
<section>6. <i>Colabora con las necesidades del aula.</i></section>
<section>7. <i>Firma diaramente la Bit&aacute;cora.</i></section>
<section>8. <i>Recoge el informe del progreso del ni&ntilde;o en la fecha indicada.</i></section>

</article>
            <?php
$generalseccion=$DOCENTE->NAMESECCIOMICARGO($codigodocentenow);
if($filanamesection=  mysql_fetch_array($generalseccion)){
    $gradoname=$filanamesection[0];
    $nameseccionnow=$filanamesection[1];
    $nomnivelsection=$filanamesection[2];
}
echo "
<h5 style='color: peru'>SECCION: ".$gradoname." ".$nameseccionnow." ".$nomnivelsection."</h5>
<h5 style='color: peru'>TUTOR: ".$apellidosdocentenow."</h5>
";
?>
<form id="frmmensaje" method="post" action="regmnsji.php?GRABAR=1">
<fieldset>
<table class="table table-hover">
    <tr class="gradeU">
        <td style="display: none;"></td>
        <td style="width: 3%;color: peru;text-transform: uppercase;"><b>N°</b></td>
        <td style="width: 30%;color: peru;text-transform: uppercase;"><b>Alumno</b></td>
        <td style="width: 8%;color: peru;text-transform: uppercase;"><b>1</b></td>
        <td style="width: 8%;color: peru;text-transform: uppercase;"><b>2</b></td>
        <td style="width: 8%;color: peru;text-transform: uppercase;"><b>3</b></td>
        <td style="width: 8%;color: peru;text-transform: uppercase;"><b>4</b></td>
        <td style="width: 8%;color: peru;text-transform: uppercase;"><b>5</b></td>
        <td style="width: 8%;color: peru;text-transform: uppercase;"><b>6</b></td>
        <td style="width: 8%;color: peru;text-transform: uppercase;"><b>7</b></td>
        <td style="width: 8%;color: peru;text-transform: uppercase;"><b>8</b></td>
    </tr>
<?php
$whoisalumno=$AlSECIONPF->ALUMNOSDEMITUTORIA($codigodocentenow);
while ($row = mysql_fetch_array($whoisalumno)) {
echo "
    <tr>
    <td style='display:none;'>
    <input type='text' value='$row[0]' id='txtcodigo$row[1]' name='txtcodigo$row[1]'/></td>
    <td><b>$row[1]</b></td>
    <td><b>$row[2] $row[3] ,</b>$row[4]</td>
    <td><input type='text' value='$row[5]' id='txtnota1$row[1]' name='txtnota1$row[1]' placeholder='FN' style='width:100%;'/></td>
    <td><input type='text' value='$row[6]' id='txtnota2$row[1]' name='txtnota2$row[1]' placeholder='FN'style='width:100%;'></td>
    <td><input type='text' value='$row[7]' id='txtnota3$row[1]' name='txtnota3$row[1]' placeholder='FN'style='width:100%;'></td>
    <td><input type='text' value='$row[8]' id='txtnota4$row[1]' name='txtnota4$row[1]' placeholder='FN'style='width:100%;'></td>
    <td><input type='text' value='$row[9]' id='txtnota5$row[1]' name='txtnota5$row[1]' placeholder='FN'style='width:100%;'></td>
    <td><input type='text' value='$row[10]' id='txtnota6$row[1]' name='txtnota6$row[1]' placeholder='FN'style='width:100%;'></td>
    <td><input type='text' value='$row[11]' id='txtnota7$row[1]' name='txtnota7$row[1]' placeholder='FN'style='width:100%;'></td>
    <td><input type='text' value='$row[12]' id='txtnota8$row[1]' name='txtnota8$row[1]' placeholder='FN'style='width:100%;'></td>
    </tr>
";
}
?>
</table>
</fieldset>
<center>

    <div class="form-actions">
    <button type="submit"class="btn btn-primary"><i>GRABAR/ACTUALIZAR LOS MENSAJES</i></button>
    </div>
</center>
</form>
</div>
</body>
<?php }?>
<!-------------------------------------------------------------------------------------------------->
<script type="text/javascript" src="Js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="Js/js.js"></script>
<!----------------------------------BOOTSTRAP--js--------------------------------------------------->
<script type="text/javascript" src="Js/bootstrap-dropdown.js"></script>
<script type="text/javascript" src="Js/bootstrap-tooltip.js"></script>
<script type="text/javascript" src="Js/bootstrap-popover.js"></script>
<script type="text/javascript" src="Js/bootstrap-tab.js"></script>
<script type="text/javascript" src="Js/jquery.innerfade.js"></script>
<script type="text/javascript" src="Js/bootstrap-collapse.js"></script>
</html>