<?php

class CMPAutocompleteAction extends OutputAction{


	protected function getContenido(){
		
		if( isset( $_GET['query'] ) && $_GET['query'] != "" && $_GET['requestClass'] != ""
			&& $_GET['itemLabel'] != "" && $_GET['itemCode'] != ""){
			
		    $text =  FormatUtils::getParam('query') ;
		    
		    //clase y método a invocar para obtener los items.
			$requestClazz =  FormatUtils::getParam('requestClass') ;
			$requestMethod =  FormatUtils::getParam('requestMethod') ;
			$itemClazz =  FormatUtils::getParam('itemClass') ;
			$itemCode =  FormatUtils::getParam('itemCode') ;
			$itemLabel =  FormatUtils::getParam('itemLabel') ;
			$itemAttrCallback =  FormatUtils::getParam('itemAttrCallback') ;
			$itemAttrList =  FormatUtils::getParam('itemAttrList') ;
			
			$oAutocomplete = new CMPAutocomplete();
			$oAutocomplete->setRequestClass( $requestClazz );
			$oAutocomplete->setRequestMethod( $requestMethod );
			$oAutocomplete->setItemClass( $itemClazz );
			$oAutocomplete->setItemLabel( $itemLabel );
			$oAutocomplete->setItemCode( $itemCode );
			$oAutocomplete->setItemAttributesCallback( $itemAttrCallback );
			$oAutocomplete->setItemAttributesList( $itemAttrList );
			
		    return $oAutocomplete->getItems( $text );
		}
		return "";
	}

	public function getTitulo(){
		return "";
	}
	

	protected function getLayout(){
		return new LayoutSimple();
	}	
}
?>