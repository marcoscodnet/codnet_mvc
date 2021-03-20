<?php

/**
 * se definen los mensajes del sistema en espa�ol.
 * 
 * @author modelBuilder
 * 
 */

define('CDT_SECURE_MSG_EXCEPTION_CANNOT_DELETE_ITEMS_RELATED', "No puede eliminar. <br/> Existen otras entidades relacionadas.", true);

//mensajes para login
define('CDT_SECURE_MSG_INVALID_PASSWORD', 'Password incorrecta', true);
define('CDT_SECURE_MSG_INVALID_USER', 'Usuario incorrecto', true);
 

define( "CDT_SECURE_MSG_LOGIN_REQUIRED",  'Login requerido', true );
define( "CDT_SECURE_MSG_PERMISSION_DENIED",  'Acceso denegado', true );

//login web.
define( "CDT_SECURE_MSG_BTN_LOGIN_WEB", 'Ingresar', true);
define( "CDT_SECURE_MSG_LOGIN_WEB_TITULO", 'Ingresar', true);
define( "CDT_SECURE_MSG_LINK_REGISTRARSE", "Nuevo usuario? Bienvenido! Reg&iacute;strese <a href='" .WEB_PATH . "doAction?action=signup_init' >aqu&iacute;</a>&nbsp;&nbsp;", true);
define( "CDT_SECURE_MSG_INGRESE_USERNAME", "Ingrese nombre de usuario", true);
define( "CDT_SECURE_MSG_INGRESE_PASSWORD", "Ingrese la password", true);
define( "CDT_SECURE_MSG_RECUPERAR_PASSWORD", "Olvid� su password?", true);

//solicitar clave.
//define( "CDT_SECURE_MSG_SOLICITAR_CLAVE", "If you have forgotten your password and would like to change it, enter your email address and we'll send you a new password reset request.", true);
define( "CDT_SECURE_MSG_FORGOT_PASSWORD_TITLE", "Solicitar password", true);
define( "CDT_SECURE_MSG_FORGOT_PASSWORD", "Si olvid� su password y quiere cambiarla, ingrese su nombre de usuario o e-mail y le enviaremos una nueva", true);
define( "CDT_SECURE_LBL_FORGOT_PASSWORD_EMAIL", "Nombre de usuario o e-mail", true);
define( "CDT_SECURE_MSG_FORGOT_PASSWORD_FILL_EMAIL", "Nombre de usuario o e-mail requerido", true);
define( "CDT_SECURE_BTN_FORGOT_PASSWORD_RESETEAR", "Resetear password", true);
define( "CDT_SECURE_MSG_FORGOT_PASSWORD_NEW_PASSWORD_SENT", "Te enviamos una nueva password a tu e-mail", true);
         
define( "CDT_SECURE_MSG_FORGOT_PASSWORD_MAIL_SUBJECT",  CDT_MVC_APP_TITLE . ' - Solicitud de nueva password', true);

//nuevos usuarios.
define( "CDT_SECURE_MSG_NEW_USER_MAIL_SUBJECT",  CDT_MVC_APP_TITLE . ' - Nuevo Usuario', true);

//registraci�n.
define( "CDT_SECURE_MSG_SECURITYCODE", 'C�digo de seguridad', true);
define( "CDT_SECURE_MSG_REPEAT_PASSWORD", 'Repetir password', true);
define( "CDT_SECURE_MSG_READ_TERMS", 'Aceptar t&eacute;rminos & condiciones', true);

define( "CDT_SECURE_MSG_USERNAME_REQUIRED", 'Nombre de usuario requerido', true);
define( "CDT_SECURE_MSG_PASSWORD_REQUIRED", 'Password requerida', true);
define( "CDT_SECURE_MSG_SECURITYCODE_REQUIRED", 'C�digo de seguridad requerido', true);

