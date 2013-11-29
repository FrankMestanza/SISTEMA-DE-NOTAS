<?php session_start();    ?>
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
echo "<script>window.location = 'index.php'</script>";
}else {
?>
<!----------------------------------BOOTSTRAP--css-------------------------------------------------->
<link href="Css/bootstrap/bootstrap-responsive.css" rel="stylesheet"/>
<link href="Css/bootstrap/bootstrap.css" rel="stylesheet"/>
</head>
<?php
require_once 'Class/Indicador.php';
//variables locales
$compo = $_GET['componente'];
$ordendendicador=$_GET['orden'];
$indicadorvalue=$_GET['indicador'];
$codeindicador=$_GET['codeindi'];
$INDICA= new Indicador();

#CUANTOS HAY-------------------------
$cantidad=$INDICA->LISTGENERAL($compo);
$numero=  mysql_num_rows($cantidad);$codigoi;$uno=1;$nrocriterio;
if($ordendendicador!=0){
$nrocriterio=$ordendendicador;
}  else {
$nrocriterio=$numero+$uno;
}
if($indicadorvalue!=""){
$criterio=$indicadorvalue;
}  else {
$criterio;
}
if($codeindicador!=0){
$codigoi=$codeindicador;
}  else {
$codigoi;
}
$peso=1;
?>
<body style="background-color: #000000;">
<center>
<div id="main" style="width: 70%;">
    <br>
<?php echo "<i class='succses' style='color:white;'> El indicador del componente es el n&uacute;mero $nrocriterio </i>";?>
<fieldset class="form-actions">
<?php
echo "<form name='frmindica' method='post' action='' onsubmit='agregarPais();'>";
?>
<table id="tableseccion" class="table table-bordered">
<caption>MANTENIMIENTO DE INDICADORES</caption>
<tbody>

<tr>
    <td style="display: none;">
        <a>CODIGO: </a><input type='text' id='txtcodigo' name='txtcodigo' <?php echo "value='".$codigoi."'";?>>
    </td>
    <td style="display: none;">
        <a>COMPONENTE: </a><input type='text' id='txtcomponente' name='txtcomponente' <?php echo "value='".$compo."'";?>>
    </td>
</tr>

<tr>
    <td style="display: none;">
        <a>N INDICADOR:</a>
        <input class="input-xlarge" id="txtfiu" name="txtfiu" type="text"  <?php echo "value='".$nrocriterio."';"?>/>
    </td>

<tr>
    <td>
        <a>CRITERIO :
        <input type='text' id='txtcriterio' name='txtcriterio' style='width: 95%'<?php echo "value='".$criterio."'"; ?>/></a>
        <I id="modelo" style="color: red;"></I>
    </td>
</tr>

<tr>
    <td style="display:none;">
        <a>Peso<input type='text' id='txtpeso' name='txtpeso'<?php echo "value='".$peso."'"; ?>/></a>
    </td>
</tr>

</tbody>
</table>

<?php
echo "</form>"
?>
<div class="form-actions">
    <button style="" class="btn btn-primary" id="btnsave" name="btnsave" onclick="agregarPais();">AGREGAR/EDITAR INDICADOR</button>
</div>
</fieldset>
<div style="text-align:left;">
<a><code><strong>ATENCI&Oacute;N:</strong></code> Usted s&oacute;lo debe ingresar el indicador, tome usted en cuenta estos ejemplos:</a>
<br>
<ul>
<li><a>Interpreta y calcula el M&iacute;nimo Com&uacute;n M&uacute;ltiplo y el M&aacute;ximo Com&uacute;n Divisor aplicando criterios de divisibilidad.</a></li>
<li><a>Interpreta y calcula el M&iacute;nimo Com&uacute;n M&uacute;ltiplo y el M&aacute;ximo Com&uacute;n Divisor aplicando criterios de divisibilidad. (Pr&aacute;ctica calificada).</a></li>
<li><a>(1.1) Interpreta y calcula el M&iacute;nimo Com&uacute;n M&uacute;ltiplo y el M&aacute;ximo Com&uacute;n Divisor aplicando criterios de divisibilidad. (Pr&aacute;ctica calificada).</a></li>
</ul>
<code><strong>Recordar que los PP.FF ven las notas de sus hijos, para ellos el instrumento es importante</strong></code>
</div>
</div>
</center>
<?php require_once 'Includes/modal-footer.php';?>
</body>

<?php }?>
</html>
<script type="text/javascript" src="Js/ajax.js"></script>
<script type="text/javascript" src="Js/hola.js"></script>
<script type="text/javascript">

function trim(str) {
  return str.replace(/^\s+|\s+$/g,"");
}

function agregarPais(){
    var criterio="";
    var codigo="";
    var componente="";
    var nro=""
    var peso=""

    criterio= document.getElementById("txtcriterio").value;
    codigo= document.getElementById("txtcodigo").value;
    componente= document.getElementById("txtcomponente").value;
    nro= document.getElementById("txtfiu").value;
    peso= document.getElementById("txtpeso").value;
    
    var sinespacio=(trim(criterio));
    

    if(sinespacio!=""){
            ajax_4(sinespacio,codigo,componente,nro,peso);
            if(ajax_4){
            alert("Preparando para guardar");
            alert("Guardando");            
            alert("Indicador guardado de forma correcta");
            opener.document.location.reload();
            window.close();
            }else{
            ajax_4(sinespacio,codigo,componente,nro,peso);
            alert("Preparando");
            }
    }else{
            document.getElementById('modelo').innerHTML = "DEBES ESCRIBIR UN INDICADOR, NO PUEDES DEJAR LA CAJA VAC&Iacute;A";
            document.getElementById("txtcriterio").focus();
    }

}
</script>