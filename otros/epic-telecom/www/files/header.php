<!doctype html>
<html lang="Spanish">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">	
    <meta name="DC.Language" scheme="RFC1766" content="Spanish">
    <meta name="AUTHOR" content="Epic Solutions SL">
    <meta name="REPLY-TO" content="telecom@epic.es">
    <link REV="made" href="mailto:telecom@epic.es">
    <meta name="DESCRIPTION" content="Epic Telecom ofrece servicios de voz e internet a empresas">
    <meta name="KEYWORDS" content="pbx,pbx virtual,centralita,centralitas virtuales,servicios de voz,servicios de internet,internet,lineas de voz,internet profesional,internet aire,aire,pro">
    <meta name="Resource-type" content="Document">
    <meta name="DateCreated" content="Thu, 1 October 2015 00:00:00 GMT+1">
    <meta name="Revisit-after" content="20 days">
    <meta name="robots" content="ALL">
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	<script src="[JS]jAlert-master/src/jAlert-v3.js"></script>
	<script src="[JS]basic.js" type="text/javascript"></script>
	<script src="[BSTP]js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="[BSTP]css/bootstrap.min.css">
    <link rel="shortcut icon" href="[IMG]logo.png" />
    <!-- librerías opcionales que activan el soporte de HTML5 para IE8 -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link type="text/css" rel="stylesheet"  href="[CSS]basic.css" />
    <link type="text/css" rel="stylesheet"  href="[JS]jAlert-master/src/jAlert-v3.css" />
    <title>Epic Telecom</title>
</head>
<body>
    <div class="parent-container alert" id="parent-container">
        <button type="button" class="close block-shadow extra" onClick="closecondititons('#parent-container')">&times;</button>    
        <div class="float-container well" id="float-container">[AVISO_LEGAL]</div>
    </div>
    <div class="parent-container" id="parent-container-actions">
        <!--//<button type="button" class="close block-shadow extra" onClick="closecondititons('#parent-container-actions')">&times;</button>//-->
        <div class="float-container-actions well" id="float-container-actions"></div>
    </div>
    <div class="centerLoad" id="loaderDiv">
   		<article class="centerLoad">
            <div class="cssload-loader" style="margin-top:-5px;">
                <div class="cssload-inner cssload-one"></div>
                <div class="cssload-inner cssload-two"></div>
                <div class="cssload-inner cssload-three"></div>
            </div>
        </article>
    </div>
    <div id="user-bar">
    	<div id="user-content">[USER]</div>
    </div>
    <header>
    	<div><a href="[ROOT]"><img src="[IMG]logo-large.png" id="logo" /></a></div>
    	<div><img src="[IMG]contact.png" id="contact" /></div>
    </header>
    <nav id="nav">
    	<div id="btns-large">
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    Servicios de voz&nbsp;&nbsp;&nbsp;<span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="[ROOT]lineas-de-voz">Líneas de voz</a></li>
                    <li class="divider"></li>
                    <li><a href="[ROOT]centralitas-virtuales">Centralitas</a></li>
                </ul>
            </div>
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                Servicios de internet&nbsp;&nbsp;&nbsp;<span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="[ROOT]internet-aire">Internet AIRE</a></li>
                    <li class="divider"></li>
                    <li><a href="[ROOT]internet-profesional">Internet PRO</a></li>
                </ul>
            </div>
            <a href="[ROOT]clientes"><button type="button" class="btn btn-default">Nuestros clientes</button></a>
            <a href="[ROOT]area-clientes"><button type="button" class="btn btn-default">Área cliente</button></a>
            <a href="[ROOT]contacto"><button type="button" class="btn btn-default">Contacta</button></a>
        </div>
    	<div id="btns-short">
        	<button type="button" class="btn btn-default width-100 dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-menu-hamburger top1"></span> Menu</button>
            <ul class="dropdown-menu width-70">
                <li><a href="[ROOT]lineas-de-voz">Líneas de voz</a></li>
                <li><a href="[ROOT]centralitas-virtuales">Centralitas</a></li>
                <li><a href="[ROOT]internet-aire">Internet AIRE</a></li>
                <li><a href="[ROOT]internet-profesional">Internet PRO</a></li>
                <li class="divider"></li>
                <li><a href="[ROOT]clientes">Nuestros clientes</a></li>
                <li class="divider"></li>
                <li><a href="[ROOT]area-clientes">Área cliente</a></li>
                <li class="divider"></li>
                <li><a href="[ROOT]contacto">Contacta</a></li>
                <li class="divider"></li>
                <li><a href="[ROOT]cesta">Cesta de la compra</a></li>
            </ul>
        </div>
    </nav>
    <div id="caption-img">
        [CAROUSEL]
    </div>
    <div class="caption-text" id="caption-text"></div>
    <div class="wrapper">
    	<article id="cesta-mobile" class="clear text-center width-100 margin10TB">
        	<a class="btn" href="[ROOT]cesta">Cesta de la compra</a>
        </article>