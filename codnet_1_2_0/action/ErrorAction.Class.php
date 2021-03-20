<?php 

/**
 * Acción para redireccionar a la página de error.
 * 
 * @author bernardo
 * @since 17-03-2010
 * 
 */
class ErrorAction extends OutputAction{

	protected function getXTemplate(){
		return $xtpl = new XTemplate ( CDT_MVC_TEMPLATE_ERROR );
	}
	
	/**
	 * @return forward.
	 */
	protected function getContenido(){
		$xtpl = $this->getXTemplate ();
		
		$xtpl->assign ( 'titulo', $this->getTitulo() );

		$msg='';
		$code=0;
		
		if (isset ( $_GET ['msg'] )) $msj = FormatUtils::getParam('msg','',true,false);
		if (isset ( $_GET ['code'] ))$code = FormatUtils::getParam('code') ;

		
		//TODO tratamiento de los códigos de error.
		if (!empty ( $code)) {
			
			$xtpl->assign ( 'code', $code );
			if($code==-1)
				$msg = 'Funcionalidad no definida<br><br><br>';
		
			if($code==1064)
				$msg = 'Error en consulta a Base de Datos<br><br><br>' . $msg;
		
		}			

		if (!empty ( $msg))
			$xtpl->assign ( 'msg', $msg );
		
		$xtpl->parse ( 'main' );
		return $xtpl->text ( 'main' );
	}

	
	public function getTitulo(){
		return 'Error no esperado';
	}
}