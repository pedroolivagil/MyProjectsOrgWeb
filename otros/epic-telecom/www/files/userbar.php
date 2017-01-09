<?php
require_once('../../config.php');
require_once(_CLASS_PATH_.'Loads.php');

$cart = Tools::getCart();
if(Client::isLogged()){
	$c = new Client($_SESSION['user_session']);	
?>
	<table border="0" cellpadding="0" cellspacing="0" class="width-100 top0">
    	<tr>
        	<td class="text-right">
                <div class="btn-group" id="btn-cart">
                    <button type="button" class="btn btn-default dropdown-toggle btn-user-bar" data-toggle="dropdown">
                        <!-- <span class="glyphicon-pro glyphicon-cart-empty fnt-120"></span> -->
                        &nbsp;&nbsp;&nbsp;Cesta de la compra&nbsp;
                        (<?= (count($cart->getService())>0)? 'Llena' : 'Vacía'; ?>)&nbsp;&nbsp;
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu bg-footer radius-bottom">
                    <?php include_once("inside_cart.php") ?>
                    </ul>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle btn-user-bar min-260" data-toggle="dropdown" title="<?php echo ucwords($c->getUserName()); ?>">
                       <?php echo Tools::getLocale()->getString('welcome'); ?>, <strong><?php echo ucwords(Tools::cutOutput($c->getUserName(),12)); ?></strong>&nbsp;&nbsp;&nbsp;<span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu bg-footer radius-bottom min-260">
                        <li><a href="<?=_ROOT_PATH_;?>perfil">
                            <div class="glyphicon glyphicon-user top1 left right10"></div>
                            Perfil
                        </a></li>
                        <li><a href="<?=_ROOT_PATH_;?>servicios">
                            <div class="glyphicon glyphicon-list top1 left right10"></div>
                            Servicios
                        </a></li>
                        <li><a href="<?=_ROOT_PATH_;?>facturas">
                            <div class="glyphicon glyphicon-credit-card top1 left right10"></div>
                            Facturas
                        </a></li>
                        <li class="divider divider-footer"></li>
            			<li><a href="<?=_ROOT_PATH_;?>logout">
                        	<div class="glyphicon-pro glyphicon-rotation-lock bottom2 left right10"></div>
                           Cerrar sesión
                        </a></li>
                    </ul>
                </div>       
            </td>
    	</tr>
    </table>
<?php
}else{
?>
<form class="form-inline right" role="form" action="sign-in">
  <div class="form-group">
    <input type="text" class="form-control input-sm" id="nif_login" name="nif_login_page" placeholder="NIF, NIE o CIF">
  </div>
  <div class="form-group">
    <input type="password" class="form-control input-sm" id="pass_login" name="pass_login_page" placeholder="Password">
  </div>
  <button type="submit" class="btn btn-default btn-xs btn-user-bar">Acceder</button>
</form>
<div class="btn-group right right10">
    <button type="button" class="btn btn-default dropdown-toggle btn-user-bar" data-toggle="dropdown">
        <span class="glyphicon-pro glyphicon-cart-empty fnt-120"></span>
        &nbsp;&nbsp;&nbsp;
        Cesta de la compra&nbsp;&nbsp;&nbsp;
        (<?= (count($cart->getService())>0)? 'Llena' : 'Vacía'; ?>)&nbsp;&nbsp;
        <span class="caret"></span>
    </button>
    <ul class="dropdown-menu bg-footer radius-bottom">
    <?php include_once("inside_cart.php") ?>
    </ul>
</div>
<?php }?>