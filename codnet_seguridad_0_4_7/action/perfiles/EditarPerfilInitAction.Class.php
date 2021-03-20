<?php 

/**
 * Acci�n para inicializar el contexto para editar
 * un almac�n.
 * 
 * @author bernardo
 * @since 15-04-2010
 * 
 */
abstract class EditarPerfilInitAction  extends EditarInitAction{

	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarInitAction#getXTemplate()
	 */
	protected function getXTemplate(){
		return new XTemplate ( CDT_SEGURIDAD_TEMPLATE_EDITAR_PERFIL );
	}

	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarInitAction#getEntidad()
	 */
	protected function getEntidad(){
		$oPerfil =  new Perfil();
		
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
			$itemCollection = new ItemCollection();
			
			while ( $i < $long ) {
				$f = $funciones [$i];
				$pf = new Perfilfuncion ( );
				$pf->setCd_perfil ( $oPerfil->getCd_perfil () );
				$pf->setCd_funcion ( $f );
				array_push ( $perfilFunciones, $pf );
				
				$itemCollection->addItem($pf);
				
				
				$i ++;
			}
			$oPerfil->setFunciones( $itemCollection );
			
		}
		if (isset ( $_POST ['ds_perfil'] ))
			$oPerfil->setDs_perfil ( FormatUtils::getParamPOST('ds_perfil') );
					
		return $oPerfil;
	}

	/**
	 * (non-PHPdoc)
	 * @see clases/com/cdt/action/generic/EditarInitAction#parseEntidad($entidad, $xtpl)
	 */
	protected function parseEntidad($entidad, XTemplate $xtpl){
		$oPerfil = FormatUtils::ifEmpty($entidad, new Perfil());
		//se muestra el perfil.
		$xtpl->assign ( 'cd_perfil', stripslashes ( $oPerfil->getCd_perfil () ) );
		$xtpl->assign ( 'ds_perfil', stripslashes ( $oPerfil->getDs_perfil () ) );

		//obtenemos todas las funciones.
		$manager = new PerfilManager();
		$funciones = $manager->getFunciones();

		$index=0;
		foreach($funciones as $key => $funcion) {

			if($index==4){
				$index=0;
				$xtpl->parse ( 'main.row' );
			}

			$xtpl->assign ( 'ds_funcion',  $funcion->getDs_funcion() ) ;

			if( $this->existe( $oPerfil->getFunciones(), $funcion ) )
			$xtpl->assign ( 'cd_funcion', "'".$funcion->getCd_funcion()."'"." checked" );
			else
			$xtpl->assign ( 'cd_funcion',  $funcion->getCd_funcion() ) ;

			$xtpl->parse ( 'main.row.funciones' );
			$index++;
		}
		//Esto es para completar las celdas vac�as en una fila.
		if($index<=4){
			while($index< 4){
				$xtpl->parse ( 'main.row.celdavacia' );
				$index++;
			}
			$xtpl->parse( 'main.row' );
		}

	}

	private function existe( ItemCollection $funciones=null, Funcion $funcion ){
		if(empty($funciones))
		return false;

		$existe = false;
		foreach($funciones as $key => $next) {
			$existe =  ( $next->getCd_funcion() == $funcion->getCd_funcion() );
			if($existe)
			return true;
		}
		return false;
	}

}