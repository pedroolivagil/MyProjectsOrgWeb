<!DOCTYPE html>
<html lang="<?php echo LOCALE; ?>">
    <head>
        <title>[GENERIC_TITLE]</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="[CSS]bootstrap.min.css" rel="stylesheet" />
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link href="[CSS]style.css" type="text/css" rel="stylesheet"/>
    </head>
    <body>
        <div class="wrapper">
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">[GENERIC_TITLE]</a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav"><!-- class="active"-->
                            <li><a href="home">[HOME_PAGE]</a></li>
                            <li><a href="about">[ABOUT_PAGE]</a></li>
                            <li><a href="contact">[CONTACT_PAGE]</a></li>
                            <!--// <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li class="dropdown-header">Nav header</li>
                                    <li><a href="#">Separated link</a></li>
                                    <li><a href="#">One more separated link</a></li>
                                </ul>
                            </li> //-->
                        </ul>
                        <!--// <form class="navbar-form navbar-right" role="search">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Search">
                            </div>
                            <button type="submit" class="btn btn-default">Submit</button>
                        </form> //-->
                        <!--// <button type="button" class="btn btn-success navbar-btn navbar-right">Sign up</button>
                        <button type="button" class="btn btn-primary navbar-btn navbar-right">Sign in</button> //-->
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="login">[LOGIN_PAGE_SIGN_IN]</a></li>
                            <li><a href="signup">[LOGIN_PAGE_SIGN_UP]</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="container">