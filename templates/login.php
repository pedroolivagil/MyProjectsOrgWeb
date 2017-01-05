<!--// BreadCrumbs //-->
<ol class="breadcrumb shadow translucid-80 width100">
    <li><a href="#"><?php echo $translator->getText('HOME_PAGE'); ?></a></li>
    <li class="active"><?php echo $translator->getText('LOGIN_PAGE'); ?></li>
</ol>

<!--// Content //-->
<div class="container container-login">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4><?php echo $translator->getText('LOGIN_PAGE_TITLE'); ?></h4>
        </div>
        <div class="panel-body">
            <form class="form-inline" role="form">
                <div class="form-group pad5-tb width100">
                    <label class="sr-only" for="login_email"><?php echo $translator->getText('LOGIN_PAGE_EMAIL'); ?></label>
                    <input type="email" class="form-control width100" name="login_email" id="login_email" placeholder="<?php echo $translator->getText('LOGIN_PAGE_PLACEHOLDER_EMAIL'); ?>">
                </div>
                <div class="form-group pad5-tb width100">
                    <label class="sr-only" for="password_login"><?php echo $translator->getText('LOGIN_PAGE_PASSWORD'); ?></label>
                    <input type="password" class="form-control width100" name="password_login" id="password_login" placeholder="<?php echo $translator->getText('LOGIN_PAGE_PLACEHOLDER_PASS'); ?>">
                </div>
                <div class="checkbox pad5-tb hidden">
                    <label>
                        <input type="checkbox"> <?php echo $translator->getText('LOGIN_PAGE_AUTOLOGIN_TEXT'); ?>
                    </label>
                </div>
                <button type="submit" class="btn btn-primary width100 mar5-tb"><?php echo $translator->getText('LOGIN_PAGE_SIGN_IN'); ?></button>
                <hr>
                <a class="btn btn-success width100 mar5-tb"><?php echo $translator->getText('LOGIN_PAGE_SIGN_UP'); ?></a>
            </form>
        </div>
    </div>
</div>
