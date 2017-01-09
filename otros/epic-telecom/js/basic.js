// JavaScript Document
var data = new FormData();
var url = document.domain;
url+= (document.domain == 'localhost') ? '/epic-telecom' : '';
function ajax(url, data, div, func){
	/* para cargar las paginas mediante ajax de jquery */
	$.ajax({
		url: url,
		type:'POST',
		data: data,
		cache:false,
		contentType:false,
		processData:false,
		success: function(sms){
			$('#'+div).html(sms);
			func();
		},
		error: function(sms){
			jsAlertError("error de conexion","Error")
		}
	});
}
function getCookie(c_name){
    var c_value = document.cookie;
    var c_start = c_value.indexOf(" " + c_name + "=");
    if (c_start == -1){
        c_start = c_value.indexOf(c_name + "=");
    }
    if (c_start == -1){
        c_value = null;
    }else{
        c_start = c_value.indexOf("=", c_start) + 1;
        var c_end = c_value.indexOf(";", c_start);
        if (c_end == -1){
            c_end = c_value.length;
        }
        c_value = unescape(c_value.substring(c_start,c_end));
    }
    return c_value;
} 
function setCookie(c_name,value,exdays){
    var exdate=new Date();
    exdate.setDate(exdate.getDate() + exdays);
    var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
    document.cookie=c_name + "=" + c_value;
}
function PonerCookie(){
    setCookie('tiendaaviso', true, 365);
	$("#barraaceptacion").fadeOut(500);
}
function btnBack(){
	window.history.back();
}
function clickElement(id){
	// clicar un elemento
	$('#'+id).click();
}
function scrollTopWeb(num){	
	// subimos la pagina a la posicion "num"
	$('html, body').animate({scrollTop:num},'fast');
}
function scrollTop(){	
	// subimos la pagina hasta arriba
	return $(window).scrollTop();
}
function fixButtonUp(){
	// mostramos el boton 'subir' para subir la pagina rapidamente
	if ($(window).scrollTop() > 1){
		$('#upPage').fadeIn(300);
	} else {
		$('#upPage').fadeOut(500);
	}
	setTimeout('fixButtonUp()',10);
}
function resizeHeader(){
	if(window.innerWidth > 767){
		$('#btns-short').slideUp(0);
		$('#btns-large').slideDown(0);
		if($(window).scrollTop() > 200){
			$('#logo').css('max-width','280px');
			$('#contact').css('max-width','150px');
			$('#nav').css('top','81px');
			$('header, #nav').css('background','rgba(255,255,255,1)');
			$('header div img').removeAttr('class').addClass('max');
		}else{
			$('#logo').css('max-width','500px');
			$('#contact').css('max-width','180px');
			$('#nav').css('top','113px');
			$('header, #nav').css('background','rgba(255,255,255,1)');
			$('header div img').removeAttr('class').addClass('min');
		}
	}else{
		$('#btns-large').slideUp(0);
		$('#btns-short').slideDown(0);
		$('#logo').css('max-width','280px');
		$('#contact').css('max-width','150px');
	}
	setTimeout('resizeHeader()',1);
}
function fillCaptionText(array){
	$('.caption-text').html();
	var str = "";
	for(var x = 0; x < array.length; x++){
		if(x==0){
        	str+= '<div class="glyphicon-pro fnt-90 top5 glyphicon-show-thumbnails left">';
		}else{
        	str+= '<div class="glyphicon-pro fnt-90 top5 glyphicon-chevron-right left">';
		}
		str+= '</div><div class="left">'+array[x]+'</div>';
	}
	$('.caption-text').html(str);
}
function randomForm(id){
	var form = document.getElementById(id);
	for(var z = 0; z < form.length; z++){
		if(form[z].value == "" && form[z].hasAttribute('required')){
			form[z].value = Math.random().toString(36).replace(/[^a-z]+/g, '');
		}
		if(form[z].type == 'email'){
			form[z].value = 
			Math.random().toString(36).replace(/[^a-z]+/g, '')+"@"+
			Math.random().toString(36).replace(/[^a-z]+/g, '')+"."+
			Math.random().toString(36).replace(/[^a-z]+/g, '');
		}
		if(form[z].type == 'tel'){
			form[z].value = 977368257;
		}
	}
	$('#form_accountiban').val('ES91');
	$('#form_accountswift').val('caixesbbxxx');
	$('#form_accountnumber').val('01821377420201717028');
}
function changeCaptionImg(url){
	// cambiamos el bg de las cabeceras de cada pestaña
	$('#caption-image').attr('src',url);
}
function showconditions(id){
	$(id).fadeIn(200);
}
function closecondititons(id){
	$(id).fadeOut(200);
}
function checkGnumPort(){
	if($('#form_gnumport').is(':checked')){
		$('#div_gnumport_values').slideDown(200);
		$('#form_gnumport_values').attr('required',true);
	}else{
		$('#div_gnumport_values').slideUp(200);
		$('#form_gnumport_values').attr('required',false);
	}
	if($('#form_autorizinternational').is(':checked')){
		$('#div_autorizinternational_values').slideDown(200);
		$('#form_autorizinternational_values').attr('required',true);
	}else{
		$('#div_autorizinternational_values').slideUp(200);
		$('#form_autorizinternational_values').attr('required',false);
	}
	setTimeout('checkGnumPort()',10);
}
function actUserBar(){
	ajax('http://'+ url +'/www/files/userbar.php', null, 'user-content',function(){
	});
}
function addLoader(){
	$('a.loader').on('click',function(){
		$('#loaderDiv').fadeIn(200);
	});
}
function checklegalisreaded(){
	/*$('#user-content').html(
		$('#legal-div').scrollTop() +' - '+ ($('#legal-div div').height()-180)
	);*/
	if($('#legal-div').scrollTop() >= ($('#legal-div div').height()-250)){
		$('#btn').removeAttr('disabled');
	}else{
		setTimeout('checklegalisreaded()',10);
	}
}
function fillForm(){
	$.getJSON('http://'+ url +'/www/php/userdata.php')
		.done(function(json){
			$('#form_razon').val(json.username);
			$('#form_ncif').val(json.nif);
			$('#form_nifrepre').val(json.nif);
			$('#form_mailrepre').val(json.email);
			$('#form_phonerepre').val(json.phone);
			$('#form_techname').val(json.fullname);
			$('#form_technif').val(json.nif);
			$('#form_techmail').val(json.email);
			$('#form_techphone').val(json.phone);
			$('#form_namerepre').val(json.fullname);
			$('#form_accountowner').val(json.fullname);
			$('#form_accountncif').val(json.nif);
		}).fail(function(data){
			jsAlertError('Ocurrio un error...');
		});
}
function fillFormContact(){
	$.getJSON('http://'+ url +'/www/php/userdata.php')
		.done(function(json){
			$('#email_contact').val(json.email);
			$('#name_contact').val(json.fullname);
			$('#phone_contact').val(json.phone);
		}).fail(function(data){
			jsAlertError('Ocurrio un error...');
		});
}
function copydir(){
	// copiamos la direccion de facturacion y la pegamos en la direccion de instalacion
	if(($('#form_firstdir').val() != "") && ($('#form_firstpob').val() != "") && ($('#form_firstprov').val() != "") && ($('#form_firstcp').val() != "")){
		// rellenamos
		$('#form_firstdirinst').val(
			$('#form_firstdir').val()+', '+
			$('#form_firstpob').val()+', '+
			$('#form_firstprov').val()+', '+
			$('#form_firstcp').val()
		);	
	}else{
		jsAlertError('Los campos estan vacíos','Error');
	}
}
function fillFormAuto(){
	$.getJSON('http://'+ url +'/www/php/getform.php')
		.done(function(json){
			var form = document.getElementById('checkout_form');
			for(var x = 0; x < form.length; x++){
				$('#'+form[x].id).val(json[form[x].id]);
			}			
		}).fail(function(data){
			jsAlertError('Ocurrio un error...');
		});
}
function editforms(type){
	data.append('type', type);
	ajax('http://'+ url +'/www/formsedituser.php', data, 'float-container-actions',function(){
		showconditions('#parent-container-actions');
	});
}
function showpdw(id,idp){
	$('#'+idp).mousedown(function(){
		$('#'+id).attr('type','text');
		if($('#'+idp).hasClass('glyphicon-eye-close')){
			$('#'+idp).removeClass('glyphicon-eye-close');
			$('#'+idp).addClass('glyphicon-eye-open');
		}
		if($('#'+idp).hasClass('glyphicon-lock')){
			$('#'+idp).removeClass('glyphicon-lock');
			$('#'+idp).addClass('glyphicon-text-size');
		}
	});
	$('#'+idp).mouseup(function(){
		$('#'+id).attr('type','password');
		if($('#'+idp).hasClass('glyphicon-eye-open')){
			$('#'+idp).removeClass('glyphicon-eye-open');
			$('#'+idp).addClass('glyphicon-eye-close');
		}
		if($('#'+idp).hasClass('glyphicon-text-size')){
			$('#'+idp).removeClass('glyphicon-text-size');
			$('#'+idp).addClass('glyphicon-lock');
		}
	});
}

