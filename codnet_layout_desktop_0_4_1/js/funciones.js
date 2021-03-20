/* 
 *  SCRIPTS para ELECNOR.
 *  
 *	Las funciones dentro del script est�n ordenadas alfab�ticamente:  
 *  
 *  function confirmaEliminar(cartel, a, href);
 *  function evaluar(onComplete);
 *  function esperar(elementId);
 *  function listartodos();
 *  function listar_todos();
 *  function mensajeErrorEliminar(mensaje);
 *  function popUp(a);
 *  function popUpGrande(a);
 *  function seleccionarContratista(cd_trabajadorObra, ds_nombre);
 *  function seleccionarCuadrilla(cd_trabajadorObra, ds_responsable, nu_numero);
 *  function seleccionarObra(cd_obra, ds_obra);
 *  function seleccionarProducto(cd_producto, ds_numero, ds_producto, ds_cantidad, cd_tipoProducto, nu_cantidad);
 *  function seleccionarProductoEnOpener(cd_producto, ds_numero, ds_producto, ds_cantidad, cd_tipoProducto, nu_cantidad);
 *  function seleccionarTipoProducto(cd_tipoProducto, ds_codigoSAP, ds_tipoProducto, ds_unidadMedida);
 *  function submit_self(accion);
 *  function submit_blank(accion);
 *  function verificarFiltro();
 *  
 */

/** ****************** A ************************* */

/** ****************** B ************************* */

/** ****************** C ************************* */

/**
 * di�logo de confirmaci�n.
 * 
 * @param cartel -
 *            mensaje de confirmaci�n.
 * @param a -
 *            tag a html al cual se le setea el link en caso de confirmaci�n.
 * @param hred -
 *            link en caso de confirmaci�n.
 */
function confirmaEliminar(cartel, a, href) {

	jConfirm(cartel, 'Confirmación', function(r) {
		if (r) {
			a.href = href;
			window.location = href;
			return true;
		} else {
			return false;
		}
	});
}

/** ****************** D ************************* */
function deshabilitarNuMotor() {
	document.getElementById('nu_motor').className = "";
	document.getElementById('nu_cuadro').style['border-color'] = "none";
	document.getElementById('nu_cuadro').style['background-color'] = "none";
	document.getElementById('nu_motor').disabled = true
	if (document.getElementById('nu_motorrequired_msg') != null) {
		document.getElementById('nu_motorrequired_msg').innerHTML = "";
	}
	exValidatorA.initialize('altaunidadmovimiento', exValidatorA.options);
}

function deshabilitarNuCuadro() {
	document.getElementById('nu_cuadro').className = "";
	document.getElementById('nu_cuadro').style['border-color'] = "none";
	document.getElementById('nu_cuadro').style['background-color'] = "none";
	document.getElementById('nu_cuadro').disabled = true
	if (document.getElementById('nu_cuadrorequired_msg') != null) {
		document.getElementById('nu_cuadrorequired_msg').innerHTML = "";
	}
	exValidatorA.initialize('altaunidadmovimiento', exValidatorA.options);
}

/** ****************** E ************************* */

/**
 * se eval�a la funci�n "onComplete" en el opener
 * 
 * @param onComplete
 *            funci�n a evaluar en el opener.
 * @return
 */
function evaluar(onComplete) {
	if (onComplete != null && onComplete != '')
		window.opener.eval(onComplete);
}

/**
 * se muestra la imagen de espera en el element html dado
 * 
 * @param elementId
 *            id del elemento html donde se mostrar� la imagen de espera.
 * @return
 */
function esperar(elementId) {
	document.getElementById(elementId).innerHTML = "<center><img src='../img/ajax-loader.gif' title='cargando...' alt='cargando...' /> </center>";
}

/** ****************** G ************************* */

/** ****************** H ************************* */

/** ****************** L ************************* */

/**
 * funci�n para listar todos los elementos en un listado.
 */
function listartodos() {
	formu = document.getElementById('validar').value = "false";
	document.getElementById('campoFiltro').selectedIndex = 0;
	document.getElementById('filtro').value = "";
}

