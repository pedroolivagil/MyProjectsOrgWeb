<?php
include_once('funciones.php');
include_once('functions_text.php');
$idMarca=$_REQUEST['marca'];
if(!$idMarca or !isset($idMarca) or $idMarca=="" or $idMarca<0){
	echo '<span class="idenUserFail">Error al crear el calibre. La marca no existe</span>';
}else{
$nombre=reemplazarForm(quitarPuntos3($_REQUEST['nombre']));
$filas=$_REQUEST['filas'];
$tamCaja=quitarPuntos3($_REQUEST['tamCaja']);
$tamBalin=quitarPuntos3($_REQUEST['tamBalin']);
$ruta="../../img/galeria/".$idMarca;
$sms='<div style="position:relative; margin:5px; left:-5px;">';
crearDirs("../../img/galeria/");
crearDirs($ruta);

if(sqlQuery('INSERT INTO calibres(idMarca,nombre,tamBalin,tamCaja,filas)VALUES('.$idMarca.',"'.$nombre.'","'.$tamBalin.'","'.$tamCaja.'",'.$filas.')')){
	$con=sqlQuery('SELECT idCalibre FROM calibres WHERE idMarca='.$idMarca.' AND nombre="'.$nombre.'" AND tamBalin="'.$tamBalin.'" AND tamCaja="'.$tamCaja.'" AND filas='.$filas);
	if($result=sqlFetch($con)){
		crearDirs($ruta.'/'.$result[0]);
		$sms.='<span class="idenUserOk">Calibre creado correctamente.</span><br /><br />';
	}
}else{
	$sms.='<span class="idenUserFail">Error al crear el calibre.</span><br /><br />';
}
echo $sms.'</div>';
}
?> 