//alert()
function jsAlertSuccess(txt, title) {
    try {
		$.jAlert({
		'title': title,
		'content': txt,
		'theme': 'green',
		'btns': { 
			'text': 'OK!',
			'theme': 'green'
		}
	  });
    } catch (e) {
        alert(txt);
    }
}
function jsAlertError(txt, title) {
    try {
		$.jAlert({
		'title': title,
		'content': txt,
		'theme': 'red',
		'btns': { 
			'text': 'OK!',
			'theme': 'red'
		}
	  });
    } catch (e) {
        alert(txt);
    }
}
function openrow(id){
	data.append('id',id);
	ajax('http://'+ url +'/www/php/printservice.php', data, 'row0', function(){
		$('#row0').slideDown(200,function(){
			if(!$('#row0 div:eq(1)')){
				$('#row0').animate({height: $('#row0 div:eq(0)').height()+100+'px'},200);
			}else{
				$('#row0').animate({height: $('#row0 div:eq(1)').height()+100+'px'},200);
			}
		});
	});
}
function openurl(url){
	location.href = url;
}

/***********************************************************************************/
$(document).ready(function(e) {
	fixButtonUp();
	resizeHeader();
	addLoader();
	if(!getCookie('tiendaaviso')){
		$("#barraaceptacion").fadeIn(500);
	}else{
		$("#barraaceptacion").fadeOut(0);
	}
	$('#upPage').on('click', function(){
		scrollTopWeb(0);
	});
	$('#fillForm').on('click', function(){
		fillForm();
	});
	$('#fillFormContact').on('click', function(){
		fillFormContact();
	});
	$('select').on('click','option',function(){
		if($(this).siblings(':selected').length > 4){
			$(this).removeAttr('selected');
			jsAlertError('Only 5 selections', 'Multiple Select');
		}
	});
});