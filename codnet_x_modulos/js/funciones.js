/* 
 *  SCRIPTS.
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

	jConfirm(cartel, 'Confirmaci&oacute;n', function(r) {
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

/** ****************** E ************************* */

/**
 * se eval�a la funci�n "onComplete" en el opener
 * @param onComplete funci�n a evaluar en el opener.
 * @return
 */
function evaluar(onComplete){
	if(onComplete!=null && onComplete!='')
		window.opener.eval(onComplete);
}

/**
 * se muestra la imagen de espera en el element html dado
 * @param elementId id del elemento html donde se mostrar� la imagen de espera.
 * @return
 */
function esperar(elementId){
	document.getElementById(elementId).innerHTML = "<center><img src='../img/ajax-loader.gif' title='cargando...' alt='cargando...' /> </center>";
}

/** ****************** G ************************* */

/** ****************** H ************************* */

/** ****************** J ************************* */

function jQuery_confirm(msj) {
	var dialogOpts = {
		title : "",
		modal : true,
		autoOpen : false,
		bgiframe : true,
		buttons : {
			"Si" : function() {
				return true;
			},
			"No" : function() {
				return false;
			}
		},
		height : 200,
		width : 300,
		open : function() {
			jQuery("#ui-dialog").load(url);
		}
	};
	jQuery("#ui-dialog").children().remove();
	jQuery("#ui-dialog").dialog("destroy");
	jQuery("#ui-dialog").dialog(dialogOpts);
	jQuery("#ui-dialog").dialog("open");
}

/** ****************** L ************************* */

/**
 * funci�n para listar todos los elementos en un listado.
 */
function listartodos() {
	formu = document.getElementById('validar').value = "false";
	document.getElementById('campoFiltro').selectedIndex = 0;
	document.getElementById('filtro').value = "";
}

/**
 * funci�n para listar todos los elementos en un listado.
 */
function listar_todos(action) {
	document.getElementById('validar').value = "false";
	document.getElementById('campoFiltro').selectedIndex = 0;
	document.getElementById('filtro').value = "";
	submit_self(action);
}

/** ****************** M ************************* */

/**
 * mensaje de error formateado con sexy alert.
 * @param mensaje - mensaje de error a mostrar
 */
function mensajeError(mensaje) {
	jAlert("<strong>Error</strong><br/><br/><br/>" + mensaje);
}

/**
 * mensaje de error formateado con sexy alert.
 * @param mensaje - mensaje de error a mostrar
 */
function mensajeErrorEliminar(mensaje) {
	jAlert("<strong>Eliminar</strong><br/><br/><br/>" + mensaje);
}

/** ****************** P ************************* */

/**
 * pop up est�ndar de 750x500
 * @param a - tag a html con el link para abrir el popup
 */
function popUp(a) {
	window.open(a.href, a.target,
			'width=750,height=500, ,location=center, scrollbars=YES');
	return false;
}

/**
 * pop up grande de 1024x500
 * @param a - tag a html con el link para abrir el popup
 */
function popUpGrande(a) {
	window.open(a.href, a.target,
			'width=1024,height=500, ,location=center, scrollbars=YES');
	return false;

}
/** ****************** S ************************* */

/* 
 * Las siguientes funciones "seleccionarXYZ" son invocadas desde los
 * popups de selecci�n de entidades. 
 * Se utilizan para llenar los inputs del opener con la informaci�n
 * del elemento seleccionado.
 */

/**
 * funci�n llamada en el popup de "seleccionar un contratista".
 * Notar que el opener debe tener los siguientes inputs:
 *       - cd_contratista
 *       - ds_nombre
 * @param cd_trabajadorObra identificador del contratista
 * @param ds_nombre nombre del contratista
 * @param onComplete funci�n a evaluar una vez seleccionado el contratista.
 * 
 */
function seleccionarContratista(cd_trabajadorObra, ds_nombre, onComplete) {
	
	setearInput( window.opener.document.getElementById('cd_contratista') , cd_trabajadorObra );
	setearInput( window.opener.document.getElementById('ds_nombre'), ds_nombre );

	evaluar(onComplete);
	
	window.close();
}

/**
 * funci�n llamada en el popup de "seleccionar un cuadrilla".
 * Notar que el opener debe tener los siguientes inputs:
 *       - cd_cuadrilla
 *       - ds_responsable
 *       - nu_numero
 * @param cd_trabajadorObra identificador de la cuadrilla
 * @param ds_responsable responsable de la cuadrilla
 * @param nu_numero n�mero de cuadrilla
 * @param onComplete funci�n a evaluar una vez seleccionada la cuadrilla.
 * 
 */
function seleccionarCuadrilla(cd_trabajadorObra, ds_responsable, nu_numero, onComplete) {
	setearInput( window.opener.document.getElementById('cd_cuadrilla'), cd_trabajadorObra );
	setearInput( window.opener.document.getElementById('ds_responsable'), ds_responsable );
	setearInput( window.opener.document.getElementById('nu_numero'), nu_numero );
	evaluar(onComplete);
	window.close();
}

/**
 * funci�n llamada en el popup de "seleccionar una obra".
 * Notar que el opener debe tener los siguientes inputs:
 *       - cd_obra
 *       - ds_obra
 * @param cd_obra identificador de la obra
 * @param ds_obra descripci�n de la obra
 * @param onComplete funci�n a evaluar una vez seleccionada la obra.
 */
