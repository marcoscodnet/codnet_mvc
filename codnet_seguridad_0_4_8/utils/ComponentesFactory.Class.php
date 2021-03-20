<?php

/**
 * Factory para componentes de seguridad.
 *
 * @author bernardo
 * @since 18-07-2011
 */
class ComponentesFactory{


	public static function getAutocompleteFunciones($defaultValue="", $inputId='funcion_autocomplete', $obligatorio=false){
		$oAutocomplete = new CMPAutocomplete();

		$oAutocomplete->setInputName( $inputId );
		$oAutocomplete->setInputId( $inputId );
		$oAutocomplete->setRequestClass( 'FuncionManager' );
		$oAutocomplete->setItemCode( 'cd_funcion' );
		$oAutocomplete->setItemLabel( 'ds_funcion' );
		$oAutocomplete->setItemClass( 'Funcion' );

		$oAutocomplete->setInputValue( $defaultValue );
		$oAutocomplete->setItemAttributesList( 'cd_funcion,ds_funcion' );
		$oAutocomplete->setFunctionCallback('funcion_change');
		$oAutocomplete->setItemAttributesCallback( 'cd_funcion,ds_funcion' );
		
		$oAutocomplete->setObligatorio( $obligatorio );
		
		return $oAutocomplete;
	}
	
	public static function getAutocompleteAccionesNavegacion($defaultValue="", $inputId='accionfuncion_autocomplete', $obligatorio=false){
		$oAutocomplete = new CMPAutocomplete();

		$oAutocomplete->setInputName( $inputId );
		$oAutocomplete->setInputId( $inputId );
		$oAutocomplete->setRequestClass( 'AccionFuncionManager' );
		$oAutocomplete->setRequestClass( 'AccionFuncionManager' );
		$oAutocomplete->setRequestMethod( 'getAccionesNavegacion' );
		$oAutocomplete->setItemCode( 'nombre' );
		$oAutocomplete->setItemLabel( 'clase' );
		
		$oAutocomplete->setInputValue( $defaultValue );
		$oAutocomplete->setItemAttributesList( 'nombre' );
		$oAutocomplete->setFunctionCallback('accion_change');
		$oAutocomplete->setItemAttributesCallback( 'nombre' );
		
		$oAutocomplete->setObligatorio( $obligatorio );
	
		return $oAutocomplete;
	}
	
	public static function getFindObjectFuncion(Funcion $oFuncion, $inputId='funcion_find', $obligatorio=false){
		$oFindObject = new CMPFindObject();

		$oFindObject->setInputName( $inputId );
		$oFindObject->setInputId( $inputId );
		$oFindObject->setRequestClass( 'FuncionManager' );
		$oFindObject->setRequestMethod( 'getFuncion' );
		$oFindObject->setTableModel( 'FuncionTableModel' );
		$oFindObject->setItemCode( 'cd_funcion' );
		$oFindObject->setItemLabel( 'ds_funcion' );
		$oFindObject->setItemClass( 'Funcion' );

		$oFindObject->setItem( $oFuncion );
		
		$oFindObject->setFunctionCallback('funcion_change');
		$oFindObject->setItemAttributesCallback( 'cd_funcion,ds_funcion' );
		
		$oFindObject->setObligatorio( $obligatorio );
		
		return $oFindObject;
	}

	public static function getFindObjectPerfil(Perfil $oPerfil, $inputId='perfil_find', $obligatorio=false){
		$oFindObject = new CMPFindObject();

		$oFindObject->setInputName( $inputId );
		$oFindObject->setInputId( $inputId );
		$oFindObject->setRequestClass( 'PerfilManager' );
		$oFindObject->setRequestMethod( 'getPerfil' );
		$oFindObject->setTableModel( 'PerfilTableModel' );
		$oFindObject->setItemCode( 'cd_perfil' );
		$oFindObject->setItemLabel( 'ds_perfil' );
		$oFindObject->setItemClass( 'Perfil' );

		$oFindObject->setItem( $oPerfil );
		
		$oFindObject->setFunctionCallback('perfil_change');
		$oFindObject->setItemAttributesCallback( 'cd_perfil,ds_perfil' );
		
		$oFindObject->setObligatorio( $obligatorio );
		
		return $oFindObject;
	}	
}
