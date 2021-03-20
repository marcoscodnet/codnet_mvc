<?php

/**
 * El actionController decide qué acciones ejecutar. * 
 * Dependiendo de los resultados, direccionará a la vista
 * adecuada. 
 * (dispatcher).
 *  
 * @author bernardo
 * @since 03-03-2010
 */
class ActionController{

	private $map;
	private $filters;
	
	public function ActionController(){
		
	}
	
	public function execute( $ds_action_name='' ){
		
		if(empty($ds_action_name))
			$ds_action_name = FormatUtils::getParam('action', FormatUtils::getParam('accion', 'page_not_found'));
		
		
		try{
			
			//se conecta a la base de datos.
			DbManager::connect();
			
			//inicializa el mapeo de acciones.
			$map = $this->getActionMapHelper();
			
			//obtenemos la acción a ejecutar.
			$ds_action=$map->getAction($ds_action_name);
			
			//instanciamos la acción por reflection.
			$oClass = new ReflectionClass($ds_action);
			$oAction = $oClass->newInstance();
			
			//aplicamos los filtros.
			$this->applyFilters( $map->getFilters(), $ds_action_name, $oAction );
			
			//ejecutamos la acción.			
			$ds_action_result = $oAction->execute();
			
			//obtenemos la vista de acuerdo al resultado.
			$ds_forward = $map->getForward($ds_action_result);
			
			//tiene sentido que una acción setee el forward a null cuando 
			//dicha acción renderiza la vista utilizando XTemplate.
			if($ds_forward!=null)	{
				
				
				//vemos si la acción tiene parámetros para el forward.
				if($oAction->getDs_forward_params()!=null){
					
					//chequeamos si el forward ya tiene parámetros (?).
					if(!$this->tieneParametros($ds_forward))
						$ds_forward .= '?';
					else
						$ds_forward .= '&';
					
					$ds_forward .= $oAction->getDs_forward_params();
				}
				
				$this->doForward( $ds_forward );
				
				
			}
			
			//se cierra la conexión.
			DbManager::close();
			
		}catch(ReflectionException $e1){
			//no existe la acción requerida
			$this->error( $e1 );

			
		}catch(FailureException $fe){
			//exception que indica un error en la acción ejecutada.
			$this->doFailureForward( $fe );
			
		}catch(GenericException $e2){
			//error no esperado.
			//print_r($e2);
			$this->error( $e2 );
		}catch(Exception $e3){
			//error no esperado.
			$this->error( $e3 );
		}

	}	
	
	private function tieneParametros($ds_forward){
		$tiene = false;
		if(!strrchr($ds_forward, '?'));
			$tiene = true;
		return tiene;
	}
	
	protected function doForward( $ds_forward ){
		header ( 'Location: '.$ds_forward );
	}
	
	protected function getActionMapHelper(){
		return  new ActionMapHelper();
	}
	
	protected function error($e){
		$ds_forward = WEB_PATH . 'doAction?action=error&msg='.$e->getMessage() . '&code='.$e->getCode();
		//print_r($ds_forward);
		$this->doForward( $ds_forward );
	}
	
	protected function doFailureForward( FailureException $fe ){
		return $this->execute( $fe->getDs_actionName() );
	}

	/**
	 * se aplican los filtros
	 */
	protected function applyFilters($filters, $ds_action_name, $oAction){
		foreach ($filters as $nombre => $clase_nombre) {

			//instanciamos el filtro por reflection.
			$oClass = new ReflectionClass( $clase_nombre );
			$oFiltro = $oClass->newInstance();
			
			$oFiltro->apply( $ds_action_name, $oAction );
			
		}
	}
}