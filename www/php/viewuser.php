<div class="panel panel-primary panel-izquierda">
    <div class="panel-heading">
        <h4><?php echo Translator::getTextStatic('PANEL_USER_HEADER_CONTROL_PANEL'); ?></h4>
    </div>
    <div class="panel-body">
        <div class="container-avatar">
            <img src="<?php echo _IMAGE_PATH_ ?>avatar.jpg" class="thumbnail avatar center-block">
        </div>
        <div class="container-user-info">
            <ol class="list-group">
                <li class="list-group-item"><?php echo $user->getFullname(); ?></li>
                <li class="list-group-item"><?php echo $user->getCorreo(); ?></li>
            </ol>
            <div class="list-group">
                <a href="<?php echo _ROOT_PATH_; ?>user-profile" class="list-group-item"><?php echo Translator::getTextStatic('PANEL_USER_LABEL_VIEW_PROFILE'); ?></a>
                <a href="<?php echo _ROOT_PATH_; ?>user-panel/pag/1" class="list-group-item">
                    <?php echo Translator::getTextStatic('PANEL_USER_LABEL_PROYECTOS'); ?>
                    <span class="badge"><?php echo $user->countProjects(); ?></span>
                </a>
                <a href="#" class="list-group-item"><?php echo Translator::getTextStatic('PANEL_USER_LABEL_NEW_PROJECT'); ?></a>
                <a href="#" class="list-group-item"><?php echo Translator::getTextStatic('PANEL_USER_LABEL_FIND_PROJECT'); ?></a>
            </div>
        </div>
    </div>
</div>
