<!--// BreadCrumbs //-->
<ol class="breadcrumb shadow translucid-80 width100">
    <li><a href="#"><?php echo $translator->getText('HOME_PAGE'); ?></a></li>
    <li class="active"><?php echo $translator->getText('SIGN_UP_PAGE'); ?></li>
</ol>

<!--// Content //-->
<div class="container container-signup">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4><?php echo $translator->getText('SIGN_UP_PAGE_TITLE'); ?></h4>
        </div>
        <div class="panel-body translucid-80">
            <form class="form-inline" role="form">
                <div class="form-group pad5-tb width100">
                    <label class="sr-only" for="signup_email"><?php echo $translator->getText('SIGN_UP_PAGE_EMAIL'); ?></label>
                    <input type="" class="form-control width100" name="signup_email" id="signup_email" placeholder="<?php echo $translator->getText('SIGN_UP_PAGE_PLACEHOLDER_EMAIL'); ?>">
                </div>
                <div class="form-group pad5-tb width100">
                    <label class="sr-only" for="signup_password"><?php echo $translator->getText('SIGN_UP_PAGE_PASSWORD'); ?></label>
                    <input type="" class="form-control width100" name="signup_password" id="signup_password" placeholder="<?php echo $translator->getText('SIGN_UP_PAGE_PLACEHOLDER_PASSWORD'); ?>">
                </div>
                <div class="form-group pad5-tb width100">
                    <label class="sr-only" for="signup_password2"><?php echo $translator->getText('SIGN_UP_PAGE_PASSWORD2'); ?></label>
                    <input type="" class="form-control width100" name="signup_password2" id="signup_password2" placeholder="<?php echo $translator->getText('SIGN_UP_PAGE_PLACEHOLDER_PASSWORD2'); ?>">
                </div>
                <hr/>
                <div class="form-group pad5-tb width100">
                    <label class="sr-only" for="signup_nif"><?php echo $translator->getText('SIGN_UP_PAGE_NIF'); ?></label>
                    <input type="" class="form-control width100" name="signup_nif" id="signup_nif" placeholder="<?php echo $translator->getText('SIGN_UP_PAGE_PLACEHOLDER_NIF'); ?>">
                </div>
                <div class="form-group pad5-tb width100">
                    <label class="sr-only" for="signup_phone"><?php echo $translator->getText('SIGN_UP_PAGE_PHONE'); ?></label>
                    <input type="" class="form-control width100" name="signup_phone" id="signup_phone" placeholder="<?php echo $translator->getText('SIGN_UP_PAGE_PLACEHOLDER_PHONE'); ?>">
                </div>
                <div class="form-group pad5-tb width100">
                    <label class="sr-only" for="signup_country"><?php echo $translator->getText('SIGN_UP_PAGE_COUNTRY'); ?></label>
                    <input type="" class="form-control width100" name="signup_country" id="signup_country" placeholder="<?php echo $translator->getText('SIGN_UP_PAGE_PLACEHOLDER_COUNTRY'); ?>">
                </div>
                <div class="form-group pad5-tb width100">
                    <label class="sr-only" for="signup_state"><?php echo $translator->getText('SIGN_UP_PAGE_STATE'); ?></label>
                    <input type="" class="form-control width100" name="signup_state" id="signup_state" placeholder="<?php echo $translator->getText('SIGN_UP_PAGE_PLACEHOLDER_STATE'); ?>">
                </div>

                <hr/>

                <a class="btn btn-default width100 mar5-tb">
                    <span class="glyphicon glyphicon-list-alt btn-lg clean-pad-mar" aria-hidden="true"></span>
                    <span style="vertical-align: super; padding-left: 10px;"><?php echo $translator->getText('SIGN_UP_PAGE_TERMS'); ?></span>
                </a>

                <hr/>

                <button type="submit" class="btn btn-primary width100 mar5-tb"><?php echo $translator->getText('SIGN_UP_PAGE_SIGNUP'); ?></button>
                <a class="btn btn-danger width100 mar5-tb"><?php echo $translator->getText('GENERIC_CANCEL'); ?></a>
            </form>
        </div>
    </div>
</div>
