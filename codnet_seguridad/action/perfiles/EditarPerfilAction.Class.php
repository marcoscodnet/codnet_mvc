<?php 

/**
 * Acción para editar un almacén.
 * 
 * @author bernardo
 * @since 15-04-2010
 * 
 */
abstract class EditarPerfilAction extends EditarAction{

	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarAction#getEntidad()
	 */
	protected function getEntidad(){
		
		//se construye el perfil a modificar.
		$oPerfil = new Perfil ( );
		
		if( isset($_POST ['cd_perfil']))
			$oPerfil->setCd_perfil (  FormatUtils::getParamPOST('cd_perfil') ) ;
		
		$oPerfilfuncion = new Perfilfuncion ( );
		
		if (isset ( $_POST ['funciones'] ))
			$funciones = FormatUtils::getParamPOST('funciones'); 
			else
			$funciones = array ( );
			
		//Recorro las funciones y creo nuevos obj PerfilFuncion por cada funcion del perfil
		if (isset ( $_POST ['cd_perfil'] )) {
			$oPerfilfuncion->setCd_perfil ( FormatUtils::getParamPOST('cd_perfil')  );
			$funciones = FormatUtils::getParamPOST('funciones');
			$perfilFunciones = array ( );
			$i = 0;
			$long = count ( $funciones );
			while ( $i < $long ) {
				$f = $funciones [$i];
				$pf = new Perfilfuncion ( );
				$pf->setCd_perfil ( $oPerfil->getCd_perfil () );
				$pf->setCd_funcion ( $f );
				array_push ( $perfilFunciones, $pf );
				$i ++;
			}
		}
		if (isset ( $_POST ['ds_perfil'] ))
			$oPerfil->setDs_perfil ( FormatUtils::getParamPOST('ds_perfil') );
			
		$oEntidad[]=$oPerfil;
		$oEntidad[]=$perfilFunciones;
		return $oEntidad;
	}
	
	
}