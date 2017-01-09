// JavaScript Document

function ajaxForm(ruta,data,id,tipo,id2,menu){
	switch(tipo){
		case 2:
		case 3:
			$('#'+id).fadeIn(500);
			$('#'+id).html('<br /><div class="circle"></div><div class="circle1"></div></div>');
		break;
		case 'ajax':
			$('#'+id2).fadeIn(500);
			$('#'+id2).html('<div class="textoCarro contenedorAjax">CARGANDO<div class="circle" style="margin-top:10px;"></div><div class="circle1"></div></div>');
		break;
	}
	$.ajax({
		url:ruta, //Url a donde la enviaremos
		type:'POST', //Metodo que usaremos
		contentType:false, //Debe estar en false para que pase el objeto sin procesar
		data:data, //Le pasamos el objeto que creamos con los archivos
		processData:false, //Debe estar en false para que JQuery no procese los datos a enviar
		cache:false //Para que el formulario no guarde cache
	}).done(function(msg){
		switch(tipo){
			case 1:
				setTimeout('abrirInput("'+id+'")',500);
			break;
			case 2:
			case 6:
				$("#"+id).html('');
				$("#"+id).append(msg);
			break;
			case 3:
				$("#"+id).html('');
				$("#"+id).append(msg);
				setTimeout('abrirInput("'+id2+'")',2000);
			break;
			case 4:
				//alert(msg)
				var div='<div style="height:40px; background:rgba(0,0,0,.2); text-transform:uppercase; font-size:24px; padding-top:8px;">información</div><div style="font-size:18px; padding-top:10px;"><br />'+msg+'</div>';
				$('#cargarLoadsGeneral').html(div);
				
				setTimeout('abrirInput("'+id+'")',2000);
				setTimeout('cerrarDivs("cargarLoadsGeneral")',3000);
				setTimeout('cerrarDivs("ajaxLoadFondo")',3500);
			break;
			case 5:
				alert(msg)
			break;
			case 'ajax':
				$('#'+id2).fadeOut(500,function(){
					$('#'+id).html(msg);
					if(menu==1){
						aparecer_menu('cargaMenus','submenu','DIV');
					}
				});
			break;
		}
	}).fail(function() {
		switch(tipo){
			case 2:
			case 3:
			case 'ajax':
				$('#'+id).fadeIn(500);
				$('#'+id).html("Error");
			break;
			case 5:
				alert("Error");
			break;
		}
	});
}

var Tools = {
  createCookie: function(name, value,days) {
    if (days) {
      var date = new Date();
      date.setTime(date.getTime()+(days*60*60*1000));
      var expires = "; expires="+date.toGMTString();
    }else var expires = "";
      document.cookie = name+"="+value+expires+"; path=/";
  },
  readCookie: function(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
      var c = ca[i];
      while (c.charAt(0)==' ') c = c.substring(1,c.length);
      if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
  },
  eraseCookie: function(name) {
    Tools.createCookie(name,"",-1);
  }
};
function volver(){
	window.history.back();
}
function mostrarArriba(){
	var alturaX=window.pageYOffset;
	var alturaMax=window.innerHeight;
	if((alturaX+alturaMax)>alturaMax){
		$('#divFlechaArriba').fadeIn(500);
	}else{
		$('#divFlechaArriba').fadeOut(500);
	}
	setTimeout('mostrarArriba()',0);
}
function arriba(px){
	(px== null)? px='0' : px=px+'px'; 
	$(document).ready(function(){
		$('html, body').animate({scrollTop:px},'fast');
	});
}
function imprSelec(nombre){
  var ficha = document.getElementById(nombre);
  var ventimp = window.open(' ', 'popimpr');
  ventimp.document.write('<center>'+ficha.innerHTML+'</center>' );
  ventimp.document.close();
  ventimp.print( );
  ventimp.close();
}