define( "CDT_SECURE_MSG_EMAIL_INVALID", 'e-mail no v&aacute;lido', true);
define( "CDT_SECURE_MSG_PASSWORDS_INVALID", 'Las passwords no coinciden', true);
define( "CDT_SECURE_MSG_RELOAD_IMAGE", 'Cambiar imagen', true);
define( "CDT_SECURE_LBL_BTN_REGISTER", 'Registrarse', true);
define( 'CDT_SECURE_MSG_REGISTRATION_SIGNUP_TITLE', 'Registrarse', true);
define( "CDT_SECURE_MSG_REGISTRATION_SIGNUP_SUCCESS", 'Gracias por registrarte! Recibir&aacute;s un e-mail con instrucciones para activar tu cuenta.', true);
define( "CDT_SECURE_MSG_ACTIVATE_REGISTRATION_SUCCESS", "Tu cuenta ha sido activada!.");
define( "CDT_SECURE_MSG_ACTIVATION_CODE_INVALID",  "El c�digo de activaci�n no es v&aacute;lido", true );
define( "CDT_SECURE_MSG_ACTIVATION_CODE_EXPIRED",  "El c�digo de activaci�n caduc�", true );
define( "CDT_SECURE_MSG_REGISTRATION_EMAIL_SUBJECT",  'Registraci�n', true );
define( "CDT_SECURE_MSG_REGISTRATION_USERNAME_DUPLICATED",  'El nombre de usuario no est&aacute; disponible', true );
define( "CDT_SECURE_MSG_REGISTRATION_EMAIL_DUPLICATED",  'El e-mail no est&aacute; disponible', true );

define( "CDT_SECURE_MSG_REGISTRATION_TERMS_TITLE", 'T&eacute;rminos & Condiciones', true);
define( "CDT_SECURE_MSG_REGISTRATION_TERMS_ACCEPT", 'He le&iacute;do y acepto los t&eacute;rminos y condiciones', true);


//mensajes comunes.
define('CDT_SECURE_LBL_BACK', 'Volver', true);
define('CDT_SECURE_LBL_SAVE', 'Guardar', true);
define('CDT_SECURE_LBL_CANCEL', 'Cancelar', true);
define('CDT_SECURE_LBL_YES', 'Si', true);
define('CDT_SECURE_LBL_NO', 'No', true);
define('CDT_SECURE_LBL_SELECT', 'Seleccionar', true);
define('CDT_SECURE_MSG_REQUIRED_FIELDS', 'Campos requeridos', true);

define('CDT_SECURE_MSG_CONFIRM_DELETE_QUESTION', 'Confirma eliminar?', true);
define('CDT_SECURE_MSG_CONFIRM_DELETE_TITLE', 'Confirmar', true);

//t�tulos de las actions
define('CDT_SECURE_MSG_CDTACTIONFUNCTION_TITLE_LIST', 'Listar Acci�n-Funciones', true);
define('CDT_SECURE_MSG_CDTACTIONFUNCTION_TITLE_ADD', 'Agregar Acci�n-Funci�n', true);
define('CDT_SECURE_MSG_CDTACTIONFUNCTION_TITLE_UPDATE', 'Modificar Acci�n-Funci�n', true);
define('CDT_SECURE_MSG_CDTACTIONFUNCTION_TITLE_VIEW', 'Ver Acci�n-Funci�n', true);

define('CDT_SECURE_MSG_CDTACTIONFUNCTION_CD_ACTIONFUNCTION_REQUIRED', 'C�digo requerido', true);
define('CDT_SECURE_MSG_CDTACTIONFUNCTION_CD_FUNCTION_REQUIRED', 'Funci�n requerida', true);
define('CDT_SECURE_MSG_CDTACTIONFUNCTION_DS_ACTION_REQUIRED', 'Acci�n requerida', true);

//t�tulos de las actions
define('CDT_SECURE_MSG_CDTFUNCTION_TITLE_LIST', 'Listar Funciones', true);
define('CDT_SECURE_MSG_CDTFUNCTION_TITLE_ADD', 'Agregar Funci�n', true);
define('CDT_SECURE_MSG_CDTFUNCTION_TITLE_UPDATE', 'Modificar Funci�n', true);
define('CDT_SECURE_MSG_CDTFUNCTION_TITLE_VIEW', 'Visualizar Funci�n', true);

define('CDT_SECURE_MSG_CDTFUNCTION_CD_FUNCTION_REQUIRED', 'C�digo requerido', true);
define('CDT_SECURE_MSG_CDTFUNCTION_DS_FUNCTION_REQUIRED', 'Funci�n requerida', true);

//t�tulos de las actions
define('CDT_SECURE_MSG_CDTMENUGROUP_TITLE_LIST', 'Listar Grupos de Men�', true);
define('CDT_SECURE_MSG_CDTMENUGROUP_TITLE_ADD', 'Agregar Grupo de Men�', true);
define('CDT_SECURE_MSG_CDTMENUGROUP_TITLE_UPDATE', 'Modificar Grupo de Men�', true);
define('CDT_SECURE_MSG_CDTMENUGROUP_TITLE_VIEW', 'Visualizar Grupo de Men�', true);

