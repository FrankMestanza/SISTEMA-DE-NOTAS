<?php session_start();
    $dni=$_SESSION['dni'];
    ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="icon" href="Css/images/favicon.ico">
        <title>LNCC ONLINE--Registra Los Criterios Del Curso</title>
<?php
require_once 'Class/Usuario.php';
if(!isset ($_SESSION['USERLNCCNOTAS']) && !$_SESSION['USERLNCCNOTAS'] instanceof Usuario){
session_destroy();
header('Location: index.php');
}else {
?>
<!----------------------------------BOOTSTRAP--css-------------------------------------------------->
<link href="Css/bootstrap/bootstrap-responsive.css" rel="stylesheet"/>
<link href="Css/bootstrap/bootstrap.css" rel="stylesheet"/>
<link href="Include/data-table/css/demo_page.css" rel="stylesheet"/>
<link href="Include/data-table/css/demo_table.css" rel="stylesheet"/>
<!-------------------------------------------------------------------------------------------------->
<script type="text/javascript" src="Js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="Js/js.js"></script>
<!----------------------------------BOOTSTRAP--js--------------------------------------------------->
<!--<script type="text/javascript" src="Js/bootstrap.js"></script>-->
<!--<script type="text/javascript" src="Js/bootstrap.js"></script>-->
<script type="text/javascript" src="Js/bootstrap-dropdown.js"></script>
<script type="text/javascript" src="Js/bootstrap-tooltip.js"></script>
<script type="text/javascript" src="Js/bootstrap-popover.js"></script>
<script type="text/javascript" src="Js/bootstrap-tab.js"></script>
<script type="text/javascript" src="Js/jquery.innerfade.js"></script>
<script type="text/javascript" src="Js/bootstrap-collapse.js"></script>

    </head>
    <body>
<?php
require_once 'Includes/navegador.php';
require_once 'Class/Conection.php';
$nivel= $_GET['nivel'];
$grado=$_GET['grado'];
?>
<div style="margin-left: 25%;margin-right: 25%;">
<center>
    <h3 style="color: red">Seleccione &Aacute;rea para ver los indicadores</h3>
    <h3 style="color: green">&Aacute;reas del <?php echo $grado." grado del Nivel:".$nivel;?></h3>
</center>
<table class="table">
<?php
$cone3an= new Conection;
$cone3an->CONECT();
$query3anos=  mysql_query("select codigo,asinatura from descripcionsinature where nomnivel=".$nivel." and  grado like ('%".$grado."%');");
while ($row = mysql_fetch_array($query3anos)) {
echo "
    <tr>
    <td class='center'><a TARGET = '_blank' href='regcriterio.php?asinatura=".$row[0]."'>Ver Indicadores</a></td>
    <td>".$row[1]."</td>
    </tr>
    ";
}
?>
</table>
</div>
        <?php require_once 'Includes/modal-footer.php';?>
    <?php }?>            
    </body>
</html>
