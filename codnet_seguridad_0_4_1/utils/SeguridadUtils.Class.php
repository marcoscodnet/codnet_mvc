<?php

/**
 * Utilidades para seguridad.
 * 
 * @author bernardo
 * @since 01-06-2011
 */
class SeguridadUtils{
	

	public static function getUsuarioLogueado(){
		$oUsuario = new Usuario();
		$oUsuario->setCd_usuario( $_SESSION ["cd_usuarioSession"] );
		$oUsuario->setFunciones( $_SESSION ["funciones"] );
		$oUsuario->setDs_nomusuario( $_SESSION ["ds_usuario"] );
		$oUsuario->setDs_apynom( $_SESSION ["ds_apynom"] );
		$oUsuario->setFunciones( $_SESSION ["funciones"] );
		return $oUsuario;		
	}
	
	public static function isUsuarioLogueado(){
		return ( isset ( $_SESSION ["cd_usuarioSession"] ) & ($_SESSION ['cd_usuarioSession'] != ""));
	}
}
