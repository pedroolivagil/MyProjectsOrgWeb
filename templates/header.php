<?php require_once('require_translator.php'); ?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><?php echo $translator->getText('GENERIC_TITLE'); ?></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav"><!-- class="active"-->
                <li><a href="#home" onclick="navigate('templates/home');"><?php echo $translator->getText('HOME_PAGE'); ?></a></li>
                <li><a href="#about" onclick="navigate('templates/about');"><?php echo $translator->getText('ABOUT_PAGE'); ?></a></li>
                <li><a href="#contact" onclick="navigate('templates/contact');"><?php echo $translator->getText('CONTACT_PAGE'); ?></a></li>
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
                <li><a href="#login" onclick="navigate('templates/login');"><?php echo $translator->getText('LOGIN_PAGE_SIGN_IN'); ?></a></li>
                <li><a href="#signup" onclick="navigate('templates/signup');"><?php echo $translator->getText('LOGIN_PAGE_SIGN_UP'); ?></a></li>
            </ul>
        </div>
    </div>
</nav>