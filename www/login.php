<?php
require_once('../config.php');

Database::init_db();
Template::getHeader();
?>
<!--// BreadCrumbs //-->
<ol class="breadcrumb shadow translucid-80 width100">
    <li><a href="#"><?php echo Translator::getTextStatic('HOME_PAGE'); ?></a></li>
    <li class="active"><?php echo Translator::getTextStatic('LOGIN_PAGE'); ?></li>
</ol>

<!--// Content //-->
<div class="container container-login">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4><?php echo Translator::getTextStatic('LOGIN_PAGE_TITLE'); ?></h4>
        </div>
        <div class="panel-body">
            <?php if ($_REQUEST['fail']) { ?>
                <div class="alert <?php echo Tools::getStyleAlert($_REQUEST['fail']) ?> alert-dismissible fade in" id="alert_login" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <p><?php echo Translator::getTextStatic('LOGIN_PAGE_ERROR_LOGIN'); ?></p>
                </div>
            <?php } ?>
            <form class="form-inline" role="form" method="post" action="login_user">
                <div class="form-group pad5-tb width100">
                    <label class="sr-only" for="login_email"><?php echo Translator::getTextStatic('LOGIN_PAGE_EMAIL'); ?></label>
                    <input type="email" class="form-control width100" required name="login_email" id="login_email" placeholder="<?php echo Translator::getTextStatic('LOGIN_PAGE_PLACEHOLDER_EMAIL'); ?>">
                </div>
                <div class="form-group pad5-tb width100">
                    <label class="sr-only" for="password_login"><?php echo Translator::getTextStatic('LOGIN_PAGE_PASSWORD'); ?></label>
                    <input type="password" class="form-control width100" required name="password_login" id="password_login" placeholder="<?php echo Translator::getTextStatic('LOGIN_PAGE_PLACEHOLDER_PASS'); ?>">
                </div>
                <div class="checkbox pad5-tb hidden">
                    <label>
                        <input type="checkbox"> <?php echo Translator::getTextStatic('LOGIN_PAGE_AUTOLOGIN_TEXT'); ?>
                    </label>
                </div>
                <button type="submit" class="btn btn-primary width100 mar5-tb"><?php echo Translator::getTextStatic('LOGIN_PAGE_SIGN_IN'); ?></button>
                <hr>
                <a class="btn btn-success width100 mar5-tb"><?php echo Translator::getTextStatic('LOGIN_PAGE_SIGN_UP'); ?></a>
            </form>
        </div>
    </div>
</div>
<?php
Template::getFooter();
Database::close_db();
?>