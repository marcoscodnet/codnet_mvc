<?php

include_once('templates.php');


//layout segurizado (implementa interface SecureLayout).
define ( 'DEFAULT_SECURE_LAYOUT', 'LayoutDesktopMenu', true );

//layout que utilizan las acciones que muestran un panel de control.
define ( 'DEFAULT_PANEL_LAYOUT', 'LayoutDesktopPanel', true );

//layout que utilizan las acciones comunes.
define ( 'DEFAULT_LAYOUT', 'LayoutDesktop', true );

//layout para el login.
define ( 'DEFAULT_LOGIN_LAYOUT', 'LayoutDesktopLogin', true );

//layout para los popups.
define ( 'DEFAULT_POPUP_LAYOUT', 'LayoutDesktopPopup', true );

//template para los listados.
define ( 'DEFAULT_LISTAR_TEMPLATE', CDT_LAYOUT_DESKTOP_TEMPLATE_LISTAR, true );
define ( 'DEFAULT_BUSCAR_TEMPLATE', CDT_LAYOUT_DESKTOP_TEMPLATE_SELECCIONAR, true );


?>