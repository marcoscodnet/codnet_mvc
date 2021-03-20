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
		$oUsuario->setCd_usuario( FormatUtils::getParamSESSION("cd_usuarioSession"));
		$oUsuario->setFunciones( FormatUtils::getParamSESSION("funciones") );
		$oUsuario->setDs_nomusuario( FormatUtils::getParamSESSION("ds_usuario") );
		$oUsuario->setDs_apynom( FormatUtils::getParamSESSION("ds_apynom") );
		return $oUsuario;
	}

	public static function isUsuarioLogueado(){
		$logueado =  (FormatUtils::getParamSESSION("cd_usuarioSession") != "");
		return $logueado;
	}
}
