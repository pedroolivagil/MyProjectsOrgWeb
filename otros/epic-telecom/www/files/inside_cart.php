<?php
if(!$cart->isEmpty()){	
	// leemos el carrito y creamos las variables.
	include_once(_PHP_PATH_.'header_cart.php');
?>
    <li style="max-height: 350px; overflow: hidden; overflow-y: auto; padding-right:5px;">
    <table class="table-cart">
    	<tr>
            <td>
                <h3><?=ucwords($serv->getDescript()); ?></h3>
            </td>
            <td style="vertical-align:bottom !important;">
                <p class="text-right gray-50">
                    <span class="fnt-90">Coste mensual:&nbsp;</span>
                    <strong><?=Tools::num_format($serv->getFee(),2); ?>€</strong>
                </p>
                <!--// <p class="text-right gray-50 top-20">
                    Coste alta:&nbsp;&nbsp;
                    <strong><?=Tools::num_format($serv->getFeeHigh(),2); ?>€</strong>
                </p> //-->
        	</td>
			<td width="75" style="vertical-align:bottom !important;">
				<a class="loader" href="<?=_ROOT_PATH_;?>del-to-cart/<?=$cart->getService();?>"><span class="btn btn-user-bar glyphicon glyphicon-trash top0"></span></a>
			</td>
        </tr>
    	<tr>
        	<td colspan="3">
            	<div class="top-20 left2">
                	<small class="gray-50">
                    	<strong><?=ucwords($cat->getDescript()); ?></strong>
                    </small>
                </div>
        	</td>
        </tr>
        <?php 
		if(!Tools::isEmpty($servicios)){
			foreach($servicios as $key => $cant){
				$sub->select($key);	
		?><tr>
        	<td>
                <?=(($sub->getCodeService()=='EXTENSION')? '<span class="fnt-70 gray-50"><strong>Extensión: '.$sub->getAttr1().'</strong></span>' : '<span class="fnt-80 gray-50"><strong>'.$sub->getDescript().'</strong></span>'); ?>
           	</td>
        	<td><p class="text-right gray-50">
                    <span class="fnt-80">Coste mensual:&nbsp;&nbsp;</span>
                    <strong><?=Tools::num_format($sub->getFee(),2); ?>€</strong>
                </p>
            </td>
			<td class="fnt-90">
				<?php if($sub->getCodeService()=='EXTENSION'){
                    $href = array('<a class="loader" href="'._ROOT_PATH_.'add-sub-to-cart/'.$sub->getID().'">','</a>');
                    $class= ' hoverup';
                }else{
                    $href = array('','');
                    $class= '';
                }
                ?>
                <div class="left" style="width:20px; margin-top:-20px;">
                    <div style="margin-top:12px;">
                    <?=$href[0];?>
                        <span class="glyphicon glyphicon-chevron-up <?=$class;?>"></span>
                    <?=$href[1];?>
                    </div>
                    <div style="margin-top:-12px;">
                    <a class="loader" href="<?=_ROOT_PATH_;?>del-sub-to-cart/<?=$sub->getID(); ?>">
                        <span class="glyphicon glyphicon glyphicon-chevron-down hoverdown"></span>
                    </a>
                    </div>
                </div>
                <div class="fnt-120">
                    <span class="padLR well" style="color:rgba(0,0,0,.5)">
                        <strong><?=$cant; ?></strong>
                    </span> 
                </div>
			</td>
        </tr>
		<?php }	} ?>
		<tr>
        	<td colspan="3"><p class="divider divider-footer"></p>
                <p class="text-right gray-50">
                Total mensual:&nbsp;&nbsp;
                <big><big>
                    <strong><?=Tools::num_format($cart->getTotal(),2); ?>€</strong>
                </big></big>
                </p>
                <!--// <p class="text-right gray-50 fnt-100 top-20">
                Alta:&nbsp;&nbsp;
                    <strong><?=Tools::num_format($cart->getTotalEntry(),2); ?>€</strong>
                </p> //-->
            </td>
        </tr>
    </table></li>
    <li><a href="<?=_ROOT_PATH_;?>cesta" class="btn btn-user-bar margin10LR loader">
    	<span class="glyphicon-pro glyphicon-shopping-cart fnt-120"></span>
        &nbsp;&nbsp;&nbsp;Completar compra
    </a></li>
    <li class="divider divider-footer"></li>
    <li><a href="<?=_ROOT_PATH_;?>unset-cart" class="btn btn-user-bar margin10LR loader">
    	<span class="glyphicon glyphicon-trash fnt-120 top1"></span>
        &nbsp;&nbsp;&nbsp;Vaciar cesta
    </a></li>
<?php
}else{	
?>
	<li><table class="table-cart">
    	<tr>
            <td>
                <p class="text-center top10">Cesta vacía</p>
            </td>
        </tr>
    </table></li>
    <li class="divider divider-footer"></li>
    <li><a href="<?=_ROOT_PATH_;?>cesta" class="btn btn-user-bar margin10LR loader">
    	<span class="glyphicon-pro glyphicon-shopping-cart fnt-120"></span>
        &nbsp;&nbsp;&nbsp;Ver cesta
    </a></li>
<?php
}
?>