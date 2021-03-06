<?php

class CMPFindObject2 extends CMPComponent{

	//label para el input.
	private $label;
	//id del input
	private $inputId;
	//name para el input.
	private $inputName;
	//size para el input.
	private $inputSize;
	//size para el label del input.
	private $inputLabelSize;
	
	//$item a visualizar.
	private $item;
	
	private $disabled=false;

	//estilos para el input y el label.
	private $labelCss;
	private $inputCss;

	//clase que atiende el listado.
	private $requestClass;
	//m?todo a invocar sobre la clase anterior para obtener los items.
	private $requestMethod;

	//para determinar la clase del item.
	//si no se define nada el item ser? un array.
	private $itemClass;
	//el m?todo para obtener el valor a mostrar en el input (por lo que se busca).
	private $itemLabel;
	//el c?digo del item.
	private $itemCode;
	
	//funci?n javascript a llamar una vez seleccionado un item.
	private $functionCallback;
	//atributos que se le pasan a la funci?n callback.
	//debemos pasarle los nombres de los m?todos separadas por coma: "cd_tabtext, ds_tabtext, ..."
	private $itemAttributesCallback="";

	//para indicar que el valor es obligatorio.
	private $obligatorio;
	
	//mensaje para cuando es obligatorio.
	private $msgObligatorio;
		
	private $showCode=true;
	
	public function setLabel( $value ){ $this->label = $value; }
	public function getLabel(){ return $this->label; }

	public function setInputId( $value ){ $this->inputId = $value; }
	public function getInputId(){ return $this->inputId; }

	public function setInputName( $value ){ $this->inputName = $value; }
	public function getInputName(){ return $this->inputName; }

	public function setInputSize( $value ){ $this->inputSize = $value; }
	public function getInputSize(){ return $this->inputSize; }

	public function setInputLabelSize( $value ){ $this->inputLabelSize = $value; }
	public function getInputLabelSize(){ return $this->inputLabelSize; }
	
	public function setDisabled( $value ){ $this->disabled = $value; }
	public function getDisabled(){ return $this->disabled; }

	public function setLabelCss( $value ){ $this->labelCss = $value; }
	public function getLabelCss(){ return $this->labelCss; }

	public function setInputCss( $value ){ $this->inputCss = $value; }
	public function getInputCss(){ return $this->inputCss; }

	public function setRequestClass( $value ){ $this->requestClass = $value; }
	public function getRequestClass(){ return $this->requestClass; }

	public function setRequestMethod( $value ){ $this->requestMethod = $value; }
	public function getRequestMethod(){ return $this->requestMethod; }

	public function setItem($value){ $this->item=$value; }
	public function getItem(){ return $this->item; }
	
	public function setItemClass($clazz){ $this->itemClass=$clazz; }
	public function getItemClass(){ return $this->itemClass; }

	public function setItemLabel($value){ $this->itemLabel=$value; }
	public function getItemLabel(){ return $this->itemLabel; }

	public function setItemCode($value){ $this->itemCode=$value; }
	public function getItemCode(){ return $this->itemCode; }

	public function setFunctionCallback( $value ){ $this->functionCallback = $value; }
	public function getFunctionCallback(){ return $this->functionCallback; }

	public function setItemAttributesCallback( $value ){ $this->itemAttributesCallback = $value; }
	public function getItemAttributesCallback(){ return $this->itemAttributesCallback; }

	public function setObligatorio( $value ){ $this->obligatorio = $value; }
	public function getObligatorio(){ return $this->obligatorio; }
	
	public function setMsgObligatorio( $value ){ $this->msgObligatorio = $value; }
	public function getMsgObligatorio(){ return $this->msgObligatorio; }
	
	public function setShowCode( $value ){ $this->showCode = $value; }
	public function getShowCode(){ return $this->showCode; }
	
	public function show(){
		return $this->getContent();
	}



	public function getContent(){

		$xtpl = $this->getXTemplate();
			
		$this->parseFindObject( $xtpl );

		$xtpl->parse("main");

		$content .= $xtpl->text("main");

		return $content;
	}

