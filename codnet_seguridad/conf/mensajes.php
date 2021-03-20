<?php
/**
 * se definen los mensajes
 * del módulo cdt_seguridad.
 * 
 * @author bernardo
 * @since 20-05-2011
 * 
 */

define( "CDT_SEGURIDAD_MSG_CAMPOS_OBLIGATORIOS", 'campos obligatorios', true);

define( "CDT_SEGURIDAD_MSG_USUARIO_NO_EXISTE",  'El usuario no existe', true );
define( "CDT_SEGURIDAD_MSG_PASSWORD_INCORRECTA",  'La contraseña no es válida', true );


define( "CDT_SEGURIDAD_MSG_DEBE_LOGUEARSE",  'Debe loguearse en el sistema', true );
define( "CDT_SEGURIDAD_MSG_USUARIO_SIN_PERMISOS",  'No tiene permisos para realizar la operación solicitada', true );


//login web.
define( "CDT_SEGURIDAD_MSG_BTN_LOGIN_WEB", 'Ingresar', true);
define( "CDT_SEGURIDAD_MSG_LOGIN_WEB_TITULO", 'Ingresar', true);
define( "CDT_SEGURIDAD_MSG_LINK_REGISTRARSE", "Nuevo usuario? Bienvenido! Reg&iacute;strese <a href='" .WEB_PATH . "doAction?action=registrarse-init' >aqu&iacute;</a>&nbsp;&nbsp;", true);
define( "CDT_SEGURIDAD_MSG_INGRESE_USERNAME", "Ingrese nombre de usuario", true);
define( "CDT_SEGURIDAD_MSG_INGRESE_PASSWORD", "Ingrese la password", true);
define( "CDT_SEGURIDAD_MSG_RECUPERAR_PASSWORD", "Olvid&oacute; su password?", true);

//solicitar clave.
//define( "CDT_SEGURIDAD_MSG_SOLICITAR_CLAVE", "If you have forgotten your password and would like to change it, enter your email address and we'll send you a new password reset request.", true);
define( "CDT_SEGURIDAD_MSG_SOLICITAR_CLAVE_TITULO", "Solicitud de nueva password", true);
define( "CDT_SEGURIDAD_MSG_SOLICITAR_CLAVE", "Si olvid&oacute; su password y quiere cambiarla, complete el formulario y le enviaremos una nueva", true);
define( "CDT_SEGURIDAD_MSG_EMAIL", "Ingrese su email o nombre de usuario", true);
define( "CDT_SEGURIDAD_MSG_INGRESE_EMAIL", "Ingrese su email", true);
define( "CDT_SEGURIDAD_MSG_BTN_RESETEAR_PASSWORD", "Resetear password", true);
define( "CDT_SEGURIDAD_MSG_NUEVA_PASSWORD_ENVIADA", "Le hemos enviado en email con su nueva password.", true);
define( "CDT_SEGURIDAD_MSG_MAIL_SOLICITAR_CLAVE_SUBJECT",  'Solicitud de nueva password', true);



//registración.
define( "CDT_SEGURIDAD_MSG_CODIGOSEGURIDAD", 'C&oacute;digo de seguridad', true);
define( "CDT_SEGURIDAD_MSG_REPEAT_PASSWORD", 'Repetir password', true);
define( "CDT_SEGURIDAD_MSG_LEER_TERMINOS", 'Debe leer t&eacute;rminos y condiciones', true);
define( "CDT_SEGURIDAD_MSG_INGRESE_NOMUSUARIO", 'Ingrese nombre de usuario', true);
define( "CDT_SEGURIDAD_MSG_EMAIL_INVALIDO", 'El E-mail no es v&aacute;lido', true);
define( "CDT_SEGURIDAD_MSG_PASSWORDS_INCORRECTAS", 'Las passwords no coinciden', true);
define( "CDT_SEGURIDAD_MSG_CAMBIAR_IMAGEN", 'Cambiar imagen', true);
define( "CDT_SEGURIDAD_MSG_HE_LEIDO", 'He le&iacute;do y acepto t&eacute;rminos y condiciones', true);
define( "CDT_SEGURIDAD_LBL_BTN_REGISTER", 'Registrarse', true);
define( "CDT_SEGURIDAD_MSG_REGISTRAR_USUARIO_TITULO", 'Registración', true);
define( "CDT_SEGURIDAD_MSG_REGISTRAR_USUARIO_SUCCESS", 'Su registración fue realizada con éxito. <br /> Recibirá un email con los datos de activación para su cuenta', true);
define( "CDT_SEGURIDAD_MSG_ACTIVAR_REGISTRACION_SUCCESS", 'Bienvenido!. <br /> Su cuenta fue activada con éxito', true);
define( "CDT_SEGURIDAD_MSG_CODIGO_ACTIVACION_INCORRECTO",  '"El código de activación no es válido"', true );
define( "CDT_SEGURIDAD_MSG_CODIGO_ACTIVACION_EXPIRO",  '"El código de activación expiró"', true );
define( "CDT_SEGURIDAD_MSG_REGISTRACION_LINK_ACTIVACION",  'undefined', true );
define( "CDT_SEGURIDAD_MSG_MAIL_REGISTRACION_SUBJECT",  'Registración', true );
define( "CDT_SEGURIDAD_MSG_USUARIO_REPETIDO",  'El nombre de usuario ya existe', true );

define( "CDT_SEGURIDAD_MSG_TERMINOS_CONDICIONES_TITULO", 'T&eacute;rminos y Condiciones', true);
define( "CDT_SEGURIDAD_MSG_TERMINOS_CONDICIONES_ACEPTAR", 'Acepto los t&eacute;rminos y condiciones', true);


include ('mensajes_labels.php');