function listar_todos_ventas() {
	document.getElementById('cd_sucursal').selectedIndex = 0;
	document.getElementById('cd_usuario').selectedIndex = 0;
	document.getElementById('cd_cliente').selectedIndex = 0;
	document.getElementById('dt_desde').value = "";
	document.getElementById('dt_hasta').value = "";
}
/**
 * funci�n para listar todos los elementos en un listado.
 */
function listar_todos(action) {
	document.getElementById('validar').value = "false";
	document.getElementById('campoFiltro').selectedIndex = 0;
	document.getElementById('filtro').value = "";
	if (action == 'listar_movimientos') {
		document.getElementById('cd_usuario').selectedIndex = 0;
	}
	if (action == 'listar_unidades') {
		document.getElementById('autorizada').checked = false;
		document.getElementById('sinautorizar').checked = false;
	}
	if (action == 'listar_ventas') {
		listar_todos_ventas();
	}
	submit_self(action);
}

function listar_todas_unidades(action, formName) {
	document.getElementById('validar').value = "false";
	document.getElementById('campoFiltro').selectedIndex = 0;
	document.getElementById('cd_producto').selectedIndex = 0;
	document.getElementById('filtro').value = "";
	if (document.getElementById('autorizada') != undefined) {
		document.getElementById('autorizada').checked = false;
	}
	if (document.getElementById('sinautorizar') != undefined) {
		document.getElementById('sinautorizar').checked = false;
	}
	submit_self(action, formName);
}

/** ****************** M ************************* */

/**
 * mensaje de error formateado con sexy alert.
 * 
 * @param mensaje -
 *            mensaje de error a mostrar
 */
function mensajeError(mensaje) {
	jAlert("<strong>Error</strong><br/><br/><br/>" + mensaje);
}

/**
 * mensaje de error formateado con sexy alert.
 * 
 * @param mensaje -
 *            mensaje de error a mostrar
 */
function mensajeErrorEliminar(mensaje) {
	jAlert("<strong>Eliminar</strong><br/><br/><br/>" + mensaje);
}


/** ****************** P ************************* */

/**
 * pop up est�ndar de 750x500
 * 
 * @param a -
 *            tag a html con el link para abrir el popup
 */
function popUp(a) {
	window.open(a.href, a.target,
			'width=750,height=500, ,location=center, scrollbars=YES');
	return false;
}

/**
 * pop up grande de 1024x500
 * 
 * @param a -
 *            tag a html con el link para abrir el popup
 */
function popUpGrande(a) {
	window.open(a.href, a.target,
			'width=1024,height=500, ,location=center, scrollbars=YES');
	return false;

}
/** ****************** S ************************* */


/**
 * setea el valor a un input
 * 
 * @param input
 *            input a setear el valor
 * @param value
 *            valor a setear
 * @param setFocus
 *            si pasamos 1, le da el foco al input.
 * @return
 */
function setearInput(input, value, setFocus) {
	if (input != null) {
		input.value = value;
		if (setFocus == 1) {
			input.focus();
		}
	}
}

function submit_self(accion, formName) {
	if (formName == 'undefined' || formName == null)
		formName = 'buscar';
	var form = document.forms[formName];
	form.accion.value = accion;
	form.target = '_self';
	form.submit();
}

function submit_blank(accion, formName) {
	if (formName == 'undefined' || formName == null)
		formName = 'buscar';

	var form = document.forms[formName];
	input = document.getElementById('validar');
	if (input != null)
		input.value = "false";
	form.accion.value = accion;
	form.target = '_blank';
	form.submit();
}

/** ****************** V ************************* */

/**
 * se verifica si se ingres� un criterio de b�squeda en las ventas de
 * listados.
 */
function verificarFiltro() {
	if (document.getElementById('filtro').value == "") {
		if (document.getElementById('validar').value == "true") {
			jAlert("Se debe ingresar un criterio de b&uacute;queda");
			return false;
		}
	}
	return true;
}