function click_link(url){
	url.replace('?','&#63');
	window.open(url,'Foros Balines');
}
function abrirInput(iden){
	document.getElementById(iden).click();
}
function max_width(ancho){
	imgs=document.getElementsByTagName('img');
	for(i=0;i<imgs.length;i++)
	{
		if(imgs[i].name='max_widthMax')
		{
			numero=ancho;
			alturaIma=imgs[i].style.height;
			anchuraIma=imgs[i].style.width;
			if(alturaIma>=anchuraIma){
				proporcion=anchuraIma/alturaIma;
				imgs[i].style.height=numero+"px";
				imgs[i].style.width=Math.ceil(numero*proporcion)+"px";
			}else{
				//Mas ancho q largo
				proporcion=alturaIma/anchuraIma;
				imgs[i].style.width= numero+"px";
				imgs[i].style.height=Math.ceil(numero*proporcion)+"px";
			}
		}
	}
}
function mostrarCodigo(e,iden){
	clave=e.keyCode;
	if(clave==13){
		abrirInput(iden);
	}
}
function aparecer_menu(idDad,idChild,typeChild,efecto,tiempo){
	var ul=document.getElementById(idDad);
	var k='';
	(tiempo)? time=tiempo*1000 : time=500;
	(efecto)? efect=true : efect=false;
	total=ul.childNodes.length;
	var num=0;
	for(var p=0;p<total;p++){
		div2=ul.childNodes[p];
		if(div2.nodeType==1){
			if(div2.nodeName==typeChild){
				if(!efect){
					$('#'+idChild+num).delay(num*200).fadeIn(time);
				}else{
					$('#'+idChild+num).delay(num*200).slideDown(time);
				}
				num++;
			}
		}
	}
}
function menus(url,id,clase1,clase){
	for(var x=1;x<5;x++){
		$('#menu'+x).removeClass('boton'+(x+4));
		$('#menu'+x).addClass('boton'+(x));
	}
	$('#'+id).removeClass(clase1);
	$('#'+id).addClass(clase);
	
	ajaxForm(url,'','cargaMenus','ajax','ajaxLoad',1);
}
function cargarSubMenu(idMarca,filas,id){
	for(var x=0;x<=filas;x++){
		$('#submenu'+x).removeClass('marca selected');
		$('#submenu'+x).addClass('marca');
	}
	$('#submenu'+id).removeClass('marca');
	$('#submenu'+id).addClass('marca selected');
	
	var data = new FormData();
	data.append('idMarca',idMarca);
	data.append('idMenu',id);
	
	ajaxForm('webs/php/submenus.php',data,'mostrarObjetosTabSup','ajax','ajaxLoad');
	
	cargarInfo('webs/php/infobrand.php',idMarca,'contenidoinfoMarca');
	cargarInfo('webs/php/infocalibres.php','','contenidoinfoCalibre');
	cargarInfo('webs/php/optmodelos.php','','contenidoopcionesModelos');
}
function subMenuModelos(idMarca,filas,id,filasCalibre,idCal){
	var idenCal=id;
	for(var x=0;x<=filas;x++){
		$('#calibre'+x).removeClass('calibres calSel');
		$('#calibre'+x).addClass('calibres');
	}
	$('#calibre'+id).removeClass('calibres');
	$('#calibre'+id).addClass('calibres calSel');
	
	var data = new FormData();
	
	data.append('idMarca',idMarca);
	data.append('filas',filasCalibre);
	data.append('id',idCal);
	data.append('idmenu',idenCal);
	ajaxForm('webs/php/mostrarmodelos.php',data,'mostrarObjetos','ajax','ajaxLoad');
	
	cargarInfo('webs/php/infocalibres.php',idCal,'contenidoinfoCalibre');
	cargarInfo('webs/php/optmodelos.php',idCal+';;'+idMarca+';;'+idenCal+';;'+filasCalibre,'contenidoopcionesModelos');
}
function cargarSubMenuDel(id,url,option){
	for(var x=0;x<=3;x++){
		$('#submenu'+x).removeClass('marca selected');
		$('#submenu'+x).addClass('marca');
	}
	$('#submenu'+id).removeClass('marca');
	$('#submenu'+id).addClass('marca selected');
	
	var data = new FormData();
	data.append('opcion',option);
	
	ajaxForm('webs/php/'+url,data,'mostrarObjetos','ajax','ajaxLoad');
}
function mostrarEditor(id,iden){
	$('#ajaxLoadFondo').fadeIn(500,function(){
		$('#titulo'+iden).css('z-index','9999');
		$('#'+id).fadeIn(500);
	});
}
function cerrarDivs(div){
	$('#'+div).fadeOut(200);
}
function cambiarTypeBG(id){
	for(var x=0;x<=3;x++){
		$('#typeImg'+x).removeClass('selectedType');
	}
	$('#typeImg'+id).addClass('selectedType');
}
function mostrarImg(ruta,anchoImg,altoImg,tipo,descript){
	switch(tipo){
		case 0:
		tipo='redondoImg';
		break;
		case 1:
		tipo='rectoImg';
		break;
		case 2:
		default:
		tipo='normalImg';
		break;
	}
	if(descript){
		descript=descript;
	}else{
		descript='No hay ninguna descripcion';
	}
	var left=anchoImg/2;
	var top=altoImg/2;
	var anchoWeb=document.body.scrollWidth;
	var altoWeb=document.body.scrollHeight;
	/*
	$('#divLoadImg').fadeIn(500,function(){
		$('#divLoadImg div').fadeIn(500,function(){
			document.getElementById('resultLoadImg').innerHTML='';
			document.getElementById('resultLoadImg').innerHTML='<img src="'+ruta+'" class="'+tipo+'" style="max-width:'+anchoWeb+'px; max-height:'+altoWeb+'px;" />';
			$('#divLoadImg div img').hide();
			$('#divLoadImg div').css('top','0').css('left','0').css('width',anchoWeb+'px').css('height',altoWeb+'px');
				$('#divLoadImg div img').fadeIn(500);
		});
	});*/
	imgsMostrarDiv
	infoImgMostrar
	var altoWeb=document.body.scrollHeight;
	var anchoWeb=document.body.scrollWidth;
	altoWeb2=(altoWeb*0.73);
	altoWeb=(altoWeb*0.75)/2;
	anchoWeb2=(anchoWeb*0.73);
	$('#mostrarImgFinal').fadeIn(200,function(){
		$('#mostrarImgFinalInterior').animate({width:'75%', height:'75%',marginTop:'-'+altoWeb+'px'},200);
		document.getElementById('imgsMostrarDiv').innerHTML='';
		document.getElementById('imgsMostrarDiv').innerHTML='<img src="'+ruta+'" class="'+tipo+'" style="max-width:'+(anchoWeb2)+'px; max-height:'+(altoWeb2)+'px;" />';
		//$('#divLoadImg div img').hide();
		var anchoDiv=document.getElementById('resultLoadImg').width;
		
	})	
}
function createModelos(marca,id,idmenu){
	$('#ajaxLoadFondo').fadeIn(500,function(){
		redimensionarDiv('cargarLoadsGeneral',290,317,5,false);
		var data = new FormData();
		data.append('idMarca',marca);
		data.append('idCal',id);
		data.append('idmenu',idmenu);
		
		ajaxForm('webs/php/crearmodelos.php',data,'cargarLoadsGeneral','ajax','ajaxLoad');
	});
}
function createCalibres(marca,id){
	$('#ajaxLoadFondo').fadeIn(500,function(){
		redimensionarDiv('cargarLoadsGeneral',290,317,5,false);
		var data = new FormData();
		data.append('idMarca',marca);
		data.append('idMenu',id);
		
		ajaxForm('webs/php/crearcalibres.php',data,'cargarLoadsGeneral','ajax','ajaxLoad');
	});
}
function createMarcas(){
	$('#ajaxLoadFondo').fadeIn(500,function(){
		redimensionarDiv('cargarLoadsGeneral',290,317,5,false);
		ajaxForm('webs/php/crearmarcas.php','','cargarLoadsGeneral','ajax','ajaxLoad');
	});
}
function subirImg(posicion,marca,calibre,modelo,idMenu){
	$('#ajaxLoadFondo').fadeIn(500,function(){
		redimensionarDiv('cargarLoadsGeneral',320,317,5,false);
		var data = new FormData();
		data.append('idMarca',marca);
		data.append('calibre',calibre);
		data.append('modelo',modelo);
		data.append('posicion',posicion);
		data.append('idMenu',idMenu);
		
		ajaxForm('webs/php/subirimg.php',data,'cargarLoadsGeneral','ajax','ajaxLoad');
	});
}
function abriLogin(){
	$('#ajaxLoadFondo').fadeIn(500,function(){
		redimensionarDiv('cargarLoadsGeneral',360,700,0,false);
		ajaxForm('webs/loginreg.php','','cargarLoadsGeneral','ajax','ajaxLoad');
	});
}
function subirLogoModelo(marca,id,modelo,idmenu){
	$('#ajaxLoadFondo').fadeIn(500,function(){
		redimensionarDiv('cargarLoadsGeneral',290,317,5,false);
		var data = new FormData();
		data.append('idMarca',marca);
		data.append('idCal',id);
		data.append('idMod',modelo);
		data.append('idmenu',idmenu);
		
		ajaxForm('webs/php/crearmodelos.php',data,'cargarLoadsGeneral','ajax','ajaxLoad');
	});
}
function redimensionarDiv(id,altura,anchura,padd,modo){
	$('#'+id).html('').css('padding','0');
	$('#'+id).animate({width:"2px",marginLeft:'-1px',height:'2px',marginTop:'-1px'},0);
	var top=altura/2;
	var left=anchura/2;
	if(modo){
		$('#'+id).fadeIn(500).animate({width:anchura+"px",marginLeft:'-'+left+'px',height:altura+'px',marginTop:'-'+top+'px'},500);
	}else{
		$('#'+id).fadeIn(500).animate({width:anchura+"px",marginLeft:'-'+left+'px',paddingLeft:padd+'px',paddingRight:padd+'px'},500,function(){
			$('#'+id).fadeIn(500).animate({height:altura+'px',marginTop:'-'+top+'px',paddingTop:padd+'px',paddingBottom:padd+'px'},200)
		});
	}
}
function seleccionado(){
	var archivos=document.getElementById("archivos");
	var archivo=archivos.files;
	var nombre=document.getElementById("nombre").value;
	var idMarca=document.getElementById("idMarca").value;
	var calibre=document.getElementById("calibre").value;
	var modelo=document.getElementById("modelo").value;
	var posicion=document.getElementById("posicion").value;
	var descript=document.getElementById("descript").value;
	var idMenu=document.getElementById("idMenu").value;
	var tipo=document.formularioUpload.tipo;
	if((nombre=='')||(idMarca=='')||(calibre=='')||(modelo=='')||(posicion=='')){
		return false;
	}
	var data = new FormData();
	
	for(i=0; i<archivo.length; i++){
		data.append('archivo'+i,archivo[i]);	
	}
	for(e=0; e<tipo.length; e++){
		if(tipo[e].checked){
			tipo1=tipo[e].value;
		}
	}
	data.append('nombre',nombre);
	data.append('idMarca',idMarca);
	data.append('calibre',calibre);
	data.append('modelo',modelo);
	data.append('posicion',posicion);
	data.append('descript',descript);
	data.append('tipo',tipo1);
	ajaxForm('webs/php/upload.php',data,'cargados',3,'calibre'+idMenu);
}
function eliminarImg(id,idMenu){
	$('#ajaxLoadFondo').fadeIn(500,function(){
		redimensionarDiv('cargarLoadsGeneral',150,400,5,false);
		var div=new Array();
		div[0]='<div style="height:40px; background:rgba(0,0,0,.2); display:none; text-transform:uppercase; font-size:24px; padding-top:8px;" id="hijo1">¿Estas seguro?</div>';
		div[1]='<div style="display:none; font-size:18px; padding-top:10px;" id="hijo2">¿Seguro que quieres borrar esta imagen?<br /><br /></div>';
		div[2]='<div id="boton1" style="float:left; width:80px; height:30px; background:rgba(0,0,0,.1); padding-top:5px; margin-right:5px; transition-property:background-color; transition-duration:.3s;">SI</div>';
		div[3]='<div id="boton2" style="float:left; width:80px; height:30px; background:rgba(0,0,0,.1); padding-top:5px; transition-property:background-color; transition-duration:.3s;">NO</div>';
		div[4]='<div id="hijo3" style=" display:none; width:170px; margin:0 auto; font-size:22px;">'+div[2]+div[3]+'</div>';
		
		document.getElementById('cargarLoadsGeneral').innerHTML=div[0]+div[1]+div[4];
		
		$('#hijo1').delay(1500).fadeIn(200,function(){
			$('#hijo2').fadeIn(200,function(){
				$('#hijo3').fadeIn(200,function(){
					$('#boton1,#boton2').hover(function(){
						$(this).css('background','rgba(180,180,180,1)');
					},function(){
						$(this).css('background','rgba(0,0,0,.1)');
					});
					$('#boton1').click(function(){
						var data = new FormData();
						data.append('idGen',id);
						ajaxForm('webs/php/delimg.php',data,'calibre'+idMenu,4);
					});
					$('#boton2').click(function(){
						cerrarDivs('cargarLoadsGeneral');
						cerrarDivs('ajaxLoadFondo');
					});
				});
			});
		});
	});
	
	/*var confirmar=confirm('Estas seguro que quieres borrar esta imagen?');
	if(!confirmar){
		alert('No se ha borrado la imagen.');
	}else{
		var data = new FormData();
		data.append('idGen',id);
		
		ajaxForm('webs/php/delimg.php',data,'calibre'+idMenu,4);
	}*/
}
function nuevaMarca(){
	var nombre = document.getElementById("nombre").value;
	var descript = document.getElementById("descripcion").value;
	var archivos = document.getElementById("archivos");
	var archivo = archivos.files;
	if((nombre=='')){
		alert('El nombre es obligatorio.')
		return false;
	}	
	var data = new FormData();
		for(i=0; i<archivo.length; i++){
		data.append('archivo'+i,archivo[i]);	
	}	
	data.append('nombre',nombre);
	data.append('descripcion',descript);
	
	ajaxForm('webs/php/newbrand.php',data,'cargados',3,'menu1');
	limpiarFile('archivos');
	limpiarFile('nombre');
	limpiarFile('descripcion');
}
function crearCalibre(id){
	var nombre = document.getElementById("nombre").value;
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
	
	ajaxForm('webs/php/newcalibre.php',data,'cargados',3,'submenu'+id);
	limpiarFile('nombre');
	limpiarFile('filas');
	limpiarFile('tamCaja');
	limpiarFile('tamBalin');
}
function crearModelo(actu,id){
	var nombre = document.getElementById("nombre").value;
	var idMarca = document.getElementById("idMarca").value;
	var idCal = document.getElementById("idCal").value;
	var idMod = document.getElementById("idMod").value;
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
	data.append('idMarca',idMarca);
	data.append('idCal',idCal);
	data.append('idMod',idMod);
	data.append('actu',actu);
	
	ajaxForm('webs/php/newmodelo.php',data,'cargados',3,'calibre'+id);
	limpiarFile('archivos');
	limpiarFile('nombre');
}
function actualizar(id,valor,id2,tabla,num){
	var contenido=($('#'+id).html().replace('<br>',''));
	var data = new FormData();
	if(!contenido){
		alert('No puede estar vacío');
		return false;
	}
	data.append('contenido',contenido);
	data.append('valor',valor);
	data.append('tabla',tabla);
	$('#'+id2).fadeOut(500);
	ajaxForm('webs/php/actumodelo.php',data,id,6);
	
	$('#'+id).css('z-index','7');
	$('#ajaxLoadFondo').fadeOut(500);
	var bg;
	if(contenido=='---'){
		bg='#DDD';
	}else{
		bg='#FFF';
	}
	cambiarBG('bgcambiable'+num,bg);
}
function editarFilas(valor,idCal,idmenu){
	var pregunta=prompt('Modifica la fila:',valor);
	var data = new FormData();
	if(!pregunta){
		return false;
	}
	data.append('idCal',idCal);
	data.append('valor',pregunta);
	ajaxForm('webs/php/actucalibre.php',data,'calibre'+idmenu,1);
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
	ajaxForm('webs/loginphp.php',data,'IdenUserLogin',2);
	
}
function salir(){
	var opcion=confirm('Seguro que deseas cerrar sesión?');
	if(opcion){
		var data = new FormData();
		data.append('salir',"<script>setTimeout(\"location.href='index.php'\",2000);</script>");
		ajaxForm('webs/salir.php',data,'ajaxLoad',2);
	}
}
function actualizarMarca(){
	var idMarca=document.getElementById('selBrand').value;
	var newName=document.getElementById('newName').value;
	var data = new FormData();
	if(!newName || idMarca==0){
		return false;
	}
	data.append('idMarca',idMarca);
	data.append('newName',newName);
	ajaxForm('webs/php/actumarca.php',data,'cargados',3,'submenu0');
}
function actumarcadescrip(id){
	var data = new FormData();
	var descript=prompt('Añade una descripción:')
	data.append('idMarca',id);
	data.append('newName',descript);
	ajaxForm('webs/php/actumarcadescrip.php',data,'descripMarca',6);
}
function ocultarMenuIzquierda(){
	var tiempo=0;
	var anchoWeb=document.body.scrollWidth;
	$('#cargaMenus,#miniMenus').fadeOut(tiempo,function(){
		$('#menuGeneral').animate({width:'0'},tiempo).hide(0);
		$('#mostrarObjetosTabSup').animate({left:'75px',width:(anchoWeb-75)+'px'},tiempo);
		$('#mostrarObjetos,#pie').animate({left:'0',width:(anchoWeb)+'px'},tiempo,function(){
			$('#divOcultarMostrarMenu').fadeIn(tiempo);
			$('#divOcultarMostrarMenu').css('-webkit-transform','rotate(180deg)');
			$('#divOcultarMostrarMenu').css('-moz-transform','rotate(180deg)');
			$('#divOcultarMostrarMenu').css('-ms-transform','rotate(180deg)');
			$('#divOcultarMostrarMenu').css('-o-transform','rotate(180deg)');
			$('#divOcultarMostrarMenu').css('transform','rotate(180deg)');
			$('#divOcultarMostrarMenu').css('margin-left','27px');
			$('#divOcultarMostrarMenu').css('margin-top','2px');
		});
	});
}
function mostrarMenuIzquierda(){
	var tiempo=0;
	var anchoWeb=document.body.scrollWidth;
	$('#divOcultarMostrarMenu').fadeOut(tiempo,function(){
		$('#cargaMenus,#miniMenus').hide(0);
		$('#menuGeneral').show(0).animate({width:'300px'},tiempo);
		$('#mostrarObjetosTabSup,#mostrarObjetos,#pie').animate({left:'300px',width:(anchoWeb-300)+'px'},tiempo,function(){
			$('#cargaMenus,#miniMenus').fadeIn(tiempo);
		});
	});
}
function borrarMarca(){
	var idMarca=document.getElementById('selBrand').value;
	var data = new FormData();
	if(idMarca==0){
		return false;
	}
	data.append('idMarca',idMarca);
	ajaxForm('webs/php/delbrand.php',data,'cargados',3,'submenu2');
}
function reemplazarSelect(){
	var idMarca=document.getElementById('selBrand').value;
	var div='reemplazarSelect';
	var data = new FormData();
	if(idMarca==0){
		return false;
	}
	data.append('idMarca',idMarca);
	ajaxForm('webs/php/calibres.php',data,div,2);
}
function actualizarCalibres(){
	var idMarca=document.getElementById('selBrand').value;
	var cargarCals=document.getElementById('cargarCals').value;
	var newName=document.getElementById('newName').value;
	var data = new FormData();
	if(idMarca==0 || cargarCals==0 || (newName=='' || newName==null)){
		return false;
	}
	data.append('idMarca',idMarca);
	data.append('cargarCals',cargarCals);
	data.append('newName',newName);
	ajaxForm('webs/php/updatecalibre.php',data,'cargados',3,'submenu1');
}
function borrarCalibre(){
	var idMarca=document.getElementById('selBrand').value;
	var cargarCals=document.getElementById('cargarCals').value;
	var data = new FormData();
	if(cargarCals==0){
		return false;
	}
	data.append('cargarCals',cargarCals);
	data.append('idMarca',idMarca);
	ajaxForm('webs/php/delcal.php',data,'cargados',3,'submenu3');
}
function vaciarTablas(){
	var conf=confirm("Estas seguro de querer vaciar las tablas?\n\nLa opcion no se puede deshacer.");
	if(conf){
		ajaxForm('webs/php/truncatetables.php','','cargados',2);
	}else{
		alert('Sin cambios');
	}
}

