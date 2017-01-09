<?php
# Plantilla para la web

class Template {
	private $scripts;
	private $header_page;
	private $content_page;
	private $footer_page;
	
	public function __construct($scripts = NULL, $carousel = false){
		$this->setHeader($carousel);
		$this->setFooter($scripts);
	}	
	private function setHeader($carousel){
		if(Client::isLogged()){
			$c = new Client($_SESSION['user_session']);	
			$area = '			
			<ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    	Area cliente&nbsp;&nbsp;<b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="'._ROOT_PATH_.'perfil">
                            <div class="glyphicon glyphicon-user top1 left right10"></div>
                            '.Tools::getLocale()->getString('profile').'
                        </a></li>
                        <li><a href="'._ROOT_PATH_.'servicios">
                            <div class="glyphicon glyphicon-list top1 left right10"></div>
                            '.Tools::getLocale()->getString('services').'
                        </a></li>
                        <li><a href="'._ROOT_PATH_.'facturas">
                            <div class="glyphicon glyphicon-credit-card top1 left right10"></div>
                            '.Tools::getLocale()->getString('invoices').'
                        </a></li>
                        <li><a href="'._ROOT_PATH_.'logout">
                        	<div class="glyphicon glyphicon-lock top1 left right10"></div>
                           '.Tools::getLocale()->getString('logout').'</a></li>
                    </ul>
                </li>
			</ul>';
		}else{
			$area = '
			<ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    	Area cliente&nbsp;&nbsp;<b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
					<form class="navbar-form navbar-left" role="form" action="'._ROOT_PATH_.'sign-in">
                        <li><div class="form-group" style="margin-bottom:0;">
                        	<label for="nif_login" class="control-label gray">NIF/NIE/CIF</label>
                        	<input type="text" class="form-control input-sm" id="nif_login" name="nif_login_page" placeholder="NIF, NIE o CIF">
                        </div></li>
                        <li><div class="form-group">
                        	<label for="pass_login" class="control-label margin0 gray">Contraseña</label>
                        	<input type="password" class="form-control input-sm" id="pass_login" name="pass_login_page" placeholder="Password">
                        </div></li>
                        <li class="margin10TB"><button type="submit" class="btn btn-default width-100">Acceder</button></li>
                	</form>
						<li class="divider"></li>
						<li><a href="'._ROOT_PATH_.'area-clientes">Registrarse</a></li>
                    </ul>
                </li>
			</ul>';
		}
		$this->header_page = Tools::getContentOfFile(
			_PAGES_PATH_.'files/header.php', 
			array(
				'[USER]',
				'[CSS]',
				'[JS]',
				'[ROOT]',
				'[IMG]',
				'[BSTP]',
				'[WWW]',
				'[CAROUSEL]',
				'[AVISO_LEGAL]',
				'[BTN_AREA]'
			), 
			array(
				'',
				_CSS_PATH_, 
				_JS_PATH_, 
				_ROOT_PATH_, 
				_IMAGE_PATH_,
				_BSTP_PATH_,
				_PAGES_PATH_,
				($carousel) ? file_get_contents(_PAGES_PATH_.'files/carousel.php') : '<img id="caption-image" class="img-responsive" />',
				file_get_contents(_ROOT_PATH_.'forms/legal/'.Tools::$lang.'/'._LEGAL_FILE_),
				$area
			)
		);
	}
	private function setFooter($scripts){
		$this->footer_page = Tools::getContentOfFile(
			_PAGES_PATH_.'files/footer.php',
			array('[SCRIPTS]'),
			array($scripts)
		);
	}	
	public function setContentPage($page,$options){
		$this->content_page = Tools::getContentOfFile(
			_PAGES_PATH_.'files/'.$page,
			array_flip($options),
			$options
		);
	}	
	public function setScripts($str){
		$this->scripts = $str;
	}
	public function getHeader(){
		return $this->header_page;
	}
	public function getContentPage(){
		return $this->content_page;
	}
	public function getFooter(){
		return $this->footer_page;
	}
	public static function getPreviewTable($arr, $extracode = NULL){
		// genera una tabla de clase 'preview' para la plantilla
		$table = '<div class="table-responsive"><table cellpadding="0" cellspacing="0" class="preview-table">
					<tr>
						<td class="select">[STR1]</td>
						<td>[STR2]</td>
						<td style="width:10px; padding:0;">'.$extracode.'</td>
					</tr>
				</table></div><br />';
		return str_replace(array('[STR1]','[STR2]'), $arr, $table)/*.' '.$extracode*/;
	}
	public static function getSimpleTable($rows, $class = NULL){
		// genera una tabla para la plantilla		
		$table = '<div class="table-responsive"><table cellpadding="0" cellspacing="0" class="simple-table '.$class.'">					
					[ROWS]					
				</table></div><br />';
		return str_replace('[ROWS]', $rows, $table);
	}
}
?>