<?php

/**
 * Representa un layout de la forma:
 *	{<meta-tags>, <scripts>, <estilos>} 
 *  <header>
 *  <content>
 *  <footer>
 * 
 * 
 * @author bernardo
 * @since 06-04-2010
 */
class LayoutSimple extends Layout{

	
	public function show(){
		return $this->getContenido();
	}
}
