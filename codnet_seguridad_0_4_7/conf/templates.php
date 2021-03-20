<?php
/**
 * se definen los nombres de los templates
 * del módulo cdt_seguridad.
 * 
 * @author bernardo
 * @since 12-04-2011
 * 
 */

/*login*/
define( 'CDT_SEGURIDAD_TEMPLATE_LOGIN',  CDT_SEGURIDAD_PATH . 'view/templates/login.html', true );

/*login web*/
define( 'CDT_SEGURIDAD_TEMPLATE_WEB_LOGIN',  CDT_SEGURIDAD_PATH . 'view/templates/login_web.html', true );

/*solicitar nueva clave*/
define( 'CDT_SEGURIDAD_TEMPLATE_SOLICITAR_CLAVE',  CDT_SEGURIDAD_PATH . 'view/templates/solicitar_clave/solicitar_clave.html', true );
define( 'CDT_SEGURIDAD_TEMPLATE_SOLICITAR_CLAVE_SUCCESS',  CDT_SEGURIDAD_PATH . 'view/templates/solicitar_clave/solicitar_clave_success.html', true );
define( 'CDT_SEGURIDAD_TEMPLATE_MAIL_SOLICITAR_CLAVE',  CDT_SEGURIDAD_PATH . 'view/templates/solicitar_clave/mail_solicitar_clave.html', true );

/*usuarios*/
define( 'CDT_SEGURIDAD_TEMPLATE_ALTA_USUARIO',  CDT_SEGURIDAD_PATH . 'view/templates/usuarios/altausuario.html' );
define( 'CDT_SEGURIDAD_TEMPLATE_MODIFICAR_USUARIO',  CDT_SEGURIDAD_PATH . 'view/templates/usuarios/modificarusuario.html' );
define( 'CDT_SEGURIDAD_TEMPLATE_BAJA_USUARIO',  CDT_SEGURIDAD_PATH . 'view/templates/usuarios/eliminarusuario.html' );
define( 'CDT_SEGURIDAD_TEMPLATE_VER_USUARIO',  CDT_SEGURIDAD_PATH . 'view/templates/usuarios/verusuario.html' );
//define( CDT_SEGURIDAD_TEMPLATE_LISTAR_USUARIO,  'Listar Usuario');
define( 'CDT_SEGURIDAD_TEMPLATE_CAMBIAR_CLAVE',  CDT_SEGURIDAD_PATH . 'view/templates/usuarios/cambiarClave.html' );
	
/*perfiles*/
define( 'CDT_SEGURIDAD_TEMPLATE_EDITAR_PERFIL', CDT_SEGURIDAD_PATH . 'view/templates/perfiles/editarperfil.html' );
define( 'CDT_SEGURIDAD_TEMPLATE_BAJA_PERFIL', CDT_SEGURIDAD_PATH . 'view/templates/perfiles/eliminarperfil.html' );
define( 'CDT_SEGURIDAD_TEMPLATE_VER_PERFIL', CDT_SEGURIDAD_PATH . 'view/templates/perfiles/verperfil.html' );
//define( CDT_SEGURIDAD_TEMPLATE_LISTAR_PERFILES, 'Listar Perfil');


define( 'CDT_SEGURIDAD_TEMPLATE_MENU', CDT_SEGURIDAD_PATH . 'view/templates/menu.html' );

/*registracion*/
define( 'CDT_SEGURIDAD_TEMPLATE_REGISTRAR_USUARIO',  CDT_SEGURIDAD_PATH . 'view/templates/registrarse.html', true );
define( 'CDT_SEGURIDAD_TEMPLATE_MAIL_ACTIVAR_REGISTRACION',  CDT_SEGURIDAD_PATH . 'view/templates/mail_activar_registracion.html', true );
define( 'CDT_SEGURIDAD_TEMPLATE_REGISTRARSE_SUCCESS',  CDT_SEGURIDAD_PATH . 'view/templates/registrarse_success.html', true );
define( 'CDT_SEGURIDAD_TEMPLATE_TERMINOS_CONDICIONES',  CDT_SEGURIDAD_PATH . 'view/templates/terminos_condiciones.html', true );

define('CDT_SEGURIDAD_TEMPLATE_EDITAR_ACCIONFUNCION', CDT_SEGURIDAD_PATH . 'view/templates/accionfunciones/editar_accionfuncion.html');
define('CDT_SEGURIDAD_TEMPLATE_VER_ACCIONFUNCION', CDT_SEGURIDAD_PATH . 'view/templates/accionfunciones/ver_accionfuncion.html');
define('CDT_SEGURIDAD_TEMPLATE_BAJA_ACCIONFUNCION', CDT_SEGURIDAD_PATH . 'view/templates/accionfunciones/eliminar_accionfuncion.html');

define('CDT_SEGURIDAD_TEMPLATE_EDITAR_FUNCION', CDT_SEGURIDAD_PATH . 'view/templates/funciones/editar_funcion.html');
define('CDT_SEGURIDAD_TEMPLATE_VER_FUNCION', CDT_SEGURIDAD_PATH . 'view/templates/funciones/ver_funcion.html');
define('CDT_SEGURIDAD_TEMPLATE_BAJA_FUNCION', CDT_SEGURIDAD_PATH . 'view/templates/funciones/eliminar_funcion.html');

define('CDT_SEGURIDAD_TEMPLATE_EDITAR_MENUGROUP', CDT_SEGURIDAD_PATH . 'view/templates/menugroups/editar_menugroup.html');
define('CDT_SEGURIDAD_TEMPLATE_VER_MENUGROUP', CDT_SEGURIDAD_PATH . 'view/templates/menugroups/ver_menugroup.html');
define('CDT_SEGURIDAD_TEMPLATE_BAJA_MENUGROUP', CDT_SEGURIDAD_PATH . 'view/templates/menugroups/eliminar_menugroup.html');

define('CDT_SEGURIDAD_TEMPLATE_EDITAR_MENUOPTION', CDT_SEGURIDAD_PATH . 'view/templates/menuoptions/editar_menuoption.html');
define('CDT_SEGURIDAD_TEMPLATE_VER_MENUOPTION', CDT_SEGURIDAD_PATH . 'view/templates/menuoptions/ver_menuoption.html');
define('CDT_SEGURIDAD_TEMPLATE_BAJA_MENUOPTION', CDT_SEGURIDAD_PATH . 'view/templates/menuoptions/eliminar_menuoption.html');

define('CDT_SEGURIDAD_TEMPLATE_EDITAR_REGISTRACION', CDT_SEGURIDAD_PATH . 'view/templates/registraciones/editar_registracion.html');
define('CDT_SEGURIDAD_TEMPLATE_VER_REGISTRACION', CDT_SEGURIDAD_PATH . 'view/templates/registraciones/ver_registracion.html');
define('CDT_SEGURIDAD_TEMPLATE_BAJA_REGISTRACION', CDT_SEGURIDAD_PATH . 'view/templates/registraciones/eliminar_registracion.html');


?>