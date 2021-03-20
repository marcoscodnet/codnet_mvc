<?php

/**
 * Representa un layout para json
 * 
 * 
 * @author bernardo
 * @since 18-07-2011
 */
class LayoutJson extends Layout{

	
	public function show(){
		return json_encode( $this->getContenido() );
	}
}
