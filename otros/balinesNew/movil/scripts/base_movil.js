// JavaScript Document

function ajaxForm(ruta,data,id,tipo,id2,menu){
	$.ajax({
		url:ruta,
		type:'POST',
		data:data,
		cache:false,
		contentType:false,
		processData:false,
		beforeSend: function(msg){
			$("#"+id).html('');
			$("#"+id).append('<img src="scripts/jquerymobile/themes/images/ajax-loader.gif">');
		},
		success: function(msg){
			$("#"+id).html('');
			$("#"+id).append(msg);
		},
		error: function(error){
			$("#"+id).html('');
			$("#"+id).append('Error JQuery: '+error);
		}
	});
}

function idenUser(){
	var usuario=document.getElementById('usuario').value;
	var pasword=document.getElementById('pasword').value;
	var autologin=document.getElementById('autologin');
	var data = new FormData();
	data.append('usuario',usuario);
	data.append('pasword',pasword);
	if(autologin.checked){
		data.append('autologin',autologin.value);
	}
	ajaxForm('php/loginphp.php',data,'IdenUserLogin');
	
}

function salir(){
	var data = new FormData();
	data.append('salir',"<script>setTimeout(\"location.href='index.php'\",2000);</script>");
	ajaxForm('php/salir.php',data,'ajaxLoad',2);
}

function abrirInput(iden){
	document.getElementById(iden).click();
}

function limpiarFile(id){
	document.getElementById(id).value='';
}

function ocultarDiv(iden){
	$('#'+iden).slideToggle(500);
}

function selccionarCasilla(id,idParent,filas,cols,posVert){
	for(var x=0;x<=filas;x++){
		for(var y=0;y<=cols;y++){
			$('#fila'+x+'_mod'+y).removeClass('casillaHover');
		}
	}
	$('#'+id).addClass('casillaHover');
	cargarId(id,posVert);
}

function cargarId(id,posVert){
	var vars=id.split('_');
	var fila=vars[0].replace('fila','');
	var cols=vars[1].replace('mod','');
	$('#rowsFinal').val(fila)
	$('#colsFinal').val(cols)
	$('#posVert').val(posVert)
}

function cargarOptMarca(iden,iden2){
	var idMarcaImg = document.getElementById(iden2).value;
	var data = new FormData();
	data.append('idMarca',idMarcaImg);
	ajaxForm('php/cargaroptmarca.php',data,iden);
}

function cargarTablaPosImg(iden){
	var idMarcaImg = document.getElementById("idMarcaImg").value;
	var idCalibre = document.getElementById("idCalibreImg").value;
	
	var data = new FormData();
	data.append('idMarca',idMarcaImg);
	data.append('idCalibre',idCalibre);
	data.append('anchoWeb',document.body.scrollWidth);
	
	ajaxForm('php/cargartablasubirimg.php',data,iden);
}

function nuevaMarca(){
	var nombre = document.getElementById("nombre").value;
	var descript = document.getElementById("descripcion").value;
	var archivos = document.getElementById("archivos");
	var archivo = archivos.files;
	if((nombre=='')){
		return false;
	}	
	var data = new FormData();
		for(i=0; i<archivo.length; i++){
		data.append('archivo'+i,archivo[i]);	
	}	
	data.append('nombre',nombre);
	data.append('descripcion',descript);
	
	ajaxForm('php/newbrand.php',data,'cargados');
	limpiarFile('archivos');
	limpiarFile('nombre');
	limpiarFile('descripcion');
}

function crearCalibre(){
	var nombre = document.getElementById("nombreCal").value;
	var marca = document.getElementById("idMarca").value;
	var filas = document.getElementById("filas").value;
	var tamCaja = document.getElementById("tamCaja").value;
	var tamBalin = document.getElementById("tamBalin").value;
	var data = new FormData();
	data.append('nombre',nombre);
	data.append('filas',filas);
	data.append('tamCaja',tamCaja);
	data.append('tamBalin',tamBalin);
	data.append('marca',marca);
	
	ajaxForm('php/newcalibre.php',data,'cargados');
	limpiarFile('nombreCal');
	limpiarFile('filas');
	limpiarFile('tamCaja');
	limpiarFile('tamBalin');
}

function crearModelo(){
	var nombre = document.getElementById("nombreMod").value;
	var idMarca = document.getElementById("idMarca2").value;
	var idCal = document.getElementById("idCal").value;
	var archivos = document.getElementById("archivos2");
	var archivo = archivos.files;
	if((nombre=='')){
		return false;
	}
	var data = new FormData();
		for(i=0; i<archivo.length; i++){
		data.append('archivo'+i,archivo[i]);
	}	
	data.append('nombre',nombre);
	data.append('idMarca',idMarca);
	data.append('idCal',idCal);
	
	ajaxForm('php/newmodelo.php',data,'cargados');
	limpiarFile('archivos2');
	limpiarFile('nombreMod');
}
function subirImgMovil(){ 
	var archivos=document.getElementById("archivosImg");
	var archivo=archivos.files;
	var nombre=document.getElementById("nombreImg").value;
	var idMarca=document.getElementById("idMarcaImg").value;
	var calibre=document.getElementById("idCalibreImg").value;
	var modelo=document.getElementById("colsFinal").value;
	var posicion=document.getElementById("rowsFinal").value;
	var descript=document.getElementById("descripcionImg").value;
	var tipo=document.formularioUpload.tipo;
	
	document.getElementById('cargarImg').src='../scripts/jquerymobile/themes/images/ajax-loader.gif';
		
	if((nombre=='')||(idMarca=='')||(calibre=='')||(modelo=='')||(posicion=='')){
		return false;
	}else{
		document.formularioUpload.submit();
	}
}