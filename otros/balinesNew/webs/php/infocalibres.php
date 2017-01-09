<?php
include_once('funciones.php');
include_once('functions_text.php');
$valor=$_REQUEST['idinfo'];
$con=sqlFetch(sqlQuery('SELECT nombre,tamBalin,tamCaja,filas FROM calibres WHERE idCalibre='.$valor));

$nombre=strtoupper(limitarSalida(replaceInverse($con[0]),20));
$tamBalin=ucfirst(limitarSalida(replaceInverse($con[1]),20));
$tamCaja=ucfirst(limitarSalida(replaceInverse($con[2]),20));
$filas=($con[3]);
if($valor!=''){
?>
<table width="100%" border="0">
  <tr height="25">
    <td width="60"><strong>Nombre</strong></td>
    <td style="color:#444;"><?php echo $nombre; ?></td>
  </tr>
  <tr>
    <td valign="top"><strong>Calibre</strong></td>
    <td style="color:#444;"><?php echo $tamBalin; ?></td>
  </tr>
  <tr>
    <td valign="top"><strong>Caja</strong></td>
    <td style="color:#444;"><?php echo $tamCaja; ?></td>
  </tr>
  <tr>
    <td valign="top"><strong>Filas</strong></td>
    <td style="color:#444;"><?php echo $filas; ?></td>
  </tr>
</table>
<?php 
}else{
	echo 'Seleccione una marca y un calibre';
}?>