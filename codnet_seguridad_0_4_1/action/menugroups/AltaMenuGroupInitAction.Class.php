<?php 

/**
 * Acción para inicializar el contexto para dar de alta
 * un MenuGroup.
 * 
 * @author modelBuilder
 * @since 04-07-2011
 * 
 */
class AltaMenuGroupInitAction extends EditarMenuGroupInitAction{

	
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/SecureAction#getFuncion()
	 */
	public function getFuncion(){
		return CDT_SEGURIDAD_FUNCION_ALTA_MENUGROUP;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/SecureOutputAction#getTitulo()
	 */
	protected function getTitulo(){
		return "Alta MenuGroup";
	}

	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarInitAction#getAccionSubmit()
	 */
	protected function getAccionSubmit(){
		return "alta_menugroup";
	}

	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarInitAction#getMostrarCodigo()
	 */
	protected function getMostrarCodigo(){
		return false;
	}	
}
