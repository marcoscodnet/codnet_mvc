<?php 

/**
 * Acci�n para inicializar la vista.
 * Las acciones con salida a pantalla extender�n
 * esta clase.
 * Cada subclase implementar� m�todos para devolver el contenido
 * a mostrar, el t�tulo y el layout a utilizar.
 * 
 * @author bernardo
 * @since 07-04-2010
 * 
 */
abstract class OutputAction extends Action{

	protected $layout;
	
	public function getLayoutInstance(){
		return $this->layout;
	}
		
	/**
	 * inicializa la vista, el layout.
	 * @return none.
	 */
	public function execute(){
		
		//armamos el layout.
		$this->layout = $this->getLayout();
		
		try{
			$this->layout->setContenido( $this->getContenido() );
			$this->layout->setTitulo( $this->getTitulo() );
					
		}catch(GenericException $ex){
			$this->layout->setException( $ex );
		}
		
		echo $this->layout->show();
		
		//para que no haga el forward.
		$forward = null;
				
		return $forward;
	}
	
	/**
	 * layout a utilizar para la salida.
	 * @return Layout
	 */
	protected function getLayout(){
		//el layuout ser� definido en la constante DEFAULT_LAYOUT
		
		//instanciamos el layout por reflection.
		$oClass = new ReflectionClass(DEFAULT_LAYOUT);
		$oLayout = $oClass->newInstance();
		
		return $oLayout;
	}
	
	/*
	 * contenido a mostrar.
	 */
	protected abstract function getContenido();
	
	/*
	 * t�tulo de la pantalla.
	 */
	protected abstract function getTitulo();
	
	
}