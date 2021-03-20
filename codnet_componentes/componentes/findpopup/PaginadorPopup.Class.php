<?php

class PaginadorPopup extends Paginador{
	
	function imprimirPaginado() {
		$funcionJs = "paginar_ajax";
		$html = "";
		if ($this->getNumPages () > 1) {
			$html .= "<span class=\"tituloPaginador\">P&aacute;ginas:&nbsp;&nbsp;</span>";
			
			if (($this->getActualPage ()) > 1) {
				$ds_pag_anterior = "&lt;&lt; anterior";
				$ant_page = ($this->getActualPage ()) - 1;
				$html .= "<a class=\"" . $this->getCssClassOtherPage () . "\" href=\"#\" onclick=\"$funcionJs('" . $this->getUrlAndGetVars ($ant_page) . "')\" >$ds_pag_anterior</a>&nbsp;&nbsp;";
			}
			
			if (($this->getInitPage ()) > 1) {
				$ds_pags_anteriores = "[.....]";
				$ant_pages = $this->getInitPage () - 1;
				$html .= "<a class=\"" . $this->getCssClassOtherPage () . "\" href=\"#\" onclick=\"$funcionJs('" . $this->getUrlAndGetVars ($ant_page) . "')\">$ds_pags_anteriores</a>&nbsp;&nbsp;";
			}
			
			for($i = $this->getInitPage (); $i <= ($this->getEndPage ()); $i ++) {
				if ($i != ($this->getActualPage ())) {
					$html .= "<a class=\"" . $this->getCssClassOtherPage () . "\" href=\"#\" onclick=\"$funcionJs('" . $this->getUrlAndGetVars ($i) . "')\">$i</a> ";
				} else {
					$html .= "<span class=\"" . $this->getCssClassActualPage () . "\">$i</span> ";
				}
			} //final del for
			

			if ($this->getNumPages () > $this->getEndPage ()) {
				$ds_pags_siguientes = "[.....]";
				$sig_pages = $this->getEndPage () + 1;
				$html .= "&nbsp;<a class=\"" . $this->getCssClassOtherPage () . "\" href=\"#\" onclick=\"$funcionJs('" . $this->getUrlAndGetVars ($sig_page) . "')\">$ds_pags_siguientes</a>";
			}
			
			if (($this->getActualPage ()) < ($this->getNumPages ())) {
				$ds_pag_siguiente = "siguiente &gt;&gt;";
				$sig_page = ($this->getActualPage ()) + 1;
				$html .= "&nbsp;&nbsp;<a class=\"" . $this->getCssClassOtherPage () . "\" href=\"#\" onclick=\"$funcionJs('" . $this->getUrlAndGetVars ($sig_page) . "')\">$ds_pag_siguiente</a>";
			}
		}
		return $html;
	}	
} // class paginador
?>