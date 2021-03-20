<?php 

/**
 * Acción para iniciarlizar el login en el sistema.
 * 
 * @author bernardo
 * @since 16-03-2010
 * 
 */
class LoginInitAction extends OutputAction{

	/**
	 * se inicializa el contexto para login en el sistema.
	 * @return forward.
	 */
	protected function getContenido(){
			
		$xtpl = $this->getXTemplate ();

		$msj='';
		if (isset ( $_GET ['code'] )){
			
			$msj = FormatUtils::getParam('msg','',true,false);
			
		}
		
		if (isset ( $_POST ['usuario'] )){//el nombre de usuario será el email.
			$xtpl->assign('usuario', InputFilter::urlEncode( FormatUtils::getParamPOST('usuario')) );
		}
		
		$backTo = FormatUtils::getParam('backTo', FormatUtils::getParamPOST('backTo','') );
		
		if(!empty($backTo)){
			$xtpl->assign('backTo', $backTo );
		}		
		
		$xtpl->assign ( 'login_titulo', CDT_SEGURIDAD_LOGIN_TITULO );
		$xtpl->assign ( 'login_subtitulo', CDT_SEGURIDAD_LOGIN_SUBTITULO );
		
		$xtpl->assign ( 'titulo', $this->getTitulo() );
		$xtpl->assign ( 'MSJ', $msj );
		$xtpl->parse ( 'main.block1' );
		$xtpl->parse ( 'main' );
		return $xtpl->text ( 'main' );
	}
	
	protected function getTitulo(){
		return 'Login';
	}

	protected function getLayout(){
		$oClass = new ReflectionClass(DEFAULT_LOGIN_LAYOUT);
		$oLayout = $oClass->newInstance();
		
		return $oLayout;
	}
	
	public function getXTemplate(){
		return new XTemplate ( CDT_SEGURIDAD_TEMPLATE_LOGIN );		
	}
}