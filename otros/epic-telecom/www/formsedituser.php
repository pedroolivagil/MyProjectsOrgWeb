<?php
require_once('../config.php');
require_once(_CLASS_PATH_.'Loads.php');
// Formularios para editar el usuario
$type = $_REQUEST['type'];
?>
<form action="<?=_ROOT_PATH_;?>edit-form">
	<input type="hidden" id="type" name="type" value="<?=$type;?>" />
<?php
switch($type){
	case "pass":
?>
    <div class="margin10TB">
      <div class="input-group">
          <span class="input-group-addon glyphicon glyphicon-lock top0" onMouseOver="showpdw('old','oldspan')" id="oldspan"></span>
          <input type="password" id="old" name="old" class="form-control center767" placeholder="<?=Tools::getLocale()->getString('CLIENTAREA_NEW_PASSOLD');?>" required>
      </div>
    </div>
    <div class="margin10TB">
      <div class="input-group">
          <span class="input-group-addon glyphicon glyphicon-eye-close top0" onMouseOver="showpdw('new','newspan')" id="newspan"></span>
          <input type="password" id="new" name="new" class="form-control center767" placeholder="<?=Tools::getLocale()->getString('CLIENTAREA_NEW_PASSNEW');?>" required>
      </div>
    </div>
    <div class="margin10TB">
      <div class="input-group">
          <span class="input-group-addon glyphicon glyphicon-eye-close top0" onMouseOver="showpdw('new2','new2span')" id="new2span"></span>
          <input type="password" id="new2" name="new2" class="form-control center767" placeholder="<?=Tools::getLocale()->getString('CLIENTAREA_NEW_PASSNEW2');?>" required>
      </div>
    </div>
<?php
	break; 
	case "email":
?>
    <div class="margin10TB">
      <div class="input-group">
          <span class="input-group-addon glyphicon glyphicon-lock top0" onMouseOver="showpdw('old','oldspan')" id="oldspan"></span>
          <input type="password" id="old" name="old" class="form-control center767" placeholder="<?=Tools::getLocale()->getString('CLIENTAREA_NEW_PASSOLD');?>" required>
      </div>
    </div>
    <div class="margin10TB">
      <div class="input-group">
          <span class="input-group-addon glyphicon glyphicon-envelope top0"></span>
          <input type="email" id="new" name="new" class="form-control center767" placeholder="<?=Tools::getLocale()->getString('CLIENTAREA_NEW_MAILNEW');?>" required>
      </div>
    </div>
    <div class="margin10TB">
      <div class="input-group">
          <span class="input-group-addon glyphicon glyphicon-envelope top0"></span>
          <input type="email" id="new2" name="new2" class="form-control center767" placeholder="<?=Tools::getLocale()->getString('CLIENTAREA_NEW_MAILNEW2');?>" required>
      </div>
    </div>
<?php
	break; 
	case "name":
?>
    <div class="margin10TB">
      <div class="input-group">
          <span class="input-group-addon glyphicon glyphicon-lock top0" onMouseOver="showpdw('old','oldspan')" id="oldspan"></span>
          <input type="password" id="old" name="old" class="form-control center767" placeholder="<?=Tools::getLocale()->getString('CLIENTAREA_NEW_PASSOLD');?>" required>
      </div>
    </div>
    <div class="margin10TB">
      <div class="input-group">
          <span class="input-group-addon glyphicon glyphicon-envelope top0"></span>
          <input type="text" id="new" name="new" class="form-control center767" placeholder="<?=Tools::getLocale()->getString('CLIENTAREA_NEW_NAMENEW');?>" required>
      </div>
    </div>
    <div class="margin10TB">
      <div class="input-group">
          <span class="input-group-addon glyphicon glyphicon-envelope top0"></span>
          <input type="text" id="new2" name="new2" class="form-control center767" placeholder="<?=Tools::getLocale()->getString('CLIENTAREA_NEW_NAMENEW2');?>" required>
      </div>
    </div>
<?php
	break;
	case "phone":
?>

    <div class="margin10TB">
      <div class="input-group">
          <span class="input-group-addon glyphicon glyphicon-lock top0" onMouseOver="showpdw('old','oldspan')" id="oldspan"></span>
          <input type="password" id="old" name="old" class="form-control center767" placeholder="<?=Tools::getLocale()->getString('CLIENTAREA_NEW_PASSOLD');?>" required>
      </div>
    </div>
    <div class="margin10TB">
      <div class="input-group">
          <span class="input-group-addon glyphicon glyphicon-envelope top0"></span>
          <input type="text" maxlength="9" id="new" name="new" class="form-control center767" placeholder="<?=Tools::getLocale()->getString('CLIENTAREA_NEW_PHONNEW');?>" required>
      </div>
    </div>
    <div class="margin10TB">
      <div class="input-group">
          <span class="input-group-addon glyphicon glyphicon-envelope top0"></span>
          <input type="text" maxlength="9" id="new2" name="new2" class="form-control center767" placeholder="<?=Tools::getLocale()->getString('CLIENTAREA_NEW_PHONNEW2');?>" required>
      </div>
    </div>
<?php
	break;  
} // switch
?>
    <button type="button" class="btn width-49 left" onClick="closecondititons('#parent-container-actions')">
        <span class="glyphicon glyphicon-remove top1 fnt-120"></span>
        &nbsp;&nbsp;<?=Tools::getLocale()->getString('CLIENTAREA_NEW_BTNDECLINE');?>
    </button>
    <button type="submit" class="btn width-49 right">
        <span class="glyphicon glyphicon-ok top1 fnt-120"></span>
        &nbsp;&nbsp;<?=Tools::getLocale()->getString('CLIENTAREA_NEW_BTNACCEPT');?>
    </button>
</form>