<?php session_start();
$dnidocenteusario=$_SESSION['dni'];
?>
<!DOCTYPE html>
<html>
    <head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="icon" href="Css/images/favicon.ico">
<title>LNCC ONLINE--Dirigite a tus alumno</title>
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
#    header('Location: index.php');
                    echo "<script>window.location = 'index.php'</script>";
}else {    
?>    
    <body>
        <?php
        require_once 'Includes/navegador.php';
        include_once 'Class/Conection.php';
        include_once 'Class/Docente.php';
        include_once 'Class/ALUMNO_SECCION.php';
        $DOCENTE=new Docente();
        $ALUMNOSECCION= new ALUMNO_SECCION();
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
    #$ALUMNOSECCION->setIDALUMNOSECCION($_REQUEST['txtcodigo'.$x]);
    $ALUMNOSECCION->setMSN4($_REQUEST['txtmensaje'.$x]);
    $ALUMNOSECCION->UPDATE($_REQUEST['txtcodigo'.$x]);
}
    echo "<script> alert ('Los mensajes se han guardado de forma correcta.GRACIAS DOCENTE TUTOR');</script>";
    echo "<script>window.location = 'regmensaje.php'</script>";
}
/*--------------------------------------------------------------------------------------*/

        ?>
        <div style="margin-left: 15%;margin-right: 15%;" id="primer">
            <center><h3 style="color: green">Escriba el comentario u observación sobre el desempeño de sus alumnos de tutor&iacute;a en el presente Bimestre.</h3></center>
            <?php
            $generalseccion=$DOCENTE->NAMESECCIOMICARGO($codigodocentenow);
            if($filanamesection=  mysql_fetch_array($generalseccion)){
                $gradoname=$filanamesection[0];
                $nameseccionnow=$filanamesection[1];
                $nomnivelsection=$filanamesection[2];
            }
            echo "<center><h4 style='color: peru'>SECCION: ".$gradoname." ".$nameseccionnow." ".$nomnivelsection."</h4>
                    <h5 style='color: peru'>TUTOR: ".$apellidosdocentenow."</h5>
                  </center>";
            ?>
<a>NOTA: No use el caracter : '</a>
            <form id="frmmensaje" method="post" action="regmensaje.php?GRABAR=0">
                <fieldset>
                    <legend>A mis Alumnos:</legend>
                    <table class="display">
                        <tr class="gradeU">
                            <td style="display: none;"></td>
                            <td style="width: 8%;">N° &Oacute;rden</td>
                            <td style="width: 30%;">Alumno</td>
                            <td style="width: 56%;">Observaci&oacute;n</td>
                        </tr>
                        
<?php
        $whoisalumno=$DOCENTE->ALUMNOSDEMITUTORIA($codigodocentenow);
        while ($row = mysql_fetch_array($whoisalumno)) {
                        echo "
                            <tr>
                            <td style='display:none;'><input type='text' value='$row[0]' id='txtcodigo$row[1]' name='txtcodigo$row[1]'/></td>
                            <td>$row[1]</td>
                            <td>$row[2] $row[3] ,$row[4]</td>
                            <td><input type='text' style='width:100%' value='$row[5]' id='txtmensaje$row[1]' name='txtmensaje$row[1]'/></td>
                            </tr>
                        ";
        }
        echo $row[6];
?>                      
                    </table>
                </fieldset>
                        <center>
                        <div class="form-actions">
                            <button type="submit"class="btn btn-primary">GRABAR/ACTUALIZAR LOS MENSAJES</button>
                        </div>
                        </center>
            </form>

        </div>
<?php require_once 'Includes/modal-footer.php'; ?>
    </body>
    <?php }?>    
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
</html>