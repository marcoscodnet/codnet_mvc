<?php

/**
 * Representa un layout de la forma:
 * 
 *  <content>
 * 
 * @author bernardo
 * @since 06-04-2010
 */
abstract class LayoutPopup extends Layout{

	public function show(){
		$xtpl = $this->getXTemplate ();
		
		$xtpl->assign('titulo', $this->getTitulo());
		$xtpl->assign('content', $this->getContenido());

		$this->parseMetaTags($xtpl);
		$this->parseEstilos($xtpl);
		$this->parseScripts($xtpl);
		
		$xtpl->parse('main');
		
		return $xtpl->text('main');
	}

	private function getXTemplate(){
		return new XTemplate(CDT_MVC_TEMPLATE_POPUP);
	}
	
	
	protected function parseMetaTags($xtpl){}
	
	protected function parseEstilos($xtpl){}
	
	protected function parseScripts($xtpl){}
	
}
