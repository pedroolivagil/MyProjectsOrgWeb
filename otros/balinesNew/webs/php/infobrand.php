<?php
include_once('funciones.php');
include_once('functions_text.php');
$valor=$_REQUEST['idinfo'];
$con=sqlFetch(sqlQuery('SELECT nombre,descripcion,imagen FROM marcas WHERE idMarca='.$valor));
$nombre=strtoupper(limitarSalida(replaceInverse($con[0]),20));
if($con[1]){
	$descripcion=ucfirst(replaceInverse($con[1]));
}else{
	if(logUser()){
		$descripcion='<a href="javascript:actumarcadescrip('.$valor.')">Añade una descripción</a>';
	}else{
		$descripcion='No hay descripción';
	}
}
$imagen='<img src="'.$con[2].'" />';
if($valor!=''){
?>
<table width="100%" border="0">
  <tr height="25">
    <td width="60"><strong>Nombre</strong></td>
    <td style="color:#444;"><?php echo $nombre; ?></td>
  </tr>
  <tr>
    <td valign="top"><strong>Descripción</strong></td>
    <td style="color:#444;" id="descripMarca"><?php echo $descripcion; ?></td>
  </tr>
</table>
<?php 
}else{
	echo 'Seleccione una marca';
}?>
