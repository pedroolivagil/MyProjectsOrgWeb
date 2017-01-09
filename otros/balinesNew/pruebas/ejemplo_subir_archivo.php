<?php 
require('Archivo.php');
if($_POST){
	$a		= $_FILES['archivo']['name'];
	$d		= "archivos/";	
	$e		= array("doc","xls","ppt");
	$t		= $_FILES['archivo']['size'];
	$tmp	= $_FILES['archivo']['tmp_name'];
	$Archivo = new Archivo($a,$d,$e,$t,$tmp);	
	$u = $Archivo->upLoadFile();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
	<script type="text/javascript" src="prototype.js"></script>		
    </head>
    <body>	
		<form name="frmCarga" id="frmCarga" method="post" action="" enctype="multipart/form-data">
		<label for="archivo">Archivo</label>
		<input type="file" name="archivo" id="archivo" />
		<input type="submit" name="cargar" id="cargar" value="cargar" />
		</form>
    </body>
</html>