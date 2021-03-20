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
			CdtUtils::log_debug("Iniciando controller para $ds_action_name");
			//se conecta a la base de datos.
			//DbManager::connect();
			
			//inicializa el mapeo de acciones.
			$map = $this->getActionMapHelper();
			
			//obtenemos la acción a ejecutar.
			$ds_action=$map->getAction($ds_action_name);
			
			CdtUtils::log_debug("acción a ejecutar $ds_action");
			
			//instanciamos la acción por reflection.
			$oClass = new ReflectionClass($ds_action);
			$oAction = $oClass->newInstance();
			
			//aplicamos los filtros.
			$this->applyFilters( $map->getFilters(), $ds_action_name, $oAction, $map );
			CdtUtils::log_debug("Filtros aprobados");
			
			//ejecutamos la acción.
						
			$ds_action_result = $oAction->execute();
			
			CdtUtils::log_debug("acción ejecutada");
			
			//obtenemos la vista de acuerdo al resultado.
			$ds_forward = $map->getForward($ds_action_result);
			
			//tiene sentido que una acción setee el forward a null cuando 
			//dicha acción renderiza la vista utilizando XTemplate.
			if($ds_forward!=null)	{
				
				CdtUtils::log_debug("ds_forward $ds_forward");
						
				//vemos si la acción tiene parámetros para el forward.
				if($oAction->getDs_forward_params()!=null){
					
					//chequeamos si el forward ya tiene parámetros (?).
					if(!$this->tieneParametros($ds_forward))
						$ds_forward .= '?';
					else
						$ds_forward .= '&';
					
					$ds_forward .= $oAction->getDs_forward_params();
				}
				
				CdtUtils::log_debug("Redireccionando a $ds_forward");
				$this->doForward( $ds_forward );
				
				
			}
			
			CdtUtils::log_debug("Terminando controller");
			
			//se cierra la conexión a la bbdd.
			DbManager::close();
			
		}catch(ReflectionException $e1){
			//no existe la acción requerida
			$this->error( $e1 );
			//se cierra la conexión a la bbdd.
			DbManager::close();
			
			
		}catch(FailureException $fe){
			//se cierra la conexión a la bbdd.
			CdtUtils::log_debug("Cerrando conexión bbdd");
			DbManager::close();
			//exception que indica un error en la acción ejecutada.
			CdtUtils::log_debug("Redireccionando x FailureException:" . $fe->getDs_actionName());
			$this->doFailureForward( $fe );
			
		}catch(GenericException $e2){
			//se cierra la conexión a la bbdd.
			CdtUtils::log_debug("Cerrando conexión bbdd");
			DbManager::close();
			//error no esperado.
			//print_r($e2);
			$this->error( $e2 );
			
		}catch(Exception $e3){
			//se cierra la conexión a la bbdd.
			CdtUtils::log_debug("Cerrando conexión bbdd");
			DbManager::close();
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
		//TODO agarrar los parámetros que están en ds_forward y agregarlos al GET, agarrar la acción,
		// y hacer un execute (similar a doFailureException).
		
		header ( 'Location: '.$ds_forward );
	}
	
	protected function getActionMapHelper(){
		return  new ActionMapHelper();
	}
	
	protected function error($e){
		$ds_forward = WEB_PATH . 'doAction?action=error';
		//print_r($ds_forward);
		$_GET ['msg'] = $e->getMessage();
		$_GET ['code'] = $e->getCode();
		
		CdtUtils::log_error( get_class($this) . " > error() => Error no esperado: code => " . $e->getCode() . " msg => " . $e->getMessage());
			
		//$this->doForward( $ds_forward );
		return $this->execute( "error" );
	}
	
	protected function doFailureForward( FailureException $fe ){
		$_GET ['msg'] = $fe->getMessage();
		$_GET ['code'] = $fe->getCode();
		
		return $this->execute( $fe->getDs_actionName() );
	}

	/**
	 * se aplican los filtros
	 */
	protected function applyFilters($filters, $ds_action_name, $oAction, ActionMapHelper $map){
		
		$url = $_SERVER['REQUEST_URI'];
		
			
		foreach ($filters as $nombre => $filter) {

			$urlPattern = APP_NAME . $filter['urlPattern'];

				
			if($this->match($url, $urlPattern)){
				
				
				//instanciamos el filtro por reflection.
				$oClass = new ReflectionClass( $filter['clase'] );
				$oFiltro = $oClass->newInstance();
				
				
				$oFiltro->apply( $ds_action_name, $oAction );
			}
		}
	}
	
	protected function getFiltersForUrl( $filters, $url = "/" ){
		$filterRes = array();
		
		foreach ($filters as $nombre => $filter) {

			$urlPattern = $filter['urlPattern'];
			
			$filterRes[] = $filter;
		}
		return $filterRes;
		
	}
	
	protected function match($url, $urlPattern){
		   
		$url = str_replace('/', '', $url);
		$urlPattern = str_replace('/', '', $urlPattern);
		
 		if(strlen($url)>=strlen($urlPattern)){
 			
 			$urlSub = substr($url,0,strlen($urlPattern));
 			
 			return ($urlSub==$urlPattern);
 			
 		}
		return false;
   
	}
	
	
	
	
}