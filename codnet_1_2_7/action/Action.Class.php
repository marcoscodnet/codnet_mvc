<?php 

/**
 * @author bernardo
 * @since 03-03-2010
 * 
 * Las acciones son disparadas por el actionController 
 * a partir de las peticiones (request).
 * Cada acción está destinada a realizar una tarea
 * específica en la aplicación. También decide el destino
 * posible de acuerdo al resultado obtenido (forward).
 * 
 */
abstract class Action{

	//parámetros utilizados para el forward.
	private $ds_forward_params=null;

		
	//Métodos Get 
	
	public function getDs_forward_params(){
		return $this->ds_forward_params;
	}
	
		
	//Métodos Set 
	
	public function setDs_forward_params($value){
		$this->ds_forward_params = $value;
	}
	
	//Funciones.
	
	/**
	 * Se ejecuta la acción.
	 * @return forward.
	 * @throws GenericException
	 */
	public abstract function execute();

	protected function doForwardException(GenericException $ex, $forward){
		
		CdtUtils::log_debug("doForwardException => $forward ");
		
		$map = new ActionMapHelper();
		$ds_forward = $map->getForward( $forward );
		
		CdtUtils::log_debug("ds_forward en navigation => $ds_forward ");
		
		$pos_accion = strpos( $ds_forward, "action" );
		
		if( $pos_accion  )
			$ds_actionName = $this->getAccionDeLink( $ds_forward );
		else		
			$ds_actionName = $ds_forward;

		CdtUtils::log_debug("mapeado a.... $ds_actionName ");
//		$_GET ['msg'] = $ex->getMessage();
//		$_GET ['code'] = $ex->getCode();
				
		throw new FailureException( $ds_actionName, $ex->getMessage() );
	}		


	
	public function getAccionDeLink($link){
		$pos_accion = strpos( $link, "action" );
		$ds_action= substr( $link ,  $pos_accion );
		$length = strpos( $ds_action, "&" );
		if( $length )
			$ds_action = substr( $ds_action ,  0, $length );
		$pos_equal = strpos( $ds_action, "=" );
		$ds_action_value = substr( $ds_action ,  $pos_equal+1 );
		return $ds_action_value;		
	}
}