function abrirDiv(iden,opt,h,t){
	$(document).ready(function(e) {
		if(opt){
			var altoWeb=document.body.scrollHeight;
			$('#'+iden).show(0).animate({height:h+'px'},t);
			$('#mostrarObjetos').animate({height:(altoWeb-(h+2)-110)+'px'},t);
		}else{
			$('#'+iden).fadeIn(500);
		}
    });
}

function abrirDiv2(minn,maxx){
	if(document.getElementById("showHideMenu").innerHTML=="ocultar menú"){
		abrirDiv('pie',1,minn,200);
		document.getElementById("showHideMenu").innerHTML="mostrar menú"
	}else{
		abrirDiv('pie',1,maxx,200);
		document.getElementById("showHideMenu").innerHTML="ocultar menú"
	}
}
function cerrarDiv(iden,opt,h,t){
	$(document).ready(function(e) {
		if(opt){
			var altoWeb=document.body.scrollHeight;
			$('#'+iden).show(0).animate({height:h+'px'},t);
			$('#mostrarObjetos').animate({height:(altoWeb-(h+2)-110)+'px'},t);
		}else{
			$('#'+iden).fadeOut(500);
		}
    });
}
function registrar(){
	var password=document.getElementById('paswordReg').value;
	var repPass=prompt('Vuelve a introducir tu password:');
	if(repPass==password && password!=''){
		var data = new FormData();
		var id='registroCompleto';
		var usuario=document.getElementById('usuarioReg').value;
		var email=document.getElementById('email').value;
		var edad=document.getElementById('edad').value;
		var nombre=document.getElementById('nombre').value;
		var pais=document.getElementById('pais').value;
		if(usuario=='' || email=='' || nombre==''){
			alert('Los campos estan vacíos.');
			return false;
		}
		data.append('usuario',usuario);
		data.append('password',password);
		data.append('email',email);
		data.append('edad',edad);
		data.append('nombre',nombre);
		data.append('pais',pais);
		data.append('register','Registrarse');
		ajaxForm('webs/reguser.php',data,id,2);
	}else{
		alert('Las contraseñas no coinciden.');
	}
}
function cerrarDivsBase(){
	$('#cargarLoadsGeneral').fadeOut(500,function(){
		$('#ajaxLoadFondo').fadeOut(500);
	});
}
function limpiarFile(id){
	document.getElementById(id).value='';
}
function cambiarBG(id,bg){
	$('.'+id).css('background-color',bg)
}
function cargarInfo(url,idinfo,id){
	var data = new FormData();	
	data.append('idinfo',idinfo);	
	ajaxForm(url,data,id,6);
}
function cerrardivonload(){
	var anchoWeb=document.body.scrollWidth;
	var altoWeb=document.body.scrollHeight;
	var maxancho=700;
	if(anchoWeb<maxancho){
		document.getElementById('menu4').click();
		
		$('#cabecera').animate({width:(anchoWeb)+'px'},0);
		$('#mostrarObjetos,#mostrarObjetosTabSup,#bordeBottomCab').animate({width:(anchoWeb)+'px'},0);
		$('#pie').animate({width:(anchoWeb)+'px'},0);
		$('#mostrarObjetos,#cargaMenus').animate({height:(altoWeb)+'px'},0);

	}else{
		document.getElementById('menu5').click();
	}
	$(window).resize(function(){
		var anchoWeb=document.body.scrollWidth;
		var altoWeb=document.body.scrollHeight;
		if(anchoWeb<maxancho){
			document.getElementById('menu4').click();
		}else{
			document.getElementById('menu5').click();
		}
	});
}

