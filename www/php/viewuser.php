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
            </ol>
            <div class="list-group">
                <a href="<?php echo _ROOT_PATH_; ?>user-profile" class="list-group-item"><?php echo Translator::getTextStatic('PANEL_USER_LABEL_VIEW_PROFILE'); ?></a>
                <a href="<?php echo _ROOT_PATH_; ?>user-panel" class="list-group-item"><?php echo Translator::getTextStatic('PANEL_USER_LABEL_CHANGE_PASSWORD'); ?></a>
                <a href="<?php echo _ROOT_PATH_; ?>user-panel" class="list-group-item"><?php echo Translator::getTextStatic('PANEL_USER_LABEL_DELETE_ACCOUNT'); ?></a>
            </div>
            <div class="list-group">
                <a href="<?php echo _ROOT_PATH_; ?>user-project/pag/1" class="list-group-item">
                    <?php echo Translator::getTextStatic('PANEL_USER_LABEL_PROYECTOS'); ?>
                    <span class="badge badge-primary"><?php echo $user->countActiveProjects(); ?></span>
                </a>
                <a href="<?php echo _ROOT_PATH_; ?>user-project/create-project" class="list-group-item"><?php echo Translator::getTextStatic('PANEL_USER_LABEL_NEW_PROJECT'); ?></a>
                <a href="<?php echo _ROOT_PATH_; ?>user-project/list-projects" class="list-group-item"><?php echo Translator::getTextStatic('PANEL_USER_LABEL_LIST_PROJECTS'); ?></a>
            </div>
        </div>
    </div>
</div>
