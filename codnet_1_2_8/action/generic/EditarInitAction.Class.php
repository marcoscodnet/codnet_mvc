<?php 

/**
 * Acci�n para inicializar el contexto para editar
 * una entidad.
 * 
 * @author bernardo
 * @since 21-04-2010
 * 
 */
abstract class EditarInitAction extends OutputAction{

	//instancia de la entidad a editar.
	protected $oEntidad;
	
	/**
	 * xtemplate para editar la entidad.
	 * @return unknown_type
	 */
	protected abstract function getXTemplate();
	
	/**
	 * acci�n a ejecutarse en el submit.
	 * @return unknown_type
	 */
	protected abstract function getAccionSubmit();
	
	/**
	 * entidad a editar.
	 * @return unknown_type
	 */
	protected abstract function getEntidad();

	/**
	 * parsea la entidad en el template para ser editada.
	 * @param unknown_type $entidad
	 * @param XTemplate $xtpl
	 * @return unknown_type
	 */
	protected abstract function parseEntidad($entidad, XTemplate $xtpl);
	
	/**
	 * muestra o no el c�digo de la entidad.
	 * @return boolean
	 */
	protected abstract function getMostrarCodigo();
	
	
	/**
	 * inicializa el contexto para editar una entidad.
	 * @return forward.
	 */
	protected function getContenido(){
		
		
		try{

			//ciertas validaciones antes de mostrar la p�gina.
			$this->doValidaciones();
			
			//se vizualiza el contenido para editar.	
			$contenido = $this->getContenidoImpl();
			
				
		}catch(GenericException $ex){
			
			$contenido = $this->doValidacionesException( $ex );
			
		}
		
		return $contenido;
	}
	
	protected function getContenidoImpl(){
		$xtpl = $this->getXTemplate();
		$this->oEntidad = $this->getEntidad();
		
		$xtpl->assign ( 'WEB_PATH', WEB_PATH );
		//$xtpl->assign ( 'pais', UGCUtils::getPais() );
		
		$this->parseEntidad( $this->oEntidad , $xtpl);
		
		if($this->getMostrarCodigo()){
			$xtpl->assign ( 'display_codigo', 'table-row' );
		}else{
			$xtpl->assign ( 'display_codigo', 'none' );
		}
		
		//se chequean los errores.
		if (isset ( $_GET ['code'] )){
			$msj = FormatUtils::getParam('msg','',true,false);
			
			$xtpl->assign('msj', $msj);
			$xtpl->parse ( 'main.msj' );
		}

		$xtpl->assign ( 'titulo', $this->getTitulo() );
		$xtpl->assign ( 'submit', $this->getAccionSubmit() );
		
		
	
		$xtpl->parse ( 'main' );
		return $xtpl->text ( 'main' );
	}
	
	protected function doValidacionesException( GenericException $ex ){	
		
		$xtpl = $this->getXTemplate();
		$this->oEntidad = $this->getEntidad();
		$this->parseEntidad( $this->oEntidad , $xtpl);
		
		if($this->getMostrarCodigo()){
			$xtpl->assign ( 'display_codigo', 'block' );
		}else{
			$xtpl->assign ( 'display_codigo', 'none' );
		}
		
		$msj = $ex->getMessage();
		$xtpl->assign('msj', $msj);
		$xtpl->parse ( 'main.msj' );
		
		$xtpl->assign ( 'titulo', $this->getTitulo() );
		$xtpl->assign ( 'submit', $this->getAccionSubmit() );
		
		$xtpl->assign ( 'WEB_PATH', WEB_PATH );
	
		$xtpl->parse ( 'main' );
		return $xtpl->text ( 'main' );
		
	}
	
	protected function doValidaciones(){
		//dejamos esta puerta para que se realicen ciertas validaciones
		//antes de mostrar la p�gina.
	}
	

	
}