/**************************************************/
/*var dispositivo = navigator.userAgent.toLowerCase();
if( dispositivo.search(/iphone|ipod|ipad|android/) > -1 ){
	document.location = 'm.balinescoleccion.es';
}*/
$(document).ready(function(e) {
	$('body').fadeIn(500,function(){
	if(navigator.appName=='Microsoft Internet Explorer'){
		alert("Esta web no esta optimizada para Internet Explorer.\n\nAlgunas de sus funciones podrian no funcionar correctamente.\n\nUse Google Chrome, Firefox, Opera o Safari");
	}
	$(document).keypress(function (e){
		clave=e.keyCode;
		if(clave==27){
			// tecla escape
			$('#divLoadImg div img').fadeOut(200,function(){
				$('#divLoadImg div').animate({width:'2px',height:'2px',marginLeft:'-1px',marginTop:'-1px',padding:'0'},200,function(){
					document.getElementById('resultLoadImg').innerHTML='';
					$('#divLoadImg div').hide();
					$('#divLoadImg').fadeOut(500);
				});
			});
			cerrarDivsBase()
			altoWeb=(altoWeb*0.75);
			$('#mostrarImgFinalInterior').animate({width:'0', height:'0',marginTop:altoWeb+'px'},200,function(){
				$('#mostrarImgFinal').fadeOut(200);
			})		
		}
	});
	//
	var anchoWeb=document.body.scrollWidth;
	var altoWeb=document.body.scrollHeight;
	if(anchoWeb<600){
		anchoWeb=600;
	}
	$('#cabecera').animate({width:(anchoWeb)+'px'},0);
	$('#mostrarObjetos,#mostrarObjetosTabSup,#bordeBottomCab').animate({width:(anchoWeb-300)+'px'},0);
	$('#pie').animate({width:(anchoWeb-301)+'px'},0);
	$('#mostrarObjetos,#cargaMenus').animate({height:(altoWeb-138)+'px'},0);
	cerrardivonload();
	});
	
	
	abrirDiv('pie',1,26,200)
	abrirInput('menu1');
	$(window).resize(function(){
		var anchoWeb=document.body.scrollWidth,resto;
		var altoWeb=document.body.scrollHeight;
		if($('#menuGeneral').is(':hidden')){
			resto=0
		}else{
			resto=300
		}
		$('#cabecera').animate({width:(anchoWeb)+'px'},-100);
		$('#mostrarObjetos,#mostrarObjetosTabSup,#bordeBottomCab,#pie').animate({width:(anchoWeb-resto)+'px'},-100);
		$('#mostrarObjetos,#cargaMenus').animate({height:(altoWeb-138)+'px'},-100);
	});
	$('#cuerpoBaseIndex').delay(1000).fadeIn(500);
	//cerrardivonload();
});