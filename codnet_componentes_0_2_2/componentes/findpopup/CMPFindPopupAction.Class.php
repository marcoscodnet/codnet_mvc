<?php

class CMPFindPopupAction extends ListarAction {

	protected function parseContenido(XTemplate $xtpl, $filtro, $oPaginador, $query_string, $entidades, CriterioBusqueda $criterio){
	
		$xtpl->assign("url", $this->getUrl());
		$xtpl->assign("onSeleccionar",  FormatUtils::getParam('onSeleccionar') );
	
		return parent::parseContenido($xtpl, $filtro, $oPaginador, $query_string, $entidades, $criterio);
	}
	
    protected function getListarTableModel(ItemCollection $items) {
    	$clazz = FormatUtils::getParam('tableModel');
    	$oClass = new ReflectionClass($clazz);
		$oInstance = $oClass->newInstance( $items );
        return $oInstance;
    }

    protected function getOpciones() {
        //$opciones[] = $this->buildOpcion('altafuncion', 'Agregar Funcion', 'alta_funcion_init');
        //return $opciones;
        //TODO setear opciones.
        return array();
    }

    protected function getFiltros() {
        //TODO revisar.

    	try{
        	$clazz = FormatUtils::getParam('tableModel');
    		$oClass = new ReflectionClass($clazz);
			$oInstance = $oClass->newInstance( new ItemCollection() );
        
			$reflectionMethod = new ReflectionMethod( get_class( $oInstance ) , 'getFiltros');
			$value = $reflectionMethod->invoke( $oInstance );
			
    	}catch(Exception $ex){
    		
    		$filtro['orden']= $clazz = FormatUtils::getParam('itemLabel');
			$filtro['descripcion']= "Label";
			$filtros[] = $filtro;
    		
    		$value = $filtros;
    	}
    	
		return $value;
		
    }
    
    protected function parseAcciones(XTemplate $xtpl, $item) {
		//TODO parsear el seleccionar.
        //$this->parseAccionesDefault($xtpl, $item, $item->getCd_funcion(), 'funcion', 'funcion', true, true, true);
    }

    protected function getEntidadManager() {
    	$clazz = FormatUtils::getParam('requestClass');
    	$oClass = new ReflectionClass($clazz);
		$oInstance = $oClass->newInstance();
        return $oInstance;
    }

    protected function getCampoOrdenDefault() {
        return FormatUtils::getParam('itemCode');;
    }

    protected function getTitulo() {
        return 'Buscar';
    }

    protected function getUrlAccionListar() {
    	return 'cmp_findpopup';
    }

    protected function getForwardError() {
        return 'error';
    }

    protected function getMenuActivo() {
    	//TODO
        return "";
    }

    protected function getCartelEliminar($entidad) {
		return "";
    }

	protected function getLayout(){
		return new LayoutSimpleAjax();
	}
	
	protected function getXTemplate(){
		return new XTemplate(CDT_CMP_TEMPLATE_FINDPOPUP);
	}
	

	protected function getPaginador($num_rows, $orden, $campoFiltro, $filtro, $campoOrden, $page){
		$num_pages = ceil ( $num_rows / ROW_PER_PAGE );

		//$url = 'index.php?orden=' . $orden . '&campo=' . $campo . '&filtro=' . $filtro;
		$url = $this->getUrlPaginador( $orden, $campoFiltro, $filtro, $campoOrden );
		$cssclassotherpage = 'paginadorOtraPagina';
		$cssclassactualpage = 'paginadorPaginaActual';
		$ds_pag_anterior = 0; //$gral['pag_ant'];
		$ds_pag_siguiente = 2; //$gral['pag_sig'];
		return new PaginadorPopup ( $url, $num_pages, $page, $cssclassotherpage, $cssclassactualpage, $num_rows );
	}
		
	protected function getUrlPaginador( $orden , $campoFiltro, $filtro, $campoOrden ){
		$url = $this->getUrl() . '&orden=' . $orden . '&campoFiltro=' . $campoFiltro . '&filtro=' . $filtro. '&campoOrden=' . $campoOrden . $this->getFiltrosEspecialesQueryString();
		return $url;
	}

	protected function getUrl(){
		$url = 'doAction?action=cmp_findpopup';
		
		$requestClass = FormatUtils::getParam('requestClass');
		$itemCode = FormatUtils::getParam('itemCode');
		$itemLabel = FormatUtils::getParam('itemLabel');
		$tableModel = FormatUtils::getParam('tableModel');
		$onSeleccionar = FormatUtils::getParam('onSeleccionar');
		
		$url .= "&tableModel=$tableModel&requestClass=$requestClass&itemCode=$itemCode&itemLabel=$itemLabel&onSeleccionar=$onSeleccionar";
		 
		return $url;
	}

	
	protected function getCriterioBusqueda(){
		//recuperamos los par�metros.
		$criterio = parent::getCriterioBusqueda();
		$criterio->setRowPerPage( 10 );
		return $criterio;
	}
	
	protected function parseItem($xtpl, $entidad){
		parent::parseItem($xtpl, $entidad);
		
		$method = 'get' . ucfirst( FormatUtils::getParam('itemCode') );
		
		$reflectionMethod = new ReflectionMethod( get_class( $entidad ) , $method);

		$value = $reflectionMethod->invoke( $entidad );
		
		$xtpl->assign ( 'code', $value  );

	}
}
?>