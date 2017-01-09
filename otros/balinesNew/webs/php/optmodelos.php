<?php
include_once('funciones.php');
include_once('functions_text.php');
$idinfo=$_REQUEST['idinfo'];
$idinfo2=explode(';;',$idinfo);
// idCal+';;'+idMarca+';;'+idenCal+';;'+filasCalibre
$marca=$idinfo2[1];
$idCal=$idinfo2[0];
$filas=$idinfo2[3];
$idmenu=$idinfo2[2];
if($idinfo!=''){
?>
<div class="miniTexto" style="background-color:rgba(0,0,0,.7); height:30px; line-height:30px; padding:5px; font-size:9px;" onclick="createModelos(<?php echo $marca; ?>,<?php echo $idCal ?>,<?php echo $idmenu ?>)">añade modelos en este calibre</div>

<div class="miniTexto" style="background-color:rgba(0,0,0,.5); height:30px; line-height:30px; padding:5px; font-size:9px;" onclick="editarFilas(<?php echo $filas; ?>,<?php echo $idCal ?>,<?php echo $idmenu ?>)">modifica las filas del calibre</div>
<?php 
}else{
	echo '';
}?>