	private function parseFindObject( $xtpl ){

		$label = $this->getLabel();
		if(!empty($label)){

			$xtpl->assign('label', $label );
			$xtpl->assign('labelCss', $this->getLabelCss() );
			$xtpl->parse('main.label');
		}

		$xtpl->assign('inputId', $this->getInputId());
		$xtpl->assign('inputName', $this->getInputName() );
		$xtpl->assign('inputValue', $this->getValue($this->getItem(), $this->getItemCode(), $this->getItemClass()));
		$xtpl->assign('inputValueDesc', $this->getValue($this->getItem(), $this->getItemLabel(), $this->getItemClass()));
		
		$size = $this->getInputSize();
		if(empty($size))
		$size=3;
		$xtpl->assign('inputSize', $size);

		$size = $this->getInputLabelSize();
		if(empty($size))
		$size=30;
		$xtpl->assign('inputLabelSize', $size);
		

		$disabled = $this->getDisabled();
		if( $disabled )
		$xtpl->assign('disabled',  'disabled' );
		else
		$xtpl->assign('disabled', '');

			
		$xtpl->assign('inputCss', $this->getInputCss() );

		$xtpl->assign('requestClass', $this->getRequestClass() );
		$xtpl->assign('requestMethod', $this->getRequestMethod() );
			
		$xtpl->assign('itemClass', $this->getItemClass() );
		$xtpl->assign('itemCode', $this->getItemCode() );
		$xtpl->assign('itemLabel', $this->getItemLabel());

		$callback = $this->getFunctionCallback();
		if( !empty($callback) )
		$xtpl->assign('functionCallback', $callback . "()" );
		else
		$xtpl->assign('functionCallback', "" );

		$attributes = $this->getItemAttributesCallback();
		if( !empty($attributes) ){
			$xtpl->assign('attributeCallback', ", attrCallBack: 'rel'");
			$xtpl->assign('itemAttrCallback', $attributes);
		}
		else
		$xtpl->assign('attributeCallback', '');
		
		if($this->obligatorio){
			$msg = (empty($this->msgObligatorio))?"Ingrese un valor":$this->msgObligatorio;
			
			$validate = "jVal=\"{valid:function (val) { return requerido(val,'$msg'); }}\"";
			$xtpl->assign('desc_obligatorio', $validate);
			
			$validate = "jVal=\"{valid:function (val) { return requerido(val,'fdfd'); }}\"";
			$xtpl->assign('code_obligatorio', $validate);
		}
			
		
		if($this->showCode)
			$xtpl->assign('code_type', 'text');
		else	
			$xtpl->assign('code_type', 'hidden');
	}

	public function findItem( $text ){

		if(empty($text)){
			$jsondata['find'] = false;
			$jsondata['msg'] = "";
			return $jsondata;
		}
		
		$method = ($this->getRequestMethod())?$this->getRequestMethod():"getEntidad";
		
		try{

			$item = $this->invokeMethod($this->getRequestClass() , $method, $this->getCriterio($text) );

		}catch(Exception $ex){

			$item = $this->invokeMethod($this->getRequestClass() , $method, $text );
		}
					
		$this->setItem( $item );
		
		if(!empty($item)){
			$jsondata['code'] = $this->getValue( $item, $this->getItemCode(), $this->getItemClass());
			$jsondata['label'] = $this->getValue( $item, $this->getItemLabel(), $this->getItemClass());	
			$jsondata['find'] = true;
		}else{
			$jsondata['find'] = false;
			$jsondata['msg'] = "no existe";
		}
		
			
		return $jsondata;
	}



	public function getCriterio( $text ){
		$criterio = new CriterioBusqueda();
		$criterio->addFiltro( $this->itemCode , $text, "=", new FormatValorString());
		return $criterio;
	}

	public function getXTemplate(){

		$xtpl = new XTemplate( CDT_CMP_TEMPLATE_FINDOBJECT );

		$xtpl->assign('WEB_PATH', WEB_PATH);


		return $xtpl;

	}
	
}
?>