function seleccionarObra(cd_obra, ds_obra, onComplete) {
	setearInput( window.opener.document.getElementById('cd_obra'), cd_obra, 1 );
	setearInput( window.opener.document.getElementById('ds_obra'), ds_obra );
	evaluar(onComplete);
	window.close();
}

/**
 * funci�n llamada en el popup de "seleccionar un producto".
 * Notar que el opener debe tener los siguientes inputs:
 *       - ds_numero
 *       - cd_producto
 *       - cd_productoSelected
 *       - cd_tipoProducto
 *       - ds_producto
 * @param cd_producto identificador del producto
 * @param ds_numero n�mero de producto
 * @param ds_producto descripci�n del producto
 * @param ds_cantidad descripci�n de la cantidad del producto
 * @param cd_tipoProducto identificar del tipo de producto asociado al producto
 * @param nu_cantidad cantidad del producto
 * @param onComplete funci�n a evaluar una vez seleccionado el producto.
 */
function seleccionarProducto(cd_producto, ds_numero, ds_producto, ds_cantidad,
		cd_tipoProducto, nu_cantidad, onComplete) {

	setearInput( window.opener.document.getElementById('ds_numero'), ds_numero );
	setearInput( window.opener.document.getElementById('cd_producto'), cd_producto );
	setearInput( window.opener.document.getElementById('codigo'), cd_producto );
	setearInput( window.opener.document.getElementById('cd_productoSelected'), cd_producto );
	setearInput( window.opener.document.getElementById('cd_tipoProducto'), cd_tipoProducto );
	setearInput( window.opener.document.getElementById('ds_producto'), ds_producto );

	input = window.opener.document.getElementById('cantidad');
	if (input != null)
		input.innerHTML = 'Cantidad disponible: ' + ds_cantidad;

	setearInput( window.opener.document.getElementById('nu_cantidad'), nu_cantidad );
	setearInput( window.opener.document.getElementById('nu_cantidadRetirar'), nu_cantidad );
	evaluar(onComplete);
	window.close();
}

/**
 * funci�n llamada en el popup de "seleccionar un producto" cuando
 * se invoca indicando que el opener se encargar� de mostrar la informaci�n
 * del producto seleccionado.
 * Notar que el opener debe definir la funci�n setearProducto(...).
 * @param cd_producto identificador del producto
 * @param ds_numero n�mero de producto
 * @param ds_producto descripci�n del producto
 * @param ds_cantidad descripci�n de la cantidad del producto
 * @param cd_tipoProducto identificar del tipo de producto asociado al producto
 * @param nu_cantidad cantidad del producto
 * @param onComplete funci�n a evaluar una vez seleccionado el producto.
 */
function seleccionarProductoEnOpener(cd_producto, ds_numero, ds_producto,
		ds_cantidad, cd_tipoProducto, nu_cantidad, onComplete) {
	
	window.opener.setearProducto(cd_producto, ds_numero, ds_producto, ds_cantidad, cd_tipoProducto, nu_cantidad);
	evaluar(onComplete);
	window.close();
}

/**
 * funci�n llamada en el popup de "seleccionar un tipo de producto".
 * Notar que el opener debe tener los siguientes inputs:
 *       - cd_tipoProducto
 *       - ds_codigoSAP
 *       - ds_tipoProducto
 *       - ds_unidadMedida
 *       
 * @param cd_tipoProducto identificar del tipo de producto
 * @param ds_codigoSAP c�digo sap del tipo de producto
 * @param ds_tipoProducto descripci�n del tipo de producto
 * @param ds_unidadMedida descripci�n de la unidad de medida del tipo de producto
 * @param onComplete funci�n a evaluar una vez seleccionado el tipo de producto.
 */
function seleccionarTipoProducto(cd_tipoProducto, ds_codigoSAP,	ds_tipoProducto, ds_unidadMedida, onComplete) {
	setearInput( window.opener.document.getElementById('cd_tipoProducto'), cd_tipoProducto );
	setearInput( window.opener.document.getElementById('ds_codigoSAP'), ds_codigoSAP, 1 );
	setearInput( window.opener.document.getElementById('ds_tipoProducto'), ds_tipoProducto + ' - (' + ds_unidadMedida + ')' );
	evaluar(onComplete);
	window.close();
}

/**
 * setea el valor a un input
 * @param input input a setear el valor
 * @param value valor a setear
 * @param setFocus si pasamos 1, le da el foco al input.
 * @return
 */
function setearInput(input, value, setFocus){
	if(input!=null){
		input.value = value;
		if(setFocus==1){
			input.focus();
		}
	}
}

function submit_self(accion, formName){
	if( formName == 'undefined' || formName==null)
		formName = 'buscar';	
	var form = document.forms[formName];
	form.accion.value = accion;
	form.target = '_self';
	form.submit();		
}

function submit_blank(accion, formName){
	if( formName == 'undefined' || formName==null)
		formName = 'buscar';	
	
	
	var form = document.forms[formName];
	input = document.getElementById('validar');
	if(input!=null)
		input.value = "false";
	form.accion.value = accion;
	form.target = '_blank';
	form.submit();		
}

/** ****************** V ************************* */

/**
 * se verifica si se ingres� un criterio de
 * b�squeda en las ventas de listados.
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