define('CDT_SECURE_MSG_CDTMENUGROUP_CD_MENUGROUP_REQUIRED', 'C�digo requerido', true);
define('CDT_SECURE_MSG_CDTMENUGROUP_NU_ORDER_REQUIRED', 'Orden requerido', true);
define('CDT_SECURE_MSG_CDTMENUGROUP_NU_WIDTH_REQUIRED', 'Ancho requerido', true);
define('CDT_SECURE_MSG_CDTMENUGROUP_DS_NAME_REQUIRED', 'Nombre requerido', true);
define('CDT_SECURE_MSG_CDTMENUGROUP_DS_ACTION_REQUIRED', 'Acci�n requerida', true);
define('CDT_SECURE_MSG_CDTMENUGROUP_DS_CSSCLASS_REQUIRED', 'Estilo requerido', true);

//t�tulos de las actions
define('CDT_SECURE_MSG_CDTMENUOPTION_TITLE_LIST', 'Listar Opciones de Men�', true);
define('CDT_SECURE_MSG_CDTMENUOPTION_TITLE_ADD', 'Agregar Opci�n de Men�', true);
define('CDT_SECURE_MSG_CDTMENUOPTION_TITLE_UPDATE', 'Modificar Opci�n de Men�', true);
define('CDT_SECURE_MSG_CDTMENUOPTION_TITLE_VIEW', 'Visualizar Opci�n de Men�', true);

define('CDT_SECURE_MSG_CDTMENUOPTION_CD_MENUOPTION_REQUIRED', 'C�digo requerido', true);
define('CDT_SECURE_MSG_CDTMENUOPTION_DS_NAME_REQUIRED', 'Nombre requerido', true);
define('CDT_SECURE_MSG_CDTMENUOPTION_DS_HREF_REQUIRED', 'Href requerido', true);
define('CDT_SECURE_MSG_CDTMENUOPTION_CD_FUNCTION_REQUIRED', 'Funci�n requerida', true);
define('CDT_SECURE_MSG_CDTMENUOPTION_NU_ORDER_REQUIRED', 'Orden requerido', true);
define('CDT_SECURE_MSG_CDTMENUOPTION_CD_MENUGROUP_REQUIRED', 'Grupo de Men� requerido', true);
define('CDT_SECURE_MSG_CDTMENUOPTION_DS_CSSCLASS_REQUIRED', 'Estilo requerido', true);
define('CDT_SECURE_MSG_CDTMENUOPTION_DS_DESCRIPTION_REQUIRED', 'Descripci�n requerida', true);

//t�tulos de las actions
define('CDT_SECURE_MSG_CDTREGISTRATION_TITLE_LIST', 'Listar Registraciones', true);
define('CDT_SECURE_MSG_CDTREGISTRATION_TITLE_ADD', 'Agregar Registraci�n', true);
define('CDT_SECURE_MSG_CDTREGISTRATION_TITLE_UPDATE', 'Modificar Registraci�n', true);
define('CDT_SECURE_MSG_CDTREGISTRATION_TITLE_VIEW', 'Visualizar Registraci�n', true);

define('CDT_SECURE_MSG_CDTREGISTRATION_CD_REGISTRATION_REQUIRED', 'C�digo requerido', true);
define('CDT_SECURE_MSG_CDTREGISTRATION_DS_ACTIVATIONCODE_REQUIRED', 'C�digo de activaci�n requerido', true);
define('CDT_SECURE_MSG_CDTREGISTRATION_DT_DATE_REQUIRED', 'Fecha requerida', true);
define('CDT_SECURE_MSG_CDTREGISTRATION_DS_USERNAME_REQUIRED', 'Nombre de usuario requerido', true);
define('CDT_SECURE_MSG_CDTREGISTRATION_DS_NAME_REQUIRED', 'Nombre requerido', true);
define('CDT_SECURE_MSG_CDTREGISTRATION_DS_EMAIL_REQUIRED', 'E-mail requerido', true);
define('CDT_SECURE_MSG_CDTREGISTRATION_DS_PASSWORD_REQUIRED', 'Password requerido', true);
define('CDT_SECURE_MSG_CDTREGISTRATION_DS_PHONE_REQUIRED', 'Tel�fono requerido', true);
define('CDT_SECURE_MSG_CDTREGISTRATION_DS_ADDRESS_REQUIRED', 'Domicilio requerido', true);

