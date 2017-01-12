<?php
require_once('../config.php');
if (!Tools::isUserSession()) {
    header("Location: " . _ROOT_PATH_ . "login-error");
}
error_reporting(1);
Database::init_db();
Template::getHeader();
$breads = array(
    Translator::getTextStatic('PANEL_USER') => _ROOT_PATH_ . "user-panel",
    Translator::getTextStatic('PROFILE_USER') => ""
);
Template::getBreadCrumbs($breads);
$user = User::findById(Tools::getCookie(SESSION_USUARIO_ID));
$editable = ($_REQUEST['editable'] == TRUE) ? TRUE : FALSE;
$page = _ROOT_PATH_ . (($editable) ? 'user-profile/save' : 'user-profile/edit');
//PROFILE_USER_LABEL_
?>
<!--// Content //-->
<?php include_once(_PHP_PATH_ . 'viewuser.php'); ?>
<form class="form-inline" role="form" method="post" action="<?php echo $page; ?>">
    <div class="panel panel-primary panel-derecha">
        <div class="panel-heading">
            <h4>
                <?php echo Translator::getTextStatic('PROFILE_USER_TITLE'); ?>
                <small class="color-white-50">(<?php echo $user->getCorreo(); ?>)</small>
            </h4>
        </div>
        <div class="panel-body">
            <fieldset <?php echo ($editable) ? '' : 'disabled'; ?>>
                <div class="form-group pad5-tb width100">
                    <label class="sr-only" for="profile_email"><?php echo Translator::getTextStatic('SIGN_UP_PAGE_EMAIL'); ?></label>
                    <input type="email" disabled class="form-control width100" required name="profile_email" id="profile_email" value="<?php echo $user->getCorreo(); ?>" placeholder="<?php echo Translator::getTextStatic('SIGN_UP_PAGE_PLACEHOLDER_EMAIL'); ?>">
                </div>
                <?php if ($editable) { ?>
                    <div class="form-group pad5-tb width100">
                        <label class="sr-only" for="profile_password"><?php echo Translator::getTextStatic('SIGN_UP_PAGE_PASSWORD'); ?></label>
                        <input type="password" class="form-control width100" required name="profile_password" id="profile_password" placeholder="<?php echo Translator::getTextStatic('SIGN_UP_PAGE_PLACEHOLDER_PASSWORD'); ?>">
                    </div>
                    <div class="form-group pad5-tb width100">
                        <label class="sr-only" for="profile_password2"><?php echo Translator::getTextStatic('SIGN_UP_PAGE_PASSWORD2'); ?></label>
                        <input type="password" class="form-control width100" required name="profile_password2" id="profile_password2" placeholder="<?php echo Translator::getTextStatic('SIGN_UP_PAGE_PLACEHOLDER_PASSWORD2'); ?>">
                    </div>
                    <hr />
                <?php } ?>
                <div class="form-group pad5-tb width100">
                    <label class="sr-only" for="profile_fullname"><?php echo Translator::getTextStatic('SIGN_UP_PAGE_FULLNAME'); ?></label>
                    <input type="text" required class="form-control width100" value="<?php echo $user->getFullname(); ?>" name="profile_fullname" id="profile_fullname" placeholder="<?php echo Translator::getTextStatic('SIGN_UP_PAGE_PLACEHOLDER_FULLNAME'); ?>">
                </div>
                <div class="form-group pad5-tb width100">
                    <label class="sr-only" for="profile_birthdate"><?php echo Translator::getTextStatic('SIGN_UP_PAGE_BIRTHDATE'); ?></label>
                    <input type="text" class="form-control width100 datepicker" value="<?php echo $user->getBirth_date(); ?>" name="profile_birthdate" id="profile_birthdate" placeholder="<?php echo Translator::getTextStatic('SIGN_UP_PAGE_PLACEHOLDER_BIRTHDATE'); ?>" />
                </div>
                <div class="form-group pad5-tb width100">
                    <label class="sr-only" for="profile_nif"><?php echo Translator::getTextStatic('SIGN_UP_PAGE_NIF'); ?></label>
                    <input type="text" class="form-control width100" value="<?php echo $user->getNif(); ?>" name="profile_nif" id="profile_nif" placeholder="<?php echo Translator::getTextStatic('SIGN_UP_PAGE_PLACEHOLDER_NIF'); ?>">
                </div>
                <div class="form-group pad5-tb width100">
                    <label class="sr-only" for="profile_phone"><?php echo Translator::getTextStatic('SIGN_UP_PAGE_PHONE'); ?></label>
                    <input type="tel" class="form-control width100" value="<?php echo $user->getTelefono(); ?>" name="profile_phone" id="profile_phone" placeholder="<?php echo Translator::getTextStatic('SIGN_UP_PAGE_PLACEHOLDER_PHONE'); ?>">
                </div>
                <div class="form-group pad5-tb width100">
                    <label class="sr-only" for="profile_country"><?php echo Translator::getTextStatic('SIGN_UP_PAGE_COUNTRY'); ?></label>
                    <select class="form-control width100" name="profile_country" id="profile_country">
                        <?php
                        $paises = Database::preparedQuery(PaisesFindAll);
                        foreach ($paises as $value) {
                            if ($value['id'] == 0) {
                                echo '<option value="' . $value['id'] . '">' . Translator::getTextStatic('SIGN_UP_PAGE_SELECT_ONE_MENU') . '</option>';
                            } else {
                                $sel = '';
                                if ($user->getId_pais() == $value['id']) {
                                    $sel = 'selected';
                                } else {
                                    $sel = '';
                                }
                                echo '<option ' . $sel . ' value="' . $value['id'] . '">' . $value['nombre'] . '</option>';
                            }
                        }
                        ?>
                    </select> 
                </div>                
                <div class="form-group pad5-tb width100">
                    <label class="sr-only" for="profile_state"><?php echo Translator::getTextStatic('SIGN_UP_PAGE_STATE'); ?></label>
                    <input type="text" class="form-control width100" value="<?php echo $user->getPoblacion(); ?>" name="profile_state" id="profile_state" placeholder="<?php echo Translator::getTextStatic('SIGN_UP_PAGE_PLACEHOLDER_STATE'); ?>">
                </div>
            </fieldset>
            <hr />
            <h4><?php echo Translator::getTextStatic('PROFILE_PREFERENCES'); ?></h4>
            <h4><span class="label label-danger"><?php echo Translator::getTextStatic('COMING_SOON'); ?></span></h4>
        </div>
        <div class="panel-footer">
            <div class="text-right">
                <div class="btn-group" role="group">
                    <?php if (!$editable) { ?>
                        <a class="btn btn-default" href="<?php echo _ROOT_PATH_ . 'user-panel'; ?>"><?php echo Translator::getTextStatic('GENERIC_BACK'); ?></a>
                        <button type="submit" class="btn btn-primary"><?php echo Translator::getTextStatic('GENERIC_EDIT'); ?></button>
                    <?php } else { ?>
                        <a class="btn btn-danger" href="<?php echo _ROOT_PATH_ . 'user-profile'; ?>"><?php echo Translator::getTextStatic('GENERIC_CANCEL'); ?></a>
                        <button type="submit" class="btn btn-primary"><?php echo Translator::getTextStatic('GENERIC_SAVE'); ?></button>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</form>

<?php
Template::getFooter();
Database::close_db();
