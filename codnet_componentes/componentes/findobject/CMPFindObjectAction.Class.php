<?php

class CMPFindObjectAction extends OutputAction{


	protected function getContenido(){

		//clase y método a invocar para obtener los items.
		$requestClazz =  FormatUtils::getParam('requestClass') ;
		$requestMethod =  FormatUtils::getParam('requestMethod') ;
		$itemClazz =  FormatUtils::getParam('itemClass') ;
		$itemCode =  FormatUtils::getParam('itemCode') ;
		$itemLabel =  FormatUtils::getParam('itemLabel') ;
		$itemAttrCallback =  FormatUtils::getParam('itemAttrCallback') ;

		$inputName =  FormatUtils::getParam('inputName') ;
		$text = FormatUtils::getParam('query') ;
			

		$oFindObject = new CMPFindObject();
		$oFindObject->setRequestClass( $requestClazz );
		$oFindObject->setRequestMethod( $requestMethod );
		$oFindObject->setItemClass( $itemClazz );
		$oFindObject->setItemLabel( $itemLabel );
		$oFindObject->setItemCode( $itemCode );
		$oFindObject->setItemAttributesCallback( $itemAttrCallback );

		return $oFindObject->findItem( $text );
	}

	protected function getLayout(){
		return new LayoutJson();
	}

	public function getTitulo(){
		return "";
	}
}
?>