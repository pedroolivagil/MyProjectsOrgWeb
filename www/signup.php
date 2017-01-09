<?php
require_once('../config.php');
error_reporting(1);

Database::init_db();
Template::getHeader();
$breads = array(Translator::getTextStatic('SIGN_UP_PAGE') => "");
Template::getBreadCrumbs($breads);
?>
<!--// Content //-->
<div class="container container-signup">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4><?php echo Translator::getTextStatic('SIGN_UP_PAGE_TITLE'); ?></h4>
        </div>
        <div class="panel-body translucid-80">
            <?php if ($_REQUEST['fail']) { ?>
                <div class="alert <?php echo Tools::getStyleAlert($_REQUEST['fail']) ?> alert-dismissible fade in" id="alert_login" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <p><?php echo Translator::getTextStatic('LOGIN_PAGE_ERROR_LOGIN'); ?></p>
                </div>
            <?php } ?>
            <form class="form-inline" role="form" method="post" action="signup-user">
                <div class="form-group pad5-tb width100">
                    <label class="sr-only" for="signup_email"><?php echo Translator::getTextStatic('SIGN_UP_PAGE_EMAIL'); ?></label>
                    <input type="email" class="form-control width100" required name="signup_email" id="signup_email" placeholder="<?php echo Translator::getTextStatic('SIGN_UP_PAGE_PLACEHOLDER_EMAIL'); ?>">
                </div>
                <div class="form-group pad5-tb width100">
                    <label class="sr-only" for="signup_password"><?php echo Translator::getTextStatic('SIGN_UP_PAGE_PASSWORD'); ?></label>
                    <input type="password" class="form-control width100" required name="signup_password" id="signup_password" placeholder="<?php echo Translator::getTextStatic('SIGN_UP_PAGE_PLACEHOLDER_PASSWORD'); ?>">
                </div>
                <div class="form-group pad5-tb width100">
                    <label class="sr-only" for="signup_password2"><?php echo Translator::getTextStatic('SIGN_UP_PAGE_PASSWORD2'); ?></label>
                    <input type="password" class="form-control width100" required name="signup_password2" id="signup_password2" placeholder="<?php echo Translator::getTextStatic('SIGN_UP_PAGE_PLACEHOLDER_PASSWORD2'); ?>">
                </div>
                <hr/>
                <div class="form-group pad5-tb width100">
                    <label class="sr-only" for="signup_fullname"><?php echo Translator::getTextStatic('SIGN_UP_PAGE_FULLNAME'); ?></label>
                    <input type="text" class="form-control width100" name="signup_fullname" id="signup_fullname" placeholder="<?php echo Translator::getTextStatic('SIGN_UP_PAGE_PLACEHOLDER_FULLNAME'); ?>">
                </div>
                <div class="form-group pad5-tb width100">
                    <label class="sr-only" for="signup_birthdate"><?php echo Translator::getTextStatic('SIGN_UP_PAGE_BIRTHDATE'); ?></label>
                    <input type="text" class="form-control width100" name="signup_birthdate" id="signup_birthdate" placeholder="<?php echo Translator::getTextStatic('SIGN_UP_PAGE_PLACEHOLDER_BIRTHDATE'); ?>">
                </div>
                <div class="form-group pad5-tb width100">
                    <label class="sr-only" for="signup_nif"><?php echo Translator::getTextStatic('SIGN_UP_PAGE_NIF'); ?></label>
                    <input type="text" class="form-control width100" name="signup_nif" id="signup_nif" placeholder="<?php echo Translator::getTextStatic('SIGN_UP_PAGE_PLACEHOLDER_NIF'); ?>">
                </div>
                <div class="form-group pad5-tb width100">
                    <label class="sr-only" for="signup_phone"><?php echo Translator::getTextStatic('SIGN_UP_PAGE_PHONE'); ?></label>
                    <input type="tel" class="form-control width100" name="signup_phone" id="signup_phone" placeholder="<?php echo Translator::getTextStatic('SIGN_UP_PAGE_PLACEHOLDER_PHONE'); ?>">
                </div>
                <div class="form-group pad5-tb width100">
                    <label class="sr-only" for="signup_country"><?php echo Translator::getTextStatic('SIGN_UP_PAGE_COUNTRY'); ?></label>
                    <input type="text" class="form-control width100" name="signup_country" id="signup_country" placeholder="<?php echo Translator::getTextStatic('SIGN_UP_PAGE_PLACEHOLDER_COUNTRY'); ?>">
                </div>
                <div class="form-group pad5-tb width100">
                    <label class="sr-only" for="signup_state"><?php echo Translator::getTextStatic('SIGN_UP_PAGE_STATE'); ?></label>
                    <input type="text" class="form-control width100" name="signup_state" id="signup_state" placeholder="<?php echo Translator::getTextStatic('SIGN_UP_PAGE_PLACEHOLDER_STATE'); ?>">
                </div>

                <hr/>

                <a href="legal-warning" target="_blank" class="btn btn-success width100 mar5-tb">
                    <span class="glyphicon glyphicon-book" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;<?php echo Translator::getTextStatic('SIGN_UP_PAGE_TERMS'); ?>
                </a>

                <hr/>

                <button type="submit" class="btn btn-primary width100 mar5-tb">
                    <?php echo Translator::getTextStatic('SIGN_UP_PAGE_SIGNUP'); ?>&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                </button>
                <a href="login" class="btn btn-danger width100 mar5-tb">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;<?php echo Translator::getTextStatic('LOGIN_PAGE_SIGN_IN'); ?>
                </a>
            </form>
        </div>
    </div>
</div>
<?php
Template::getFooter();
Database::close_db();
?>
