<?php 

/**
 * Acción para mostrar un panel de control.
 * 
 * @author bernardo
 * @since 08-03-2011
 * 
 */
abstract class PanelAction extends OutputAction{

	
	/**
	 * se muestra un panel de control con íconos para
	 * acceder a las operaciones.
	 */
	protected function getContenido(){

		$xtpl = $this->getXTemplate();
		$xtpl->assign('WEB_PATH', WEB_PATH);	
		

		//título del listado.
		$xtpl->assign( 'titulo', $this->getTitulo() );
		
		//generamos el contenido.
		$this->parsePanel( $xtpl );
		
		$xtpl->parse('main' );
		return $xtpl->text( 'main' );

	}

	/**
	 * template donde parsear la salida.
	 * @return unknown_type
	 */
	protected abstract function getXTemplate();

	protected abstract function parsePanel( XTemplate $xtpl );	
	
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/SecureOutputAction#getTitulo()
	 */
	protected function getTitulo(){
		return 'Panel de Control';
	}

	
}