<?php
require_once('../../config.php');
require_once(_CLASS_PATH_.'Loads.php');
/*require_once('../../classes/Locale.php');
require_once('../../classes/Tools.php');
require_once('../../classes/Log.php');
require_once('../../classes/Template.php');
require_once('../../classes/Mail.php');
require_once('../../classes/Client.php');
require_once('../../classes/Category.php');
require_once('../../classes/Service.php');
require_once('../../classes/SubService.php');
header('Content-type: text/plain; charset=utf-8');*/
$id_contract = $_REQUEST['id'];
if(Client::isLogged()){
	/* replantear todo el script a partir de aqui para leer el servicio del cliente y no como esta ahora*/
	$c = new Client($_SESSION['user_session']);
	$contrato = $c->getFullService($id_contract);
	$ser = new Service($contrato[0]['id_serv']);
	$cat = new Category($ser->getCategory());
	if($contrato){
		$array_sub = array();
		if($ser->getCategory() == 2){
			$arr_quant = array();
			foreach($contrato as $subserv){
				array_push($arr_quant, $subserv['id_subservice']);
			}
			$subs = array_count_values($arr_quant);
			foreach($subs as $key => $subserv){
				array_push($array_sub, new SubService($key));
			}
		}else{
			foreach($contrato as $subserv){
				array_push($array_sub, new SubService($subserv['id_subservice']));
			}		
		}
	}
	?>
    <article style="float:right;" data-dismiss="alert">
    	<button class="btn fnt-90" onClick="openurl('<?=_ROOT_PATH_;?>download-contract/<?=$id_contract;?>')" target="new">Descarga el contrato</button>
    </article>
	<h3 class="mtop0"><?= ucwords($ser->getDescript());?> <span class="fnt-70">(<?=ucfirst($cat->getDescript());?>)</span></h3>
	<?php 
	if($array_sub){
		// dividimos el array en dos columnas iguales
		$columns = array_chunk($array_sub, ceil(count($array_sub)/2), true);
		for($x = 0; $x <= count($columns); $x++){
	?>
    <div class="width-50 left">
		<?php if(!Tools::isEmpty($columns[$x])){ foreach($columns[$x] as $key => $sub){ ?>
        <p class="fnt-90 margin0 gray"><?=$sub->getDescript();?><br /><span class="pad15L gray-70">- 
        <?php
            if ((Tools::isEmpty($contrato[$key]['value_subservice']))){
				switch($sub->getCodeService()){
					case 'BMM': // imprimimos en la misma linea
						echo Tools::num_format($sub->getAttr2());
						echo ' '.Tools::getLocale()->getString('min');
						if($sub->getAttr3()) {
							echo ' '.Tools::getLocale()->getString('to');
							echo ' '.Tools::num_format($sub->getAttr3());
							echo ' '.Tools::getLocale()->getString('nums');
						}
					break;
					case 'MF':
					case 'MM':
						echo Tools::num_format($sub->getAttr2());
						echo ' '.Tools::getLocale()->getString('min');
					break;
					case 'CENTSOR':
						echo Tools::num_format($sub->getAttr1());
						echo ' '.Tools::getLocale()->getString('input');
						echo ' / '.Tools::num_format($sub->getAttr2());
						echo ' '.Tools::getLocale()->getString('output');
					break;
					case 'INTERNET_SPEED':
						echo Tools::num_format($sub->getAttr1());
						echo 'Mbps <span class="gray">('.Tools::getLocale()->getString('down').')</span>';
						echo ' / '.Tools::num_format($sub->getAttr2());
						echo 'Mbps <span class="gray">('.Tools::getLocale()->getString('up').')</span>';
					break;
					case 'EXTENSION':
						echo $sub->getAttr1().', '.$subs[$sub->getID()];
						if($subs[$sub->getID()]==1){
							echo ' '.Tools::getLocale()->getString('terminal');
						}else{
							echo ' '.Tools::getLocale()->getString('terminals');
						}
					break;
					case 'T_PLANA':
						echo ucfirst(Tools::getLocale()->getString('contracted'));
					break;
				}
			}else{
				switch($sub->getCodeService()){
					case 'CHADD':
						echo $contrato[$key]['value_subservice'];
						echo ' '.Tools::getLocale()->getString('chanels');
					break;
					case 'GNUM':
						echo $contrato[$key]['value_subservice'];
						echo ' '.Tools::getLocale()->getString('nums');
					break;
					case 'GNUMPORTAT':
						$nums = explode(',',$contrato[$key]['value_subservice']);
						$x=0;
						foreach($nums as $num){
							echo Tools::phonef($num);
							$x++;
							if(count($nums)>1 and count($nums) > $x){
								echo '</span><br /><span class="pad15L gray-70">- ';
							}
						}
					break;
					case 'AUTOR_DESTINO':
						$cntry = explode(',',$contrato[$key]['value_subservice']);
						$y=0;
						foreach($cntry as $country){
							echo ucfirst($country);
							$y++;
							if(count($cntry)>1 and count($cntry) > $y){
								echo '</span><br /><span class="pad15L gray-70">- ';
							}
						}
					break;
					case 'AUTOR_ZONA_A':
					case 'RESTRICT_80X90X118XX':
					case 'RESTRICT_INTERN':
						echo ucfirst(Tools::getLocale()->getString('contracted'));
					break;
					default:
						echo $contrato[$key]['value_subservice'];
					break;
				}
			}// foreach
        ?>
        </span></p>
        <?php } ?>
    </div>
    <?php } else{
				echo '<p class="fnt-90 margin0">&nbsp;<br>&nbsp;</span></p>';
			}// if
		}//for
	} // if
} ?>