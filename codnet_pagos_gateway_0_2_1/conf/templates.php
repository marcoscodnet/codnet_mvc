<?php
/**
 * se definen los nombres de los templates
 * del módulo cdt_pagos_gateway.
 * 
 * @author bernardo
 * @since 10-08-2011
 * 
 */

define('CDT_PAGOS_GATEWAY_TEMPLATE_PAYPAL_SUCCESS', CDT_PAGOS_GATEWAY_PATH . 'view/templates/paypal/success.html', true);
define('CDT_PAGOS_GATEWAY_TEMPLATE_PAYPAL_CANCELED', CDT_PAGOS_GATEWAY_PATH . 'view/templates/paypal/canceled.html', true);
define('CDT_PAGOS_GATEWAY_TEMPLATE_PAYPAL_ERROR', CDT_PAGOS_GATEWAY_PATH . 'view/templates/paypal/error.html', true);

//estados de pago
define('CDT_PAGOS_GATEWAY_TEMPLATE_EDITAR_ESTADOPAGO', CDT_PAGOS_GATEWAY_PATH . 'view/templates/estadospago/editar_estadopago.html');
define('CDT_PAGOS_GATEWAY_TEMPLATE_VER_ESTADOPAGO', CDT_PAGOS_GATEWAY_PATH . 'view/templates/estadospago/ver_estadopago.html');
define('CDT_PAGOS_GATEWAY_TEMPLATE_BAJA_ESTADOPAGO', CDT_PAGOS_GATEWAY_PATH . 'view/templates/estadospago/eliminar_estadopago.html');

//pagos
define('CDT_PAGOS_GATEWAY_TEMPLATE_EDITAR_PAGO', CDT_PAGOS_GATEWAY_PATH . 'view/templates/pagos/editar_pago.html');
define('CDT_PAGOS_GATEWAY_TEMPLATE_VER_PAGO', CDT_PAGOS_GATEWAY_PATH . 'view/templates/pagos/ver_pago.html');
define('CDT_PAGOS_GATEWAY_TEMPLATE_BAJA_PAGO', CDT_PAGOS_GATEWAY_PATH . 'view/templates/pagos/eliminar_pago.html');

//paypaltx
define('CDT_PAGOS_GATEWAY_TEMPLATE_EDITAR_PAYPALTX', CDT_PAGOS_GATEWAY_PATH . 'view/templates/paypaltxs/editar_paypaltx.html');
define('CDT_PAGOS_GATEWAY_TEMPLATE_VER_PAYPALTX', CDT_PAGOS_GATEWAY_PATH . 'view/templates/paypaltxs/ver_paypaltx.html');
define('CDT_PAGOS_GATEWAY_TEMPLATE_BAJA_PAYPALTX', CDT_PAGOS_GATEWAY_PATH . 'view/templates/paypaltxs/eliminar_paypaltx.html');

?>