//t�tulos de las actions
define('CDT_SECURE_MSG_CDTUSER_TITLE_LIST', 'Listar Usuarios', true);
define('CDT_SECURE_MSG_CDTUSER_TITLE_ADD', 'Agregar Usuario', true);
define('CDT_SECURE_MSG_CDTUSER_TITLE_UPDATE', 'Modificar Usuario', true);
define('CDT_SECURE_MSG_CDTUSER_TITLE_VIEW', 'Visualizar Usuario', true);
define('CDT_SECURE_MSG_CDTUSERPROFILE_TITLE_UPDATE', 'Actualizar mi cuenta', true);
define('CDT_SECURE_MSG_CDTUSER_TITLE_VIEW_NEW', 'Nuevo Usuario', true);

define('CDT_SECURE_MSG_CDTUSER_CD_USER_REQUIRED', 'C�digo requerido', true);
define('CDT_SECURE_MSG_CDTUSER_DS_USERNAME_REQUIRED', 'Nombre de usuario requerido', true);
define('CDT_SECURE_MSG_CDTUSER_DS_USERNAME_DUPLICATED', 'Nombre de usuario duplicado', true);
define('CDT_SECURE_MSG_CDTUSER_DS_NAME_REQUIRED', 'Nombre requerido', true);
define('CDT_SECURE_MSG_CDTUSER_DS_EMAIL_REQUIRED', 'E-mail requerido', true);
define('CDT_SECURE_MSG_CDTUSER_DS_EMAIL_DUPLICATED', 'E-mail duplicado', true);
define('CDT_SECURE_MSG_CDTUSER_DS_PASSWORD_REQUIRED', 'Password requerido', true);
define('CDT_SECURE_MSG_CDTUSER_CD_USERGROUP_REQUIRED', 'Grupo de Usuario requerido', true);
define('CDT_SECURE_MSG_CDTUSER_DS_PHONE_REQUIRED', 'Tel�fono requerido', true);
define('CDT_SECURE_MSG_CDTUSER_DS_ADDRESS_REQUIRED', 'Domicilio requerido', true);

define('CDT_SECURE_MSG_CDTUSER_NEW_USER_PASSWORD', 'Debe anotar y enviar la clave generada al nuevo usuario: <b>$1 / $2</b>', true);

//t�tulos de las actions
define('CDT_SECURE_MSG_CDTUSERGROUP_TITLE_LIST', 'Listar Grupos de Usuario', true);
define('CDT_SECURE_MSG_CDTUSERGROUP_TITLE_ADD', 'Agregar Grupo de Usuario', true);
define('CDT_SECURE_MSG_CDTUSERGROUP_TITLE_UPDATE', 'Modificar Grupo de Usuario', true);
define('CDT_SECURE_MSG_CDTUSERGROUP_TITLE_VIEW', 'Visualizar Grupo de Usuario', true);

define('CDT_SECURE_MSG_CDTUSERGROUP_CD_USERGROUP_REQUIRED', 'C�digo requerido', true);
define('CDT_SECURE_MSG_CDTUSERGROUP_DS_USERGROUP_REQUIRED', 'Grupo de Usuario requerido', true);

define('CDT_SECURE_MSG_USERGROUPFUNCTION_TITLE_ASSIGN', 'Grupo de Usuario / Asignar funciones', true);

//t�tulos de las actions
define('CDT_SECURE_MSG_CDTUSERGROUPFUNCTION_TITLE_LIST', 'Listar Funciones del Grupo de usuario', true);
define('CDT_SECURE_MSG_CDTUSERGROUPFUNCTION_TITLE_ADD', 'Agregar Funci�n del Grupo de Usuario', true);
define('CDT_SECURE_MSG_CDTUSERGROUPFUNCTION_TITLE_UPDATE', 'Modificar Funci�n del Grupo de Usuario', true);
define('CDT_SECURE_MSG_CDTUSERGROUPFUNCTION_TITLE_VIEW', 'Visualizar Funci�n del Grupo de Usuario', true);

define('CDT_SECURE_MSG_CDTUSERGROUPFUNCTION_CD_USERGROUP_FUNCTION_REQUIRED', 'C�digo requerido', true);
define('CDT_SECURE_MSG_CDTUSERGROUPFUNCTION_CD_USERGROUP_REQUIRED', 'Grupo de Usuario requerido', true);
define('CDT_SECURE_MSG_CDTUSERGROUPFUNCTION_CD_FUNCTION_REQUIRED', 'Funci�n requerida', true);

define('CDT_SECURE_LBL_USERGROUP_FUNCTIONS_EDIT', 'Asignar Funciones', true);

include ('messages_labels_es.php');
?>
