<?php 

/**
 * Acción para visualizar un club.
 *  
 * @author bernardo
 * @since 10-03-2010
 * 
 */
class VerPerfilAction extends OutputAction{

	/**
	 * consulta un perfil.
	 * @return forward.
	 */
	protected function getContenido(){
			
		$xtpl = $this->getXTemplate ();
		
		if (isset ( $_GET ['id'] )) {
			$cd_perfil = FormatUtils::getParam('id');
			
			$manager = new PerfilManager();
			
			try{
				$oPerfil = $manager->getPerfilConFuncionesPorId ( $cd_perfil );
			}catch(GenericException $ex){
				$oPerfil = new Perfil();
				//TODO ver si se muestra un mensaje de error.
			}			

			//se muestra el perfil.
			$this->parsePerfil( $xtpl, $oPerfil );
			
			
		}
		
		$xtpl->assign ( 'titulo', 'Detalle de perfil' );
		$xtpl->parse ( 'main' );
		return $xtpl->text ( 'main' );
	}
	

	
	protected function getTitulo(){
		return "Ver Perfil";
	}

	public function getXTemplate(){ 
		return new XTemplate ( CDT_SEGURIDAD_TEMPLATE_VER_PERFIL );
	}
	
	public function parsePerfil($xtpl, $oPerfil){ 
		//se muestra el perfil.
		$xtpl->assign ( 'cd_perfil', $oPerfil->getCd_perfil());
		$xtpl->assign ( 'ds_perfil', stripslashes ( $oPerfil->getDs_perfil () ) );
					
		//se muestran las funciones asociadas.
		$funciones = $oPerfil->getFunciones();
		$index=0;
		foreach($funciones as $key => $funcion) {
			$index++;
			if($index==4){
				$index=0;
				$xtpl->parse ( 'main.row' );	
			}
			$xtpl->assign ( 'ds_funcion', stripslashes ( $funcion->getDs_funcion() ) );
			$xtpl->parse ( 'main.row.funciones' );
		}
		if($index<=4){
			$xtpl->parse ( 'main.row' );
		}
		
	}
}