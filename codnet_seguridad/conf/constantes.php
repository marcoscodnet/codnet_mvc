<?php

	
define("CDT_SEGURIDAD_REGISTRACION_LAYOUT", 'LayoutSimple', true);
define("CDT_SEGURIDAD_ACTIVAR_REGISTRACION_ACTION", 'doAction?action=activar_registracion', true);
define("CDT_SEGURIDAD_PERFIL_DEFAULT_ID", 4, true);
define("CDT_SEGURIDAD_TERMINOS_CONDICIONES_LAYOUT", "LayoutSimpleAjax", true);


define("CDT_SEGURIDAD_SOLICITAR_CLAVE_LAYOUT", 'LayoutSimple', true);
define("CDT_SEGURIDAD_SOLICITAR_CLAVE_INIT_ACTION", 'doAction?action=solicitar_clave_init', true);
define("CDT_SEGURIDAD_SOLICITAR_CLAVE_ACTION", 'doAction?action=solicitar_clave', true);

define("CDT_SEGURIDAD_LOGIN_WEB_LAYOUT", 'LayoutSimple', true);
define("CDT_SEGURIDAD_LOGIN_WEB_ACTION", 'doAction?action=login_web', true);

define("CDT_SEGURIDAD_LOGIN_WEB_INIT_ACTION", 'login_web_init', true);
define("CDT_SEGURIDAD_ACCESO_WEB_DENEGADO_ACTION", 'acceso_web_denegado', true);
?>