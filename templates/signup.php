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
        <div class="panel-body">
            <form class="form-inline" role="form">
                <div class="form-group width100">
                    <label class="sr-only" for="signup_"><?php echo $translator->getText('SIGN_UP_PAGE_'); ?></label>
                    <input type="" class="form-control width100" id="signup_" placeholder="<?php echo $translator->getText('SIGN_UP_PAGE_PLACEHOLDER_'); ?>">
                </div>
                
                <div class="checkbox pad5-tb">
                    <label>
                        <input type="checkbox"> <?php echo $translator->getText('SIGN_UP_PAGE_TERMS'); ?>
                    </label>
                </div>
                <button type="submit" class="btn btn-primary width100 mar5-tb"><?php echo $translator->getText('SIGN_UP_PAGE_SIGNUP'); ?></button>
                <hr>
                <a class="btn btn-danger width100 mar5-tb"><?php echo $translator->getText('GENERIC_CANCEL'); ?></a>
            </form>
        </div>
    </div>
</div>
