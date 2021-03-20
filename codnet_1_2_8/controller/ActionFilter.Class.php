<?php

/**
 * Un filtro se ejecuta antes de las acciones.
 * La principal funcionalidad de los filtros es realizar validaciones.
 * Todo lo que necesitemos ejecutar antes de una acción lo podemos realizar con un filtro.
 * 
 * @author bernardo
 * @since 04-07-2011
 */
interface ActionFilter{

	function apply( $ds_action_name, $oAction );
	
}